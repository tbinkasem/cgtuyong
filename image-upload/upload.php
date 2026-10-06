<?php

date_default_timezone_set('Asia/Bangkok');

session_start();

require_once 'functions.php';

/**
 * ตรวจสอบว่ามีการส่งไฟล์มาหรือไม่
 */
if (!isset($_FILES['image'])) {

    $_SESSION['message'] = 'ไม่พบไฟล์ภาพที่อัปโหลด';
    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}


$file = $_FILES['image'];

/**
 * ตรวจสอบ Error จากการ Upload
 */
if ($file['error'] !== UPLOAD_ERR_OK) {

    $_SESSION['message'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * ตรวจสอบขนาดไฟล์ต้นฉบับ
 *
 * กำหนดไม่เกิน 10 MB
 */
$maxUploadSize = 10 * 1024 * 1024;

if ($file['size'] > $maxUploadSize) {

    $_SESSION['message'] =
        'ไฟล์ต้นฉบับมีขนาดเกิน 10 MB';

    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * ตรวจสอบว่าเป็นภาพจริงหรือไม่
 */
if (!isAllowedImage($file['tmp_name'])) {

    $_SESSION['message'] =
        'อนุญาตเฉพาะ JPG, JPEG, PNG และ WEBP เท่านั้น';

    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * ตรวจสอบข้อมูลภาพ
 */
$imageInfo = getimagesize($file['tmp_name']);

if ($imageInfo === false) {

    $_SESSION['message'] =
        'ไฟล์ที่อัปโหลดไม่ใช่ภาพที่ถูกต้อง';

    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * สร้าง Image Resource
 */
$image = createImageResource($file['tmp_name']);

if ($image === false) {

    $_SESSION['message'] =
        'ไม่สามารถประมวลผลภาพได้';

    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * ปรับขนาดภาพ
 *
 * จำกัดด้านยาวไม่เกิน 2048 px
 */
$image = resizeImage(
    $image,
    2048,
    2048
);

/**
 * สร้างโฟลเดอร์ปลายทาง
 */
// $uploadDirectory = __DIR__ . '/uploads/images/';
$uploadDirectory = __DIR__ . '../../photos/';

if (!is_dir($uploadDirectory)) {

    mkdir(
        $uploadDirectory,
        0755,
        true
    );
}

/**
 * สร้างชื่อไฟล์ใหม่
 */

// $fileName = generateFileName('jpg');
$fileName = date("YmdHis")."_teera".".jpg";

$destination = $uploadDirectory . $fileName;

/**
 * บีบอัดภาพจนไม่เกิน 1 MB
 */
$result = compressImageToOneMB(
    $image,
    $destination
);

/**
 * ปล่อย Memory
 */
imagedestroy($image);

if (!$result) {

    $_SESSION['message'] =
        'ไม่สามารถลดขนาดภาพให้ไม่เกิน 1 MB ได้';

    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * ตรวจสอบขนาดไฟล์สุดท้ายอีกครั้ง
 */
$finalSize = filesize($destination);

if ($finalSize > MAX_OUTPUT_SIZE) {

    unlink($destination);

    $_SESSION['message'] =
        'ไฟล์ภาพหลังบีบอัดยังมีขนาดเกิน 1 MB';

    $_SESSION['message_type'] = 'error';

    header('Location: index.php');
    exit;
}

/**
 * แปลงขนาดเป็น KB
 */
$finalSizeKB = round(
    $finalSize / 1024,
    2
);

/**
 * แสดงผลสำเร็จ
 */
$_SESSION['message'] =
    'อัปโหลดสำเร็จ ขนาดไฟล์หลังบีบอัด ' .
    $finalSizeKB .
    ' KB';

$_SESSION['message_type'] = 'success';

header('Location: index.php');

exit;

?>
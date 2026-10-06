<?php

/**
 * ขนาดไฟล์สูงสุดหลังบีบอัด
 * 1 MB = 1,048,576 bytes
 */
define('MAX_OUTPUT_SIZE', 1048576);


/**
 * สร้างชื่อไฟล์ใหม่แบบสุ่ม
 */
function generateFileName($extension)
{
    return bin2hex(random_bytes(16)) . '.' . $extension;
}


/**
 * ตรวจสอบ MIME Type ของภาพ
 */
function isAllowedImage($tmpFile)
{
    $allowedMime = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    $mime = mime_content_type($tmpFile);

    return in_array($mime, $allowedMime);
}


/**
 * อ่านข้อมูลภาพ
 */
function createImageResource($file)
{
    $mime = mime_content_type($file);

    switch ($mime) {

        case 'image/jpeg':
            return imagecreatefromjpeg($file);

        case 'image/png':
            return imagecreatefrompng($file);

        case 'image/webp':
            return imagecreatefromwebp($file);

        default:
            return false;
    }
}


/**
 * ปรับขนาดภาพ
 */
function resizeImage($source, $maxWidth, $maxHeight)
{
    $width  = imagesx($source);
    $height = imagesy($source);

    /**
     * หากภาพมีขนาดเล็กกว่า
     * ไม่ต้องขยายภาพ
     */
    if ($width <= $maxWidth && $height <= $maxHeight) {

        return $source;
    }

    $ratio = min(
        $maxWidth / $width,
        $maxHeight / $height
    );

    $newWidth  = (int)($width * $ratio);
    $newHeight = (int)($height * $ratio);

    $newImage = imagecreatetruecolor(
        $newWidth,
        $newHeight
    );

    /**
     * พื้นหลังสำหรับ PNG
     */
    imagealphablending($newImage, false);
    imagesavealpha($newImage, true);

    imagecopyresampled(
        $newImage,
        $source,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $width,
        $height
    );

    /**
     * ปิด resource เดิม
     */
    if ($source !== $newImage) {
        imagedestroy($source);
    }

    return $newImage;
}


/**
 * บันทึกภาพเป็น JPEG
 * และลด Quality จนกว่าจะไม่เกิน 1 MB
 */
function compressImageToOneMB($image, $destination)
{
    /**
     * Quality เริ่มต้น
     */
    $quality = 90;

    /**
     * ขั้นต่ำที่ยอมให้ Quality ลดลง
     */
    $minQuality = 30;

    /**
     * สร้างไฟล์ชั่วคราว
     */
    $tempFile = tempnam(
        sys_get_temp_dir(),
        'img_'
    );

    while ($quality >= $minQuality) {

        imagejpeg(
            $image,
            $tempFile,
            $quality
        );

        $fileSize = filesize($tempFile);

        /**
         * ถ้าไฟล์ไม่เกิน 1 MB
         * ถือว่าสำเร็จ
         */
        if ($fileSize <= MAX_OUTPUT_SIZE) {

            if (!copy($tempFile, $destination)) {

                unlink($tempFile);

                return false;
            }

            unlink($tempFile);

            return true;
        }

        /**
         * ลด Quality ลงครั้งละ 5
         */
        $quality -= 5;
    }

    /**
     * ไม่สามารถลดให้ต่ำกว่า 1 MB ได้
     */
    unlink($tempFile);

    return false;
}

?>
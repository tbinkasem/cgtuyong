<?php

    session_start();
    $user = $_SESSION["FullName"];
    $message = $_SESSION['message'] ?? '';
    $message_type = $_SESSION['message_type'] ?? '';

    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ระบบอัปโหลดภาพ</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <div class="upload-card">

            <div class="icon">
                📷
            </div>

            <h1>ระบบอัปโหลดภาพ</h1>

            <p class="description">
                ภาพจะถูกลดขนาดให้ไม่เกิน 1 MB ก่อนจัดเก็บ
            </p>

            <?php if ($message != ''): ?>

                <div class="message <?php echo htmlspecialchars($message_type); ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>

            <?php endif; ?>

            <form action="upload.php" method="POST" enctype="multipart/form-data">

                <div class="file-box">

                    <label for="image">
                        เลือกภาพที่ต้องการอัปโหลด
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        required>

                    <p>
                        รองรับ JPG, JPEG, PNG และ WEBP
                    </p>

                    <p>
                        ขนาดไฟล์ต้นฉบับไม่เกิน 10 MB
                    </p>

                </div>

                <button type="submit" class="upload-button">
                    อัปโหลดภาพ
                </button>
                <a href="../main_page.php" class="main-page-button">
                    กลับหน้าหลัก
                </a>

            </form>

        </div>

    </div>

</body>

</html>
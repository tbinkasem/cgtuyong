<?php

    session_start();
    $user = $_SESSION["FullName"];

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการข้อมูล</title>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- ================= HEADER ================= -->
    <header class="header">
        <div class="system-info">
            <div class="system-logo">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="system-title">
                <h1>ระบบข้อมูลกลุ่มภาวะพึ่งพิง</h1>
                <p>Dependency Group Information System: DGIS</p>
            </div>
        </div>
        <!-- ผู้ใช้งาน -->
        <div class="user-info">
            <div class="user-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-detail">
                <span class="login-label">
                    เข้าสู่ระบบโดย
                </span>
                <!-- สามารถเปลี่ยนเป็นชื่อจาก PHP ได้ภายหลัง -->
                <strong>
                    <?php echo $user; ?>
                </strong>
            </div>
        </div>
    </header>
    <!-- ================= MAIN ================= -->
    <main class="main-container">
        <!-- หัวข้อ -->
        <section class="welcome">
            <h2>
                ยินดีต้อนรับ
            </h2>
            <p>
                กรุณาเลือกเมนูที่ต้องการใช้งาน
            </p>
        </section>
        <!-- ================= MENU ================= -->
        <section class="menu-grid">
            <!-- 1. บัญชีผู้ใช้งาน -->
            <a href="member.php"
                class="menu-card menu-green">
                <div class="menu-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="menu-text">
                    <h3>บัญชีผู้ใช้งาน</h3>
                    <p>จัดการบัญชีผู้ใช้งาน</p>
                </div>
                <div class="arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
            <!-- 2. รายชื่อบุคคลภาวะพึงพิง -->
            <a href="people.php"
                class="menu-card menu-blue">

                <div class="menu-icon">
                    <i class="fa-solid fa-person"></i>
                </div>
                <div class="menu-text">
                    <h3>รายชื่อบุคคลภาวะพึงพิง</h3>
                    <p>จัดการข้อมูลบุคคล</p>
                </div>
                <div class="arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
            <!-- 3. รายการความต้องการ -->
            <a href="headgroup.php"
                class="menu-card menu-pink">
                <div class="menu-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="menu-text">
                    <h3>รายการความต้องการ</h3>
                    <p>จัดการรายการความต้องการ</p>
                </div>
                <div class="arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
            <!-- 4. ออกจากระบบ -->
            <a href="logout.php"
                class="menu-card menu-red">
                <div class="menu-icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div class="menu-text">
                    <h3>ออกจากระบบ</h3>
                    <p>สิ้นสุดการใช้งาน</p>
                </div>
                <div class="arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
        </section>
    </main>
    <!-- ================= FOOTER ================= -->
    <footer class="footer">
        <p>
            ©2026 ระบบข้อมูลกลุ่มภาวะพึ่งพิง
        </p>
    </footer>
</body>
</html>
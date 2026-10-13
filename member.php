<?php

    session_start();
    $user = $_SESSION["FullName"];
    $rol = $_SESSION["rol"];

    if($rol != "admin" ){

        session_start();
        $_SESSION = array();
        session_destroy();
        header("location: index.html");

    }

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>บันทึกข้อมูลผู้ใช้งาน</title>

    <!-- เชื่อมต่อไฟล์ CSS -->
    <link rel="stylesheet" href="css/member.css">
</head>

<body>

    <main class="form-card">

        <header class="form-header">
            <div class="icon">👤</div>
            <h2>บันทึกข้อมูลผู้ใช้งาน</h2>
            <p>กรุณากรอกข้อมูลผู้ใช้งานให้ครบถ้วน</p>
        </header>

        <form action="process_member.php" method="POST" autocomplete="on">

            <div class="form-group">
                <label for="user_id">
                    รหัสผู้ใช้งาน <span class="required">*</span>
                </label>
                <input type="text" id="user_id" name="user_id"
                    placeholder="ถ้าเป็น admin (Axxx) ถ้าผู้ใช้งาน (Uxxx) เช่น A999 / U999" required>
            </div>

            <div class="form-group">
                <label for="fullname">
                    ชื่อ-สกุล <span class="required">*</span>
                </label>
                <input type="text" id="fullname" name="fullname" placeholder="กรอกชื่อและนามสกุล" autocomplete="name"
                    required>
            </div>

            <div class="form-group">
                <label for="username">
                    ชื่อบัญชีผู้ใช้งาน
                    <span class="required">*</span>
                </label>
                <input type="text" id="username" name="username" placeholder="ใช้เลขบัตรประจำตัวประชาชน 13 หลัก"
                    autocomplete="username" required>
            </div>

            <div class="form-group">
                <label for="password">
                    รหัสผ่านการใช้งาน
                    <span class="required">*</span>
                </label>
                <input type="password" id="password" name="password"
                    placeholder="กรอกรหัสผ่านจำนวน 8 ตัว ควรใช้ตัวเลขผสมตัวอักษร" autocomplete="new-password" required>
            </div>

            <div class="form-group">
                <label for="position">
                    สถานะ/ตำแหน่ง
                    <span class="required">*</span>
                </label>

                <select id="position" name="position" required>
                    <option value="">-- เลือกสถานะ/ตำแหน่ง --</option>
                    <option value="admin">ผู้ดูแลระบบ</option>
                    <option value="user">ผู้ใช้งานทั่วไป</option>
                </select>
            </div>


            <div class="button-group">
                <button type="submit" class="btn btn-submit">
                    ✓ ส่งข้อมูล
                </button>

                <a href="admin_page.php" class="btn btn-home">
                    ← กลับหน้าหลัก
                </a>
            </div>

        </form>

    </main>

</body>

</html>
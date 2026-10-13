<?php

session_start();
$user = $_SESSION["FullName"];
$rol = $_SESSION["rol"];

if ($rol != "admin") {

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

    <title>บันทึกข้อมูลบุคคลภาวะพึ่งพิง</title>

    <link rel="stylesheet" href="css/people.css">
</head>

<body>

    <main class="page-container">
        <section class="form-card">

            <header class="form-header">
                <div class="header-icon">♥</div>

                <h1>บันทึกข้อมูลบุคคลภาวะพึ่งพิง</h1>

                <p>กรุณากรอกข้อมูลบุคคลให้ครบถ้วน</p>
            </header>

            <form action="save_dependent.php" method="POST">

                <div class="form-group">
                    <label for="fullname">ชื่อ-สกุล</label>
                    <input type="text" id="fullname" name="fullname" placeholder="กรอกชื่อและนามสกุล"
                        autocomplete="name" required>
                </div>

                <div class="form-group">
                    <label for="age">อายุ (ปี)</label>
                    <input type="number" id="age" name="age" placeholder="ระบุอายุ" min="0" max="130" required>
                </div>

                <div class="form-group">
                    <label for="address">ที่อยู่ปัจจุบัน</label>
                    <textarea id="address" name="address" rows="3" placeholder="บ้านเลขที่ หมู่ที่ ตำบล อำเภอ จังหวัด"
                        required></textarea>
                </div>


                <!-- ความต้องการ -->
                <div class="form-group">
                    <label>ความต้องการ (เลือกได้มากกว่า 1 รายการ)</label>

                    <div class="needs-checkbox">

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="อาหารและเครื่องดื่ม">
                            <span>ผ้าอ้อมสำหรับเด็ก ขนาด S</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="อาหารและเครื่องดื่ม">
                            <span>ผ้าอ้อมสำหรับเด็ก ขนาด M</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="อาหารและเครื่องดื่ม">
                            <span>ผ้าอ้อมสำหรับเด็ก ขนาด L</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="เสื้อผ้าและเครื่องนุ่งห่ม">
                            <span>แผ่นรองซับ</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="ยาและเวชภัณฑ์">
                            <span>แพมเพิร์ส ขนาด S</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="ยาและเวชภัณฑ์">
                            <span>แพมเพิร์ส ขนาด M</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="ยาและเวชภัณฑ์">
                            <span>แพมเพิร์ส ขนาด L</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="ยาและเวชภัณฑ์">
                            <span>แพมเพิร์ส ขนาด XL</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="ยาและเวชภัณฑ์">
                            <span>แพมเพิร์ส ขนาด 2XL</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="การดูแลสุขภาพ">
                            <span>อาหารเสริม ยี่ห้อ Ensure</span>
                        </label>

                        <label class="checkbox-item">
                            <input type="checkbox" name="needs[]" value="การดูแลสุขภาพ">
                            <span>อาหารเสริม ยี่ห้อ Blendera</span>
                        </label>


                        <!-- ความต้องการอื่น ๆ -->
                        <label class="checkbox-item other-checkbox">
                            <input type="checkbox" id="other_needs_check">

                            <span>อื่น ๆ</span>

                            <input type="text" id="other_needs_detail" name="needs[]"
                                class="other-needs-input" placeholder="ระบุความต้องการ" maxlength="150"
                                aria-label="รายละเอียดความต้องการอื่น ๆ">
                        </label>

                    </div>
                </div>

                <div class="form-group">
                    <label for="caregiver_code">
                        รหัสผู้ดูแล (อสม.)
                    </label>

                    <input type="text" id="caregiver_code" name="caregiver_code" placeholder="กรอกรหัสผู้ดูแล" required>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-submit">
                        <span aria-hidden="true">➤</span>
                        ส่งข้อมูล
                    </button>

                    <a href="main_page.php" class="btn btn-back">
                        ← กลับหน้าหลัก
                    </a>
                </div>

            </form>

            <footer class="form-footer">
                ระบบบันทึกข้อมูลเพื่อการดูแลและช่วยเหลือ
            </footer>

        </section>
    </main>

</body>

</html>
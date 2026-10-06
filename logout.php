<?php

// เริ่มต้น Session
session_start();

// ล้างข้อมูล Session
$_SESSION = array();

// ทำลาย Session
session_destroy();

?>

<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>ออกจากระบบ</title>


    <!-- Google Font -->
    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap"
        rel="stylesheet">


    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- CSS -->
    <link rel="stylesheet"
        href="css/logout.css">

</head>


<body>


    <!-- ==============================
         LOGOUT CARD
    =============================== -->

    <div class="logout-card">


        <!-- Success Icon -->

        <div class="success-icon">

            <i class="fa-solid fa-check"></i>

        </div>


        <!-- Title -->

        <h1>
            ออกจากระบบสำเร็จ
        </h1>


        <!-- Message -->

        <p class="message">
            คุณได้ออกจากระบบเรียบร้อยแล้ว
        </p>


        <!-- Redirect Message -->

        <p class="redirect-message">

            รอสักครู่ ระบบกำลังกลับไปยังหน้าหลัก

            <span class="countdown"
                id="countdown">
                3
            </span>

        </p>


        <!-- Progress Bar -->

        <div class="progress-container">

            <div class="progress-bar"></div>

        </div>


    </div>



    <!-- ==============================
         REDIRECT SCRIPT
    =============================== -->

    <script>
        let seconds = 3;

        const countdown =
            document.getElementById("countdown");


        // Countdown

        const timer =
            setInterval(function() {

                seconds--;

                if (seconds >= 0) {

                    countdown.textContent =
                        seconds;

                }

                if (seconds <= 0) {

                    clearInterval(timer);

                }

            }, 1000);


        // Redirect หลังจาก 3 วินาที

        setTimeout(function() {

            window.location.href =
                "index.html";

        }, 3000);
    </script>


</body>

</html>
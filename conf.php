<?php

    $server = "localhost";
    $user = "root";
    // $pass = "";
    $pass = "itdep333011";
    $db = "cgty";

    $conn = mysqli_connect($server,$user,$pass,$db);
    mysqli_set_charset($conn, "utf8");

    if(!$conn){
        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้";
    }

?>
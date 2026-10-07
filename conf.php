<?php

    $server = "localhost";
	// $server = "sql302.infinityfree.com";

    $user = "root";
    // $user = "if0_42978370";

    $pass = "itdep333011";
    // $pass = "BZKysgC0NnjU75D";

    $db = "cgty";
    // $db = "if0_42978370_cgty2569";

    $conn = mysqli_connect($server,$user,$pass,$db);
    mysqli_set_charset($conn, "utf8");

    if(!$conn){
        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้";
    }

?>
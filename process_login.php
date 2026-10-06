<?php
        include "conf.php";
        session_start();

        $gen_pass = md5(mysqli_real_escape_string($conn,$_POST['password']));
        $user = mysqli_real_escape_string($conn,$_POST['username']);
        // $pass = mysqli_real_escape_string($conn,$_POST['password']);
        $pass = $gen_pass;

        $strSQL = "SELECT * FROM accounts WHERE UserName = '".$user."' and PassWord = '".$pass."'";
        $objQuery = mysqli_query($conn,$strSQL);
        $objResult = mysqli_fetch_array($objQuery);
        if(!$objResult)
        {
                echo "<img style='display: block; margin-left: auto; margin-right: auto;' src='images/block.png'>";
                echo "<h2 style='text-align: center; color: red; margin-top: 10%;'>บัญชีผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง</h2>";
                echo "<meta http-equiv='refresh' content='3; url=index.html'>";
        }else{
                $_SESSION["UserName"] = $objResult["UserName"];
                $_SESSION["FullName"] = $objResult["FullName"];
                header("location: main_page.php");
        }
        mysqli_close($conn);
?>
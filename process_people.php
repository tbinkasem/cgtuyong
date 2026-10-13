<?php
include "conf.php";

$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$position = mysqli_real_escape_string($conn, $_POST['position']);
$gen_pass = md5(mysqli_real_escape_string($conn, $_POST['password']));
$pass = $gen_pass;

$strSQL1 = "INSERT INTO accounts(id, UserName, PassWord, FullName, Role, iduser)";
$strSQL2 = " VALUES(0,'$username','$pass','$fullname','$position','$user_id')";
$strSQL3 = $strSQL1 . $strSQL2;
$ResultQuery = mysqli_query($conn, $strSQL3);

if (!$ResultQuery) {
    echo "<img style='width: 50%; display: block; margin-left: auto; margin-right: auto;' src='images/warning.png'>";
    echo "<h2 style='width: 50%; text-align: center; color: red; margin-top: 10%;'>ไม่สามารถเพิ่มผู้ใช้งานได้</h2>";
    echo "<meta http-equiv='refresh' content='3; url=member.html'>";
} else {
    echo "<img style='display: block; margin-left: auto; margin-right: auto;' src='images/hiring.png'>";
    echo "<h2 style='text-align: center; color: green; margin-top: 10%;'>ไม่สามารถเพิ่มผู้ใช้งานได้</h2>";
    echo "<meta http-equiv='refresh' content='3; url=main_page.php'>";
}
mysqli_close($conn);
?>
<?php
$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
$name=$_POST['nameadmin'];
$custid = mysqli_fetch_array(mysqli_query($connect, "SELECT user_id FROM users WHERE user_login='$name'"));
if($_POST['sub']) mysqli_query($connect, "INSERT INTO admins(admins_user_id) values ('$custid[0]')");
else if($_POST['sub_1']) mysqli_query($connect, "DELETE FROM admins WHERE admins_user_id='$custid[0]'");
header('Location: loginfo.php');
mysqli_close($connect);
?>
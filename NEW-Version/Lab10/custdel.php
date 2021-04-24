<?php
$name = $_POST['namecust'];
$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
$custid = mysqli_fetch_array(mysqli_query($connect, "SELECT user_id FROM users WHERE user_login = '$name'"));
mysqli_query($connect, "DELETE FROM users WHERE user_id = '$custid[0]'");
mysqli_error($connect);
mysqli_close($connect);
header('Location: loginfo.php');
exit();
?>
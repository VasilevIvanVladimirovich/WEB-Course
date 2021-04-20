<?php
$name = $_POST['namecust'];
$email = $_POST['emailcust'];
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
if (mysqli_query($connect, "INSERT INTO customers (cust_name, cust_email) VALUES ('$name', '$email')")) echo "Пользователь добавлен.";
else echo "хуйня" . mysqli_error($connect);
mysqli_error($connect);
mysqli_close($connect);
header('Location: orders.php');
exit();
?>
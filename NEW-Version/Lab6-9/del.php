<?php
$name = $_POST['namedel'];
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
mysqli_query($connect, "DELETE FROM products WHERE prod_name = '$name'");
mysqli_close($connect);
header('Location: Database.php');
exit();
?>
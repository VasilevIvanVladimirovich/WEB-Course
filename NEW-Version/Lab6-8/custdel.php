<?php
$name = $_POST['namecust'];
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$custid = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_id FROM customers WHERE cust_name = '$name'"));
mysqli_query($connect, "DELETE FROM orders WHERE cust_id = '$custid[0]'");
mysqli_query($connect, "DELETE FROM customers WHERE cust_name = '$name'");
mysqli_close($connect);
header('Location: orders.php');
exit();
?>
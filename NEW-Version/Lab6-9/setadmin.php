<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$name=$_POST['nameadmin'];
$custid = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_id FROM customers WHERE cust_name='$name'"));
if($_POST['sub']) mysqli_query($connect, "INSERT INTO admins(cust_id) values ('$custid[0]')");
else if($_POST['sub_1']) mysqli_query($connect, "DELETE FROM admins WHERE cust_id='$custid[0]'");
header('Location: orders.php');
mysqli_close($connect);
?>
<?php
$namecust = $_POST['namecust'];
$nameproduct = $_POST['nameproduct'];
$num = $_POST['num'];
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$custid = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_id FROM customers WHERE cust_name = '$namecust'"));
$prodid = mysqli_fetch_array(mysqli_query($connect, "SELECT prod_id FROM products WHERE prod_name = '$nameproduct'"));
$orderid = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM orders"));
$orderid[0] += 1;
mysqli_query($connect, "INSERT INTO orders (order_id, cust_id, prod_id, count) VALUES ('$orderid[0]','$custid[0]', '$prodid[0]','$num')");
mysqli_close($connect);
header('Location: orders.php');
exit();
?>
<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$name = $_COOKIE['name'];
$num = $_POST['numchange'];
$custid = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_id FROM customers WHERE cust_name='$name'"));
$nameproduct = $_POST['namechange'];
$prodid = mysqli_fetch_array(mysqli_query($connect, "SELECT prod_id FROM products WHERE prod_name='$nameproduct'"));
if ($_POST['del']) {
    mysqli_query($connect, "DELETE FROM orders WHERE cust_id='$custid[0]' AND order_id='$num'");
} else {
    $custid = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_id FROM customers WHERE cust_name='$name'"));
    mysqli_query($connect, "UPDATE orders SET order_id='$num', cust_id='$custid[0]', prod_id='$prodid[0]', count ='$num' ");
}
header('Location: orders.php');
mysqli_close($connect);
?>
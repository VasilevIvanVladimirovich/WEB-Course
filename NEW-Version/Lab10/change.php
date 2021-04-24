<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$numchange = $_POST['numchange'];
$namechange = $_POST['namechange'];
$cenachange = $_POST['cenachange'];
$filename = $_FILES["filenamechange"]['name'];

if($numchange=="") exit();
if($namechange=="")
{
    $namebd = mysqli_fetch_array(mysqli_query($connect, "SELECT prod_name FROM products WHERE prod_id='$numchange'"));
    $namechange = $namebd[0];
}
if($cenachange=="")
{
    $cenabd = mysqli_fetch_array(mysqli_query($connect, "SELECT prod_price FROM products WHERE prod_id='$numchange'"));
    $cenachange = $cenabd[0];
}
if($filename=="")
{
    $filebd = mysqli_fetch_array(mysqli_query($connect, "SELECT image FROM products WHERE prod_id='$numchange'"));
    $filename = $filebd[0];
}

mysqli_query($connect, "UPDATE products SET prod_name='$namechange', prod_price='$cenachange', image='$filename' WHERE prod_id='$numchange' ");
mysqli_close($connect);
header('Location: Database.php');
exit();
?>

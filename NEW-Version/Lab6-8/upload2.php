<?php
$name = $_FILES["filename"]['name'];
$cena = $_POST["cena"];
$nameproduct = $_POST["name"];
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$productrid = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM products"));
$productrid[0] +=1;
if (mysqli_query($connect, "INSERT INTO products (prod_id, prod_name, prod_price, image ) VALUES ('$productrid[0]','$nameproduct', '$cena','$name')")
) echo "Пользователь добавлен.";
else echo "Пользователь не добавлен: " . mysqli_error($connect);
$format = explode('.', (string)$name);
if ($format[1] == "jpg" || $format[1] == "png" || $format[1] == "gif") {
    copy($_FILES["filename"]["tmp_name"], "img/" . $_FILES["filename"]["name"]);
}
mysqli_close($connect);
header('Location: Database.php');
exit();    // прерываем работу скрипта, чтобы забыл о прошлом*/
?>

<?php
//запись файла на сервер
$name_file = $_FILES["filename"]["name"];
$format = explode('.', (string)$name_file);
if ($format[1] == "jpg" || $format[1] == "png" || $format[1] == "gif") {
    copy($_FILES["filename"]["tmp_name"], "img/" . $_FILES["filename"]["name"]);
}

$data=$_POST;
$header = $data['header_news'];
$massage = $data['message'];
$date_time = date('Y-m-d H:i:s');

$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
mysqli_query($connect,"INSERT INTO news (news_date,news_header,news_content,news_image) VALUES ('$date_time','$header','$massage','$name_file')");
mysqli_error($connect);
header('Location: index.php');
?>
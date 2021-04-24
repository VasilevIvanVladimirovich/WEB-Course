<?php
$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
$edit_header = $_POST['header_news'];
$message = $_POST['message'];
$filename = $_FILES["filenamechange"]['name'];

if ($filename == "") {
    $filebd = mysqli_fetch_array(mysqli_query($connect, "SELECT news_image FROM news WHERE news_header='$edit_header'"));
    $filename = $filebd[0];
}
if ($_POST['edit']) {
    mysqli_query($connect, "UPDATE news SET news_content='$message', news_image='$filename' WHERE news_header='$edit_header' ");
}
if ($_POST['del']) {
    mysqli_query($connect, "DELETE FROM news WHERE news_header='$edit_header'");
}
mysqli_close($connect);
header('Location: index.php');
exit();
?>

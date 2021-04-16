<?php
if ($_FILES["filename"]["size"] > 1024 * 1024) {
    echo("Размер файла превышает 1 мегабайт");
    exit;
}
$name = $_FILES["filename"]['name'];
$format = explode('.', (string)$name);
if ($format[1] == "jpg" || $format[1] == "png" || $format[1] == "gif") {
    if ($_POST != "") $_FILES["filename"]["name"] = $_POST['namedoc'] . '.' . $format[1];
    copy($_FILES["filename"]["tmp_name"], "img/" . $_FILES["filename"]["name"]);
}
if ($format[1] == "docx" || $format[1] == "xlsx" || $format[1] == "pdf") {
    if ($_POST != "") $_FILES["filename"]["name"] = $_POST['namedoc'] . '.' . $format[1];
    copy($_FILES["filename"]["tmp_name"], "document/" . $_FILES["filename"]["name"]);
}


header('Location: photo.php');
exit();    // прерываем работу скрипта, чтобы забыл о прошлом
?>


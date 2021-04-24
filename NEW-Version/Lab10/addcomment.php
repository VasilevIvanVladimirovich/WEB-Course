<?php

$data = $_POST;
$comment = $data["comment"];
$news_id = $data["newsid"];
$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
$name_user = $_COOKIE['name'];
$user_id = mysqli_fetch_array(mysqli_query($connect, "SELECT user_id FROM users WHERE user_login='$name_user'"));
mysqli_query($connect, "INSERT INTO comments (comments_user_id,comment_news_id,comment_content) VALUE ('$user_id[0]','$news_id', '$comment')");
mysqli_error($connect);
header('Location: index.php');
?>
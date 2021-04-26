<?php

if (isset($_COOKIE['name'])):
    $connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
    $login = $_COOKIE['name'];
    $user_id = mysqli_fetch_array(mysqli_query($connect, "SELECT user_id FROM users WHERE user_login = '$login'"));
    $admins = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) FROM admins WHERE admins_user_id = '$user_id[0]'"));
    if ($admins[0] != 0):
        ?>

        <table>
            <tr>
                <td>
                    <form action="addnews.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr><h1>Добавление новости</h1></tr>
                            <tr>
                                <td>Введите заголовок:</td>
                                <td><input type="text" name="header_news"></td>
                            </tr>
                            <tr>
                                <td>Введите сообщение:</td>
                                <td><textarea name="message" id="" cols="30" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>Картинка:</td>
                                <td><input type="file" name="filename"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Отправить"></td>
                            </tr>
                        </table>
                    </form>
                </td>
                <td>
                    <form action="editnews.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr><h1>Редактировать новость</h1></tr>
                            <tr>
                                <td>Заголовок:</td>
                                <td><input type="text" name="header_news" required></td>
                            </tr>
                            <tr>
                                <td>Введите сообщение:</td>
                                <td><textarea name="message" id="" cols="30" rows="10" required></textarea></td>
                            </tr>
                            <tr>
                                <td>Картинка:</td>
                                <td><input type="file" name="filename"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="edit" value="Редактировать">
                                    <input type="submit" name="del" value="удалить">
                                <td>

                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
    <?php endif; ?>
<?php endif; ?>
<H1>Список новостей:</H1>
<?php
$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
$count_news = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(news_id) FROM news"));

for ($i = $count_news[0];
$i > 0;
$i--):
$check = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) FROM news WHERE news_id = '$i'"));
if ($check[0] != 1) continue;
$header_news = mysqli_fetch_array(mysqli_query($connect, "SELECT news_header FROM news WHERE news_id = '$i'"));
$date_news = mysqli_fetch_array(mysqli_query($connect, "SELECT news_date FROM news WHERE news_id = '$i'"));
$message_news = mysqli_fetch_array(mysqli_query($connect, "SELECT news_content FROM news WHERE news_id = '$i'"));
$user_image = mysqli_fetch_array(mysqli_query($connect, "SELECT news_image FROM news WHERE news_id = '$i'"));

?>

<table border="1" width="60%" align=center style="margin-bottom: 20px;">
    <tr>
        <td><?php echo $header_news[0] ?></td>
    </tr>
    <tr>
        <td><img src="img/<?php print $user_image[0] ?> " width="100"</td>
    </tr>
    <tr>
        <td><?php echo $message_news[0] ?></td>
    </tr>
    <tr>
        <td>Дата публицации: <?php echo $date_news[0] ?></td>
    </tr>
    <tr>
        <td>Комментарии:</td>
    </tr>
    <?php
    $count_max = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(comments_id) FROM comments WHERE comment_news_id = '$i'"));
    //echo " 1)/" . $count_max[0]; //i=9
    ///$comments_id = mysqli_fetch_array(mysqli_query($connect, "SELECT comments_id FROM comments WHERE comment_news_id = '$i'"));
    $result = mysqli_query($connect, "SELECT comments_id FROM comments WHERE comment_news_id = '$i'");
    while ($comments_id = mysqli_fetch_array($result)) {
        $com_id = $comments_id['comments_id'];
        $user_id = mysqli_fetch_array(mysqli_query($connect, "SELECT comments_user_id FROM comments WHERE comments_id = '$com_id'"));
        $name_user = mysqli_fetch_array(mysqli_query($connect, "SELECT user_name FROM users WHERE user_id = '$user_id[0]'"));
        $content = mysqli_fetch_array(mysqli_query($connect, "SELECT comment_content FROM comments WHERE comments_id = '$com_id'"));
        mysqli_error($connect);
        ?>
        <tr>
            <td><?php echo $name_user[0] ?>: <?php echo $content[0] ?></td>
        </tr>

    <?php } ?>
    <form action="addcomment.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="newsid" value="<?php echo $i ?>">
        <tr>
            <td><input type="text" name="comment"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Комментировать"></td>
        </tr>
    </form>

    <?php endfor; ?>
</table>
<?php
$login = $_COOKIE['name'];
$connect = mysqli_connect('127.0.0.2', 'vaxa', 'nzxcvb320', 'new_schema') or die("Ошибка");
$user_email = mysqli_fetch_array(mysqli_query($connect, "SELECT user_email FROM users WHERE user_login = '$login'"));
$user_name = mysqli_fetch_array(mysqli_query($connect, "SELECT user_name FROM users WHERE user_login = '$login'"));
$user_image = mysqli_fetch_array(mysqli_query($connect, "SELECT user_image FROM users WHERE user_login = '$login'"));
$user_id = mysqli_fetch_array(mysqli_query($connect, "SELECT user_id FROM users WHERE user_login = '$login'"));

$user_status = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) FROM admins WHERE admins_user_id = '$user_id[0]'"));
if ($user_status[0] != 0) $user_status[0] = "Администратор";
else $user_status[0] = "Пользователь";
?>
    <table>
        <tr>
            <td><img src="img/<?php print $user_image[0] ?> " width="100"</td>
        </tr>
        <tr>
            <td>
                <p>Ваш логин: </p>
            </td>
            <td>
                <?php echo $login; ?>
            </td>
        </tr>
        <tr>
            <td>
                <p>Ваша почта: </p>
            </td>
            <td>
                <?php echo $user_email[0]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <p>Ваше имя: </p>
            </td>
            <td>
                <?php echo $user_name[0]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <p>Статус: </p>
            </td>
            <td>
                <?php echo $user_status[0]; ?>
            </td>
        </tr>
    </table>
<?php if ($user_status[0] == "Администратор"): ?>
    <form action=custdel.php method=post enctype=multipart/form-data style="border:1px solid black">
        <p>Удалить пользователя</p>
        <table>
            <tr>
                <td>Имя пользователя:</td>
                <td><input type="text" name="namecust" maxlength="50" size="36"></td>
            </tr>
            <tr>
                <td><input type=submit name="sub" value="Удалить пользователя"></td>
            </tr>
        </table>
    </form>

    <form action=setadmin.php method=post enctype=multipart/form-data style="border:1px solid black">
        <p>Администраторы</p>
        <table>
            <tr>
                <td>Имя пользователя:</td>
                <td><input type="text" name="nameadmin" maxlength="50" size="36"></td>
            </tr>
            <tr>
                <td><input type=submit name="sub" value="Назначить"></td>
                <td><input type=submit name="sub_1" value="разжалобить"></td>
            </tr>
        </table>
    </form>


    <h2 align=center> Пользователи </h2>
    <table border="1" width="60%" align="center">
        <tr>
            <th>Логин</th>
            <th>Имя</th>
            <th>Почта клиента</th>
            <th>Статус</th>
        </tr>
        <?php
        $result = mysqli_query($connect, "SELECT user_id, user_login,user_name, user_email FROM users");
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php print $row["user_login"] ?></td>
                <td><?php print $row["user_name"] ?></td>
                <td><?php print $row["user_email"] ?></td>
                <td><?php
                    $userid = $row['user_id'];
                    $check = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) FROM admins WHERE admins_user_id='$userid'"));
                    if ($check[0]) print "Admin";
                    else print "User";
                    ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php
endif;
?>
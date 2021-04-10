<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form name="FormShadow" method="post">
    <table class="TableForm">
        <tr>
            <td>Ведите логин</td>
            <td><input type="text" name="Login" placeholder="Name" pattern="^[A-Za-zА-Яа-яЁё]+$" required></td>
        </tr>
        <tr>
            <td>Ведите почту</td>
            <td><input type="text" name="Email" placeholder="example@mail.com"
                       pattern="([a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$)" required></td>
        </tr>
        <tr>
            <td>Ведите пароль</td>
            <td><input type="password" name="Pass1" placeholder="password" required></td>
        </tr>
        <tr>
            <td>Номер телефона</td>
            <td><input type="tel" id="tel" name="tel" placeholder=89116294490 title="Введите ваш номер телефона"
                       pattern="[0-9]{11}" required/></td>
        </tr>
        <tr>
            <td></td>
            <td><input class="CheckPass" type="submit" value="Отправить" name="Submit">
                <input class="CheckPass" type="reset" value="Стереть" name="Reset" placeholder="password" required>
            </td>
        </tr>
    </table>
</form>
<form action="proverka.php" method="post">
    <p><select name="list1">
            <option>Логин</option>
            <option>Пароль</option>
            <option>Email</option>
            <option>Телефон</option>
        </select></p>
    <p><input type="submit" value="Отправить"></p>
</form>
</body>
</html>
<?php
if (isset($_POST)) {
    $fd = fopen("hello.txt", 'a') or die("не удалось создать файл");

    $login = (string)$_POST['Login'];
    $str1 = "Логин: " . $login . "\n";
    fwrite($fd, $str1);

    $Pass = (string)$_POST['Pass1'];
    $str2 = "Пароль: " . $Pass . "\n";
    fwrite($fd, $str2);

    $Email = $_POST['Email'];
    $str3 = "Email: " . $Email . "\n";
    fwrite($fd, $str3);

    $tel = $_POST['tel'];
    $str4 = "Телефон: " . $tel . "\n";
    fwrite($fd, $str4);
    fclose($fd);

    $fd = fopen("hello.txt", 'r') or die("не удалось создать файл");
    while (!feof($fd)) {
        $out = (string)fgets($fd) . "\n";
        echo $out;
    }
    fclose($fd);
}
?>
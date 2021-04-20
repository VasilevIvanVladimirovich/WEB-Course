<h1>Регистрация</h1>
<?php
$data = $_POST;
if (isset($data['do_signup'])) {
    //тут регистрируем
    $connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
    $errors = array();
    if (trim($data['login']) == "") $errors[] = 'Введите логин!';
    if (trim($data['email']) == "") $errors[] = 'Введите Email!';
    if (trim($data['password']) == "") $errors[] = 'Введите пароль!';
    if (trim($data['password_2']) != $data['password']) $errors[] = 'Повторный пароль введён неверно!';
    $login = $data['login'];
    $email = $data['email'];
    $password = password_hash($data['password'],PASSWORD_DEFAULT);
    $count_name = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM customers WHERE cust_name = '$login'"));
    $count_emale = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM customers WHERE cust_name = '$email'"));
    if ($count_name[0] != 0) $errors[] = "Пользователь с таким логином уже существует!";
    if ($count_emale[0] != 0) $errors[] = "Пользователь с такой почтой уже существует!";
    if (empty($errors)) {
        //тут регистрируем
        $custid = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM customers"));
        $custid[0] += 1;
        mysqli_query($connect, "INSERT INTO customers (cust_id, cust_name, cust_email,cust_password) VALUES ('$custid[0]', '$login','$email', '$password')");
        header('Location: index.php');
        exit();    // прерываем работу скрипта, чтобы забыл о прошлом*/
    } else {
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
    mysqli_close($connect);
}
?>

<form action="registration.php" method="POST" ">
<table style="border:1px solid black;">
    <tr>
        <td>
            <p>Ваш логин: </p>
        </td>
        <td>
            <input type="text" name="login" value="<?php echo @$data['login']; ?>">
        </td>
    </tr>
    <tr>
        <td>
            <p>Ваша почта: </p>
        </td>
        <td>
            <input type="email" name="email" value="<?php echo @$data['email']; ?>">
        </td>
    </tr>
    <tr>
        <td>
            <p>Ваш пароль: </p>
        </td>
        <td>
            <input type="password" name="password" value="<?php echo @$data['password']; ?>">
        </td>
    </tr>
    <tr>
        <td>
            <p>Повторите пароль: </p>
        </td>
        <td>
            <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
        </td>
    </tr>
    <tr>
        <td>
            <button type="submit" name="do_signup">Зарегистрироваться</button>
        </td>
    </tr>
</table>
</form>

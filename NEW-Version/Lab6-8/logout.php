<h1>Вход</h1>
<?php
session_start();
$data = $_POST;
if (isset($data['do_login'])) {
    $errors = array();
    $cust_name = $data['login'];
    $connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
    $cust_password = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_password FROM customers WHERE cust_name = '$cust_name'"));
    $count_name = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM customers WHERE cust_name = '$cust_name'"));
    if ($count_name[0] == 1) {
        if (password_verify($data['password'], $cust_password[0])) {
            setcookie('name', $cust_name);
            header('Location: index.php');
        } else $errors[] = "Неверный пароль!";
    } else $errors[] = "Пользователь не найден";
    if (!empty($errors)) echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';

}
?>

<form action="logout.php" method="POST">
    <table style="border:1px solid black;">
        <tr>
            <td>
                <p>Логин: </p>
            </td>
            <td>
                <input type="text" name="login">
            </td>
        </tr>
        <tr>
            <td>
                <p>Пароль: </p>
            </td>
            <td>
                <input type="text" name="password">
            </td>
        </tr>
        <tr>
            <td>
                <button name="do_login">Войти</button>
            </td>
        </tr>

    </table>
</form>

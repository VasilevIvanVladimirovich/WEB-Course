<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$name = $_COOKIE['name'];
$cust_email = mysqli_fetch_array(mysqli_query($connect, "SELECT cust_email FROM customers WHERE cust_name = '$name'"));


?>
<table>
    <tr>
        <td>
            <p>Ваше имя: </p>
        </td>
        <td>
            <?php echo $name; ?>
        </td>
    </tr>
    <tr>
        <td>
            <p>Ваша почта: </p>
        </td>
        <td>
            <?php echo $cust_email[0]; ?>
        </td>
    </tr>
</table>

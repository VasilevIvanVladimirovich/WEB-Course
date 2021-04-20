<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
if (mysqli_connect_errno()) {
    echo 'Ошибка подключения к базе данных(' . mysqli_connect_errno() . ')';
}
//Выполняем запрос- выбрать все записи из таблицы products
$result = mysqli_query($connect, "SELECT * FROM products  ORDER BY prod_price") or die(mysqli_error($connect));
// для проверки выводим количество строк, участвующих в запросе
$resultrow = mysqli_num_rows($result);
?>

<h2 align=center> У нас в продаже </h2>
<table border="1" width="60%" align=center>
    <tr>
        <th> Номер продукта</th>
        <th> Наименование</th>
        <th>Цена</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php print $row["prod_id"] ?></td>
            <td><?php print $row["prod_name"] ?></td>
            <td><?php print $row["prod_price"] ?></td>
        </tr>

        <?php
    }
    ?>
</table>
<?php
//mysqli_close();
?>


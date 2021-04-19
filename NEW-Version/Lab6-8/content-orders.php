<table>
    <tr>
        <td>
            <form action=custinput.php method=post enctype=multipart/form-data style="border:1px solid black">
                <p>Добавление покупателя</p>
                <table>
                    <tr>
                        <td>Имя покупателя:</td>
                        <td><input type="text" name="namecust" maxlength="50" size="36"></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input type="text" name="emailcust" maxlength="50" size="36"></td>
                    </tr>
                    <tr>
                        <td><input type=submit name="sub" value="Добавить покупателя"></td>
                    </tr>
                </table>
            </form>
        </td>
        <td>
            <?php
            $connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");

            $result = mysqli_query($connect, "SELECT cust_name,cust_email FROM customers");

            // для проверки выводим количество строк, участвующих в запросе
            $resultrow = mysqli_num_rows($result);
            ?>
            <h2 align=center> Клиенты </h2>
            <table border="1" width="60%" align="center">
                <tr>
                    <th>Имя клиента</th>
                    <th>Почта клиента</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php print $row["cust_name"] ?></td>
                        <td><?php print $row["cust_email"] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
            mysqli_close($connect);
            ?>


        </td>
    </tr>
    <tr>
        <td>
            <form action=custby.php method=post enctype=multipart/form-data style="border:1px solid black">
                <p>Добавить заказ</p>
                <table>
                    <tr>
                        <td>Имя покупателя:</td>
                        <td><input type="text" name="namecust" maxlength="50" size="36"></td>
                    </tr>
                    <tr>
                        <td>Наименование товара:</td>
                        <td><input type="text" name="nameproduct" maxlength="50" size="36"></td>
                    </tr>
                    <tr>
                        <td>Кол-во товара</td>
                        <td><input type="text" name="num" maxlength="50" size="36"></td>
                    </tr>
                    <tr>
                        <td><input type=submit name="sub" value="Добавить покупателя"></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <form action=custdel.php method=post enctype=multipart/form-data style="border:1px solid black">
                <p>Удалить покупателя</p>
                <table>
                    <tr>
                        <td>Имя покупателя:</td>
                        <td><input type="text" name="namecust" maxlength="50" size="36"></td>
                    </tr>
                    <tr>
                        <td><input type=submit name="sub" value="Удалить покупателя"></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>

<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");

$result = mysqli_query($connect, "SELECT  cust_name,
        cust_email,
        prod_name,
        prod_price,
        count,
        count * prod_price AS sum,
        image
FROM customers
JOIN orders USING(cust_id)
JOIN products USING(prod_id);");

// для проверки выводим количество строк, участвующих в запросе
$resultrow = mysqli_num_rows($result);
?>
<h2 align=center> Заказы </h2>
<table border="1" width="60%" align="center">
    <tr>
        <th>Имя покупателя</th>
        <th>E-mail</th>
        <th>Название товара</th>
        <th>Цена товара за 1шт</th>
        <th>кол-во товара</th>
        <th>Сумма покупки</th>
        <th>Изображение</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php print $row["cust_name"] ?></td>
            <td><?php print $row["cust_email"] ?></td>
            <td><?php print $row["prod_name"] ?></td>
            <td><?php print $row["prod_price"] ?></td>
            <td><?php print $row["count"] ?></td>
            <td><?php print $row["sum"] ?></td>
            <td><img src="img/<?php print $row["image"] ?> " width="100"</td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
mysqli_close($connect);
?>

<?php
$connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");
$user = 'unknown';
if (isset($_COOKIE['name'])) {
    $coockyname = $_COOKIE['name'];
    $admin = mysqli_fetch_array(mysqli_query($connect, "SELECT count(cust_name)
                                                            FROM customers
                                                            JOIN admins USING(cust_id)
                                                            WHERE cust_name = '$coockyname'"));
    if ($admin[0] == 1) $user = 'admin';
    else $user = "customers";
}
if ($user == "admin"):
    ?>
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

                $result = mysqli_query($connect, "SELECT cust_id, cust_name,cust_email FROM customers");

                // для проверки выводим количество строк, участвующих в запросе
                $resultrow = mysqli_num_rows($result);
                ?>
                <h2 align=center> Клиенты </h2>
                <table border="1" width="60%" align="center">
                    <tr>
                        <th>Имя клиента</th>
                        <th>Почта клиента</th>
                        <th>Статус</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php print $row["cust_name"] ?></td>
                            <td><?php print $row["cust_email"] ?></td>
                            <td><?php
                                $custid = $row['cust_id'];
                                $check = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) FROM admins WHERE cust_id='$custid'"));
                                if ($check[0]) print "Admin";
                                else print "Customer";
                                ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
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
                            <td><input type=submit name="sub" value="Добавить заказ покупателю"></td>
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
        <tr>
            <td>
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
            </td>
        </tr>
    </table>
    <?php
    $connect = mysqli_connect('127.0.0.1', 'vaxa', 'nzxcvb320', 'sys') or die("Ошибка");

    $result = mysqli_query($connect, "SELECT  order_id,
       cust_name,
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
            <th>Номер заказа</th>
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
                <td><?php print $row["order_id"] ?></td>
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
<?php elseif ($user == "customers"): ?>
    <table>
        <tr>
            <td>
                <form action=changeby.php method=post enctype=multipart/form-data style="border: 1px solid black">
                    <p>Изменение покупки</p>
                    <table>
                        <tr>
                            <td>Номер изменяемой покупки:</td>
                            <td><input type="text" name="numchange" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td>Введите новое наименование товара:</td>
                            <td><input type="text" name="namechange" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td>Введите кол-во товара:</td>
                            <td><input type="text" name="count_change" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="del" value="Удалить запись"></td>
                            <td><input type="submit" name="re" value="Изменить запись"></td>
                        </tr>
                        </td>
                    </table>
                </form>
            </td>
        </tr>
    </table>


    <?php
    $result = mysqli_query($connect, "SELECT  order_id,
    prod_name,
    prod_price,
    count,
    count * prod_price AS sum,
    image
    FROM customers
    JOIN orders USING(cust_id)
    JOIN products USING(prod_id)
    WHERE cust_name='$coockyname';");

    // для проверки выводим количество строк, участвующих в запросе
    $resultrow = mysqli_num_rows($result);
    ?>
    <h2 align=center> Заказы </h2>
    <table border="1" width="60%" align="center">
        <tr>
            <th>Номер заказа</th>
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
                <td><?php print $row["order_id"] ?></td>
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
<?php elseif ($user == "unknown"): ?>
    <H1>Небходимо войти в аккаунт</H1>

<?php endif; ?>


<?php
mysqli_close($connect);
?>


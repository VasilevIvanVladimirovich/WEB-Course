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
                <form action=upload2.php method=post enctype=multipart/form-data style="border:1px solid black">
                    <p>Добавление продукта</p>
                    <table>
                        <tr>
                            <td>Продукт:</td>
                            <td><input type="text" name="name" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td>Цена:</td>
                            <td><input type="text" name="cena" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td><input type=file name="filename"></td>
                            <td><input type=submit name="doupload" value="Добавить запись"></td>
                        </tr>
                    </table>
                </form>
            </td>
            <td>
                <form action=del.php method=post enctype=multipart/form-data style="border:1px solid black">
                    <p>Удаление продукта</p>
                    <table>
                        <tr>
                            <td>Название продукта:</td>
                            <td><input type="text" name="namedel" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td><input type=submit name="del" value="Удалить запись"></td>
                        </tr>
                        </td>
                    </table>
                </form>
        </tr>
        <tr>
            <td>
                <form action=change.php method=post enctype=multipart/form-data style="border: 1px solid black">
                    <p>Изменение продукта</p>
                    <table>
                        <tr>
                            <td>Номер изменяемого продукта:</td>
                            <td><input type="text" name="numchange" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td>Введите новое наименование:</td>
                            <td><input type="text" name="namechange" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td>Введите новую цену:</td>
                            <td><input type="text" name="cenachange" maxlength="50" size="36"></td>
                        </tr>
                        <tr>
                            <td><input type=file name="filenamechange"></td>
                            <td><input type=submit name="change" value="Изменить запись"></td>
                        </tr>
                        </td>
                    </table>
                </form>
            </td>
        </tr>
    </table>
<?php elseif ($user == 'customers'): ?>
    <table>
        <tr>
            <td>
                <form action=custby.php method=post enctype=multipart/form-data style="border:1px solid black">
                    <p>Добавить заказ</p>
                    <table>
                        <tr>
                            <td><input type="hidden" name="namecust" value="<?php echo $coockyname ?>"></td>
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
                            <td><input type=submit name="sub" value="Купить товар"></td>
                        </tr>
                    </table>
                </form>
            </td>
    </table>

<?php elseif ($user == 'unknown'): ?>
<?php endif; ?>
<?php
// задаем кодировку по умолчанию, которая будет использоваться при обмене данными с сервером баз данных
mysqli_set_charset($connect, "utf8");
//проверяем существование переменных из формы
if (isset($_POST["name"]) && isset ($_POST["cena"]) && isset  ($_FILES["filename"]["name"])) {
    if ($_FILES["filename"]["size"] > 1024 * 1024) {
        echo("Размер файла превышает 1 мегабайт");
        exit;
    }
    @copy($_FILES["filename"]["tmp_name"],
        "img/" . $_FILES["filename"]["name"]);


// формируем текст запроса на добавление записи путем конкатенации текста и значений переменных
//чтобы получилась ковычка для текстововго поля ее экранируем \"

    $query = "INSERT INTO products VALUES(null,\"" . $_POST["name"] . "\"," . $_POST["cena"] . ",\"" . $_FILES["filename"]["name"] . "\")";
//выводим текст запроса для проверки
//выполняем запрос на добавление записи
    $result = mysqli_query($connect, $query);

}
//Выполняем запрос- выбрать все записи из таблицы products
$result = mysqli_query($connect, "SELECT * FROM products  ORDER BY prod_price");

// для проверки выводим количество строк, участвующих в запросе
$resultrow = mysqli_num_rows($result);
?>
<h2 align=center> У нас в продаже </h2>
<table border="1" width="60%" align="center">
    <tr>
        <th> Номер продукта</th>
        <th> Наименование</th>
        <th>Цена</th>
        <th>Изображение</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php print $row["prod_id"] ?></td>
            <td><?php print $row["prod_name"] ?></td>
            <td><?php print $row["prod_price"] ?></td>
            <td><img src="img/<?php print $row["image"] ?> " width="100"</td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
mysqli_close($connect);
?>

<head>
<meta charset="utf-8">
</head>
<body>
<?php
$connect = mysqli_connect('127.0.0.1', 'root', '', 'company') or die ("Не могу соединиться с сервером MySql");

// задаем кодировку по умолчанию, которая будет использоваться при обмене данными с сервером баз данных

if (!mysqli_set_charset($connect, "utf8")) {
    printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($connect));
} else {
    printf("Текущий набор символов: %s\n", mysqli_character_set_name($connect));
}
//проверяем существование переменных из формы
if ( isset($_POST["name"] ) && isset ($_POST["cena"]) && isset  ($_FILES["filename"]["name"]))
{
   if($_FILES["filename"]["size"] > 1024*1024)
   {
     echo ("Размер файла превышает 1 мегабайт");
     exit;
   }
   if(@copy($_FILES["filename"]["tmp_name"],
     "img/".$_FILES["filename"]["name"]))
   {
/*    
 echo("Файл успешно загружен <br>");
     echo("Характеристики файла: <br>");
     echo("Имя файла: ");
     echo($_FILES["filename"]["name"]);
     echo("<br>Размер файла: ");
     echo($_FILES["filename"]["size"]);
     echo("<br>Каталог для загрузки: ");
     echo($_FILES["filename"]["tmp_name"]);
     echo("<br>Тип файла: ");
     echo($_FILES["filename"]["type"]);
*/
   } else {
     echo("Ошибка загрузки файла");
   }

// формируем текст запроса на добавление записи путем конкатенации текста и значений переменных
//чтобы получилась ковычка для текстововго поля ее экранируем \"
 
$query="INSERT INTO products VALUES(null,\"".$_POST["name"]."\",".$_POST["cena"].",\"".$_FILES["filename"]["name"]."\")";
//выводим текст запроса для проверки
print $query;
//выполняем запрос на добавление записи
$result=mysqli_query($connect, $query);

}



//Выполняем запрос- выбрать все записи из таблицы products
$result=mysqli_query($connect, "SELECT * FROM products  ORDER BY prod_price");

// для проверки выводим количество строк, участвующих в запросе
$resultrow=mysqli_num_rows($result); 
print "выбрано записей-". $resultrow;
?>
<h2 align=center> У нас в продаже </h2>
<table border="1" width="60%"  align="center">
<tr>
<th> Номер продукта</th>
<th> Наименование</th>
<th>Цена</th>
<th>Изображение</th>
</tr>
<?php
while ($row=mysqli_fetch_array($result))
{
?>
<tr>
<td><?php print $row["prod_id"]?></td>
<td><?php print $row["prod_name"]?></td>
<td><?php print $row["prod_price"]?></td>
<td><img src="img/<?php print $row["image"]?> " width="100"</td>
</tr>

<?php 
}
?>
</table>
<?php
mysqli_close($connect );
?>

<div style="margin:20px 300px auto; ">
<form action=14.php method=post enctype=multipart/form-data>
<p>Продукт:<input type="text" name="name" maxlength="50" size="36"></p>
<p>Цена:<input type="text" name="cena" maxlength="50" size="36"></p>

<p><input type=file name="filename"> <br></p>
<input type=submit name="doupload" value="Добавить запись">
</form>
</div>
</body>

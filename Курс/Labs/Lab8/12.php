<?php
$connect = mysqli_connect('127.0.0.1', 'root', '', 'company') or die ("Не могу соединиться с сервером MySql");



//Выполняем запрос- выбрать все записи из таблицы products
$result=mysqli_query($connect, "SELECT * FROM products  ORDER BY prod_price");

// для проверки выводим количество строк, участвующих в запросе
$resultrow=mysqli_num_rows($result); 
print $resultrow;
?>
<h2 align=center> У нас в продаже </h2>
<table border="1" width="60%"  align=center>
<tr>
<th> Номер продукта</th>
<th> Наименование</th>
<th>Цена</th>
</tr>
<?php
while ($row=mysqli_fetch_array($result))
{
?>
<tr>
<td><?php print $row["prod_id"]?></td>
<td><?php print $row["prod_name"]?></td>
<td><?php print $row["prod_price"]?></td>
</tr>

<?php 
}
?>
</table>
<?php
//mysqli_close();
?>


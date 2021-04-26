<?php
$connect = mysqli_connect('127.0.0.1', 'root', '', 'company') or die ("Не могу соединиться с сервером MySql");



//Выполняем запрос- выбрать все записи из таблицы products
//$result=mysqli_query($connect, "SELECT * FROM products");
$result=mysqli_query($connect, "SELECT customers.cust_name, products.prod_name, orders.price, products.prod_price, products.image 
FROM products,customers, orders WHERE products.prod_id=orders.prod_id  and  customers.cust_id=orders.cust_id");

$resultrow=mysqli_num_rows($result); 
print $resultrow;
?>
<h2 align=center> У нас в продаже </h2>
<table border="1" width="60%"  align=center>
<tr>
<th> Поставщик</th>
<th> Товар</th>
<th>Цена</th>
<th>Количество</th>

<th>Изображение</th>
</tr>
<?php
while ($row=mysqli_fetch_array($result))
{
?>
<tr>
<td><?php print $row["cust_name"]?></td>

<td><?php print $row["prod_name"]?></td>
<td><?php print $row["price"]?></td>

<td><?php print $row["prod_price"]?></td>

<td><img src="<?php print $row["image"]?>"</td>

</tr>
<?php 
}
?>
</table>
<?php
mysqli_close($connect);
?>


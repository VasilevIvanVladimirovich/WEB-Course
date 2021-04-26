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
//mysqli_close();*/
?>






















-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2020 г., 11:36
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `company`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cust_email` varchar(20) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_name`, `cust_email`) VALUES
(1, 'Gizon', '123@ya.ru'),
(2, 'ABC', '18787873@ya.ru'),
(3, 'Piton', '123iytiy@ya.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `prod_id`, `price`) VALUES
(1, 1, 2, 20),
(2, 2, 1, 56),
(3, 3, 3, 65),
(4, 1, 3, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `prod_price` int(20) NOT NULL,
  `image` varchar(40) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_price`, `image`) VALUES
(1, 'виноград', 120, '4.jpg'),
(2, 'арбуз', 46, '2.jpg'),
(4, 'дыня', 56, '3.webp'),
(5, 'яблоко', 78, '1.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

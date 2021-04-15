<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
    <div class="left">
        <ul class="menu">
            <?php
            $menu = array (
                array ("link"=>"Главная", "href"=>"index.php"),
                array ("link"=>"Текст1", "href"=>"text1.php"),
                array ("link"=>"Текст2", "href"=>"text2.php")
);
            ?>
            <div class="nav">
                <div class="left">
                    <ul class="menu">
                        <li><a href='<?=$menu [0] ["href"]?>'><?=$menu [0] ["link"]?></a></li>
                        <li><a href='<?=$menu [1] ["href"]?>'><?=$menu [1] ["link"]?></a></li>
                        <li><a href='<?=$menu [2] ["href"]?>'><?=$menu [2] ["link"]?></a></li>
                    </ul>
                </div>
                </div>
            </div>
</div>
</body>






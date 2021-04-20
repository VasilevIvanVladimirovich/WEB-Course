<div class="nav">
    <div class="left">
        <ul class="menu">
            <?php
            $menu = array(
                array("link" => "Главная", "href" => "index.php"),
                array("link" => "Яndex", "href" => "text1.php"),
                array("link" => "Информация", "href" => "text2.php"),
                array("link" => "Фото", "href" => "photo.php"),
                array("link" => "Продукты", "href" => "Database.php"),
                array("link" => "Заказы", "href" => "orders.php"),
            );
            ?>
            <li><a href='<?= $menu [0] ["href"] ?>'><?= $menu [0] ["link"] ?></a></li>
            <li><a href='<?= $menu [1] ["href"] ?>'><?= $menu [1] ["link"] ?></a></li>
            <li><a href='<?= $menu [2] ["href"] ?>'><?= $menu [2] ["link"] ?></a></li>
            <li><a href='<?= $menu [3] ["href"] ?>'><?= $menu [3] ["link"] ?></a></li>
            <li><a href='<?= $menu [4] ["href"] ?>'><?= $menu [4] ["link"] ?></a></li>
            <li><a href='<?= $menu [5] ["href"] ?>'><?= $menu [5] ["link"] ?></a></li>
    </div>
    <div class="right">
        <?php
        if(isset($_COOKIE['name'])) {
            $name = $_COOKIE['name'];
            $menuright = array(
                array("link" => "Вы вошли как $name", "href" => "loginfo.php"),
                array("link" => "Выход", "href" => "logexit.php")
            );
        } else {
            $menuright = array(
                array("link" => "Регистрация", "href" => "registration.php"),
                array("link" => "Вход", "href" => "logout.php")
            );
        }
        ?>
        <li><a href='<?= $menuright [0] ["href"] ?>'><?= $menuright [0] ["link"] ?></a></li>
        <li><a href='<?= $menuright [1] ["href"] ?>'><?= $menuright [1] ["link"] ?></a></li>
    </div>
</div>
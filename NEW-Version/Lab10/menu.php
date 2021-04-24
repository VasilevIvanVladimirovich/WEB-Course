<div class="nav">
    <div class="left">
        <ul class="menu">
            <?php
            $menu = array(
                array("link" => "Новости", "href" => "index.php"),
            );
            ?>
            <li><a href='<?= $menu [0] ["href"] ?>'><?= $menu [0] ["link"] ?></a></li>
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
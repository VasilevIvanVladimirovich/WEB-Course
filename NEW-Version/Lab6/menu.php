<div class="nav">
    <div class="left">
        <ul class="menu">
            <?php
            $menu = array(
                array("link" => "Главная", "href" => "index.php"),
                array("link" => "Яndex", "href" => "text1.php"),
                array("link" => "Информация", "href" => "text2.php")
            );
            ?>
            <li><a href='<?= $menu [0] ["href"] ?>'><?= $menu [0] ["link"] ?></a></li>
            <li><a href='<?= $menu [1] ["href"] ?>'><?= $menu [1] ["link"] ?></a></li>
            <li><a href='<?= $menu [2] ["href"] ?>'><?= $menu [2] ["link"] ?></a></li>
    </div>
</div>







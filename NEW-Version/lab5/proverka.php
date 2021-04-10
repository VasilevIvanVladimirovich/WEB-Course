<?php
$fd = "hello.txt";
$lines = file($fd);
$sp = $_POST['list1'];
$lang = count($lines) / 4;
if ($sp === "Логин") {
    $c = 0;
    for ($i = 0; $i <= $lang; $i++) {
        @$out = explode(':', @$lines[$c]);
        echo @$out[1];
        $c += 4;
    }
} elseif ($sp === "Пароль") {
    $c = 1;
    for ($i = 0; $i <= $lang; $i++) {
        $out = explode(':', $lines[$c]);
        echo $out[1];
        $c += 4;
    }
} elseif ($sp === "Email") {
    $c = 2;
    for ($i = 0; $i <= $lang; $i++) {
        $out = explode(':', $lines[$c]);
        echo $out[1];
        $c += 4;
    }
} elseif ($sp === "Телефон") {
    $c = 3;
    for ($i = 0; $i <= $lang; $i++) {
        $out = explode(':', $lines[$c]);
        echo $out[1];
        $c += 4;
    }
}
?>
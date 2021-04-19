<h2><p><b> Форма для загрузки файлов </b></p></h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <table>
        <td>
            <tr>Введите название файла</tr>
            <tr><input type="text" name="namedoc"></tr>
        </td>
        <td>
            <input type="file" name="filename">
        </td>
        <td>
            <input type="submit" value="Загрузить">
        </td>
    </table>
</form>
<h2>Документы</h2>
    <?php
    $docdir = "./document";  // каталог для хранения изображений
    $d = opendir($docdir);  // открываем каталог (функция opendir возвращает идентификатор //каталога)
    $document = array(); // сначала альбом пуст
    while (($e = readdir($d)) !== false) {
        if (!preg_match("/^(.*)\.(docx|xlsx|pdf)$/", $e, $p)) continue;
        $path = "$docdir/$e";   // адрес
        $sz = getimagesize($path);  // размер
        $tm = filemtime($path); //время добавления
        $document[$tm] = array(
            'time' => filemtime($path),  //время добавления
            'name' => $e, // имя файла
            'url' => $path, // url файла
            'type' => filetype($path),
            'size' => filesize($path)
        );
    }
    krsort($document);
    foreach ($document as $key => $value) {
        $type = $value['type'];
        $name = $value['name'];
        $qq = date("d . m . Y H:i:s", $value['time']);
        $url = $value['url'];
        $tp = explode('.', (string)$name);
        $fl = round($value['size'] / 1024,0);
        if ($tp[1] == "docx") $format = "Word";
        if ($tp[1] == "xlsx") $format = "Exel";
        if ($tp[1] == "pdf") $format = "PDF";
        $str = $tp[0] . "(формат " . '<a href="download.php?file='.$name.'">' . $format . "," . $fl . " kb"."</a>".")";
        echo "<ul>
                <li> {$str} </li>
            </ul>";
    }

    ?>


<h1> Фотоальбом </h1>

<?php
$imgdir = "./img";  // каталог для хранения изображений
$d = opendir($imgdir);  // открываем каталог (функция opendir возвращает идентификатор //каталога)
$photos = array(); // сначала альбом пуст
while (($e = readdir($d)) !== false) {
    if (!preg_match("/^(.*)\.(gif|jpg|png)$/", $e, $p)) continue;
    $path = "$imgdir/$e";   // адрес
    $sz = getimagesize($path);  // размер
    $tm = filemtime($path); //время добавления
    $photos[$tm] = array(
        'time' => filemtime($path),  //время добавления
        'name' => $e, // имя файла
        'url' => $path, // url файла
        'w' => $sz[0], // ширина картинки
        'h' => $sz[1],  // высота картинки
        'wh' => $sz[3]  // "width=xxx height=yyy"
    );
}
krsort($photos);
//echo '<pre>';
//print_r($photos);
//echo '</pre>';
foreach ($photos as $key => $value) {
    $q = $value['wh'];
    $name = $value['name'];
    $qq = date("d . m . Y H:i:s", $value['time']);
    $pach_f = $value['url'];
    echo "<table border='1' width='80%' align=center>
        <tr>
            <td align=center> {$name} <br> Оригинальный размер: {$q} <br> Добавлена {$qq}
            </td>
            <td align=center>
                <img width='300px' height='300px' src='{$pach_f}'>
            </td>
        </tr>
</table>";
}
?>
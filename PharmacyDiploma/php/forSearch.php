<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="../css/head.css" type="text/css"/>
<?php

require "../php/connection.php";

// Получаем запрос
$inputSearch = $_REQUEST['search'];

// Создаём SQL запрос
$sql = "SELECT * FROM `products` WHERE `name` = '$inputSearch' || `description` = '$inputSearch'";

// Отправляем SQL запрос
$result = $mysql->query($sql);

function doesItExist(array $arr) {
    // Создаём новый массив
    $data = array(
        'name' => $arr['name'] != false ? $arr['name'] : 'Нет данных',
        'description' => $arr['description'] != false ? $arr['description'] : 'Нет данных',
        //'description' => $arr['description'] != false ? $arr['description'] : 'Нет данных',
    );
    return $data; // Возвращаем этот массив
}

function countPeople($result) {
    // Проверка на то, что строк больше нуля
    if ($result -> num_rows > 0) {
        ?> <div class="parent"> <?
        // Цикл для вывода данных
        echo "По вашему запросу было найдено $result->num_rows результатов: "; ?> <br> <br> <?php
        while ($row = $result -> fetch_assoc()) {
            // Получаем массив с строками которые нужно выводить
            $arr = doesItExist($row);
            // Вывод данных
            echo " ". $row['name'] .": от ". $row['price'] ." руб - ". $row['description'] . "<br>  "; ?>
            <a href="catalog.php?page=products&action=add&id=<?php echo $row['id_product']?>"> Добавить в корзину</a>
            <hr>
            <?php
        }
        // Если данных нет
    } ?> </div> <?php /*else {
        $result = -1;
        if ($result < 0) {
            print ("<script language=javascript>
            alert('По вашему запросу ничего не найдено.')
            </script>");
        }
        $result = 0;
    }
    /*if ($result -> num_rows <= 0) {
        echo "Ничего не найдено";
    }*/
}
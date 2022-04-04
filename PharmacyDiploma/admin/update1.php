<?php

//Обновление информации о продукте

require '../php/connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$dealer_name = $_POST['dealer_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$pic = $_POST['pic'];

$sql = $mysql->query("UPDATE `products` SET `id_product`='$id',`name` = '$name', `description` = '$description', `price` = '$price', `pic`='$pic'  WHERE `products`.`id_product` = '$id'");
$sql1 = $mysql->query("UPDATE `dealers` SET `dealer_name`='$dealer_name' WHERE `products`.`id_product` = '$id'");

//var_dump($sql);

header('Location: ../php/update.php');

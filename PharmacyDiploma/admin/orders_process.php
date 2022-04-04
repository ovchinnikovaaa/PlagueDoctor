<?php

require_once "../php/connection.php";

$status = 0;


$sql = "SELECT DISTINCT `id_order` FROM `orders` WHERE `status`='$status'";
$customers = [];

if ($result = $mysql->query($sql)) {

    while ($row = $result->fetch_assoc()) {
        $customers[] = $row['id_order'];
    }

}

$sql = "SELECT * FROM `orders` LEFT JOIN `products` USING(`id_product`)";

$orders = [];
if ($result = $mysql->query($sql)) {

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

}


foreach ($customers as $customer) {
    $k = 0;

    foreach ($orders as $order) {
        if ($customer == $order['id_order']) {
            $info = '';
            if ($k == 0) {
                $info .= '<h4>Идентификатор заказa: '.$order['id_order'].'</h4><br />';
            }

            $info .= 'Наименование товара: '.$order['name']
                .'<br />Количество: '.$order['quantity']
                .'<br />Цена: '.$order['price'].' руб.'.'.<br /><br />';

            $subtotal = $order['price'] * $order['quantity'];
            $total += $subtotal;

            echo $info;

            $k++;
        }

    }

    echo "Общая стоимость: $total руб.";
    $total = 0;
    echo '<hr />';
}
<?php

require_once "../php/db.php";
require_once "../php/connection.php";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/head.css" type="text/css"/>

<html>
<head>

    <title>Архив заказов</title>

</head>
<body>

<div class="main">

    <div class="top_string">
        <h2> Бесплатный звонок: 8-999-999-99-99 (с 8:00 до 23:00) <div class="login_check"> <?php echo $_SESSION['logged_user']->login; ?> </div> </h2>

        <div class="header">
            <div class="logo">
                <img src="../images/logo.png" height="126" width="240" alt="logo" title="logo">
            </div>

            <ul class="menu">
                <li><a href="../html/main.php">Главная</a></li>
                <li><a href="../php/catalog.php">Каталог</a>
                <ul class="submenu">
                        <li><a href="../php/horrible.php" class="notpodcherk">Все товары</a></li>
                    </ul></li>
                <li><a href="../html/adresses.php">Адреса аптек</a></li>
                <li><a href="../html/vacancy.php">Вакансии</a></li>
                <li><a href="../html/contact.php">Контакты</a></li>
        </ul>

        </div>
    </div>

    <div class="parent">

<?php
    // в этом куске только та часть кода, которая доступна все пользователям кроме админа
    if($_SESSION['logged_user']->login != 'admin') {

        ?><hr><?php

        $person = $_SESSION['logged_user']->login;

        $result = $mysql->query("SELECT * FROM `orders` where `customer`='$person'");
        $user = $result->fetch_assoc();
        if (count($user) != 0) {
            echo "Ваши заказы: ";
            $doneStatus = 1;

            $sql = "SELECT DISTINCT `id_order` FROM `orders` WHERE `customer`='$person' && `status` = '$doneStatus'";
            $customers = [];

            if ($result = $mysql->query($sql)) {

                while ($row = $result->fetch_assoc()) {
                    $customers[] = $row['id_order'];
                }

            }


            $sql = "SELECT * FROM `orders` LEFT JOIN `products` USING(`id_product`) WHERE `status` = '$doneStatus' AND `customer` = '$person'";

            $orders = [];
            if ($result = $mysql->query($sql)) {

                while ($row = $result->fetch_assoc()) {
                    $orders[] = $row;
                }

            }

            /* Это проверка на существование первого элемента. Если его нет, значит массив пустой, значит заказов не было */
            if (array_shift($orders)) {
            foreach ($customers as $customer) {
                $k = 0;

                foreach ($orders as $order) {
                    if ($customer == $order['id_order']) {
                        $info = '';
                        if ($k == 0) {
                            if($order['status'] == 1) {
                                $st = "Выполнен!";
                            } else {
                                $st = "Не выполнен!";
                            }
                            $info .= '<h4>Идентификатор заказa: '.$order['id_order']
                                .'<br />Статус заказа: '.$st
                                .'</h4><br />';
                        }

                        $info .= 'Наименование товара: '.$order['name']
                            .'<br />Количество: '.$order['quantity']
                            .'<br />Цена: '.$order['price'].' руб.'.'<br /><br />';

                        $subtotal = $order['price'] * $order['quantity'];
                        $total += $subtotal;

                        echo $info;

                        $k++;
                    }

                }

                echo "Общая стоимость: $total руб.";
                $total = 0;
            }
            }
            else { ?> <br> <?php
                echo "К сожалению, ни один из ваших заказов еще не был выполнен. Подождите немного или свяжитесь с нами по телефону: +79999999999.";
            }
        }
    }
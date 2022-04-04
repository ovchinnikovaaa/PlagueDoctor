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
    <title>Личный кабинет</title>

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
if(isset($_SESSION['logged_user']) ) : ?>
    Привет, <?php echo $_SESSION['logged_user']->login; global $me; $me = $_SESSION['logged_user']->login; ?>!

    <?php
    if($_SESSION['logged_user']->login == 'admin') { ?>
    <p><a href="../enter/logout.php"><img src="../images/exit.png" width="50" height="50" border="0" align="right" class="cabinet" alt="Выход из личного кабинета"></a></p>

        <?php } if ($_SESSION['logged_user']->login != 'admin') { ?>
        <p><a href="../enter/logout.php"><img src="../images/exit.png" width="50" height="50" border="0" align="right" class="cabinet" alt="Выход из личного кабинета"></a></p>
        <a href="../php/archive.php"><img src="../images/archieve.png" width="50" height="50" border="0" align="right" alt="Архив заказов"></a>
        <a href="../php/cart.php"><img src="../images/cart.png" width="50" height="50" border="0" align="right" alt="Корзина"></a>

        <?php
    }
    // в этом куске только та часть кода, которая доступна админу
    if($_SESSION['logged_user']->login == 'admin') {
        ?>
        <p>Вам доступно:</p>

        <p>1. <a href="../admin/create.php" class="notpodcherk">Добавить товар</a></p>

        <p>2. <a href="../admin/update.php" class="notpodcherk">Изменить товар</a></p>

        <p>3. <a href="../admin/delete.php" class="notpodcherk">Удалить товар</a></p>

        <p>4. <a href="../admin/orders_wtf.php" class="notpodcherk">Посмотреть заказы</a></p>
        <?php
    }
    // в этом куске только та часть кода, которая доступна все пользователям кроме админа
    if($_SESSION['logged_user']->login != 'admin') {

        ?><?php

        $person = $_SESSION['logged_user']->login;
        $status = 0;

        $result = $mysql->query("SELECT * FROM `orders` where `customer`='$person'");
        $user = $result->fetch_assoc();
        if (count($user) != 0) {
            echo "Ваши заказы: "; ?> <!--<p><a href="../enter/logout.php"><img src="../images/exit.png" width="100" height="100" border="0" align="right" class="cabinet" alt="Выход из личного кабинета"></a></p> <a href="../php/archive.php"><img src="../images/archieve.png" width="100" height="100" border="0" align="right" alt="Архив заказов"></a>-->
            <?php

            $sql = "SELECT DISTINCT `id_order` FROM `orders` WHERE `customer`='$person' && `status` = '$status'";
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
                            if($order['status'] == 1) {
                                $st = "Выполнен!";
                            } else {
                                $st = "Не выполнен!";
                            }
                            $info .= '<h4>Идентификатор заказa: '.$order['id_order']
                                .'<br />Дата заказа: '.$order['date']
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
        } }

        else {
            echo "Список ваших заказов пуст. Закажите что-нибудь!";
        }

    }
    ?>

<?php else : ?>
    Вы не авторизованы, пожалуйста, войдите на сайт или зарегистрируйтесь! <br>
    <a href="../enter/login.php">Авторизироваться</a><br>
    <!--<a href="../enter/signup.php">Регистрация</a>-->
<?php endif; ?>

    </div>

<?php

require "../php/connection.php";
require_once "../php/db.php";


?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <html>
    <head>
        <link rel="stylesheet" href="../css/head.css" type="text/css"/>
        <link rel="stylesheet" href="../css/forLogin.css" type="text/css"/>
        <link rel="stylesheet" href="../css/forAdminFields.css" type="text/css"/>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <title>Онлайн-заказы</title>

    </head>
<body>

    <div class="main">
        <div class="top_string">
            <h2>Бесплатный звонок: 8-999-999-99-99 (с 8:00 до 23:00) <div class="login_check"> <?php echo $_SESSION['logged_user']->login; ?> </div> </h2>
            <div class="header">
                <div class="logo">
                    <img src="../images/logo.png" height="126" width="240" alt="logo" title="logo">
                </div>

                <?php if($_SESSION['logged_user']->login) { ?>
                    <p><a href="../php/enter.php"><img src="../images/cabinetw.png" width="50" height="50" border="0" align="right" class="cabinet" alt="Личный кабинет"></a></p>
                <?php } else { ?>
                    <p><a href="../enter/login.php"><img src="../images/cabinetw.png" width="50" height="50" border="0" align="right" class="cabinet" alt="Личный кабинет"></a></p>
                <?php } ?>

                <ul class="menu">
                    <li><a href="../html/main.php">Главная</a></li>
                    <li><a href="../php/catalog.php">Каталог</a>
                        <ul class="submenu">
                            <li><a href="../php/horrible.php" class="notpodcherk">Все товары</a></li>
                        </ul>
                    </li>
                    <li><a href="../html/adresses.php">Адреса аптек</a></li>
                    <li><a href="../html/vacancy.php">Вакансии</a></li>
                    <li><a href="../html/contact.php">Контакты</a></li>
                </ul>
            </div>
        </div>
    </div>

<!--<a href="orders_done.php">Посмотреть ВЫПОЛНЕННЫЕ заказы</a>
<a href="orders_process.php">Посмотреть заказы В ПРОЦЕССЕ</a>-->

<div class="parent">

    <p align="right"><a href="orders_done.php" class="notpodcherk">Архив</a></p>

    <h3>Заказы онлайн-аптеки "Чумной доктор": </h3>

<?php

$status_process = 0;
$status_done = 1;
$sql = "SELECT DISTINCT `id_order` FROM `orders` WHERE `status` = '$status_process' ";
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
                $info .= //'<h4><form action="change.php" method="post">Идентификатор заказa: <input type="text" name="id_order" value=" '.$order['id_order'].'"></form><a style="color: green;"href="orders_wtf.php?id_order= '.$order['id_order'].'">Изменить статус</a>'
                    '<h4>Идентификатор заказa: '.$order['id_order'].'<a style="color: green;" href="orders_wtf.php?id_order='. $order['id_order'].'">Выбрать заказ</a>'
                    .'<br />Статус заказа: '.$st
                    .'</h4><br />';


            }

            $info .= 'Наименование товара: '.$order['name']
                .'<br />Количество: '.$order['quantity']
                .'<br />Цена: '.$order['price'].' руб.'
                .' 
                .<br /><br />';

                $subtotal = $order['price'] * $order['quantity'];
                $total += $subtotal;

            echo $info;

            $k++;
        }


    }


    echo "Общая стоимость: $total руб.";
    $total = 0;

    $order_id = $_GET['id_order'];
    $order = $mysql->query("SELECT * FROM `orders` WHERE `id_order` = '$order_id'");
    $order = $order->fetch_assoc();
    ?>

    <form action="../admin/change.php" method="post">

        <input type="hidden" class="field_type" name="id_order" value="<?= $order['id_order'] ?>">
        <button type="submit" class="form_button" name="change">Изменить</button>

    </form>

    <?php

    echo '<hr />';
} ?>

</div>

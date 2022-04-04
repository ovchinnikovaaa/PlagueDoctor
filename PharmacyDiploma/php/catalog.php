<?php

require_once "../php/connection.php";
require_once "../php/forSearch.php";
require_once "../php/db.php";

if(isset($_GET['page'])) {
    $pages = array('products', 'cart');

    if(in_array($_GET['page'], $pages)) {

        $_page = $_GET['page'];

    } else {
        $_page = 'products';

    }

} else {
    $_page = 'products';
}

if(isset($_GET['action']) && $_GET['action'] == "add") {

    $id = intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $query_s = $mysql->query("SELECT * FROM `products` WHERE id_product={$id}");
        if (mysqli_num_rows($query_s) != 0) {
            $row_s = $query_s->fetch_array();

            $_SESSION['cart'][$row_s['id_product']] = array(
                "quantity" => 1,
                "price" => $row_s['price']
            );
        } else {
            $message = "This product id is invalid!";

        }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="../css/head.css" type="text/css"/>
<link rel="stylesheet" href="../css/forSearch.css" type="text/css"/>

<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Каталог аптеки</title>

</head>
<body>

<div class="main"></div>
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
                </ul></li>
            <li><a href="../html/adresses.php">Адреса аптек</a></li>
            <li><a href="../html/vacancy.php">Вакансии</a></li>
            <li><a href="../html/contact.php">Контакты</a></li>
        </ul>
    </div>
</div>
</div>

<div class="container1">
    <div class="search">
        <form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
            <input type="text" name="search" placeholder="Найти товары"> <button type="submit" name="button"></button>
        </form>


        <?php
            countPeople($result); // Функция вывода товаров, если были совпадения
        ?>

    </div>
</div>

<div class="parent">

    <div class="column1">
        <p><a href="../categories/nerves.php"><img src="../images/nerves.png" width="300" height="240" border="0" align="left" alt="Нервная система"></a></p>
        <p><a href="../categories/breath.php"><img src="../images/breath.png" width="300" height="240" border="0" align="middle" alt="Респираторная система"></a></p>
        <p><a href="../categories/antibiotics.php"><img src="../images/antibiotics.png" width="300" height="240" border="0" align="right" alt="Антибиотики"></a></p>
    </div>

    <div class="column1">
        <p><a href="../categories/heart.php"><img src="../images/heart.png" width="300" height="240" border="0" align="left" alt="Антибиотики"></a></p>
        <p><a href="../categories/skin.php"><img src="../images/skin.png" width="300" height="240" border="0" align="middle" alt="Антибиотики"></a></p>
        <p><a href="../categories/eat.php"><img src="../images/eat.png" width="300" height="240" border="0" align="right" alt="Антибиотики"></a></p>
    </div>

    <a class="notpodcherk" href="../html/policy.html">Политика обработки персональных данных</a>


</div>

</body>
</html>
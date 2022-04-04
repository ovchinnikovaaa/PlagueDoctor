<?php

require_once "../php/db.php";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/head.css" type="text/css"/>
    <title>Pharmacy</title>

    <!--<script src="../js/city_confirm.js"></script>-->

</head>
<body>

<div class="main">

    <div class="top_string">
        <h2> Бесплатный звонок: 8-999-999-99-99 (с 8:00 до 23:00) <div class="login_check"> <?php echo $_SESSION['logged_user']->login; ?> </div> </h2>
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
                <li><a href="main.php">Главная</a></li>
                <li><a href="../php/catalog.php">Каталог</a>
                        <ul class="submenu">
                            <li><a href="../php/horrible.php" class="notpodcherk">Все товары</a></li>
                        </ul>
                </li>
                <li><a href="adresses.php">Адреса аптек</a></li>
                <li><a href="vacancy.php">Вакансии</a></li>
                <li><a href="contact.php">Контакты</a></li>
            </ul>


        </div>

    </div>

    <!--<a href="../php/horrible.php">Перейти в корзину</a>-->
    <!--<a href="../php/enter.php">Личный кабинет</a>-->

    <div class="parent">

        <div class="child">
            «Чумной доктор» это:
        </div>

        <div class="child1">
            <img src="../images/main_pic_1.png" height="360" width="360" >
            <img src="../images/main_pic_2.png" height="360" width="360" align="right">
        </div>

        <div class="he"></div>

        <div class="child2">
            <img src="../images/main_pic_3.png" height="360" width="360" >
            <img src="../images/main_pic_4.png" height="360" width="360" align="right">
        </div>
    </div>
</div>

</body>
</html>

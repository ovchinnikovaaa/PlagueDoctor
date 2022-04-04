<?php

require_once "../php/db.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
    <link rel="stylesheet" href="../css/head.css" type="text/css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Контакты</title>

    <!--<style>
        body {
            margin: 0; /* Убираем отступы */
        }
        .parent {
            font-family: Georgia, serif;
            margin-top: 5%; /* Отступы вокруг элемента */
            margin-left: 15%;
            margin-right: 15%;
            background: #c7dbff; /* Цвет фона */
            padding: 10px; /* Поля вокруг текста */
        }
        .child {
            /*border: 3px solid #666; /* Параметры рамки */
            font-family: Georgia, serif;
            padding: 10px; /* Поля вокруг текста */
            margin: 10px; /* Отступы вокруг */
            font-size: 48px;
            color: Black;
        }
        .child1 {
            font-family: Georgia, serif;
            padding: 10px; /* Поля вокруг текста */
            margin: 10px; /* Отступы вокруг */
            font-size: 20px;
            color: Black;
        }
        .notpodcherk /* у ссылки с классом notpodcherk не будет подчеркивания по умолчанию */
        {
            text-decoration: none
        }
    </style>-->

</head>
<body>

<div class="main">
</div>
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
                </ul></li>
            <li><a href="adresses.php">Адреса аптек</a></li>
            <li><a href="vacancy.php">Вакансии</a></li>
            <li><a href="contact.php">Контакты</a></li>
        </ul>
    </div>
</div>
</div>

<div class="parent">

    <div class="child">
        Контакты
    </div>

    <div class="child1">
        <p> По всем интересующим вопросам о работе аптечной сети «Чумной доктор» обращайтесь по телефону горячей линии: 8 (999) 999-99-99 (звонок бесплатный). </p>
        <p>Хотите начать сотрудничество с нашей компанией или возникли вопросы по работе аптечной сети «Чумной доктор»? </p>
        <p><b>Рассмотрю предложения по аренде/приобретению в собственность торговых помещений под аптеки:</b></p>
        <p>Пример Примеров<br>Руководитель аптечной сети</br>example@plaguedoctor.ru</p>
        <p><b>Буду рада ответить на вопросы и предложения по рекламе и маркетингу:</b></p>
        <p>Примера Примерова<br>Специалист отдела маркетинга и рекламы</br>example@plaguedoctor.ru</p>
        <p><b>Хотите у нас работать? Трудоустроим лучшие кадры! </b></p>
        <p>Пример Примеров<br>Ведущий менеджер по персоналу</br>example@plaguedoctor.ru </p>
    </div>

    <a class="notpodcherk" href="policy.html">Политика обработки персональных данных</a>

</div>

</body>
</html>
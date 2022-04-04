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
    <title>Адреса аптек</title>

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
</div>

<div class="parent">

    <div class="child">
        Адреса аптек в Воронеже:
    </div>

    <div class="child1">

        <p><a class="notpodcherk" href="error.html" TARGET="adresses"> <b>Аптека №1</b></a></p>
        <p>Адрес аптеки: ул. Куколкина, 31<br>Часы работы: круглосуточно</br>Телефон: +7 (999) 123-32-11</p>

        <p><a class="notpodcherk" href="error.html" TARGET="adresses"> <b>Аптека №2</b></a></p>
        <p>Адрес аптеки: ул. Защитников Родины, 9<br>Часы работы: 9:00 - 20:00</br>Телефон: +7 (999) 123-32-12</p>

        <p><a class="notpodcherk" href="error.html" TARGET="adresses"> <b>Аптека №3</b></a></p>
        <p>Адрес аптеки: Московский проспект, 116А<br>Часы работы: 8:00 - 21:00</br>Телефон: +7 (999) 123-32-13</p>

        <p><a class="notpodcherk" href="error.html" TARGET="adresses"> <b>Аптека №4</b></a></p>
        <p>Адрес аптеки: ул. Матросова, 6<br>Часы работы: круглосуточно</br>Телефон: +7 (999) 123-32-14</p>

        <p><a class="notpodcherk" href="error.html" TARGET="adresses"> <b>Аптека №5</b></a></p>
        <p>Адрес аптеки: ул. Димитрова, 8<br>Часы работы: круглосуточно</br>Телефон: +7 (999) 123-32-15</p>

    </div>

    <p>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A182b5f95147521c18a1dea5201cefd442f4da82512587add4ca31c73adb80539&amp;width=100%25&amp;height=449&amp;lang=ru_RU&amp;scroll=true"></script>
    </p>

    <a class="notpodcherk" href="policy.html">Политика обработки персональных данных</a>

</div>


</body>
</html>
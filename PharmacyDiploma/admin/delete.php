<?php

require_once '../php/connection.php';
require_once "../php/db.php";

?>

    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <html>
    <head>
        <link rel="stylesheet" href="../css/head.css" type="text/css"/>
        <link rel="stylesheet" href="../css/newStyle.css" type="text/css"/>
        <link rel="stylesheet" href="../css/forLogin.css" type="text/css"/>
        <link rel="stylesheet" href="../css/forAdminFields.css" type="text/css"/>


        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <title>Удалить товар</title>

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

    <div id="container">
    <div id="main1">
 <h1>Выберите товар для удаления: </h1>
<?php
?>
        <table>
            <tr>
                <th>Название</th>
                <th>Поставщик</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Изображение</th>
                <th>Удалить</th>
            </tr>

            <!-- тут происходит выборка данных из бд -->

            <?php

            $sql = $mysql->query("SELECT * FROM `products`, `dealers` WHERE `products`.`id_dealer` = `dealers`.`id_dealer` ORDER BY name");

            while ($row = $sql->fetch_array()) {

                ?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['dealer_name']?></td>
                    <td><?php echo $row['description']?></td>
                    <td><?php echo $row['price']?> руб</td>
                    <td><img src ='<?php echo $row['pic']?>' width="100" alt=""></td>
                    <td><a style="color: red;" class="notpodcherk" href="delete.php?id=<?= $row['id_product'] ?>">Удалить</a></td>
                </tr>

                <?php

            }
            ?>
        </table>

        <!--<a href="../php/enter.php">Вернуться к кабинету админа</a>-->
<?php

$id =  $_GET['id'];
/*
 * Делаем запрос на удаление строки из таблицы products
 */

$mysql->query("DELETE FROM `products` WHERE `products`.`id_product` = '$id'");

/*
 * Переадресация на главную страницу
 */

//header('Location: ../php/enter.php');
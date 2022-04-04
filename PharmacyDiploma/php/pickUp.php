<?php

require_once "../php/db.php";

$min = 1;
$max = 10000;
$status = 0;
$id_order = rand($min, $max);

?>

<?php
session_start();
require("../php/connection.php");

if(isset($_POST['change'])) {
    foreach($_POST['quantity'] as $key => $val) {
        if($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['quantity'] = $val;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/forList.css" />
    <link rel="stylesheet" href="../css/head.css" type="text/css"/>
    <link rel="stylesheet" href="../css/forLogin.css" type="text/css"/>
    <link rel="stylesheet" href="../css/forOrderRegistration.css" type="text/css"/>

    <title>Самовывоз</title>

    <script type="text/javascript">
        function $(param) {

        }

        $(function () {

        })
    </script>

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

    <div id="container">

        <!--<div id="main1">-->

        <h1>Оформление заказа</h1>
        <hr>
        <!-- здесь код для "ваши покупки" наверху -->
        <div class="col-25">
            <div class="container">
                <?php
                if($_SESSION['logged_user']->login) {
                    ?> <p>Ваш заказ: </p><?php
                    if(isset($_SESSION['cart'])) {
                        $sql = "SELECT * FROM `products` WHERE id_product IN(";
                        foreach($_SESSION['cart'] as $id => $value) {
                            $sql.=$id.",";
                        }
                        $sql=substr($sql, 0, -1).") ORDER BY name";

                        $query = $mysql->query($sql);
                        while ($row = $query->fetch_array()) {

                            ?>
                            <?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?> <span class="price"> <?php echo $row['price']*$_SESSION['cart'][$row['id_product']]['quantity']; $subtotal1 = $_SESSION['cart'][$row['id_product']]['quantity']*$row['price']; $totalprice1 += $subtotal1; ?> руб.</span></p>
                            <?php
                        }
                    }
                    ?>
                    <hr>
                    <p>Итого: <?php echo $totalprice1; ?> руб.</p> <?php
                } ?>
            </div>
        </div>
        <!-- здесь код для формы оформления заказа -->
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form action="cart.php" method="post">
                        <div class="row">
                            <div class="col-50">
                                <h3>Платежный адрес</h3>
                                <label for="fname"><i class="fa fa-user"></i> Фамилия Имя</label>
                                <input type="text" id="fname" name="firstname" placeholder="Иванов Иван">
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="email" name="email" placeholder="ivanov@example.com">


                                <div class="containerList">
                                    <span class="choose">Выберите аптеку</span>
                                    <div class="dropdownList">
                                        <div class="select">
                                            <span>Выберите аптеку</span>
                                            <i class="fa fa-chevron-left"></i>
                                        </div>
                                        <input type="hidden" name="pharmacyList">
                                        <ul class="dropdown-menuList">
                                            <li id="num1">Аптека №1</li>
                                            <li id="num2">Аптека №2</li>
                                            <li id="num3">Аптека №3</li>
                                            <li id="num4">Аптека №4</li>
                                            <li id="num5">Аптека №5</li>
                                        </ul>
                                    </div>
                                    <span class="msg"></span>
                                </div>
                                <script src="../js/forList.js" ></script>

                            </div>

                            </div>

                            <div class="col-50">
                                <h3>Оплата</h3>
                                <label for="fname">Принимаемые карты</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>
                                <label for="cname">Имя обладателя</label>
                                <input type="text" id="cname" name="cardname" placeholder="Иванов Иван">
                                <label for="ccnum">Номер кредитной карты</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                                <label for="expmonth">Срок действия</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="Месяц (две цифры)">
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Год</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2018">
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <label>
                            <!--<input type="checkbox" checked="checked" name="sameadr"> Адрес доставки совпадает с платежным адресом-->
                        </label>
                        <button type="submit" name="submit" class="btn">Оформить заказ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
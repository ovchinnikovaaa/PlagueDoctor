<?php

require_once "../php/db.php";

?>

<?php
        session_start();
        require("../php/connection.php");
        require("../php/forSearch.php");

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/newStyle.css" />
    <link rel="stylesheet" href="../css/search.css" />
    <link rel="stylesheet" href="../css/head.css" type="text/css"/>

    <title>Все товары</title>

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

        <!-- Тут просто вывод таблицы со всеми товарами -->
        <?php
        require("../php/products.php");
        ?>

    </div>


    <div id="sidebar">
        <h1>Ваши покупки:</h1>
        <?php
        if(empty($_SESSION['logged_user']->login)) { ?> <p>Для совершения покупок необходимо войти или зарегистрироваться!</p> <?php }
        if($_SESSION['logged_user']->login) {
            if(isset($_SESSION['cart'])) {
                $sql = "SELECT * FROM `products` WHERE id_product IN(";
                foreach($_SESSION['cart'] as $id => $value) {
                    $sql.=$id.",";
                }
                $sql=substr($sql, 0, -1).") ORDER BY name";

                $query = $mysql->query($sql);
                while ($row = $query->fetch_array()) {

                    ?>
                        <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?></p>
                    <?php
                }

        ?>
                <hr />
                <a href="cart.php">Перейти к корзине</a>
                <?php
            } else {
                echo "<p>Ваша корзина пуста! Добавьте что-нибудь :( </p>";


            }
        } ?>

    </div>

    </div>

</body>
</html>
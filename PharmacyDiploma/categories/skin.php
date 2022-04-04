<?php

require_once "../php/db.php";
require_once "../php/connection.php";

if (isset($_GET['page'])) {
    $pages = array('products', 'cart');

    if (in_array($_GET['page'], $pages)) {

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


            <h1>Наш ассортимент в категории "Дерматология":</h1>

            <table>
                <tr>
                    <th>Название</th>
                    <th>Производитель</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Изображение</th>
                    <th>Корзина</th>
                </tr>

                <!-- тут происходит выборка данных из бд -->

                <?php

                $zero_amount = 0;
                $sql = $mysql->query("SELECT DISTINCT * FROM `products`, `dealers` WHERE `products`.`description` = 'Дерматология' && `products`.`id_dealer` = `dealers`.`id_dealer` && `amount` != '$zero_amount'");

                while ($row = $sql->fetch_array()) {

                    ?>
                    <tr>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['dealer_name']?></td>
                        <td><?php echo $row['description']?></td>
                        <td><?php echo $row['price']?> руб</td>
                        <td><img src ='<?php echo $row['pic']?>' width="100" alt=""></td>
                        <td><a href="skin.php?page=products&action=add&id=<?php echo $row['id_product']?>" onclick="<?php if(($_SESSION['logged_user']->login == 'NULL')) { print ("<script language=javascript> alert('Для добавления товара в корзину необходимо войти или зарегистироваться!'); </script>"); } ?> "> Добавить в корзину</a> </td>

                    </tr>

                    <?php

                }
                ?>
            </table>

        </div>
    </div>
<?php

<?php

require '../php/connection.php';
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
    <title>Добавить товар</title>

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
<h1>Выберите товар для изменения:</h1>

<table>
    <tr>
        <th>Название</th>
        <th>Поставщик</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Изображение</th>
        <th>Изменить</th>
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
            <td><a style="color: green;" class="notpodcherk" href="update.php?id=<?= $row['id_product'] ?>">Изменить</a></td>
        </tr>

        <?php

    }
    ?>
</table>

</div>
    </div>
</div>

<?php

$product_id = $_GET['id'];

$product = $mysql->query("SELECT * FROM `products`, `dealers` WHERE `products`.`id_dealer` = `dealers`.`id_dealer` && `products`.`id_product` = '$product_id' ORDER BY name");

$product = $product->fetch_assoc();

?>

<div class="parent1">

    <form action="update1.php" method="post" class="form">

        <h3 class="form_title">Изменить товар</h3>

        <input type="hidden" name="id" value="<?= $product['id_product'] ?>">

        <p>Название</p>
        <input type="text" class="field_type" name="name" value="<?= $product['name'] ?>">

        <p>Поставщик</p>
        <input type="text" class="field_type" name="dealer_name" value="<?= $product['dealer_name'] ?>">

        <p>Описание</p>
        <textarea class="field_type" name="description"><?= $product['description'] ?></textarea>

        <p>Цена</p>
        <input type="number" class="field_type" name="price" value="<?= $product['price'] ?>">

        <p>Количество</p>
        <input type="number" class="field_type" name="price" value="<?= $product['amount'] ?>">

        <p>Изображение</p>
        <input type="text" class="field_type" name="pic" value="<?= $product['pic'] ?>"> <br> <br>

        <button type="submit" class="form_button">Изменить</button>
    </form>
</div>

    <!--<a href="../php/enter.php">Вернуться к кабинету админа</a>-->
</body>
</html>
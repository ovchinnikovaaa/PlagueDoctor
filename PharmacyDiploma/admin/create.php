<?php

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
    </div>

    <div class="parent1">

<form action="create.php" method="post" class="form">

    <h3 class="form_title">Добавить в базу данных</h3>

    <p>Название</p>
    <input type="text" name="name" class="field_type">

    <p>Поставщик</p>
    <input type="text" name="dealer" class="field_type" >

    <p>Описание</p>
    <textarea name="description" placeholder="Введите описание" class="field_type"></textarea>

    <p>Цена</p>
    <input type="number" name="price" class="field_type">

    <p>Количество</p>
    <input type="number" name="price" class="field_type">

    <p>Изображение</p>
    <input type="text" name="pic" class="field_type" ><br> <br>

    <button type="submit" name="add" class="form_button">Добавить</button>
</form>

<?php

//Добавление нового продукта

require_once '../php/connection.php';

$title = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$pic = $_POST['pic'];
$dealer = $_POST['dealer'];
$amount = $_POST['amount'];

/*
 * Делаем запрос на добавление новой строки в таблицу products
 */

// Проверка на дублирование названия
$result = $mysql->query("SELECT * FROM `products` where `name`='$title'");
$duplicate_name = $result->fetch_assoc();

if (count($duplicate_name) != 0) {
    print (" 
<script language=javascript>
alert('Препарат $title уже существует!');
</script> 
");
} else {
    $mysql->query("INSERT INTO `products` (`id_dealer`,`name`, `description`, `price`, `amount`,`pic`) VALUES ('$dealer', '$title', '$description', '$price', '$amount', '$pic')");
} ?>
    </div>
</body>
    </html>

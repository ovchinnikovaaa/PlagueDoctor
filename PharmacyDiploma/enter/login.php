<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/head.css" type="text/css"/>
<link rel="stylesheet" href="../css/forLogin.css" type="text/css"/>

<html>
<head>
    <title>Регистрация</title>


</head>
<body>

<div class="main">

    <div class="top_string">
        <h2> Бесплатный звонок: 8-999-999-99-99 (с 8:00 до 23:00) </h2>

        <div class="header">
            <div class="logo">
                <img src="../images/logo.png" height="126" width="240" alt="logo" title="logo">
            </div>
        </div>
    </div>

    <!--<a href="../html/main.php">Вернуться на главную страницу</a><br>-->
<?php

require "../php/db.php";

$data = $_POST;

if(isset($data['do_login'])) {

    $errors = array();
    $user = R::findOne('users', "login = ?", array($data['login']));
    if($user) {
        // логин существует
        if(password_verify($data['password'], $user->password)) {
            // все хорошо, логиним пользователя
            $_SESSION['logged_user'] = $user;
            //echo '<div style="color: forestgreen;">Вы авторизованы! <br/> Можете перейти на <a href="../php/enter.php">главную </a> страницу!</div><hr>';
            print("<script> alert('Вы успешно авторизированы!'); location = '../html/main.php'; </script>");
        } else {
            //$errors[] = 'Пароль неправильно введен!';
            print("<script> alert('Пароль неправильно введен!');");
        }
    } else {
        //$errors[] = 'Пользователь с таким логином не найден!';
        print("<script> alert('Пользователь с таким логином не найден!');");
    }

    /*if(!empty($errors)) {
        echo '<div style="color: darkred;">'.array_shift($errors).'</div><hr>';
    }*/
}

?>

    <div class="parent1">
<form class="form" action="login.php" method="post">

    <h1 class="form_title">Вход</h1>

    <div class="form_grup">
        <label class="form_label">Логин</label>
        <input class="form_input" placeholder=" " type="text" name="login" value="<?php echo @$data['login']; ?>">
    </div>

    <div class="form_grup">
        <label class="form_label">Пароль</label>
        <input class="form_input" placeholder=" " type="password" name="password" value="<?php echo @$data['password']; ?>">
    </div>

    <button class="form_button" type="submit" name="do_login">Войти</button>

    <p>Нет аккуата? <a href="../enter/signup.php" class="notpodcherk">Зарегистрируйтесь!</a></p>

</form>
    </div>


<?php

require "../php/db.php";

?>
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

$data = $_POST;

if(isset($data['do_signup'])) {
    // здесь регистрируем

    // проверка логина, email и пароля
    $errors = array();
    if(trim($data['login']) == '') {
        $errors[] = 'Введите логин';
        print("<script> alert('Введите логин'); </script>");
    }

    if(trim($data['email']) == '') {
        $errors[] = 'Введите email';
        print("<script> alert('Введите email'); </script>");
    }

    if($data['password'] == '') {
        $errors[] = 'Введите пароль';
        print("<script> alert('Введите пароль'); </script>");
    }

    if($data['password2'] != $data['password']) {
        $errors[] = 'Пароли не совпадают!';
        print("<script> alert('Пароли не совпадают!'); </script>");
    }

    if(R::count('users', "login = ?", array($data['login'])) > 0 ) {
        $errors[] = 'Пользователь с таким логином уже существует!';
        print("<script> alert('Пользователь с таким логином уже существует!'); </script>");
    }

    if(R::count('users', "email = ?", array($data['email'])) > 0 ) {
        $errors[] = 'Пользователь с таким email уже существует!';
        print("<script> alert('Пользователь с таким email уже существует!'); </script>");
    }

    if(empty($errors)) {
        // все хорошо, регаем

        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        //echo '<div style="color: forestgreen;">Вы успешно зарегистрированы!</div><hr>';
        print("<script> alert('Вы успешно зарегистрированы!'); location = '../enter/login.php'; </script>");
    } /*else {
        echo '<div style="color: darkred;">'.array_shift($errors).'</div><hr>';
    } */

}

?>

    <div class="parent2">
<form class="form1" action="signup.php" method="post">

    <h1 class="form_title">Регистрация</h1>

    <div class="form_grup">
        <label class="form_label">Логин</label>
        <input class="form_input" placeholder=" " type="text" name="login" value="<?php echo @$data['login']; ?>">
    </div>

    <div class="form_grup">
        <label class="form_label">Email</label>
        <input class="form_input" placeholder=" " type="email" name="email" value="<?php echo @$data['email']; ?>">
    </div>

    <div class="form_grup">
        <label class="form_label">Пароль</label>
        <input class="form_input" placeholder=" " type="password" name="password" value="<?php echo @$data['password']; ?>">
    </div>

    <div class="form_grup">
        <label class="form_label">Повторите пароль</label>
        <input class="form_input" placeholder=" " type="password" name="password2" value="<?php echo @$data['password2']; ?>">
    </div>

    <button class="form_button" type="submit" name="do_signup">Загеристрироваться</button>

</form>

    </div>

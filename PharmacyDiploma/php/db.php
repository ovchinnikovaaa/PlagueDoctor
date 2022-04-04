<?php

require "../libs/rb.php";

//mysqli_connect('localhost', 'root', 'root', 'users');

R::setup( 'mysql:host=localhost;dbname=users',
    'root', 'root' );

session_start();

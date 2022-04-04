<?php

$server = "localhost";
$user = "root";
$pass = "root";
$dbname = "products";

//соединение с бд

$mysql = new mysqli($server, $user, $pass, $dbname);

$mysql->select_db($dbname) or die("Sorry can't connect to DB!");
<?php

$server = "localhost";
$user = "root";
$pass = "root";
$dbname = "orders";

$mysql = new mysqli($server, $user, $pass, $dbname);

$mysql->select_db($dbname) or die("Sorry can't connect to DB!");

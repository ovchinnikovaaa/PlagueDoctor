<?php

require "../php/db.php";

unset($_SESSION['logged_user']);

header('Location: ../html/main.php');


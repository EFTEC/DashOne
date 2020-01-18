<?php

use eftec\DashOne\DashOne;

@session_start();
include "../vendor/autoload.php";


$user= DashOne::getLogin('testlogin.php');

echo "<h1>Login correct</h1>";

var_dump($_SESSION['user']);

echo "<br><a href='testlogin3.php'>Logout</a>";
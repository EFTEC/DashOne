<?php

use eftec\DashOne\DashOne;

@session_start();
include "../vendor/autoload.php";


DashOne::logout('testlogin.php');

@session_write_close();
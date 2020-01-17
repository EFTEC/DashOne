<?php
@session_start();
@session_write_close();
$user=@$_SESSION['user'];
if(!$user && $user['result']!==false) {
    header('location:testlogin.php');
}
echo "<h1>Login correct</h1>";

var_dump($_SESSION['user']);

<?php

use eftec\DashOne\controls\ContainerOne;
use eftec\DashOne\controls\ControlOne;
use eftec\DashOne\controls\ButtonOne;
use eftec\DashOne\controls\ImageOne;
use eftec\DashOne\DashOne;
use eftec\DashOne\controls\LinkOne;
use eftec\DashOne\controls\UlOne;
use eftec\DashOne\controls\FormOne;
use eftec\DashOne\controls\TableOne;
@session_start();
include "../vendor/autoload.php";

$valueUL=['Cocacola','Fanta','Sprite'];

/**
 * @param array $user =['username' => '', 'password' => '', '_csrf' => '','result'=>false]
 *
 * @return bool
 */
/*
$validateLogin= function($user) {
    return $user['username'] === 'john' && $user['password'] === 'doe';
};
$dash=new DashOne(false,false,'salt_123',$validateLogin);
*/
$dash=new DashOne(false,false,'salt_123',['user'=>'john','password'=>'doe']);

if (!$dash->checkCSRF()) {
    die(1);
}

$user=[];
$dash->fetchLogin($user);


if($user['result']) {
    header('location:testlogin2.php');
    die(1);
} else {
    $message='user or password incorrect';
}


$dash->head('Example - test 1','',true)
    ->login($user,null,'user "john" and password "doe"')
        ->alert($message)
        ->footer()
    ->endLogin()
->render();

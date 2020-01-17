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
$validateLogin= function($user) {
    if($user['username']=='john' && $user['password']=='doe') {
        return true;
    }
    return false;
};

$dash=new DashOne(false,false,'salt_123',$validateLogin);
$user=[];
$dash->fetchLogin($user);

if($user['result']) {
    header('location:testlogin2.php');
    $message='ok';
} else {
    $message='';
}


$dash->head('Example - test 1','',true);
$dash->login($user);
$dash->alert($message);
$dash->footer();
$dash->endLogin();
$dash->render();

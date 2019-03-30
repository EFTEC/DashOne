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

include "../vendor/autoload.php";

$links=[
	new LinkOne('Link1','#','far fa-star'),
	new LinkOne('Link2','#','far fa-star'),
	new LinkOne('Link3','#','far fa-star')
];


$dash=new DashOne();
$dash->head('Example - test 1')
	->menuUpper(['Upper title'])
	->startcontent()
	->menu($links) // left menu
	->startmain()
	// here it goes the content
		->alert("It is an alert","Content of the alert","alert alert-danger")
		->container("<hr>%control<hr>")->rawHtml("hello world")
	->endmain()
	->endcontent()
	->footer()
	->render();	
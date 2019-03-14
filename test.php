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

include "lib/DashOne.php";
include "lib/controls/ControlOne.php";
include "lib/controls/FormOne.php";
include "lib/controls/LinkOne.php";
include "lib/controls/TableOne.php";
include "lib/controls/UlOne.php";
include "lib/controls/ButtonOne.php";
include "lib/controls/ContainerOne.php";
include "lib/controls/ImageOne.php";

$valueUL=['Cocacola','Fanta','Sprite'];

$values=
	[
		['IdProduct'=>1,'Name'=>'Cocacola','Price'=>"20.2","Buttons"=>[new LinkOne('button1','#','icon')]],
		['IdProduct'=>2,'Name'=>'Fanta','Price'=>"30.5",[new ButtonOne('https://www.google.cl',"click",'btn btn-danger','link')]],
		['IdProduct'=>3,'Name'=>'Sprite','Price'=>"11.5"],
	];

$definition=['IdProduct'=>'hidden','Name'=>'text','Price'=>'text','Type'=>['cocacola','fanta','sprite']];
$currentValue=['IdProduct'=>"2",'Name'=>"aaa",'Price'=>"333",'Type'=>1];

$buttons=[
	new ButtonOne('button1','Click me','btn btn-primary'),
	new ButtonOne('button2','Click me too','btn btn-danger')
];

$links=[
	new LinkOne('Link1','#','users'),
	new LinkOne('Link2','#','shopping-cart'),
	new LinkOne('Link3','#','home')
];

$dash=new DashOne();
$dash->companyName="Cocacola";
$dash->head('Example');
$dash->menuUpper([new ImageOne('https://via.placeholder.com/32x32')," - ",new LinkOne('Cocacola','#')]);
$dash
	->startcontent()
		->menu($links)
		->startmain()
			->title('Table of Products')
			->rawHtml('<br>')
			->table($values)->setClass('table table-stripped')->setId('table1')
			->title('Form')
			->rawHtml('<br>')
			->form($currentValue,$definition)
			->container("<div class='form-group row'><div class='col-sm-10 offset-sm-2'>%control</div></div>")->buttons($buttons)
			->ul($valueUL)
		->endmain()
	->endcontent();
$dash->footer();
echo $dash->render();

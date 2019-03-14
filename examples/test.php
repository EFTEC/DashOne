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

$valueUL=['Cocacola','Fanta','Sprite'];

$values=
	[
		['IdProduct'=>1,'Name'=>'Cocacola','Price'=>"20.2","Buttons"=>[new LinkOne('button1','#','icon')]],
		['IdProduct'=>2,'Name'=>'Fanta','Price'=>"30.5",[new ButtonOne('https://www.google.cl',"click",'btn btn-danger btn-sm','link')]],
		['IdProduct'=>3,'Name'=>'Sprite','Price'=>"11.5"],
	];

$definition=['IdProduct'=>'hidden','Name'=>'text','Price'=>'text','Type'=>['cocacola','fanta','sprite'],'Description'=>'textarea'];
$currentValue=['IdProduct'=>"2",'Name'=>"aaa",'Price'=>"333",'Type'=>1,'Description'=>''];

$buttons=[
	new ButtonOne('button1','Click me','btn btn-primary'),
	new ButtonOne('button2','Click me too','btn btn-danger')
];

$links=[
	new LinkOne('Link1','#','far fa-star'),
	new LinkOne('Link2','#','far fa-star'),
	new LinkOne('Link3','#','far fa-star')
];

$dash=new DashOne();
$dash->companyName="Cocacola";
$dash->head('Example - test 1');
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
			->container("<div class='form-group row'><div class='col-sm-10 offset-sm-2'>%control</div></div>")
				->buttons($buttons)
			->ul($valueUL)
			->rawHtml("<br><br>")
		->endmain()
	->endcontent();
$dash->footer();
$dash->render();

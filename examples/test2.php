<?php
use eftec\DashOne\controls\ControlOne;
use eftec\DashOne\controls\ButtonOne;
use eftec\DashOne\DashOne;
use eftec\DashOne\controls\LinkOne;
use eftec\DashOne\controls\UlOne;
use eftec\DashOne\controls\FormOne;
use eftec\DashOne\controls\TableOne;

include "../vendor/autoload.php";


$values=
	[
		['IdProduct'=>1,'Name'=>'Cocacola','Price'=>"20.2","Buttons"=>[new LinkOne('button1','#','icon')]],
		['IdProduct'=>2,'Name'=>'Fanta','Price'=>"30.5",[new ButtonOne('https://www.google.cl',"click",'btn btn-danger','link')]],
		['IdProduct'=>3,'Name'=>'Sprite','Price'=>"11.5"],
	];

$value=['IdProduct'=>1,'Name'=>'Cocacola','Price'=>"20.2",'Type'=>['cocacola','fanta','sprite']];

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
$dash->menuUpper();
$dash
	->startcontent()
		->startmain()
			->title('Table of Products')
			->rawHtml('<br>')
			->table($values)->setClass('table table-stripped')->setId('table1')
			->title('Form')
			->rawHtml('<br>')
			->form($value)
			->container("<div class='form-group row'><div class='col-sm-10 offset-sm-2'>%control</div></div>")->buttons($buttons)
		->endmain()
	->endcontent();
$dash->footer();
echo $dash->render();

# DashOne
A minimalist dashboard /backend library  for PHP


[![Build Status](https://travis-ci.org/EFTEC/DashOne.svg?branch=master)](https://travis-ci.org/EFTEC/DashOne)
[![Packagist](https://img.shields.io/packagist/v/eftec/dashone.svg)](https://packagist.org/packages/eftec/dashone)
[![Total Downloads](https://poser.pugx.org/eftec/dashone/downloads)](https://packagist.org/packages/eftec/dashone)
[![Maintenance](https://img.shields.io/maintenance/yes/2019.svg)]()
[![composer](https://img.shields.io/badge/composer-%3E1.6-blue.svg)]()
[![php](https://img.shields.io/badge/php->5.6-green.svg)]()
[![php](https://img.shields.io/badge/php-7.x-green.svg)]()
[![CocoaPods](https://img.shields.io/badge/docs-70%25-yellow.svg)]()

With this library, it is possible to create a fast dashboard (backend) without need to edit html or use a template.  




Example:

![doc/screenshot1.jpg](doc/screenshot1.jpg)


Example:

![doc/screenshot2.jpg](doc/screenshot2.jpg)


## Getting started

Install via composer 

> composer require eftec/dashone

### A basic page :

Any pages requires at least to call the head() and footer().  Render() draws the end page

```php
$dash=new DashOne();

$dash->head('Example - test 1');
$dash->footer();
$dash->render();
```

### An empty dashboard:

 
```php
$dash=new DashOne();

$dash->head('Example - test 1');
$dash->menuUpper([new ImageOne('https://via.placeholder.com/32x32')," - ",new LinkOne('Cocacola','#')]);
$dash
	->startcontent() // start the container
		->menu($links) // left menu
		->startmain() // start the main container
			->title('Table of Products')
		->endmain()
	->endcontent();
$dash->footer();
$dash->render();
```

### Drawing a table

```php
$values=
	[
		['IdProduct'=>1,'Name'=>'Cocacola','Price'=>"20.2"],
		['IdProduct'=>2,'Name'=>'Fanta','Price'=>"30.5"],
		['IdProduct'=>3,'Name'=>'Sprite','Price'=>"11.5"],
	];

$dash->table($values)->...  // it must be called after the render
```    

![doc/screenshottable.jpg](doc/screenshottable.jpg)


### Drawing a form

You could draw a form using an associative array. By default, every field will be a textbox

```php
$currentValue=['IdProduct'=>"2"
	,'Name'=>"aaa"
	,'Price'=>"333"
	,'Type'=>1
	,'Description'=>''];

$dash->form($currentValue)
``` 

![doc/screenshotform0.jpg](doc/screenshotform0.jpg)

Or you could explicit the type of field

```php
$definition=['IdProduct'=>'hidden'
	,'Name'=>'text'
	,'Price'=>'text'
	,'Type'=>['cocacola','fanta','sprite']
	,'Description'=>'textarea'];
$currentValue=['IdProduct'=>"2"
	,'Name'=>"aaa"
	,'Price'=>"333"
	,'Type'=>1
	,'Description'=>''];

$dash->form($currentValue,$definition)
``` 

![doc/screenshotform.jpg](doc/screenshotform.jpg)

### Drawing a list (unsorted list)

```php
$valueUL=['Cocacola','Fanta','Sprite'];

$dash->ul($valueUL)
```

![doc/screenshotul.jpg](doc/screenshotul.jpg)

### Drawing buttons

```php

$buttons=[
	new ButtonOne('button1','Click me','btn btn-primary'),
	new ButtonOne('button2','Click me too','btn btn-danger')
];


$dash->buttons($buttons,false) // where if true then buttons are aligned with the form

```

> $dash->buttons($buttons,true) 

![doc/screenshotbutton1.jpg](doc/screenshotbutton1.jpg)

> $dash->buttons($buttons,false)

![doc/screenshotbutton2.jpg](doc/screenshotbutton2.jpg)

## Copyright

Copyright Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
Dual License (LGPL v3 and Commercial License)  

You could use in commercial / close source product or service while  

In a nutshell (it is the license): 

* You must keep the copyright notices.  
* If you modify the library then you must share the changes and modifications.

   




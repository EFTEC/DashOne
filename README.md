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
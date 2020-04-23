# DashOne
A minimalist dashboard /backend library  for PHP

This library allows to create a fast dashboard with the basic features without any template and only using code.  In the examples, we create a page for a dashboard in less than 80 lines of code ( [examples/test.php](examples/test.php) )

[![Build Status](https://travis-ci.org/EFTEC/DashOne.svg?branch=master)](https://travis-ci.org/EFTEC/DashOne)
[![Packagist](https://img.shields.io/packagist/v/eftec/dashone.svg)](https://packagist.org/packages/eftec/dashone)
[![Total Downloads](https://poser.pugx.org/eftec/dashone/downloads)](https://packagist.org/packages/eftec/dashone)
[![Maintenance](https://img.shields.io/maintenance/yes/2020.svg)]()
[![composer](https://img.shields.io/badge/composer-%3E1.6-blue.svg)]()
[![php](https://img.shields.io/badge/php->5.6-green.svg)]()
[![php](https://img.shields.io/badge/php-7.x-green.svg)]()
[![CocoaPods](https://img.shields.io/badge/docs-70%25-yellow.svg)]()


Example  ( [examples/test.php](examples/test2.php) ):

![doc/screenshot1.jpg](doc/screenshot1.jpg)


Another example ( [examples/test.php](examples/test2.php) ):

![doc/screenshot2.jpg](doc/screenshot2.jpg)

## Getting started

Install via composer 

> composer require eftec/dashone

Create a new object DashOne (you will need to add the required include, via autoload.php or manually)

> $dash=new DashOne();

And you could render a page using the object of the class DashOne()

```php
use eftec\DashOne\DashOne;
$dash=new DashOne();
$dash->head('Example - test 1'); // it is required
$dash->rawHtml('hello world'); 
$dash->footer(); // it is required
$dash->render(); // it renders an empty page
```

## Classes

### DashOne

It is the main class that generates the dashboard.

> $dash=new DashOne();

It is possible to add new elements using fluent interface (chain methods each one).


Example: It renders an empty page

```php
use eftec\DashOne\DashOne;
$dash=new DashOne();

$dash->head('Example - test 1');
$dash->footer();
$dash->render();
```

Example using fluent

```php
use eftec\DashOne\DashOne;
$dash=new DashOne();
$dash->head('Example - test 1')
    ->footer()
    ->render();
```

Where the method head is required to render the < head > of the page.

The footer is also required to close all the tags.

And every chain of methods must end with the method render() (it draw the page).

```php
// see examples/testuibasic.php
$dash=new DashOne();
$dash->head('Example - test 1')
	->menuUpper(['Upper title'])
	->startcontent()
	->menu($links) // left menu
	->startmain()
	// here it goes the content
	->endmain()
	->endcontent()
	->footer()
	->render();		
```
![doc/screenshotdashboardempty.jpg](doc/screenshotdashboardempty.jpg)


#### Method DashOne->head($title,$extrahtml)

It renders the head of the page.  This element is required

> $dash->head('Example - test 1');

#### Method DashOne->menuUpper($leftControls=[],$rightControls=[])

It renders the upper menu of the dashboard.

> $dash->menuUpper([new ImageOne('https://via.placeholder.com/32x32')," - ",new LinkOne('Cocacola','#')]);




### AlertOne

It renders an alert

> new AlertOne($title,$content,$class);

Example:

```php
$dash->alert("It is an alert","Content of the alert")

```

![doc/screenshotalert.jpg](doc/screenshotalert.jpg)

```php
$dash->alert("It is an alert","Content of the alert","alert alert-danger")
```

![doc/screenshotalert2.jpg](doc/screenshotalert2.jpg)

### ButtonOne

It renders a button

> new ButtonOne('button1','Click me','btn btn-primary');

You could use the method buttons (DashOne) to render a button (or buttons).  The method has a second argument to determine if the buttons must be aligned or not with the form.

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


### ContainerOne

It renders a container where it is possible to add other elements (such as buttons)

> new ContainerOne($html);

Example:

```php
	$dash->container("<div class='form-group row'><div class='col-sm-10 offset-sm-2'>%control</div></div>")
		->buttons($buttons)
```
The method container() but be followed by a visual method. This method is added inside the container (where it says %control)

Another example:

```php
	$dash->container("<hr>%control<hr>")->rawHtml("hello world")
```

![doc/screencontainer.jpg](doc/screencontainer.jpg)



### FormOne

It renders a form. It requires a declarative array.

If it sets a definition, then it uses the definition to define the types of input objects (textbox,textarea,etc.)

If a field of the definition has an array then it is used to render a dropdownitem

If it doesn't have a definition then, it uses the values to define the types of input objects (textboxes,textareas,etc.)



You could also render a message (for example for warning or information)
You could draw a form using an associative array. By default, every field will be a textbox

```php
$currentValue=['IdProduct'=>"2"
	,'Name'=>"aaa"
	,'Price'=>"333"
	,'Type'=>1
	,'Description'=>''];

$dash->form($currentValue) // it's macro of new FormOne()
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

$dash->form($currentValue,$definition) // it's macro of new FormOne()
```

![doc/screenshotform.jpg](doc/screenshotform.jpg)

### UlOne

It draws a list (unsorted list)

```php
$valueUL=['Cocacola','Fanta','Sprite'];

$dash->ul($valueUL) // it's macro of new UlOne()
```

![doc/screenshotul.jpg](doc/screenshotul.jpg)

### ImageOne

It draws a image

> new ImageOne('https://via.placeholder.com/32x32');

![https://via.placeholder.com/32x32](https://via.placeholder.com/32x32)

### LinkOne

It draws a hyperlink

The first value is the name of the link, the second is the address. And the third value (optional), it's a icon (using the classes of Font-Awesome)

> new LinkOne('Cocacola','#','far fa-star')
> $dash->link('Cocacola','#','far fa-star')

![doc/link.jpg](doc/link.jpg)



### TableOne

it renders a table.

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




### A basic page :

Any pages requires at least to call the head(), footer() and Render().

Render() draws the page so it must be called at the end of the chain.

For example, a basic page is as follow:


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

### Login Page

[examples/testlogin.php](examples/testlogin.php)

![doc/login.jpg](doc/login.jpg)

The library has a build-in login page that it relies on PHP's session variable.

To use a the function, the session must be enabled

```php
@session_start(); // or via php.ini
```

And we could read the current session as follow:

```php
$_SESSION['user'];
// array(5) { ["username"]=> "" ["password"]=> "" ["remember"]=> "" ["_csrf"]=>  "" ["result"]=> bool(true) }
```



#### Step 1 Initialize Login Page

To create a login page, you must initialize in the constructor as follow

Using an array (user and password)

```php
$dash=new DashOne(false,true,'salt_123',['user'=>'john','password'=>'doe']);
```

Or using a method

```php
$validateLogin= function($user) {
    // this method could access to the database
    return $user['username'] === 'john' && $user['password'] === 'doe';
};
$dash=new DashOne(false,false,'salt_123',$validateLogin);
```

#### Step 2 Fetch values

```php
$user=[];
$dash->fetchLogin($user); // user could returns [ ["username"]=> "" ["password"]=> "" ["remember"]=> "" ["_csrf"]=>  "" ["result"]=> bool(true) ]
```

#### Step 3 Redirect if the user has sign-in correctly

```php
if($user['result']) {
    @session_write_close();
    header('location:testlogin2.php');
    die(1);
} else {
    $message='user or password incorrect';
}
```

#### Step 4 Display Login Screen

```php
$dash->head('Example - test 1','',true) // title of the page, extra content in the header and true= for login page
    ->login($user,null,'Sign-In') // user variable, null or link to the login image and title of the login page
        ->alert($message) // (optional) shows an alert inside the login page
        ->footer() // (optional) shows a footer inside the login
    ->endLogin() // end login container
->render();
```

#### Step 5 Log out

The validation of the user is keep in the session. So to close a session we could destroy the session or unsetting the session.

```php
session_destroy();
unset($_SESSION['user']);
```

#### Step 6 CSRF protection (optional)

It is possible to add an extra layer of protection by adding the next line

```php
if (!$dash->checkCSRF()) {
    die(1);
}
```

#### Step 7 Validating the session

It is possible to validate the session 

```php
if (isset($_SESSION['user']) ) {
	// user has sign-in
} else {
    // user hasn't sign-in
}
```



## Version

* 1.7 2020-04-23
    * Added .gitattribute Examples and doc are not pushed via composer (it should reduce the size)
* 1.6.2 2020-04-23   
    * Fix: cleanups.   
* 1.6.1 2020-03-03
    * Fix: TableOne now allows non-base zero array
* 1.6 2020-18-01
    * modified LinkOne::LinkOne()
    * added summernote to textarea
* 1.5 2020-16-01
    * new method getLogin()
    * new method logout()
* 1.4 2020-16-01 
    * new method cssLogin()
    * new method login()
    * new method fetchLogin()
    * new method decrypt()
    * new method encrypt()      
    * new field var $salt='';
    * new field $validateLogin (callable)
    * changes to __construct()
* 1.3 2020-01-15 new method fetchvalue()
* 1.2 2019-03-30 New changes.  
* 1.1 2019-03-17 Fixed some bugs  
* 1.0 2019-03-01 First Version.  


## Copyright

Copyright Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
Dual License (LGPL v3 and Commercial License)  

You could use in commercial / close source product or service while  

In a nutshell (it is the license): 

* You must keep the copyright notices.  
* If you modify the library then you must share the changes and modifications.

   




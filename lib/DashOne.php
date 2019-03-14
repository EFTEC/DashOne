<?php

namespace eftec\DashOne;
use eftec\DashOne\controls\ButtonOne;
use eftec\DashOne\controls\ContainerOne;
use eftec\DashOne\controls\FormOne;
use eftec\DashOne\controls\ImageOne;
use eftec\DashOne\controls\LinkOne;
use eftec\DashOne\controls\TableOne;
use eftec\DashOne\controls\UlOne;
use Exception;

/**
 * Class DashOne
 * @package eftec\DashOne
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class DashOne {
	const VERSION=0.1;
	
	var $companyName='';
	var $links=[];
	
	var $html=[];
	var $hasSideMenu=false;
	
	public static function genNode($type='',$value=null,$class='',$id='',$messages=null) {
		return ['_def'=>$type,"value"=>$value,"class"=>$class,"id"=>$id,"messages"=>$messages];
	}

	public function css() {
		return "body{font-size:.875rem}.bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}@media (min-width: 768px){.bd-placeholder-img-lg{font-size:3.5rem}}.form-control-dark{color:#fff;background-color:rgba(255,255,255,.1);border-color:rgba(255,255,255,.1)}.form-control-dark:focus{border-color:transparent;box-shadow:0 0 0 3px rgba(255,255,255,.25)}.feather{width:16px;height:16px;vertical-align:text-bottom}.leftmenu{position:fixed;top:0;bottom:0;left:0;z-index:100;padding:48px 0 0;box-shadow:inset -1px 0 0 rgba(0,0,0,.1)}.leftmenu-sticky{position:relative;top:0;height:calc(100vh - 48px);padding-top:.5rem;overflow-x:hidden;overflow-y:auto}.leftmenu .nav-link{font-weight:500;color:#333}.leftmenu .nav-link .feather{margin-right:4px;color:#999}.leftmenu .nav-link.active{color:#007bff}.leftmenu .nav-link:hover .feather,.leftmenu .nav-link.active .feather{color:inherit}.leftmenu-heading{font-size:.75rem;text-transform:uppercase}[role=\"main\"]{padding-top:133px}@media (min-width: 768px){[role=\"main\"]{padding-top:48px}}.navbar-brand{padding-top:.75rem;padding-bottom:.75rem;font-size:1rem;background-color:rgba(0,0,0,.25);box-shadow:inset -1px 0 0 rgba(0,0,0,.25)}.navbar .form-control{padding:.75rem 1rem;border-width:0;border-radius:0}";
	}
	
	public function head($title='DashOne',$extraHtml='') {
		$css=$this->css();
		$cin=<<<inout
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="DashOne">
    <title>$title</title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
    <style>$css</style>    
    $extraHtml
</head>
inout;
		$this->html[]=$cin;
		return $this;
	} // head
	
	public function footer($extraHtml='') {
		$cin=<<<inout
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

$extraHtml
<script>
	(function () {
	    'use strict';
	    feather.replace()
	}());
</script>
</body>
</html>

inout;
		$this->html[]=$cin;
		return $this;
	} //footer
	
	public function menuUpper($leftControls=[],$rightControls=[]) {

		$htmlLeft=$this->renderItem($leftControls);
		$htmlRight=$this->renderItem($rightControls);
		$cin="<body>
		<nav class='navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow'>
		    <span class='navbar-brand col-sm-3 col-md-2 mr-0'>$htmlLeft</span>";
		
		$cin.="<ul class='navbar-nav px-3'>
		        <li class='nav-item text-nowrap'>
		            <span class='nav-link' href='#'>$htmlRight</span>
		        </li>
		    </ul>
		</nav>";
    
    
		$this->html[]=$cin;
		return $this;
	} // menuUpper
	
	public function startContent($class='container-fluid') {
		$cin="<div class='$class'><div class='row'>\n";
		$this->html[]=$cin;
		return $this;
	} //startContent

	/**
	 * @param LinkOne[] $links
	 * @return $this
	 */
	public function menu($links) {
		$cin="<nav class='col-md-2 d-none d-md-block bg-light leftmenu'>
            <div class='leftmenu-sticky'>
                <ul class='nav flex-column'>\n";
			foreach($links as $link) {
				$cin.="<li class='nav-item'>".$link->addClass('nav-link')->render()."</li>";
			}
		$cin.="</ul></div></nav>";
		$this->html[]=$cin;
		$this->hasSideMenu=true;
		return $this;
	} //menu
	
	public function startMain() {
		if ($this->hasSideMenu) {
			$class="col-md-9 ml-sm-auto col-lg-10 px-4";
		} else {
			$class="col-md-12 ml-sm-auto col-lg-12 px-4";
		}
		$cin=<<<inout
<main role="main" class="$class">
<form method='post'>
inout;
		$this->html[]=$cin;
		return $this;
	} // startMain

	public function endMain() {
		$cin=<<<inout
		</form>
        </main>
inout;
		$this->html[]=$cin;
		return $this;
	} // endMain	
	
	public function endContent() {
		$cin=<<<inout
    </div>
</div>
inout;
		$this->html[]=$cin;
		return $this;
	} // endContent
	
	public function title($title,$level=1) {
		$this->html[]="<h{$level}>$title</h{$level}>\n";
		return $this;
	}
	public function rawHtml($html) {
		$this->html[]=$html."\n";
		return $this;
	}

	/**
	 * @param $info
	 * @return $this
	 * @see \DashOne::renderTable
	 */
	public function table($info) {
		$this->html[]=(new TableOne($info) )->addClass('table');
		return $this;
	}
	public function ul($info,$class='list-group') {
		$this->html[]=(new UlOne($info))->addClass($class);
		return $this;
	}
	public function form($currentValues,$definition=null,$messages=[]) {
		$this->html[]=(new FormOne($currentValues,$definition,$messages));
		return $this;
	}

	/**
	 * @param ButtonOne[]|ButtonOne $buttons
	 * @return $this
	 */
	public function buttons($buttons) {
		$this->html[]=$buttons; // $this::genNode('button',$buttons);
		return $this;
	}

	/**
	 * @param string $url
	 * @param string|null $title
	 * @return $this
	 */
	public function image($url,$title=null) {
		$this->html[]=new ImageOne($url,$title);
		return $this;
	}
	public function container($html) {
		$this->html[]=new ContainerOne($html);
		return $this;
	}	
	
	/**
	 * 
	 * @param $class
	 * @return $this
	 * @see https://getbootstrap.com/docs/4.1/content/tables/
	 */
	public function setClass($class) {
		$last=count($this->html)-1;
		$this->html[$last]->addClass($class);
		return $this;
	}
	public function setId($id) {
		$last=count($this->html)-1;
		$this->html[$last]->setId($id);
		return $this;
	}
	public function render() {
		$co=count($this->html);
		$html="";
		for($i=0;$i<$co;$i++) {
			$html.=$this->renderItem($i);
		}
		return $html;
	}

	/**
	 * @param int|array $idHtml If int then it returns the item loaded on $this->html
	 * @return array|mixed|string
	 * @throws Exception
	 */
	public function renderItem(&$idHtml) {
		if (is_numeric($idHtml)) {
			$item = $this->html[$idHtml];
		} else {
			$item=$idHtml;
		}
		if (is_array($item)) {
			$result='';
			foreach($item as $node) {
				$result.=$this->renderItem($node);
			}
			return $result;
		}
		if (is_object($item)) {
			//$defType= (!isset($item['_def']))?@$item[0]['_def']:$item['_def'];
			$tmpArr=explode('\\',get_class($item));
			$defType=end($tmpArr);

			switch ($defType) {
				case 'TableOne':
					/** @see \eftec\DashOne\controls\TableOne::render */
					return $item->render($this);
					break;
				case 'UlOne':
					/** @see \eftec\DashOne\controls\UlOne::render */
					return $item->render($this);
					break;					
				case 'FormOne':
					/** @see \eftec\DashOne\controls\FormOne::render */
					return  $item->render();
					break;
				case 'ButtonOne':
					/** @see \eftec\DashOne\controls\ButtonOne::render */
					return $item->render();
					break;
				case 'ImageOne':
					/** @see \eftec\DashOne\controls\ImageOne::render */
					return $item->render();
					break;
					
				case 'LinkOne':
					/** @see \eftec\DashOne\controls\LinkOne::render */
					return $item->render();
					break;					
				case 'ContainerOne':
					$idHtml++;
					/** @see \eftec\DashOne\controls\ContainerOne::render */
					return  $item->render($this->renderItem($idHtml));
					break;
				default:
					throw new Exception("class $defType not defined");
			}
		} else {
			return $item;
		}
	}
	private function renderContainer($item,$subobject) {
		$html=$item['value'];
		$html=str_replace('%control',$subobject,$html);
		return $html;
	}






	

}
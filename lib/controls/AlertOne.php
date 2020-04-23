<?php

namespace eftec\DashOne\controls;

/**
 * Class AlertOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class AlertOne extends ControlOne
{
	public $title;
	public $content;

	/**
	 * AlertOne constructor.
	 * @param $title
	 * @param $content
	 * @param string $class
	 */
	public function __construct($title, $content='',$class=null)
	{
		$this->title = $title;
		$this->content = $content;
		$this->class = ($class===null)?'alert alert-primary':$class;
	}
	
	public function render() {
		if (!$this->content) {
			// header-less, then the title is the content.
			$html = "<div class='{$this->class}' role='alert'>
			  {$this->title}</div>";
		} else {
			$html = "<div class='{$this->class}' role='alert'>
			  <h4 class='alert-heading'>{$this->title}</h4><hr>
			  {$this->content}
			  {$this->extra}</div>";
			
		}
		return $html;			
	}


}
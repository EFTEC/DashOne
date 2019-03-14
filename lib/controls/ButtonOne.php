<?php

namespace eftec\DashOne\controls;

/**
 * Class ButtonOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class ButtonOne extends ControlOne
{
	
	var $label;
	/** @var string=['submit','button','link'][$i]  */
	var $type;

	/**
	 * ButtonOne constructor.
	 * @param $name
	 * @param $label
	 * @param $class
	 * @param $type
	 */
	public function __construct($name, $label, $class='btn', $type='submit')
	{
		$this->name = $name;
		$this->label = $label;
		$this->class = $class;
		$this->type = $type;
	}
	
	public function render() {
		if ($this->type=='link') {
			$html="<a class='{$this->class}' href='{$this->name}'>{$this->label}</a>&nbsp;\n";
		} else {
			$html="<button type='{$this->type}' class='{$this->class}' id='{$this->name}' name='{$this->name}'>{$this->label}</button>&nbsp;\n";
		}
		return $html;
	}

}
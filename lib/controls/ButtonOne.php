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
	
	public $label;
	/** @var string=['submit','button','link'][$i]  */
	public $type;

	/**
	 * ButtonOne constructor.
	 * Example:
	 *      new Button('frm_button1','Click me','btn btn-default','submit')
	 * @param string $name name (and id) of the button. It's also the value.
	 * @param string $label label of the button
	 * @param string $class=['btn','btn btn-default','btn btn-primary','btn btn-success','btn btn-info','btn btn-warning','btn btn-danger','btn btn-link'][$i]
	 * @param string $type=['submit','link','button','reset'][$i]
	 * @param string $extra Extra values
	 */
	public function __construct($name, $label, $class='btn', $type='submit',$extra='')
	{
		$this->name = $name;
		$this->label = $label;
		$this->class = $class;
		$this->type = $type;
		$this->extra = $extra;
	}
	
	public function render() {
		if ($this->type === 'link') {
			$html="<a class='{$this->class}' href='{$this->name}' {$this->extra}>{$this->label}</a>&nbsp;\n";
		} else {
			$html="<button type='{$this->type}' value='{$this->name}' class='{$this->class}' id='{$this->name}' name='{$this->name}' {$this->extra}>{$this->label}</button>&nbsp;\n";
		}
		return $html;
	}

}
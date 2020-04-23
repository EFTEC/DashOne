<?php

namespace eftec\DashOne\controls;

/**
 * Class ControlOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 1.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
abstract class ControlOne
{
	public $name='';
	public $class='';
	public $extra='';
	public $subclass='';

	/**
	 * Subclass is the class of the inner element, for example the class of "li" inside the "ul"
	 * @param $class
	 * @return $this
	 */
	public function setSubClass($class) {
		$this->subclass=$class;
		return $this;
	}
	public function setClass($class) {
		$this->class=$class;
		return $this;
	}
	public function addClass($class) {
		$this->class.=' '.$class;
		return $this;
	}
	public function setId($name) {
		$this->name=$name;
		return $this;
	}
	public function setExtra($extra) {
		$this->extra=$extra;
		return $this;
	}
	public function addExtra($extra) {
		$this->extra.=$extra;
		return $this;
	}
}
<?php

namespace eftec\DashOne\controls;

/**
 * Class ControlOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
abstract class ControlOne
{
	var $name;
	var $class;

	
	public function addClass($class) {
		$this->class.=' '.$class;
		return $this;
	}
	public function setId($name) {
		$this->name=$name;
		return $this;
	}	

}
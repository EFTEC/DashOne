<?php

namespace eftec\DashOne\controls;


use eftec\DashOne\DashOne;

/**
 * Class ContainerOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class ContainerOne extends ControlOne
{
	var $html;
	
	/**
	 * ContainerOne constructor.
	 * @param $html
	 */
	public function __construct($html)
	{
		$this->html = $html;
	}


	public function render($subobject,$caller=null) {
		$html=str_replace('%control',$subobject,$this->html);
		return $html;
	}

}
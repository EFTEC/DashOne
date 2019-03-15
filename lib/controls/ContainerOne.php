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
	 * @param string $html It could contain %control (inner control if any) and %extra (extra value if any).
	 */
	public function __construct($html)
	{
		$this->html = $html;
	}

	/**
	 * Example:
	 *      new ContainerOne('<hr>%control %extra<hr>')
	 *      ->render('<b>inner object</b>')
	 * @param $subobject
	 * @param null $caller
	 * @return mixed
	 */
	public function render($subobject,$caller=null) {
		$html=str_replace('%control',$subobject,$this->html);
		$html=str_replace('%extra',$this->extra,$html);
		return $html;
	}

}
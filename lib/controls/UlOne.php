<?php

namespace eftec\DashOne\controls;


use eftec\DashOne\DashOne;

/**
 * Class UlOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class UlOne extends ControlOne
{
	var $values;

	/**
	 * TableOne constructor.
	 * @param $values
	 */
	public function __construct($values)
	{
		$this->values = $values;
	}

	/**
	 * @param DashOne|null $caller
	 * @return string
	 * @throws \Exception
	 */
	public function render($caller=null) {
		$html="<ul class='".$this->class."'>";
		foreach($this->values as $line) {
			$html.="<li class='list-group-item'>".$caller->renderItem($line)."</li>\n";
		}
		$html.="</ul>";
		return $html;
	}

}
<?php

namespace eftec\DashOne\controls;

/**
 * Class LinkOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class LinkOne extends ControlOne
{
	var $url;
	var $icon;
	
	/**
	 * LinkOne constructor.
	 * @param $name
	 * @param $url
	 * @param string $icon Font-awesome icons. Example: far fa-star
	 */
	public function __construct($name, $url='#', $icon='')
	{
		$this->name = $name;
		$this->url = $url;
		$this->icon = $icon;
	}
	public function render() {
		$html="<a class='{$this->class}' href='{$this->url}'>";
		$html.=($this->icon)?"<i class='{$this->icon}'></i> ":"";
		$html.="{$this->name}{$this->extra}</a>";
		return $html;
	}


}
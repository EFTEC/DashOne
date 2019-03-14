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
	 * @param $icon
	 */
	public function __construct($name, $url='#', $icon='')
	{
		$this->name = $name;
		$this->url = $url;
		$this->icon = $icon;
	}
	public function render() {
		$html="<a class='{$this->class}' href='{$this->url}'>";
		$html.=($this->icon)?"<span data-feather='{$this->icon}'></span>":"";
		$html.="{$this->name}</a>";
		return $html;
	}


}
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
	public $url;
	public $icon;

    /**
     * LinkOne constructor.
     *
     * @param        $name
     * @param string $url
     * @param string $icon Font-awesome icons. Example: far fa-star
     * @param string $class
     */
	public function __construct($name, $url='#', $icon='',$class='')
	{
		$this->name = $name;
		$this->url = $url;
		$this->icon = $icon;
		$this->class=$class;
	}
	public function render() {
		$html="<a class='{$this->class}' href='{$this->url}'>";
		$html.=($this->icon)?"<i class='{$this->icon}'></i> ": '';
		$html.="{$this->name}{$this->extra}</a>";
		return $html;
	}


}
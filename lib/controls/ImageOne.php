<?php

namespace eftec\DashOne\controls;

/**
 * Class ImageOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class ImageOne extends ControlOne
{
	var $url;
	var $title;

	/**
	 * ImageOne constructor.
	 * @param $url
	 * @param $title
	 */
	public function __construct($url, $title=null)
	{
		$title=($title==null)?$url:$title;
		$this->url = $url;
		$this->title = $title;
	}
	
	public function render() {
		return "<img src='{$this->url}' alt='{$this->title}' class='{$this->class} {$this->extra}'/>";
	}

}
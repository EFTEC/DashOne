<?php

use eftec\DashOne\DashOne;

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
	require_once __DIR__ . '/../vendor/autoload.php';
} else {
	require_once __DIR__ . '/../autoload.php';
}


class Bootstrap extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DashOne
	 */
	var $dash;
	public function init() {
		$this->dash=new DashOne();
	}
	public function assertEqualsStrip($eq,$txt) {
		$txt2=str_replace(['  ',"\r\n","\n"],'',$txt);
		$eq=str_replace(['  ',"\r\n","\n"],'',$eq);
		$this->assertEquals($eq,$txt2);
	}

}
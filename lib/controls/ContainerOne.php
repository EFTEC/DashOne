<?php

namespace eftec\DashOne\controls;


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
	public $html;
	
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
     * @noinspection PhpUnusedParameterInspection
     */
	public function render($subobject,$caller=null) {
        return str_replace(array('%control', '%extra'), array($subobject, $this->extra), $this->html);
	}

}
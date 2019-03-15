<?php

namespace eftec\DashOne\controls;


use eftec\DashOne\DashOne;

/**
 * Class TableOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM 
 * @link https://github.com/EFTEC/DashOne
 */
class TableOne extends ControlOne
{
	var $values;
	var $definition;

	/**
	 * TableOne constructor.
	 * @param $values
	 */
	public function __construct($values=[],$definition=null)
	{
		if ($definition==null) {

			$definition=array_keys($values[0]);
			/*
			foreach($definition as &$v) {
			}
			*/
		}
		$this->definition=$definition;
		$this->values = $values;
	}


	/**
	 * @param DashOne|null $caller
	 * @return string
	 * @throws \Exception
	 */
	public function render($caller=null) {
		if (!$this->values && $this->definition) return "";
		

		$html="<table class='".$this->class."'>{$this->extra}";
		$html.="<thead><tr>\n";
		foreach($this->definition as $k) {
			$html.="<th>$k</th>\n";
		}
		$html.="</tr></thead>\n";
		$html.="<tbody>\n";
		foreach($this->values as $line) {
			$html.="<tr class='{$this->subclass}'>\n";
			foreach($this->definition as $key) {
				$cell=@$line[$key];
				if (is_object($cell) || is_array($cell)) {
					if ($caller===null) {
						$html .= "<td>-array-</td>\n";
					} else {
						$html .= "<td>".$caller->renderItem($cell)."</td>\n";	
					}
				} else {
					$html .= "<td>$cell</td>\n";
				}
			}
			$html.="</tr>\n";
		}
		$html.="</tbody>\n";
		$html.="</table>";
		return $html;
	
	}
}
<?php

namespace eftec\DashOne\controls;


use eftec\DashOne\DashOne;

/**
 * Class TableOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 1.2 2019-mar-30 4:59 PM 
 * @link https://github.com/EFTEC/DashOne
 */
class TableOne extends ControlOne
{
	private $values;
	private $definition;

	/**
	 * TableOne constructor.
	 * @param array $values
	 * @param null $definition
	 */
	public function __construct($values=[],$definition=null)
	{
		if ($definition==null) {
			if (isset($values[0])) {
				$definition = array_keys($values[0]);
			}
			/*
			foreach($definition as &$v) {
			}
			*/
		}
		if (isset($definition[0])) {
			// its not associative
			$copy=$definition;
			$definition=[];
			foreach($copy as $cell) {
				$definition[$cell]=$cell;
			}
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
		$html="<table class='".$this->class."'>{$this->extra}";
		$html.="<thead><tr>\n";
		if (!is_array($this->definition)) {
			$html .= "<th>-</th>\n";
		} else {
			foreach ($this->definition as $k) {
				$html .= "<th>$k</th>\n";
			}
		}
		$html.="</tr></thead>\n";
		$html.="<tbody>\n";

		if (empty($this->values)) {
			$html .= "<tr class='{$this->subclass}'><td>&nbsp;</td></tr></tr>\n";
		} else {
			foreach ($this->values as $line) {
				$html .= "<tr class='{$this->subclass}'>\n";
				foreach ($this->definition as $key=>$label) {
					$cell = @$line[$key];
					if (is_object($cell) || is_array($cell)) {
						if ($caller === null) {
							$html .= "<td>-array-</td>\n";
						} else {
							$html .= "<td>" . $caller->renderItem($cell) . "</td>\n";
						}
					} else {
						$html .= "<td>$cell</td>\n";
					}
				}
				$html .= "</tr>\n";
			}
		}
		$html.="</tbody>\n";
		$html.="</table>";
		return $html;
	
	}
}
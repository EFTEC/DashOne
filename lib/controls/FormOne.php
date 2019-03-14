<?php

namespace eftec\DashOne\controls;


use eftec\DashOne\DashOne;

/**
 * Class FormOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 0.1 2019-mar-14 4:59 PM
 * @link https://github.com/EFTEC/DashOne
 */
class FormOne extends ControlOne
{
	var $currentValues;
	var $definition;
	var $messages;

	/**
	 * FormOne constructor.
	 * @param array $currentValues
	 * @param array|null $definition
	 * @param $messages
	 */
	public function __construct($currentValues, $definition=null, $messages=[])
	{
		if ($definition==null) {

			$definition=$currentValues;
			foreach($definition as &$v) {
				if(!is_array($v)) {
					$v='text'; // by default, types are array 
				}
			}
		}
		$this->currentValues = $currentValues;
		$this->definition = $definition;
		$this->messages = $messages;
	}


	public function render($messages=[],$caller=null) {
		$html="";
		
		foreach($this->definition as $key=>$defType) {
			$cv=@$this->currentValues[$key];
			if ($defType=='hidden') {
				$html.="<input type='hidden'  id='$key' name='$key' value='".htmlentities($cv)."'/>";
			} else {
				$html .= "<div class='form-group row'>\n";
				$html .= "<label for='$key' class='col-sm-2 col-form-label'>$key</label>\n";
				$html .= "<div class='col-sm-10'>\n";
				if (is_array($defType)) {
					$html .= "<select class='form-control' id='$key' name='$key'>\n";
					foreach ($defType as $k => $v) {
						if ($cv == $k) {
							$html .= "<option name='$k' selected>$v</option>\n";
						} else {
							$html .= "<option name='$k'>$v</option>\n";
						}
					}
					$html .= "</select>";

				} else {
					$html .= "<input type='$defType' class='form-control' id='$key' name='$key'  value='" . htmlentities($cv) . "' />";
				}
				$html .= "<em>" . @$messages[$key] . "</em>";
				$html .= "</div>\n";
				$html .= "</div>\n";
			}
		}
		return $html;
	}

}
<?php

namespace eftec\DashOne\controls;


/**
 * Class FormOne
 * @package eftec\DashOne\controls
 * @license lgplv3
 * @author   Jorge Patricio Castro Castillo <jcastro arroba eftec dot cl>
 * @version 1 2020-03-03
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


	public function render($caller=null) {
		$html="";
		foreach($this->definition as $key=>$defType) {
			$cv=@$this->currentValues[$key];
			switch ($defType) {
				case 'hidden':
					// hidden
					$html.="<input type='hidden'  id='$key' name='$key' value='".htmlentities($cv,ENT_QUOTES)."'/>";
					break;
				case 'textarea':
					// text area
					$html .= "<div class='form-group row'>\n";
					$html .= "<label for='$key' class='col-sm-2 col-form-label'>$key</label>\n";
					$html .= "<div class='col-sm-10'>\n";
					$html.="<textarea class='{$this->class} summernote' id='$key' name='$key' >".htmlentities($cv,ENT_QUOTES)."</textarea>\n";
					$html .= "<em class='{$this->subclass}'>" . @$this->messages[$key] . "</em>";
					$html .= "</div>\n";
					$html .= "</div>\n";					
					break;						
				default:
					$html .= "<div class='form-group row'>\n";
					$html .= "<label for='$key' class='col-sm-2 col-form-label'>$key</label>\n";
					$html .= "<div class='col-sm-10'>\n";
					if (is_array($defType)) {
						// select item

						$html .= "<select class='{$this->class}' id='$key' name='$key'>\n";
						foreach ($defType as $k => $v) {
							if ($cv == $k) {
								$html .= "<option value='$k' selected>$v</option>\n";
							} else {
								$html .= "<option value='$k'>$v</option>\n";
							}
						}
						$html .= "</select>";
					} else {
						// textbox
						$html .= "<input type='$defType' class='{$this->class}' id='$key' name='$key'  value='" . htmlentities($cv,ENT_QUOTES) . "' />";
					}
					$html .= "<em class='{$this->subclass}'>" . @$this->messages[$key] . "</em>";
					$html .= "</div>\n";
					$html .= "</div>\n";					
					break;
			}
		}
		$html.=$this->extra;
		return $html;
	}

}
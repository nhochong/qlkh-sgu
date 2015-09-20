<?php
class Khcn_Form_Decorator_Select{
	public static function getDecorator(){
		return array(
					'ViewHelper',
				    'Errors',
				    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
				    array(array('row' => 'HtmlTag'), array('tag' => 'span')));
	}
}
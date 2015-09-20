<?php
class Khcn_View_Helper_GetBaseUrl extends Zend_View_Helper_Abstract{
	public static function getBaseUrl(){
		$url = Zend_Controller_Front::getInstance();
		return $url->getBaseUrl();
	}
}
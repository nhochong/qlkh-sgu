<?php
class Khcn_View_Helper_TitleBlock extends Zend_View_Helper_Abstract
{
	protected $_title_block;
	
	public function titleBlock($title = '')
	{
		if(!empty($title)){
			$this->_title_block = Zend_Registry::get('Zend_Translate')->_($title);
			$view = Zend_Registry::get('Zend_View');
			$view->headTitle($title);
		}
		return $this;
	}	
	
	public function getTitle(){
		return $this->_title_block;
	}
}
<?php
class Khcn_View_Helper_AddFormSearch extends Zend_View_Helper_Abstract
{
	public function addFormSearch()
	{		
		return new Default_Form_Search();
	}	
}
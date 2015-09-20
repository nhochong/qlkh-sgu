<?php
class Admin_Bootstrap extends Khcn_Application_Bootstrap_Abstract 
{
	protected function _initPaginator()
	{
		// Set up default paginator options
		Zend_Paginator::setDefaultScrollingStyle('Sliding');
		Zend_View_Helper_PaginationControl::setDefaultViewPartial(array(
		  'includes/pagination.phtml',
		  'admin'
		));
	}
}
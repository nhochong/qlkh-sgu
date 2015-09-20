<?php
class Default_ChuongTrinhController extends Khcn_Controller_Action_Standard
{
	public function indexAction()
    {
		$table = Khcn_Api::_()->getDbTable('chuong_trinh', 'default');
		$select = $table->select()
						->where('trang_thai = 1')
						->order('ngay_tao DESC');
    	$chuongTrinhs = $table->fetchAll($select);
        
        $paginator = Zend_Paginator::factory($chuongTrinhs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $this->view->paginator = $paginator;
    }
    
	public function chiTietAction()
    {
        $id = $this->getRequest()->getParam('id');
		$this->view->chuong_trinh = $chuong_trinh = Khcn_Api::_()->getItem('default_chuong_trinh', $id);
		if(!$chuong_trinh){
			return $this->_helper->requireSubject()->forward();
		}
    }
}
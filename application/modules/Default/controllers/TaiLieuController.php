<?php
class Default_TaiLieuController extends Khcn_Controller_Action_Standard
{
	public function indexAction()
    {
		$table = Khcn_Api::_()->getDbTable('tai_lieu', 'default');
		$select = $table->select()->order('ngay_tao DESC');
        $taiLieus = $table->fetchAll($select);
        $paginator = Zend_Paginator::factory($taiLieus);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $this->view->paginator = $paginator;
    }
    
	public function chiTietAction()
    {
        $id = $this->getRequest()->getParam('id');
		$this->view->tai_lieu = $tai_lieu = Khcn_Api::_()->getItem('default_tai_lieu', $id);
		if(!$tai_lieu){
			return $this->_helper->requireSubject()->forward();
		}
    }
}
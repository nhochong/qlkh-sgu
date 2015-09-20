<?php
class Default_SinhHoatChuyenDeController extends Khcn_Controller_Action_Standard
{
	public function indexAction()
    {
		$table = Khcn_Api::_()->getDbTable('sinh_hoat_chuyen_de', 'default');
		$select = $table->select()->order('ngay_tao DESC');
        $chuyenDes = $table->fetchAll($select);
        $paginator = Zend_Paginator::factory($chuyenDes);
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
		$this->view->sinh_hoat_chuyen_de = $sinh_hoat_chuyen_de = Khcn_Api::_()->getItem('default_sinh_hoat_chuyen_de', $id);
		if(!$sinh_hoat_chuyen_de){
			return $this->_helper->requireSubject()->forward();
		}
		$this->view->hinhAnhs = $hinhAnhs = Khcn_Api::_()->getDbTable('hinh_anh_chuyen_de', 'default')->getHinhAnhByChuyenDe($sinh_hoat_chuyen_de->getIdentity());
    }
}
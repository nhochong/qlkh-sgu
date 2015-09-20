<?php
class Default_DaoTaoController extends Khcn_Controller_Action_Standard
{
	public function indexAction()
    {
		
    }
    
	public function dhvinhAction()
    {
        
    }
	
	public function thongBaoAction(){
		$loai = $this->getRequest()->getParam('loai');
		$this->view->loaiThongBao = $loaiThongBao = Khcn_Api::_()->getItem('default_loai_thong_bao', $loai);
		
		$params = array(
			'trang_thai' => true,
			'limit' => 20,
			'loai' => $loai
		);
        $thongBaos = Khcn_Api::_()->getDbTable('thong_bao', 'default')->getDSThongBaos($params);
				
		$paginator = Zend_Paginator::factory($thongBaos);
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
		$paginator->setView($this->view);
		$this->view->paginator = $paginator;
	}
}
<?php
class Default_BaiBaoController extends Khcn_Controller_Action_Standard
{
	public function indexAction()
    {
		$table = Khcn_Api::_()->getDbTable('bai_bao', 'default');
		$select = $table->select()
						->order('ngay_tao DESC');
    	$baiBaos = $table->fetchAll($select);
        
        $paginator = Zend_Paginator::factory($baiBaos);
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
		$this->view->bai_bao = $bai_bao = Khcn_Api::_()->getItem('default_bai_bao', $id);
		if(!$bai_bao){
			return $this->_helper->requireSubject()->forward();
		}
		$this->view->giangViens = $bai_bao->getGiangViens();
    }
}
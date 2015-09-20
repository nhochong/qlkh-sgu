<?php

class Default_TinTucController extends Khcn_Controller_Action_Standard
{
	protected $tin_tuc = null;
		
    public function init()
    {
        $this->tin_tuc = new Default_Model_TinTuc();
    }

    public function indexAction()
    {
        // action body
        $tinTucs = Khcn_Api::_()->getDbTable('tin_tuc', 'default')->danhsachhienthi();;
        $paginator = Zend_Paginator::factory($tinTucs);
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

    public function chiTietAction()
    {
        // action body
    	$id = $this->getRequest()->getParam('id');
        if(!empty($id)){
        	$tinTuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
        	if($tinTuc != null){
        		$tinTuc->so_lan_xem++;
				$tinTuc->save();
        		$this->view->tin_tuc = $tinTuc;
        		$this->view->cungchude = Khcn_Api::_()->getDbTable('tin_tuc', 'default')->getTinTucs(array('trang_thai' => 1, 'limit' => 5, 'not_ids' => array($tinTuc->getIdentity())));
        	}
        	else 
        		$this->_redirect('tin-tuc/index');
        }else{
        	$this->_redirect('tin-tuc/index');
        }
    }
}






<?php
class Default_LichCongTacController extends Khcn_Controller_Action_Standard
{
    /**
     * The default action - show the home page
     */
    
    public function indexAction()
    {
    	$lichCTs = Khcn_Api::_()->getDbTable('lich_cong_tac', 'default')->getLichCTs();
        $paginator = Zend_Paginator::factory($lichCTs);
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
        $id = $this->getRequest()->getParam('id');
		$this->view->lich_ct = $lich_ct = Khcn_Api::_()->getItem('default_lich_cong_tac', $id);
		if(!$lich_ct){
			return $this->_redirect('lich-cong-tac/index');
		}
        $this->view->ndcts = $ndcts = $lich_ct->getFullNDCTs();
		$this->view->thus = Default_Model_Constraints::lct_thu();
    }
}
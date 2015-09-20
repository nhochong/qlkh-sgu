<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Default_GioiThieuController extends Khcn_Controller_Action_Standard {    
    public function indexAction (){     	
    	$this->view->gioi_thieu = Khcn_Api::_()->getApi('settings', 'default')->getSetting('gioi_thieu', '');
    }
	
	public function nhanSuAction(){
		$table = Khcn_Api::_()->getDbTable('nhan_su', 'default');
		$this->view->nhanSus = $table->fetchAll($table->select()->order('order'));
	}
	
	public function hinhAnhAction(){
		$hinhAnhs = Khcn_Api::_()->getDbTable('hinh_anh', 'default')->fetchAll();
		$paginator = Zend_Paginator::factory($hinhAnhs);
        $paginator->setItemCountPerPage(21);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;  
	}
	
	public function lienHeAction (){     	
    	$this->view->lien_he = Khcn_Api::_()->getApi('settings', 'default')->getSetting('lien_he', '');
    }
}

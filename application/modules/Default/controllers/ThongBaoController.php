<?php

class Default_ThongBaoController extends Khcn_Controller_Action_Standard
{
	/**
	 * The default action - show the home page
	 */
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$params = array(
			'trang_thai' => true,
			'limit' => 20
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
    
	public function chiTietAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
    	$id = $this->getRequest()->getParam('id');
        if(!empty($id)){        	
        	$thongbao = Khcn_Api::_()->getItem('default_thong_bao', $id);
        	if($thongbao != null){
        		$thongbao->so_lan_xem += 1;
				$thongbao->save();
	        	$this->view->thongbao = $thongbao;
	        	$this->view->cungchude = Khcn_Api::_()->getDbTable('thong_bao', 'default')->GetThongBaoCungChuDe($thongbao->loai, $id);
        	}else{
        		$this->_redirect('thong-bao/index');
        	}
        }else{
        	$this->_redirect('thong-bao/index');
        }
                
    }
    
	public function danhSachAction() 
    {
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

<?php

class Default_DeTaiController extends Khcn_Controller_Action_Standard
{
	public function init(){
		$request = Zend_Controller_Front::getInstance()->getRequest();
		//if($request->getActionName() != 'dang-cap-nhat')
			//$this->_redirect('de-tai/dang-cap-nhat');
	}
	
	public function dangCapNhatAction(){
		
	}
	
	public function indexAction() 
    {
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
        $this->view->form = $form = new Default_Form_SearchDT();
        $form->populate($params);
		if( empty($params['from']) ) {
			$params['from'] = date('Y');
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		} 
		$params['loai_linh_vuc'] = 'co-so';
		$deTais = Khcn_Api::_()->getDbTable('de_tai', 'default')->getDeTais($params);
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($deTais);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;   
		$this->view->capQLs = $capQLs = Default_Model_Constraints::detai_capquanly();
    }
	
	public function giaoTrinhAction() 
    {
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
        $this->view->form = $form = new Default_Form_SearchDT();
        $form->populate($params);
		if( empty($params['from']) ) {
			$params['from'] = date('Y');
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		} 
		$params['loai_linh_vuc'] = 'giao-trinh';
		$deTais = Khcn_Api::_()->getDbTable('de_tai', 'default')->getDeTais($params);
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($deTais);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;   
		$this->view->capQLs = $capQLs = Default_Model_Constraints::detai_capquanly();
    }
	
	public function taiLieuAction() 
    {
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
        $this->view->form = $form = new Default_Form_SearchDT();
        $form->populate($params);
		if( empty($params['from']) ) {
			$params['from'] = date('Y');
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		} 
		$params['loai_linh_vuc'] = 'tai-lieu';
		$deTais = Khcn_Api::_()->getDbTable('de_tai', 'default')->getDeTais($params);
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($deTais);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;   
		$this->view->capQLs = $capQLs = Default_Model_Constraints::detai_capquanly();
    }
	
	public function baiGiangAction() 
    {
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
        $this->view->form = $form = new Default_Form_SearchDT();
        $form->populate($params);
		if( empty($params['from']) ) {
			$params['from'] = date('Y');
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		} 
		$params['loai_linh_vuc'] = 'bai-giang';
		$deTais = Khcn_Api::_()->getDbTable('de_tai', 'default')->getDeTais($params);
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($deTais);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;   
		$this->view->capQLs = $capQLs = Default_Model_Constraints::detai_capquanly();
    }
	
	public function chiTietAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $id = $this->_getParam('id');
        if(!empty($id)){
        	$deTai = Khcn_Api::_()->getItem('default_de_tai', $id);
        	if($deTai != null){
        		$thanhViens = Khcn_Api::_()->getDbTable('dang_ky', 'default')->getThanhViens(array('ma_de_tai' => $id));
	        	$this->view->de_tai = $deTai;
	        	$this->view->thanhViens = $thanhViens;
	        }else{
	        	$this->_redirect('de-tai');
	        }
        }else {
        	$this->_redirect('de-tai');
        }
    }
    
    public function thongKeAction()
    {
    	$form_nam = new Default_Form_ReportYear();
    	$form_don_vi = new Default_Form_ReportDept();
    	$this->view->form_nam = $form_nam;
    	$this->view->form_don_vi = $form_don_vi;
    	$this->view->tab = 0;
    }
    
    public function tkNamAction()
    {
    	$from = $_POST['from'];
    	$to = $_POST['to'];
		$amount = $_POST['amount'];
    	if($to > date('Y'))
    		$to = date('Y');
    	try{
    		$this->view->result = $result = Khcn_Api::_()->getDbTable('de_tai', 'default')->thong_ke($from, $to, null, $amount);
		}catch (Zend_Db_Exception $ex){
    		echo "Lỗi. Vui lòng thử lại sau";
    		exit;
    	}	
    	$this->_helper->layout->disableLayout();
    }
    
	public function tkDonViAction()
    {
    	$from = $_POST['from'];
    	$to = $_POST['to'];
		$amount = $_POST['amount'];
    	if($to > date('Y'))
    		$to = date('Y');
    	$ma_don_vi = $_POST['ma_don_vi'];
    	try{
    		$this->view->result = $result = Khcn_Api::_()->getDbTable('de_tai', 'default')->thong_ke($from, $to, $ma_don_vi, $amount);  		
		}catch (Zend_Db_Exception $ex){
    		echo "Lỗi. Vui lòng thử lại sau";
    		exit;
    	}	
    	$this->_helper->layout->disableLayout();
    }
}

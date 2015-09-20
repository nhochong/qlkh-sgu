<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LichCongTacController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('lich_cong_tac', 'default');
		$select = $table->select()->order('id DESC');
        $lichCTs = $table->fetchAll($select);
        $paginator = Zend_Paginator::factory($lichCTs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_LichCongTac_Create();
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$table = Khcn_Api::_()->getDbTable('lich_cong_tac', 'default');
		$row = $table->createRow();
		$row->setFromArray($values);
		$row->save();

		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lich-cong-tac/index');
    }
	
	public function hoatDongAction(){
		$id = $this->_getParam('id', null);
		$this->view->lich_ct = $lich_ct = Khcn_Api::_()->getItem('default_lich_cong_tac', $id);
		if(!$lich_ct){
			$_SESSION['msg'] = "Lỗi! Lịch công tác không tồn tại.";
			$_SESSION['type_msg'] = "error";
			return $this->_redirect('/admin/lich-cong-tac/index');
		}
		$this->view->ndcts = $ndcts = $lich_ct->getFullNDCTs();
	}
	
	public function themHoatDongAction(){
		$ma_cong_tac = $this->_getParam('ma_cong_tac', null);
		$this->view->lich_ct = $lich_ct = Khcn_Api::_()->getItem('default_lich_cong_tac', $ma_cong_tac);
		if(!$lich_ct){
			$_SESSION['msg'] = "Lỗi! Lịch công tác không tồn tại.";
			$_SESSION['type_msg'] = "error";
			return $this->_redirect('/admin/lich-cong-tac/index');
		}
		$this->view->form = $form = new Admin_Form_LichCongTac_HoatDong();
		$form->ma_cong_tac->setValue($lich_ct->getIdentity());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$table = Khcn_Api::_()->getDbTable('noi_dung_cong_tac', 'default');
		$row = $table->createRow();
		$row->setFromArray($values);
		$row->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/lich-cong-tac/them-hoat-dong/ma_cong_tac/' . $lich_ct->getIdentity());
		}else{
			$this->_redirect('/admin/lich-cong-tac/hoat-dong/id/' . $lich_ct->getIdentity());
		}
	}
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0){
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/lich-cong-tac/index');
		}
				
		foreach($_POST['item'] as $id){			
			$lich_ct = Khcn_Api::_()->getItem('default_lich_cong_tac', $id);
			if($lich_ct != NULL){	
				$lich_ct->delete();
			}			
		}
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lich-cong-tac/index');			
    }
    
	public function xoaAction()
    {
		$id = $this->_getParam('id');
    	if(!empty($id)){
    		$lich_ct = Khcn_Api::_()->getItem('default_lich_cong_tac', $id);
    		if($lich_ct){	
				$lich_ct->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/lich-cong-tac/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Lịch công tác không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-cong-tac/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-cong-tac/index');
    	}
    }
    
	public function suaAction()
    {
		$id = $this->_getParam('id', null);
		$this->view->lich_ct = $lich_ct = Khcn_Api::_()->getItem('default_lich_cong_tac', $id);
		if(!$lich_ct){
			$_SESSION['msg'] = "Lỗi! Lịch công tác không tồn tại.";
			$_SESSION['type_msg'] = "error";
			return $this->_redirect('/admin/lich-cong-tac/index');
		}
    	$this->view->form = $form = new Admin_Form_LichCongTac_Create();
    	$form->populate($lich_ct->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$lich_ct->setFromArray($values);
		$lich_ct->save();
		
        $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lich-cong-tac/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$lich_ct = $this->lich_ct->getLichCT($id);
    		if($lich_ct != null){
	    		$kq = $this->lich_ct->CapNhatTT($id,$status);
	    		if(!$kq){
	    			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/lich-cong-tac/index');
	    		}
	    		$this->_redirect('/admin/lich-cong-tac/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã lịch công tác không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-cong-tac/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-cong-tac/index');
    	}
    }
	
	public function removeNoiDungAction(){
		$lct_id = $this->_getParam('lct_id');
		$ndct_id = $this->_getParam('ndct_id');
		$lct = Khcn_Api::_()->getItem('default_lich_cong_tac', $lct_id);
		if(!$lct){
			$_SESSION['msg'] = 'Lỗi !. Lịch công tác không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/lich-cong-tac/index');
		}
		
		$ndct = Khcn_Api::_()->getItem('default_noi_dung_cong_tac', $ndct_id);
		if(!$ndct){
			$_SESSION['msg'] = 'Lỗi !. Nội dung công tác không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/lich-cong-tac/hoat-dong/id/' . $lct_id);
		}

		$ndct->delete();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lich-cong-tac/hoat-dong/id/' . $lct_id);
	}
}

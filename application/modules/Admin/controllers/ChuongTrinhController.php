<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_ChuongTrinhController extends Khcn_Controller_Action_Admin
{
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('chuong_trinh', 'default');
		$chuongTrinhs = $table->fetchAll($table->select()->order('ngay_tao DESC'));
		
        //Set the properties for the pagination
        $this->view->paginator = $paginator = Zend_Paginator::factory($chuongTrinhs);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_ChuongTrinh();
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}		

		$table = Khcn_Api::_()->getDbTable('chuong_trinh', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$values = $form->getValues();
			$chuong_trinh = $table->createRow();
			$chuong_trinh -> setFromArray($values);
			$chuong_trinh->save();
			$db->commit();
			
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			if($form->submitCon->isChecked()){
				$this->_redirect('/admin/chuong-trinh/them');
			}else{
				$this->_redirect('/admin/chuong-trinh/index');
			}
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/chuong-trinh/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$chuong_trinh = Khcn_Api::_()->getItem('default_chuong_trinh', $id);
			if($chuong_trinh){
				$chuong_trinh->delete();
			}	
		}		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/chuong-trinh/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$chuong_trinh = Khcn_Api::_()->getItem('default_chuong_trinh', $id);
    		if($chuong_trinh){	
				$chuong_trinh->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/chuong-trinh/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã chương trình không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/chuong-trinh/index');
    		}
    	}else{
    		$this->_redirect('/admin/chuong-trinh/index');
    	}
    }
    
	public function suaAction()
    {
    	$this->view->form = $form = new Admin_Form_ChuongTrinh();
		$id = $this->_getParam('id');
		$chuong_trinh = Khcn_Api::_()->getItem('default_chuong_trinh', $id);
		$form->populate($chuong_trinh->toArray());
		$form->removeElement('submitCon');			
		$form->submitExit->setLabel('Lưu');
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('chuong_trinh', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {	
			$values = $form->getValues();	
			$chuong_trinh -> setFromArray($values);
			$chuong_trinh->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/chuong-trinh/index');
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
	
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$chuong_trinh = Khcn_Api::_()->getItem('default_chuong_trinh', $id);
    		if($chuong_trinh != null){
	    		$chuong_trinh->trang_thai = 1 - $status;
				$chuong_trinh->save();
	    		$this->_redirect('/admin/chuong-trinh/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã chương trình không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/chuong-trinh/index');
    		}
    	}else{
    		$this->_redirect('/admin/chuong-trinh/index');
    	}
    }
}

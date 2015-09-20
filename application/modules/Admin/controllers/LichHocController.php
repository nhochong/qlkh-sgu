<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LichHocController extends Khcn_Controller_Action_Admin
{
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action    
		$table = Khcn_Api::_()->getDbTable('lich_hoc', 'default');
		$select = $table->select()->order('ngay_tao DESC');
		$lichHocs = $table->fetchAll($select);
        
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($lichHocs);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_LichHoc();
        $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'lich-hoc','action' => 'index'),null,true);
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
		$form->cancel->setLabel('Không lưu')
        			 ->setAttribs(array('onclick' => 'window.location.href="' . $link . '"'));
        $this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}

		$values = $form->getValues();
		$table = Khcn_Api::_()->getDbTable('lich_hoc', 'default');
		$lich_hoc = $table->createRow();
		$lich_hoc->setFromArray($values);
		$lich_hoc->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/lich-hoc/them');					
		}else{
			$this->_redirect('/admin/lich-hoc/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/lich-hoc/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$lich_hoc = Khcn_Api::_()->getItem('default_lich_hoc', $id);
			if($lich_hoc != NULL){
				if($lich_hoc['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_hoc/' . $lich_hoc['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/lich_hoc/' . $lich_hoc['file']);
				$lich_hoc->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/lich-hoc/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$lich_hoc = Khcn_Api::_()->getItem('default_lich_hoc', $id);
    		if($lich_hoc != null){	
				if($lich_hoc['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_hoc/' . $lich_hoc['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/lich_hoc/' . $lich_hoc['file']);
    			$lich_hoc->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/lich-hoc/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-hoc/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-hoc/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LichHoc();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$lich_hoc = Khcn_Api::_()->getItem('default_lich_hoc', $id);
		if(!$lich_hoc){	     
			$_SESSION['msg'] = 'Lỗi !. Không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/lich-hoc/index');
		}
		
		$form->populate($lich_hoc->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$lich_hoc->setFromArray($values);
		$lich_hoc->save();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lich-hoc/index');
    }
	
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$lich_hoc = Khcn_Api::_()->getItem('default_lich_hoc', $id);
    		if($lich_hoc != null){
	    		$lich_hoc->trang_thai = 1 - $status;
				$lich_hoc->save();
	    		$this->_redirect('/admin/lich-hoc/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-hoc/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-hoc/index');
    	}
    }
	
	public function updateAction(){
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
		$lich_hoc_id = $this->_getParam('lich_hoc_id', null);
		$type = $this->_getParam('type', null);
		$status = $this->_getParam('status', true);
		
		$lich_hoc = Khcn_Api::_()->getItem('default_lich_hoc', $lich_hoc_id);
		if($lich_hoc){
			$lich_hoc->$type = $status;
			$lich_hoc->save();
			echo json_encode(array('status' => true));
			exit;
		}else{
			echo json_encode(array('status' => false));
			exit;
		}
	}
}

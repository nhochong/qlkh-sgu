<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_DanhSachLopController extends Khcn_Controller_Action_Admin
{
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action    
		$table = Khcn_Api::_()->getDbTable('danh_sach_lop', 'default');
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
        $form = new Admin_Form_DanhSachLop();
        $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'danh-sach-lop','action' => 'index'),null,true);
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
		$table = Khcn_Api::_()->getDbTable('danh_sach_lop', 'default');
		$danh_sach_lop = $table->createRow();
		$danh_sach_lop->setFromArray($values);
		$danh_sach_lop->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/danh-sach-lop/them');					
		}else{
			$this->_redirect('/admin/danh-sach-lop/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/danh-sach-lop/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$danh_sach_lop = Khcn_Api::_()->getItem('default_danh_sach_lop', $id);
			if($danh_sach_lop != NULL){
				if($danh_sach_lop['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/danh_sach_lop/' . $danh_sach_lop['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/danh_sach_lop/' . $danh_sach_lop['file']);
				$danh_sach_lop->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/danh-sach-lop/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$danh_sach_lop = Khcn_Api::_()->getItem('default_danh_sach_lop', $id);
    		if($danh_sach_lop != null){	
				if($danh_sach_lop['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/danh_sach_lop/' . $danh_sach_lop['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/danh_sach_lop/' . $danh_sach_lop['file']);
    			$danh_sach_lop->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/danh-sach-lop/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/danh-sach-lop/index');
    		}
    	}else{
    		$this->_redirect('/admin/danh-sach-lop/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_DanhSachLop();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$danh_sach_lop = Khcn_Api::_()->getItem('default_danh_sach_lop', $id);
		if(!$danh_sach_lop){	     
			$_SESSION['msg'] = 'Lỗi !. Không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/danh-sach-lop/index');
		}
		
		$form->populate($danh_sach_lop->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$danh_sach_lop->setFromArray($values);
		$danh_sach_lop->save();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/danh-sach-lop/index');
    }
	
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$danh_sach_lop = Khcn_Api::_()->getItem('default_danh_sach_lop', $id);
    		if($danh_sach_lop != null){
	    		$danh_sach_lop->trang_thai = 1 - $status;
				$danh_sach_lop->save();
	    		$this->_redirect('/admin/danh-sach-lop/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/danh-sach-lop/index');
    		}
    	}else{
    		$this->_redirect('/admin/danh-sach-lop/index');
    	}
    }
	
	public function updateAction(){
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
		$danh_sach_lop_id = $this->_getParam('danh_sach_lop_id', null);
		$type = $this->_getParam('type', null);
		$status = $this->_getParam('status', true);
		
		$danh_sach_lop = Khcn_Api::_()->getItem('default_danh_sach_lop', $danh_sach_lop_id);
		if($danh_sach_lop){
			$danh_sach_lop->$type = $status;
			$danh_sach_lop->save();
			echo json_encode(array('status' => true));
			exit;
		}else{
			echo json_encode(array('status' => false));
			exit;
		}
	}
}

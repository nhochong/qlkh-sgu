<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LichThiController extends Khcn_Controller_Action_Admin
{
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action    
		$table = Khcn_Api::_()->getDbTable('lich_thi', 'default');
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
        $form = new Admin_Form_LichThi();
        $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'lich-thi','action' => 'index'),null,true);
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
		$table = Khcn_Api::_()->getDbTable('lich_thi', 'default');
		$lich_thi = $table->createRow();
		$lich_thi->setFromArray($values);
		$lich_thi->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/lich-thi/them');					
		}else{
			$this->_redirect('/admin/lich-thi/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/lich-thi/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$lich_thi = Khcn_Api::_()->getItem('default_lich_thi', $id);
			if($lich_thi != NULL){
				if($lich_thi['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_thi/' . $lich_thi['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/lich_thi/' . $lich_thi['file']);
				$lich_thi->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/lich-thi/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$lich_thi = Khcn_Api::_()->getItem('default_lich_thi', $id);
    		if($lich_thi != null){	
				if($lich_thi['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_thi/' . $lich_thi['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/lich_thi/' . $lich_thi['file']);
    			$lich_thi->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/lich-thi/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-thi/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-thi/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LichThi();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$lich_thi = Khcn_Api::_()->getItem('default_lich_thi', $id);
		if(!$lich_thi){	     
			$_SESSION['msg'] = 'Lỗi !. Không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/lich-thi/index');
		}
		
		$form->populate($lich_thi->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		$lich_thi->setFromArray($values);
		$lich_thi->save();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lich-thi/index');
    }
	
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$lich_thi = Khcn_Api::_()->getItem('default_lich_thi', $id);
    		if($lich_thi != null){
	    		$lich_thi->trang_thai = 1 - $status;
				$lich_thi->save();
	    		$this->_redirect('/admin/lich-thi/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-thi/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-thi/index');
    	}
    }
	
	public function updateAction(){
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
		$lich_thi_id = $this->_getParam('lich_thi_id', null);
		$type = $this->_getParam('type', null);
		$status = $this->_getParam('status', true);
		
		$lich_thi = Khcn_Api::_()->getItem('default_lich_thi', $lich_thi_id);
		if($lich_thi){
			$lich_thi->$type = $status;
			$lich_thi->save();
			echo json_encode(array('status' => true));
			exit;
		}else{
			echo json_encode(array('status' => false));
			exit;
		}
	}
}

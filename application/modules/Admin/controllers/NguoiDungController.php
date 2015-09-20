<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_NguoiDungController extends Khcn_Controller_Action_Admin
{
	protected $nguoi_dung = null;
	
	public function init ()
    {
        $this->nguoi_dung = new Default_Model_NguoiDung();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $nguoiDungs = $this->nguoi_dung->getAll();
        $paginator = Zend_Paginator::factory($nguoiDungs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }

    public function dsViPhamAction()
    {
    	// TODO Auto-generated {0}::indexAction() default action
        $nguoiDungs = $this->nguoi_dung->getDSViPham();
        $paginator = Zend_Paginator::factory($nguoiDungs);
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
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			header('Location: '.$_SERVER['HTTP_REFERER']);exit;
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$nguoi_dung = $this->nguoi_dung->getNguoiDung($id);
			if($nguoi_dung != NULL)
			{	
				$kq = $this->nguoi_dung->xoa($id);
				if(!$kq){
					$str .= $nguoi_dung['ten_dang_nhap'] . ', ';
				}
			}	
		}
		
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các user sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			header('Location: '.$_SERVER['HTTP_REFERER']);exit;	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$nguoi_dung = $this->nguoi_dung->getNguoiDung($id);
    		if($nguoi_dung != null){			
    			$kq = $this->nguoi_dung->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã người dùng không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    		}
    	}else{
    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    	}
    }
     
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$nguoi_dung = $this->nguoi_dung->getNguoiDung($id);
    		if($nguoi_dung != null){
	    		$kq = $this->nguoi_dung->CapNhatTT($id,$status);
    			if(!$kq){
	    			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
	    		}else{
		    		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
					$_SESSION['type_msg'] = 'success';
	    		}
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã người dùng không tồn tại .';
				$_SESSION['type_msg'] = 'error';	    		
    		}
    	}
    	header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    }
	
	public function listQueuesAction(){
		// TODO Auto-generated {0}::indexAction() default action\
		$table = Khcn_Api::_()->getDbTable('queue', 'default');
    	$this->view->form = $form = new Admin_Form_FilterGV();
		$form->removeElement('reset');
		$params = Default_Model_Functions::filterParams($this->_getAllParams());		
        $form->populate($params);
		$params['page'] = $this->_getParam('page',1);
		
		// Delete or Approve queue
		if(!empty($params['submit'])){
			if($params['submit'] == 'Xóa'){
				foreach($params['items'] as $id){
					$queue = Khcn_Api::_()->getItem('default_queue', $id);
					if($queue != null){			
						$queue->delete();
					}
				}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa.';
				$_SESSION['type_msg'] = 'success';
			}else if ($params['submit'] == 'Xác nhận'){
				foreach($params['items'] as $id){
					$queue = Khcn_Api::_()->getItem('default_queue', $id);
					if($queue != null){			
						$this->addGiangVien($queue);
						$queue->delete();
					}
				}
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật.';
				$_SESSION['type_msg'] = 'success';
			}
		}
				
        //Set the properties for the pagination
        $paginator = $table->getQueuesPaginator($params);
        $paginator->setItemCountPerPage(20);
        $this->view->paginator = $paginator;
		$this->view->filterValues = $params;
	}
	
	public function deleteQueueAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$queue = Khcn_Api::_()->getItem('default_queue', $id);
    		if($queue != null){			
    			$queue->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa.';
				$_SESSION['type_msg'] = 'success';
    		}
    	}
    	return $this->_helper->redirector->gotoRoute(array('module' => 'admin', 'controller' => 'nguoi-dung', 'action' => 'list-queues'), null, true);   	
    }
	
	public function approveQueueAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
			$table = Khcn_Api::_()->getDbTable('giang_vien', 'default');
			$db = $table->getAdapter();
			$db->beginTransaction();
			try {		
				$queue = Khcn_Api::_()->getItem('default_queue', $id);
				if($queue != null){	
					$this->addGiangVien($queue);
					$queue->delete();
					$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật.';
					$_SESSION['type_msg'] = 'success';
					$db->commit();
				}
			} catch( Exception $e ) {
				$db->rollBack();
				throw $e;
			}
    	}
    	return $this->_helper->redirector->gotoRoute(array('module' => 'admin', 'controller' => 'nguoi-dung', 'action' => 'list-queues'), null, true);   	
    }
	
	public function addGiangVien($queue){
		$table = Khcn_Api::_()->getDbTable('giang_vien', 'default');
		$nguoi_dung = Khcn_Api::_()->getItem('default_nguoi_dung', $queue->nguoi_dung_id);
		$row = $table->getGiangVienByOptions(array('ma_giang_vien' => $queue->ma_giang_vien));
		if($row == null){
			$row = $table->createRow();
			$row->ma = $queue->ma_giang_vien;
		}
		$row->ho = $queue->ho;
		$row->ten = $queue->ten;
		$row->email = $queue->email;
		$row->so_dien_thoai = $queue->so_dien_thoai;
		$row->chuc_vu = $queue->chuc_vu;
		$row->ma_don_vi = $queue->don_vi_id	;
		$row->ma_hoc_vi = $queue->hoc_vi_id;
		$row->save();
		
		$nguoi_dung->giang_vien_id = $row->id;
		$nguoi_dung->ma_quyen = Khcn_Api::_()->getDbTable('quyen', 'default')->getLevelIdByType('teacher');
		$nguoi_dung->save();
	}
	
	public function editAction(){
		//Checking viewer
		if (!$this -> _helper -> requireUser() -> isValid()) {
			return;
		}

		//Get nguoi_dung
		$id = $this -> _getParam('id', 0);
		$this->view->nguoi_dung = $nguoi_dung = Khcn_Api::_() -> getItem('default_nguoi_dung', $id);
		$tableGV = Khcn_Api::_()->getDbTable('giang_vien','default');
		$this->view->form = $form = new Admin_Form_NguoiDung();
		$form -> populate($nguoi_dung->toArray());
		$form->ngay_sinh->setValue(date('d-m-Y', strtotime($nguoi_dung->ngay_sinh)));
		if(!empty($nguoi_dung->giang_vien_id) && $giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $nguoi_dung->giang_vien_id)){
			$giangViens = $tableGV->getGiangViensByDonViAssoc($giang_vien->ma_don_vi);
			$form->giang_vien_id->setMultiOptions($giangViens)->setValue($nguoi_dung->giang_vien_id);
			$form->is_giang_vien->setValue(1);
			$form->don_vi_id->setValue($giang_vien->ma_don_vi);
			$this->view->giang_vien = $giang_vien;
		}
		
		// Check method/valid
		if (!$this -> getRequest() -> isPost()) {
			return;
		}
		if (!$form -> isValid($this -> getRequest() -> getPost())) {
			return;
		}

		$db = Khcn_Db_Table::getDefaultAdapter();
		$db -> beginTransaction();

		try {
			$values = $form -> getValues();
			$nguoi_dung->ho = $values['ho'];
			$nguoi_dung->ten = $values['ten'];
			$nguoi_dung->ngay_sinh = date('Y-m-d',strtotime($values['ngay_sinh']));
			if(!empty($values['is_giang_vien'])){
				$nguoi_dung->giang_vien_id = $values['giang_vien_id'];
			}else{
				$nguoi_dung->giang_vien_id = 0;
			}
			$nguoi_dung->setTenHienThi(array('ho' => $values['ho'], 'ten' => $values['ten']));
			$nguoi_dung -> save();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật.';
			$_SESSION['type_msg'] = 'success';
			$db -> commit();
		} catch (Exception $e) {
			$db -> rollBack();
			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý.';
			$_SESSION['type_msg'] = 'error';
			throw $e;
		}

		return $this -> _forward('index', 'nguoi-dung', 'admin');
	}
}

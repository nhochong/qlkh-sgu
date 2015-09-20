<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_BoMonController extends Khcn_Controller_Action_Admin
{
    public function indexAction() 
    {
		$this->view->form = $form = new Admin_Form_BoMon_Filter(); 	
		$params = Default_Model_Functions::filterParams($this->_getAllParams());	
        $form->populate($params);
		
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->paginator = $paginator = Khcn_Api::_()->getDbTable('bo_mon', 'default')->getBoMonsPaginator($params);
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
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_BoMon_Create();
		
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
			$table = Khcn_Api::_()->getDbTable('bo_mon', 'default');
			$bo_mon = $table->createRow();
			$bo_mon -> setFromArray($values);
			$bo_mon->save();
			$db->commit();
			
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/bo-mon/index');
		} catch (Exception $e) {
			$db -> rollBack();
			throw $e;
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0){
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/bo-mon/index');
		}
	
		foreach($_POST['item'] as $id){
			$bo_mon = Khcn_Api::_()->getItem('default_bo_mon', $id);
			if($bo_mon){	
				$bo_mon->delete();
			}
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/bo-mon/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$bo_mon = Khcn_Api::_()->getItem('default_bo_mon', $id);
    		if($bo_mon){    			
				$bo_mon->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/bo-mon/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã bộ môn không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/bo-mon/index');
    		}
    	}else{
    		$this->_redirect('/admin/bo-mon/index');
    	}
    }
    
	public function suaAction()
    {
		$this->view->form = $form = new Admin_Form_BoMon_Create();
		$id = $this->_getParam('id');
		$bo_mon = Khcn_Api::_()->getItem('default_bo_mon',$id);		
		$form->populate($bo_mon->toArray());
		
		if (!$this -> getRequest() -> isPost()) {
			return;
		}
		if (!$form -> isValid($this -> getRequest() -> getPost())) {
			return;
		}

		$table = Khcn_Api::_()->getItemTable('default_bo_mon');
        $db = $table->getAdapter();
        $db->beginTransaction();

        try
        {
			$values = $form->getValues();
			$bo_mon -> setFromArray($values);
			$bo_mon->save();
			
			// Commit
            $db->commit();
			
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
		} catch( Exception $e ){
			$db->rollBack();
			throw $e;
			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'error';
        }
		$this->_redirect('/admin/bo-mon/index');
    }
	
	public function loadAction() {
      	// If we use Ajax to load response of this action
      	// set no render
      	$this->_helper->getHelper('viewRenderer')->setNoRender();
      	// If you use layout, disable it
      	$this->_helper->layout()->disableLayout();
      
      	// Get the id from request
      	$id = $_POST['id'];
      	if($id != 0){
	      	// Query from database
	      	$data = Khcn_Api::_()->getDbTable('bo_mon','default')->getBoMonByDonViAssoc($id);
	      	$result = '';
	      	foreach ($data as $k=>$v)
	      	{
	      		$result .= '<option value=' . $k . '>' . $v .'</option>';
	      	}
	      	echo $result;
      	}else{
      		echo '<option value="0">===== Chọn bộ môn =====</option>';
      	}
    }
}

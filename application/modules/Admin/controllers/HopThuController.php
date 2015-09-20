<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_HopThuController extends Khcn_Controller_Action_Admin
{
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
    	
    }
    
	public function gopYAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
    	$this->view->form = $form = new Admin_Form_GopY_Filter(); 	
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
        $form->populate($params);
		
		$this->view->tinhTrangOptions = $tinhTrangOptions = array(
			'initial' => 'Mới',
			'pending' => 'Đang kiểm tra',
			'failure' => 'Hủy bỏ',
			'completed' => 'Hoàn thành'
		);
        //Set the properties for the pagination
        $this->view->paginator = $paginator = Khcn_Api::_()->getDbTable('gop_y', 'default')->getGopYsPaginator($params);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
		$this->view->filterValues = $params;
    }
    
	public function chiTietAction(){
		$id = $this->_getParam('id', null);
		$this->view->gop_y = $gop_y = Khcn_Api::_()->getItem('default_gop_y', $id);
		$this->view->form = $form = new Admin_Form_GopY_Edit();
		$form->populate($gop_y->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}		

		$table = Khcn_Api::_()->getDbTable('gop_y', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {	
			$values = $form->getValues();
			$gop_y -> setFromArray($values);
			$gop_y->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/hop-thu/gop-y/');
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
			$this->_redirect('/admin/hop-thu/gop-y');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$gop_y = Khcn_Api::_()->getItem('default_gop_y', $id);
			if($gop_y)
				$gop_y->delete();
		}		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/hop-thu/gop-y');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$gop_y = Khcn_Api::_()->getItem('default_gop_y', $id);
    		if($gop_y){	
				$gop_y->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/hop-thu/gop-y');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã hội thảo không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hop-thu/gop-y');
    		}
    	}else{
    		$this->_redirect('/admin/hop-thu/gop-y');
    	}
    }
}

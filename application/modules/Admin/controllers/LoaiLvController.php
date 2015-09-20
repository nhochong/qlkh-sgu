<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LoaiLvController extends Khcn_Controller_Action_Admin
{
	protected $loai_lv = null;
	
	public function init ()
    {
        $this->loai_lv = new Default_Model_LoaiLinhVuc();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $loaiLVs = $this->loai_lv->getAll();
        
        $paginator = Zend_Paginator::factory($loaiLVs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(5);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }

	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_LoaiLV();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{			
				$loai_lv = new Default_Model_LoaiLinhVuc();
				$loai_lv->setMa($form->getValue('ma'))
						->setTen($form->getValue('ten'));
				$kq = $loai_lv->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-lv/index');
				}
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/loai-lv/them');					
				}else{
					$this->_redirect('/admin/loai-lv/index');
				}
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/loai-lv/index');
		}
		
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$loai_lv = $this->loai_lv->getLoaiLV($id);			
			if($loai_lv != NULL)
			{			
				//xoa database
				$kq = $this->loai_lv->xoa($id);
				if(!$kq){
					$str .= $loai_lv['ten'] . ', ';
					continue;
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các loại đề tài sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/loai-lv/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/loai-lv/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$loai_lv = $this->loai_lv->getLoaiLV($id);
    		if($loai_lv != null){   			
    			$kq = $this->loai_lv->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-lv/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/loai-lv/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã loại biểu mẫu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/loai-lv/index');
    		}
    	}else{
    		$this->_redirect('/admin/loai-lv/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LoaiLV();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$loai_lv = Khcn_Api::_()->getItem('default_loai_linh_vuc',$id);
		$form->populate($loai_lv->toArray());
					
		if( !$this->getRequest()->isPost() ) {
            return;
        }
		
        if(!$form->isValid($this->getRequest()->getPost())){
            return;
		}
		
		$table = Khcn_Api::_()->getItemTable('default_don_vi');
        $db = $table->getAdapter();
        $db->beginTransaction();

        try
        {
			$values = $form->getValues();
			$loai_lv->setFromArray($values);
			$loai_lv->save();
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
		$this->_redirect('/admin/loai-lv/index');
    }
}

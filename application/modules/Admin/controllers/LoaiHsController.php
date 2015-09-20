<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LoaiHsController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$this->view->parent_id = $parent_id = $this->_getParam('ma_loai', 0);
        $loaiHSs = Khcn_Api::_()->getDbTable('loai_ho_so', 'default')->getByParent($parent_id);
        $paginator = Zend_Paginator::factory($loaiHSs);
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
		$ma_loai = $this->_getParam('ma_loai', 0);
        $form = new Admin_Form_LoaiHS();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{		
				$values = $form->getValues();
				$values['parent_id'] = $ma_loai;
				$table = Khcn_Api::_()->getDbTable('loai_ho_so', 'default');
				$loai_ho_so = $table->createRow();
				$loai_ho_so->setFromArray($values);
				$loai_ho_so->save();
								
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/loai-hs/them/ma_loai/' . $ma_loai);					
				}else{
					$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
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
		$ma_loai = $this->_getParam('ma_loai', 0);
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
		}
		
    	$str = '';
		foreach($_POST['item'] as $id){
			$loai_bm = Khcn_Api::_()->getItem('default_loai_ho_so', $id);
			if($loai_bm != NULL)
			{			
				$loai_bm->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
    }
    
	public function xoaAction()
    {
		$ma_loai = $this->_getParam('ma_loai', 0);
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$loai_bm = Khcn_Api::_()->getItem('default_loai_ho_so', $id);
    		if($loai_bm != null){   			
    			$loai_bm->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã loại biểu mẫu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
    		}
    	}else{
    		$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
    	}
    }
    
	public function suaAction()
    {
		$ma_loai = $this->_getParam('ma_loai', 0);
    	$form = new Admin_Form_LoaiHS();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$loai_bm = Khcn_Api::_()->getItem('default_loai_ho_so', $id);
		if(!$loai_bm){	     
			$_SESSION['msg'] = 'Lỗi !. Loại hồ sơ không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
		}
		           	
		$form->populate($loai_bm->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
        $values = $form->getValues();
		$loai_bm->setFromArray($values);
		$loai_bm->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/loai-hs/index/ma_loai/' . $ma_loai);
	}
}

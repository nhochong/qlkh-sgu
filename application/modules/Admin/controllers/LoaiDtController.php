<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LoaiDtController extends Khcn_Controller_Action_Admin
{
	protected $loai_dt = null;
	
	public function init ()
    {
        $this->loai_dt = new Default_Model_LoaiDt();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $loaiDTs = $this->loai_dt->getAll();
        
        $paginator = Zend_Paginator::factory($loaiDTs);
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
    
    public function kiemTraMaAction()
    {  	
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if($this->loai_dt->kiem_tra_ma($ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function kiemTraIdMaAction()
    {  	
    	$id = $_POST['id'];
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if($this->loai_dt->kiem_tra_id_ma($id,$ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_LoaiDT();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{				
				if($this->loai_dt->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã loại đề tài đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-dt/index');
				}	
				$loai_dt = new Default_Model_LoaiDt();
				$loai_dt->setMa($form->getValue('ma'))
                		->setTen($form->getValue('ten'))
                		->setGhiChu($form->getValue('ghi_chu'));
				$kq = $loai_dt->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-dt/index');
				}
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/loai-dt/them');					
				}else{
					$this->_redirect('/admin/loai-dt/index');
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
			$this->_redirect('/admin/loai-dt/index');
		}
	
		$de_tai	= new Default_Model_DeTai();
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$loai_dt = $this->loai_dt->getLoaiDT($id);			
			if($loai_dt != NULL)
			{			
				if($de_tai->KiemTraLDT($loai_dt['id']))
				{
					$str .= $loai_dt['ten'] . ', ';
					continue;
				}
				//xoa database
				$kq = $this->loai_dt->xoa($id);
				if(!$kq){
					$str .= $loai_dt['ten'] . ', ';
					continue;
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các loại đề tài sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/loai-dt/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/loai-dt/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$loai_dt = $this->loai_dt->getLoaiDT($id);
    		if($loai_dt != null){
    			
				$de_tai	= new Default_Model_DeTai();
				if($de_tai->KiemTraLDT($loai_dt['id']))
				{
					$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-dt/index');
				}
    			$kq = $this->loai_dt->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-dt/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/loai-dt/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã loại đề tài không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/loai-dt/index');
    		}
    	}else{
    		$this->_redirect('/admin/loai-dt/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LoaiDt();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	if($this->loai_dt->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã loại đề tài đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-dt/index');
				}
            	$loai_dt = new Default_Model_LoaiDt();
            	$loai_dt->setId($form->getValue('id'))
            			->setMa($form->getValue('ma'))
                		->setTen($form->getValue('ten'))
                		->setGhiChu($form->getValue('ghi_chu'));
                $kq = $loai_dt->sua();
                if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/loai-dt/index');
                }
                
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/loai-dt/index');
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->loai_dt->getLoaiDT($id);
	            if($data != null){
	            	$data = $this->loai_dt->LoaiDTToArray($data);
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã loại đề tài không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/loai-dt/index');
	            }
        	}else{
            	$this->_redirect('/admin/loai-dt/index');
            }
        }
    }
}

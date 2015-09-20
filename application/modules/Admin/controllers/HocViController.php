<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_HocViController extends Khcn_Controller_Action_Admin
{
	protected $hoc_vi = null;
	
	public function init ()
    {
        $this->hoc_vi = new Default_Model_HocVi();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $hocVis = $this->hoc_vi->getAll();
        $paginator = Zend_Paginator::factory($hocVis);
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
	    	if($this->hoc_vi->kiem_tra_ma($ma)){
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
	    	if($this->hoc_vi->kiem_tra_id_ma($id,$ma)){
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
        $form = new Admin_Form_HocVi();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{				
				if($this->hoc_vi->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã học vị đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoc-vi/index');
				}	
				$hoc_vi = new Default_Model_HocVi();
				$hoc_vi->setMa($form->getValue('ma'));
                $hoc_vi->setTen($form->getValue('ten'));
                $hoc_vi->setGhiChu($form->getValue('ghi_chu'));
				$kq = $hoc_vi->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoc-vi/index');
				}
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/hoc-vi/them');					
				}else{
					$this->_redirect('/admin/hoc-vi/index');
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
			$this->_redirect('/admin/hoc-vi/index');
		}
	
		$giang_vien	= new Default_Model_GiangVien();
    	$str = '';
		foreach($_POST['item'] as $id){			
			$hoc_vi = $this->hoc_vi->getHocVi($id);
			//khong dc xoa don vi SGU va ngoai SGU
			if($id == '9'){
				$str .= $hoc_vi['ten'] . ', ';
				continue;
			}
			if($hoc_vi != NULL)
			{			
				if($giang_vien->KiemTraHV($hoc_vi['id']))
				{
					$str .= $hoc_vi['ten'] . ', ';
					continue;
				}
				//xoa database
				$kq = $this->hoc_vi->xoa($id);
				if(!$kq){
					$str .= $hoc_vi['ten'] . ', ';
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các học vị sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoc-vi/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/hoc-vi/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		if($id == '9'){
    			$_SESSION['msg'] = 'Lỗi !. Học vị này không được xóa .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hoc-vi/index');
    		}
    		$hoc_vi = $this->hoc_vi->getHocVi($id);
    		if($hoc_vi != null){
    			
				$giang_vien	= new Default_Model_GiangVien();
				if($giang_vien->KiemTraHV($hoc_vi['id']))
				{
					$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoc-vi/index');
				}
				
    			$kq = $this->hoc_vi->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoc-vi/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/hoc-vi/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã học vị không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hoc-vi/index');
    		}
    	}else{
    		$this->_redirect('/admin/hoc-vi/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_HocVi();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	if($this->hoc_vi->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã học vị đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoc-vi/index');
				}
            	$hoc_vi = new Default_Model_HocVi();
            	$hoc_vi->setId($form->getValue('id'));
            	$hoc_vi->setMa($form->getValue('ma'));
                $hoc_vi->setTen($form->getValue('ten'));
                $hoc_vi->setGhiChu($form->getValue('ghi_chu'));
                $kq = $hoc_vi->sua();
                if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoc-vi/index');
                }
                
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/hoc-vi/index');
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->hoc_vi->getHocVi($id);
	            if($data != null){
	            	$data = $this->hoc_vi->HocViToArray($data);
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã học vị không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoc-vi/index');
	            }
        	}else{
            	$this->_redirect('/admin/hoc-vi/index');
            }
        }
    }
}

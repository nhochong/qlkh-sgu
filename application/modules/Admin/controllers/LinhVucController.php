<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LinhVucController extends Khcn_Controller_Action_Admin
{
	protected $linh_vuc = null;
	
	public function init ()
    {
		$this->linh_vuc = new Default_Model_LinhVuc();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $linhVucs = $this->linh_vuc->getAll();
        
        $paginator = Zend_Paginator::factory($linhVucs);
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
	    	if($this->linh_vuc->kiem_tra_ma($ma)){
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
	    	if($this->linh_vuc->kiem_tra_id_ma($id,$ma)){
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
        $form = new Admin_Form_LinhVuc();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{			
				if($this->linh_vuc->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã lĩnh vực đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/linh-vuc/index');
				}
				$linh_vuc = new Default_Model_LinhVuc();
				$linh_vuc->setMa($form->getValue('ma'));
                $linh_vuc->setTen($form->getValue('ten'));
                $linh_vuc->setMoTa($form->getValue('mo_ta'));
				$linh_vuc->setMaLoai($form->getValue('ma_loai'));
				$kq = $linh_vuc->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/linh-vuc/index');
				}
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/linh-vuc/them');					
				}else{
					$this->_redirect('/admin/linh-vuc/index');
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
			$this->_redirect('/admin/linh-vuc/index');
		}
	
		$de_tai	= new Default_Model_DeTai();
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$linh_vuc = $this->linh_vuc->getLinhVuc($id);
			
			if($linh_vuc != NULL)
			{			
				if($de_tai->KiemTraLV($linh_vuc['id']))
				{
					$str .= $linh_vuc['ten'] . ', ';
					continue;
				}
				//xoa database
				$kq = $this->linh_vuc->xoa($id);
				if(!$kq){
					$str .= $linh_vuc['ten'] . ', ';
					continue;
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các lĩnh vực sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/linh-vuc/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/linh-vuc/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$linh_vuc = $this->linh_vuc->getLinhVuc($id);
    		if($linh_vuc != null){
    			
				$de_tai	= new Default_Model_DeTai();
				if($de_tai->KiemTraLV($linh_vuc['id']))
				{
					$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/linh-vuc/index');
				}
				
    			$kq = $this->linh_vuc->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/linh-vuc/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/linh-vuc/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã lĩnh vực không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/linh-vuc/index');
    		}
    	}else{
    		$this->_redirect('/admin/linh-vuc/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LinhVuc();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	
            	if($this->linh_vuc->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã lĩnh vực đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/linh-vuc/index');
				}				
            	$linh_vuc = new Default_Model_LinhVuc();
            	$linh_vuc->setId($form->getValue('id'));
            	$linh_vuc->setMa($form->getValue('ma'));
                $linh_vuc->setTen($form->getValue('ten'));
                $linh_vuc->setMoTa($form->getValue('mo_ta'));
				$linh_vuc->setMaLoai($form->getValue('ma_loai'));
                $kq = $linh_vuc->sua();
                if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/linh-vuc/index');
                }
                
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/linh-vuc/index');
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->linh_vuc->getLinhVuc($id);
	            if($data != null){
	            	$data = $this->linh_vuc->LinhVucToArray($data);
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã lĩnh vực không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/linh-vuc/index');
	            }
        	}else{
            	$this->_redirect('/admin/linh-vuc/index');
            }
        }
    }
}

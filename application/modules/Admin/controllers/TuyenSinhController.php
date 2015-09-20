<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_TuyenSinhController extends Khcn_Controller_Action_Admin
{
	protected $tuyen_sinh = null;
	
	public function init ()
    {
        $this->tuyen_sinh = new Default_Model_TuyenSinh();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $tuyenSinhs = $this->tuyen_sinh->getAll();
        $paginator = Zend_Paginator::factory($tuyenSinhs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_TuyenSinh();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{
				//determine filename and extension 
                $info = pathinfo($form->ten_file->getFileName(null,false)); 
                $filename = $info['filename']; 
                $ext = $info['extension']?".".$info['extension']:""; 
                //filter for renaming.. prepend with current time 
                $file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
                $form->ten_file->addFilter(new Zend_Filter_File_Rename(array( 
                                "target"=>$file, 
                                "overwrite"=>true)));
                $form->getValue('ten_file');
				$tuyen_sinh = new Default_Model_TuyenSinh();
				$tuyen_sinh->setTen($form->getValue('ten'));
				$tuyen_sinh->setTenFile($file);
				$kq = $tuyen_sinh->them();
				if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/tuyen-sinh/index');
                }
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/tuyen-sinh/them');					
				}else{
					$this->_redirect('/admin/tuyen-sinh/index');
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
			$this->_redirect('/admin/tuyen-sinh/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$tuyen_sinh = $this->tuyen_sinh->getTuyenSinh($id);
			if($tuyen_sinh != NULL)
			{
				if($tuyen_sinh['ten_file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tuyen_sinh/' . $tuyen_sinh['ten_file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/tuyen_sinh/' . $tuyen_sinh['ten_file']);
					
				//xoa database
				$kq = $this->tuyen_sinh->xoa($id);
				if(!$kq){
					$str .= $tuyen_sinh['ten'] . ', ';
				}
			}			
		}
		
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các lịch tuyển sinh sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/tuyen-sinh/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/tuyen-sinh/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$tuyen_sinh = $this->tuyen_sinh->getTuyenSinh($id);
    		if($tuyen_sinh != null){
    			
    			$oldFile = $this->tuyen_sinh->getFile($id);
                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tuyen_sinh/' . $oldFile))
					unlink(APPLICATION_PATH . '/../public/upload/files/tuyen_sinh/' . $oldFile);
						
    			$kq = $this->tuyen_sinh->xoa($id);
    			if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/tuyen-sinh/index');
                }
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/tuyen-sinh/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã tuyển sinh không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/tuyen-sinh/index');
    		}
    	}else{
    		$this->_redirect('/admin/tuyen-sinh/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_TuyenSinh();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->ten_file->setRequired(false);
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	
            	$tuyen_sinh = new Default_Model_TuyenSinh();
            	$tuyen_sinh->setId($form->getValue('id'));
                $tuyen_sinh->setTen($form->getValue('ten'));
                
                //kiem tra co chon lai file
                
                if($form->ten_file->getFileName(null,false) != null)
                {
                	//determine filename and extension 
	                $info = pathinfo($form->ten_file->getFileName(null,false)); 
	                $filename = $info['filename']; 
	                $ext = $info['extension']?".".$info['extension']:""; 
	                //filter for renaming.. prepend with current time 
	                $file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
	                $form->ten_file->addFilter(new Zend_Filter_File_Rename(array( 
	                                "target"=>$file, 
	                                "overwrite"=>true)));
	                $form->getValue('ten_file');
	                $tuyen_sinh->setTenFile($file);
	                
	                $oldFile = $this->tuyen_sinh->getFile($form->getValue('id'));
	                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tuyen_sinh/' . $oldFile))
						unlink(APPLICATION_PATH . '/../public/upload/files/tuyen_sinh/' . $oldFile);
                }    
          
                $kq = $tuyen_sinh->sua();
            	if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/tuyen-sinh/index');
                }
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/tuyen-sinh/index');
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->tuyen_sinh->getTuyenSinh($id);
	            if($data != null){
	            	$data = $this->tuyen_sinh->TuyenSinhToArray($data);
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã tuyển sinh không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/tuyen-sinh/index');
	            }
        	}else{
            	$this->_redirect('/admin/tuyen-sinh/index');
            }
        }
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$tuyen_sinh = $this->tuyen_sinh->getTuyenSinh($id);
    		if($tuyen_sinh != null){
	    		$kq = $this->tuyen_sinh->CapNhatTT($id,$status);
    			if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/tuyen-sinh/index');
                }
	    		$this->_redirect('/admin/tuyen-sinh/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã tuyển sinh không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/tuyen-sinh/index');
    		}
    	}else{
    		$this->_redirect('/admin/tuyen-sinh/index');
    	}
    }
}

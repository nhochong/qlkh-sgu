<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LichBieuController extends Khcn_Controller_Action_Admin
{
	protected $lich_bieu = null;
	
	public function init ()
    {
        $this->lich_bieu = new Default_Model_LichBieu();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $lichBieus = $this->lich_bieu->getAll();
        $paginator = Zend_Paginator::factory($lichBieus);
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
        $form = new Admin_Form_LichBieu();
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
				$lich_bieu = new Default_Model_LichBieu();
				$lich_bieu->setTen($form->getValue('ten'));
				$lich_bieu->setTenFile($file);
				$kq = $lich_bieu->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/lich-bieu/index');
				}
				$_SESSION['msg'] = 'Thành công !. Thêm dữ liệu thành công .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/lich-bieu/them');					
				}else{
					$this->_redirect('/admin/lich-bieu/index');
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
			$this->_redirect('/admin/lich-bieu/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$lich_bieu = $this->lich_bieu->getLichBieu($id);
			if($lich_bieu != NULL)
			{
				if($lich_bieu['ten_file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_bieu/' . $lich_bieu['ten_file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/lich_bieu/' . $lich_bieu['ten_file']);
					
				//xoa database
				$kq = $this->lich_bieu->xoa($id);
				if(!$kq){
					$str .= $lich_bieu['ten'] . ', ';
				}
			}			
		}
		
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các lịch biểu sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/lich-bieu/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/lich-bieu/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$lich_bieu = $this->lich_bieu->getLichBieu($id);
    		if($lich_bieu != null){
    			
    			$oldFile = $this->lich_bieu->getFile($id);
                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_bieu/' . $oldFile))
					unlink(APPLICATION_PATH . '/../public/upload/files/lich_bieu/' . $oldFile);
						
    			$kq = $this->lich_bieu->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/lich-bieu/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/lich-bieu/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã lịch biểu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-bieu/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-bieu/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LichBieu();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->ten_file->setRequired(false);
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	
            	$lich_bieu = new Default_Model_LichBieu();
            	$lich_bieu->setId($form->getValue('id'));
                $lich_bieu->setTen($form->getValue('ten'));
                
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
	                $lich_bieu->setTenFile($file);
	                
	                $oldFile = $this->lich_bieu->getFile($form->getValue('id'));
	                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/lich_bieu/' . $oldFile))
						unlink(APPLICATION_PATH . '/../public/upload/files/lich_bieu/' . $oldFile);
                }    
          
                $kq = $lich_bieu->sua();
            	if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/lich-bieu/index');
                }
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/lich-bieu/index');
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->lich_bieu->getLichBieu($id);
	            if($data != null){
	            	$data = $this->lich_bieu->LichBieuToArray($data);
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã lịch biểu không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/lich-bieu/index');
	            }
        	}else{
            	$this->_redirect('/admin/lich-bieu/index');
            }
        }
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$lich_bieu = $this->lich_bieu->getLichBieu($id);
    		if($lich_bieu != null){
	    		$kq = $this->lich_bieu->CapNhatTT($id,$status);
    			if(!$kq){
	    			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/lich-bieu/index');
	    		}
	    		$this->_redirect('/admin/lich-bieu/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã lịch biểu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lich-bieu/index');
    		}
    	}else{
    		$this->_redirect('/admin/lich-bieu/index');
    	}
    }
}

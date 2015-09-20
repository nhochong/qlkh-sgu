<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_HoSoController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $hoSos = Khcn_Api::_()->getDbTable('ho_so', 'default')->fetchAll();
        $paginator = Zend_Paginator::factory($hoSos);
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
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_HoSo();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		//determine filename and extension 
		$info = pathinfo($form->file->getFileName(null,false)); 
		$filename = $info['filename']; 
		$ext = $info['extension']?".".$info['extension']:""; 
		//filter for renaming.. prepend with current time 
		$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
		$form->file->addFilter(new Zend_Filter_File_Rename(array( 
						"target"=>$file, 
						"overwrite"=>true)));
		$form->getValue('file');
		
		$values = $form->getValues();
		$values['ten_file'] = $file;
		$table = Khcn_Api::_()->getDbTable('ho_so', 'default');
		$ho_so = $table->createRow();
		$ho_so->setFromArray($values);
		$ho_so->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/ho-so/them');					
		}else{
			$this->_redirect('/admin/ho-so/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/ho-so/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$ho_so = Khcn_Api::_()->getItem('default_ho_so', $id);
			if($ho_so != NULL)
			{
				if($ho_so['ten_file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/ho_so/' . $ho_so['ten_file']))
						unlink(APPLICATION_PATH . '/../public/upload/files/ho_so/' . $ho_so['ten_file']);
					
				//xoa database
				$ho_so->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/ho-so/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$ho_so = Khcn_Api::_()->getItem('default_ho_so', $id);
    		if($ho_so != null){
    			$oldFile = $ho_so->ten_file;
                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/ho_so/' . $oldFile))
					unlink(APPLICATION_PATH . '/../public/upload/files/ho_so/' . $oldFile);
						
    			$ho_so->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/ho-so/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã biểu mẫu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/ho-so/index');
    		}
    	}else{
    		$this->_redirect('/admin/ho-so/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_HoSo();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->file->setRequired(false);
        $this->view->form = $form;     

		$id = $this->_getParam('id');
		$ho_so = Khcn_Api::_()->getItem('default_ho_so', $id);
		if(!$ho_so){	     
			$_SESSION['msg'] = 'Lỗi !. Hồ sơ không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/ho-so/index');
		}
		
		$form->populate($ho_so->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}	
		
		//kiem tra co chon lai file
		if($form->file->getFileName(null,false) != null)
		{
			//determine filename and extension 
			$info = pathinfo($form->file->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->file->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)));
			$form->getValue('file');
			$oldFile = $ho_so->ten_file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/ho_so/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/ho_so/' . $oldFile);
			$ho_so['ten_file'] = $file;
		}    
          
        $values = $form->getValues();
		$ho_so->setFromArray($values);
		$ho_so->save();        
                
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/ho-so/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$ho_so = Khcn_Api::_()->getItem('default_ho_so', $id);
    		if($ho_so != null){
	    		$ho_so->trang_thai = 1 - $status;
				$ho_so->save();
	    		$this->_redirect('/admin/ho-so/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã hồ sơ không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/ho-so/index');
    		}
    	}else{
    		$this->_redirect('/admin/ho-so/index');
    	}
    }
}

<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_BieuMauController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $bieuMaus = Khcn_Api::_()->getDbTable('bieu_mau', 'default')->fetchAll();
        $paginator = Zend_Paginator::factory($bieuMaus);
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
        $form = new Admin_Form_BieuMau();
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
		$table = Khcn_Api::_()->getDbTable('bieu_mau', 'default');
		$bieu_mau = $table->createRow();
		$bieu_mau->setFromArray($values);
		$bieu_mau->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/bieu-mau/them');					
		}else{
			$this->_redirect('/admin/bieu-mau/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/bieu-mau/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$bieu_mau = Khcn_Api::_()->getItem('default_bieu_mau', $id);
			if($bieu_mau != NULL)
			{
				if($bieu_mau['ten_file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/bieu_mau/' . $bieu_mau['ten_file']))
						unlink(APPLICATION_PATH . '/../public/upload/files/bieu_mau/' . $bieu_mau['ten_file']);
					
				//xoa database
				$bieu_mau->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/bieu-mau/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$bieu_mau = Khcn_Api::_()->getItem('default_bieu_mau', $id);
    		if($bieu_mau != null){
    			$oldFile = $bieu_mau->ten_file;
                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/bieu_mau/' . $oldFile))
					unlink(APPLICATION_PATH . '/../public/upload/files/bieu_mau/' . $oldFile);
						
    			$bieu_mau->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/bieu-mau/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã biểu mẫu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/bieu-mau/index');
    		}
    	}else{
    		$this->_redirect('/admin/bieu-mau/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_BieuMau();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->file->setRequired(false);
        $this->view->form = $form;     

		$id = $this->_getParam('id');
		$bieu_mau = Khcn_Api::_()->getItem('default_bieu_mau', $id);
		if(!$bieu_mau){	     
			$_SESSION['msg'] = 'Lỗi !. Biểu mẫu không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/bieu-mau/index');
		}
		
		$form->populate($bieu_mau->toArray());
		
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
			$oldFile = $bieu_mau->ten_file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/bieu_mau/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/bieu_mau/' . $oldFile);
			$bieu_mau['ten_file'] = $file;
		}    
          
        $values = $form->getValues();
		$bieu_mau->setFromArray($values);
		$bieu_mau->save();        
                
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/bieu-mau/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$bieu_mau = Khcn_Api::_()->getItem('default_bieu_mau', $id);
    		if($bieu_mau != null){
	    		$bieu_mau->trang_thai = 1 - $status;
				$bieu_mau->save();
	    		$this->_redirect('/admin/bieu-mau/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã biểu mẫu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/bieu-mau/index');
    		}
    	}else{
    		$this->_redirect('/admin/bieu-mau/index');
    	}
    }
}

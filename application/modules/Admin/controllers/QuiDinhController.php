<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_QuiDinhController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('qui_dinh', 'default');
        $quiDinhs = $table->fetchAll($table->select()->order('id DESC'));
        $this->view->loais = Default_Model_Constraints::quidinh_loai();
        
        $paginator = Zend_Paginator::factory($quiDinhs);
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
        $form = new Admin_Form_QuiDinh();
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
		$table = Khcn_Api::_()->getDbTable('qui_dinh', 'default');
		$qui_dinh = $table->createRow();
		$qui_dinh->setFromArray($values);
		$qui_dinh->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/qui-dinh/them');					
		}else{
			$this->_redirect('/admin/qui-dinh/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/qui-dinh/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$qui_dinh = Khcn_Api::_()->getItem('default_qui_dinh', $id);
			if($qui_dinh != NULL)
			{
				if($qui_dinh['ten_file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $qui_dinh['ten_file']))
						unlink(APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $qui_dinh['ten_file']);
				$qui_dinh->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/qui-dinh/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$qui_dinh = Khcn_Api::_()->getItem('default_qui_dinh', $id);
    		if($qui_dinh != null){
    			$oldFile = $qui_dinh->ten_file;
                if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $oldFile))
					unlink(APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $oldFile);
						
    			$qui_dinh->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/qui-dinh/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã qui định không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/qui-dinh/index');
    		}
    	}else{
    		$this->_redirect('/admin/qui-dinh/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_QuiDinh();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->file->setRequired(false);
        $this->view->form = $form;  

		$id = $this->_getParam('id');
		$qui_dinh = Khcn_Api::_()->getItem('default_qui_dinh', $id);
		if(!$qui_dinh){	     
			$_SESSION['msg'] = 'Lỗi !. Biểu mẫu không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/qui-dinh/index');
		}
		
		$form->populate($qui_dinh->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
                
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
			
			$oldFile = $qui_dinh->ten_file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $oldFile);
			$qui_dinh->ten_file = $file;
		}    
          
        $values = $form->getValues();
		$qui_dinh->setFromArray($values);
		$qui_dinh->save();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/qui-dinh/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$qui_dinh = Khcn_Api::_()->getItem('default_qui_dinh', $id);
    		if($qui_dinh != null){
	    		$qui_dinh->trang_thai = 1 - $status;
				$qui_dinh->save();
	    		$this->_redirect('/admin/qui-dinh/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã qui định không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/qui-dinh/index');
    		}
    	}else{
    		$this->_redirect('/admin/qui-dinh/index');
    	}
    }
}

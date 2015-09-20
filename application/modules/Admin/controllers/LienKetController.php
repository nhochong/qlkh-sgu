<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_LienKetController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('lien_ket', 'default');
        $LienKets = $table->fetchAll($table->select()->order('id DESC'));    
        $paginator = Zend_Paginator::factory($LienKets);
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
        $form = new Admin_Form_LienKet();
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
		
		$table = Khcn_Api::_()->getDbTable('lien_ket', 'default');
		$lien_ket = $table->createRow();
		if($form->file->getFileName(null,false) != null){
			//determine filename and extension 
			$info = pathinfo($form->file->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->file->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)))
					   ->addFilter(new Khcn_Filter_File_Resize(array(
							'width' => 170,
							'height' => 130,
							'keepRatio' => true,
						)));
			$form->getValue('file');
			$lien_ket->ten_file = $file;
		}
		
		$values = $form->getValues();
		$lien_ket->setFromArray($values);
		$lien_ket->save();
				
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/lien-ket/them');					
		}else{
			$this->_redirect('/admin/lien-ket/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/lien-ket/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$lien_ket = Khcn_Api::_()->getItem('default_lien_ket', $id);
			if($lien_ket != NULL){
				//xoa database
				$lien_ket->delete();
			}			
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/lien-ket/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$lien_ket = Khcn_Api::_()->getItem('default_lien_ket', $id);
    		if($lien_ket != null){
    			$lien_ket->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/lien-ket/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã liên kết không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/lien-ket/index');
    		}
    	}else{
    		$this->_redirect('/admin/lien-ket/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_LienKet();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$lien_ket = Khcn_Api::_()->getItem('default_lien_ket', $id);
		if(!$lien_ket){	     
			$_SESSION['msg'] = 'Lỗi !. Liên kết không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/qui-dinh/index');
		}
		
		$form->populate($lien_ket->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost(), $lien_ket)){
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
							"overwrite"=>true)))
						->addFilter(new Khcn_Filter_File_Resize(array(
							'width' => 170,
							'height' => 130,
							'keepRatio' => true,
						)));
			$form->getValue('file');
			
			$oldFile = $lien_ket->ten_file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/qui_dinh/' . $oldFile);
			$lien_ket->ten_file = $file;
		}    
          
        $values = $form->getValues();
		$lien_ket->setFromArray($values);
		$lien_ket->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/lien-ket/index');
    }
}

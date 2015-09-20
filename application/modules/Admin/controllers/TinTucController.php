<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_TinTucController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
		$table = Khcn_Api::_()->getDbTable('tin_tuc', 'default');
		$select = $table->select();
		$params = $this->_getAllParams();
		if( empty($params['order']) ) {
			$params['order'] = 'id';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		}
		if( !empty($params['order']) ) {
			$select->order($params['order'] . ' ' . $params['direction']);
		}
		$select->order('id DESC');
        $tinTucs = $table->fetchAll($select);
		$this->view->filterValues = $params;
		
        $paginator = Zend_Paginator::factory($tinTucs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(15);
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
        $form = new Admin_Form_TinTuc();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $form->removeElement('image');
        $this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('tin_tuc', 'default');
		$tin_tuc = $table->createRow();
		if($form->photo->getFileName(null,false) != null){
			//determine filename and extension 
			$info = pathinfo($form->photo->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->photo->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)))
					   ->addFilter(new Khcn_Filter_File_Resize(array(
							'width' => 720,
							'height' => 720,
							'keepRatio' => true,
						)));
			$form->getValue('photo');
			$tin_tuc->file = $file;
		}
		
		if($form->pdf->getFileName(null,false) != null){
			//determine filename and extension 
			$info = pathinfo($form->pdf->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->pdf->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)));
			$form->getValue('pdf');
			$tin_tuc->file_pdf = $file;
		}
		
		$viewer = Khcn_Api::_()->getViewer();
		$values = $form->getValues();
		$values['ma_quan_tri'] = $viewer->getIdentity();
		$tin_tuc->setFromArray($values);
		$tin_tuc->save();
				
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/tin-tuc/them');					
		}else{
			$this->_redirect('/admin/tin-tuc/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/tin-tuc/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
			if($tin_tuc != NULL){
				if($tin_tuc['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file']);
				if($tin_tuc['file_pdf'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file_pdf']))
					unlink(APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file_pdf']);
				$tin_tuc->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/tin-tuc/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
    		if($tin_tuc != null){	
    			if($tin_tuc['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file']);
    			if($tin_tuc['file_pdf'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file_pdf']))
					unlink(APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $tin_tuc['file_pdf']);
				$tin_tuc->delete();
				
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/tin-tuc/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã tin tức không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/tin-tuc/index');
    		}
    	}else{
    		$this->_redirect('/admin/tin-tuc/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_TinTuc();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->photo->setRequired(false);
        $this->view->form = $form;    

		$id = $this->_getParam('id');
		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
		if(!$tin_tuc){	     
			$_SESSION['msg'] = 'Lỗi !. Tin tức không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/tin-tuc/index');
		}
		           	
		$form->image->setImage(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/tin_tuc/' . $tin_tuc['file']);	
		$form->populate($tin_tuc->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}	
				
		if($form->photo->getFileName(null,false) != null)
		{
			//determine filename and extension 
			$info = pathinfo($form->photo->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->photo->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)))
					   ->addFilter(new Khcn_Filter_File_Resize(array(
								'width' => 720,
								'height' => 720,
								'keepRatio' => true,
							)));
			$form->getValue('photo');
			
			// Remove old file
			$oldFile = $tin_tuc->file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $oldFile);
			
			$tin_tuc->file = $file;
		}
		
		if($form->pdf->getFileName(null,false) != null)
		{
			//determine filename and extension 
			$info = pathinfo($form->pdf->getFileName(null,false)); 
			$filename = $info['filename']; 
			$ext = $info['extension']?".".$info['extension']:""; 
			//filter for renaming.. prepend with current time 
			$file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
			$form->pdf->addFilter(new Zend_Filter_File_Rename(array( 
							"target"=>$file, 
							"overwrite"=>true)));
			$form->getValue('pdf');
			
			// Remove old file
			$oldFile = $tin_tuc->file_pdf;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/tin_tuc/' . $oldFile);
			
			$tin_tuc->file_pdf = $file;
		}
		
		$values = $form->getValues();
		$tin_tuc->setFromArray($values);
		$tin_tuc->save();
				
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/tin-tuc/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $id);
    		if($tin_tuc != null){
	    		$tin_tuc->trang_thai = 1 - $status;
				$tin_tuc->save();
	    		$this->_redirect('/admin/tin-tuc/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã tin tức không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/tin-tuc/index');
    		}
    	}else{
    		$this->_redirect('/admin/tin-tuc/index');
    	}
    }
	
	public function updateAction(){
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
		$tin_tuc_id = $this->_getParam('tin_tuc_id', null);
		$type = $this->_getParam('type', null);
		$status = $this->_getParam('status', true);
		
		$tin_tuc = Khcn_Api::_()->getItem('default_tin_tuc', $tin_tuc_id);
		if($tin_tuc){
			$tin_tuc->$type = $status;
			$tin_tuc->save();
			echo json_encode(array('status' => true));
			exit;
		}else{
			echo json_encode(array('status' => false));
			exit;
		}
	}
}

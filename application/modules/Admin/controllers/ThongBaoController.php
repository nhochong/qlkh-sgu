<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_ThongBaoController extends Khcn_Controller_Action_Admin
{
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action    
    	$this->view->form = $form = new Admin_Form_FilterTB();  
		$table = Khcn_Api::_()->getDbTable('thong_bao', 'default');
		$select = $table->select();
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
		if( empty($params['order']) ) {
			$params['order'] = 'ngay_tao';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		} 		
        $form->populate($params);
		
		if(isset($params['loai']) && !empty($params['loai'])){
			$select->where('loai = ?', $params['loai']);
		}
		
		$select->order($params['order'] . ' ' . $params['direction']);
        $thongBaos = $table->fetchAll($select);
        
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($thongBaos);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
		$this->view->filterValues = $params;
		$this->view->order = $params['order'];
		$this->view->direction = $params['direction'];
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_ThongBao();
        $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'thong-bao','action' => 'index'),null,true);
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
		$form->cancel->setLabel('Không lưu')
        			 ->setAttribs(array('onclick' => 'window.location.href="' . $link . '"'));
		$form->removeElement('image');
        $this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}

		$table = Khcn_Api::_()->getDbTable('thong_bao', 'default');
		$thong_bao = $table->createRow();
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
			$thong_bao->file = $file;
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
			$thong_bao->file_pdf = $file;
		}
		
		$viewer = Khcn_Api::_()->getViewer();
		$values = $form->getValues();
		$values['ma_quan_tri'] = $viewer->getIdentity();
		$thong_bao->setFromArray($values);
		$thong_bao->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/thong-bao/them');					
		}else{
			$this->_redirect('/admin/thong-bao/index');
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/thong-bao/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$thong_bao = Khcn_Api::_()->getItem('default_thong_bao', $id);
			if($thong_bao != NULL){
				if($thong_bao['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file']);
				if($thong_bao['file_pdf'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file_pdf']))
					unlink(APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file_pdf']);
				$thong_bao->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/thong-bao/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$thong_bao = Khcn_Api::_()->getItem('default_thong_bao', $id);
    		if($thong_bao != null){	
				if($thong_bao['file'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file']))
					unlink(APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file']);
				if($thong_bao['file_pdf'] != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file_pdf']))
					unlink(APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $thong_bao['file_pdf']);
    			$thong_bao->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/thong-bao/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã thông báo không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/thong-bao/index');
    		}
    	}else{
    		$this->_redirect('/admin/thong-bao/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_ThongBao();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   

		$id = $this->_getParam('id');
		$thong_bao = Khcn_Api::_()->getItem('default_thong_bao', $id);
		if(!$thong_bao){	     
			$_SESSION['msg'] = 'Lỗi !. Thông báo không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/thong-bao/index');
		}
		
		$form->image->setImage(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/thong_bao/' . $thong_bao['file']);	
		$form->populate($thong_bao->toArray());
		
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
			$oldFile = $thong_bao->file;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $oldFile);
			
			$thong_bao->file = $file;
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
			$oldFile = $thong_bao->file_pdf;
			if($oldFile != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $oldFile))
				unlink(APPLICATION_PATH . '/../public/upload/files/thong_bao/' . $oldFile);
			
			$thong_bao->file_pdf = $file;
		}
		
		$values = $form->getValues();
		$thong_bao->setFromArray($values);
		$thong_bao->save();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/thong-bao/index');
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$thong_bao = Khcn_Api::_()->getItem('default_thong_bao', $id);
    		if($thong_bao != null){
	    		$thong_bao->trang_thai = 1 - $status;
				$thong_bao->save();
	    		$this->_redirect('/admin/thong-bao/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã thông báo không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/thong-bao/index');
    		}
    	}else{
    		$this->_redirect('/admin/thong-bao/index');
    	}
    }
	
	public function updateAction(){
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
		$thong_bao_id = $this->_getParam('thong_bao_id', null);
		$type = $this->_getParam('type', null);
		$status = $this->_getParam('status', true);
		
		$thong_bao = Khcn_Api::_()->getItem('default_thong_bao', $thong_bao_id);
		if($thong_bao){
			$thong_bao->$type = $status;
			$thong_bao->save();
			echo json_encode(array('status' => true));
			exit;
		}else{
			echo json_encode(array('status' => false));
			exit;
		}
	}
}

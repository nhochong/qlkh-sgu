<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_GioiThieuController extends Khcn_Controller_Action_Admin
{   
    public function indexAction() 
    {
    	$form = new Admin_Form_GioiThieu();
        $this->view->form = $form;
		
		$form->populate(array(
			'gioi_thieu' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('gioi_thieu', '')
		));
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('gioi_thieu', $values['gioi_thieu']);
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
    }
    
    public function hinhAnhAction()
    {
		$params = $this->_getAllParams();
		$table = Khcn_Api::_()->getDbTable('hinh_anh', 'default');
		$select = $table->select();
		
		if( empty($params['order']) ) {
			$params['order'] = 'id';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		}
		$select->order($params['order'] . ' ' . $params['direction']);
        $hinhAnhs = $table->fetchAll($select);
		$this->view->filterValues = $params;
    	// TODO Auto-generated {0}::indexAction() default action
        
        $paginator = Zend_Paginator::factory($hinhAnhs);
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
    
	public function themHaAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_HinhAnh();
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
                                "overwrite"=>true)))
                		   ->addFilter(new Khcn_Filter_File_Resize(array(
							    'width' => 720,
							    'height' => 720,
							    'keepRatio' => true,
							)));
                $values = $form->getValues();
				$table = Khcn_Api::_()->getDbTable('hinh_anh', 'default');
				$row = $table->createRow();
				$row->slideshow = $values['slideshow'];
				$row->ten_file = $file;
				$row->save();
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/gioi-thieu/them-ha');					
				}else{
					$this->_redirect('/admin/gioi-thieu/hinh-anh');
				}
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
	
    public function xoasHaAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/gioi-thieu/hinh-anh');
		}
		foreach($_POST['item'] as $id){			
			$hinh_anh = Khcn_Api::_()->getItem('default_hinh_anh', $id);	
			if($hinh_anh){			
				if($hinh_anh['ten_file'] != '' && file_exists( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']))
					unlink( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']);
				$hinh_anh->delete();
			}			
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/gioi-thieu/hinh-anh');
    }
    
	public function xoaHaAction()
    {
    	$id = $this->_getParam('id');
		$hinh_anh = Khcn_Api::_()->getItem('default_hinh_anh', $id);
		
		if(!$hinh_anh){
			$_SESSION['msg'] = 'Lỗi !. Hình ảnh không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/gioi-thieu/hinh-anh');
		}
    	
		if($hinh_anh['ten_file'] != '' && file_exists( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']))
			unlink( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']);
		
		$hinh_anh->delete();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
		$_SESSION['type_msg'] = 'success';
		return $this->_redirect('/admin/gioi-thieu/hinh-anh');
    }
    
	
	public function slideshowAction(){
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
		$hinh_anh_id = $this->_getParam('hinh_anh_id', null);
		$status = $this->_getParam('status', true);
		
		$hinh_anh = Khcn_Api::_()->getItem('default_hinh_anh', $hinh_anh_id);
		if($hinh_anh){
			$hinh_anh->slideshow = $status;
			$hinh_anh->save();
			echo json_encode(array('status' => true));
			exit;
		}else{
			echo json_encode(array('status' => false));
			exit;
		}
	}
	
	public function nhanSuAction() 
    {
        $this->view->nhanSus = Khcn_Api::_()->getDbTable('nhan_su', 'default')->fetchAll();
    }
	
	public function themNhanSuAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_NhanSu_Create();
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('nhan_su', 'default');
		$row = $table->createRow();
		
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
							'width' => 200,
							'height' => 400,
							'keepRatio' => true,
						)));
			$form->getValue('file');
			$row->ten_file = $file;
		}
			
		$values = $form->getValues();
		$row->setFromArray($values);
		$row->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/gioi-thieu/nhan-su');
    }
    
    public function xoasNhanSuAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/gioi-thieu/nhan-su');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$nhan_su = Khcn_Api::_()->getItem('default_nhan_su', $id);
			if($nhan_su){
				$nhan_su->delete();
			}	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/gioi-thieu/nhan-su');
    }
    
	public function xoaNhanSuAction()
    {
		$id = $this->_getParam('id', null);
		$nhan_su = Khcn_Api::_()->getItem('default_nhan_su', $id);
		
		if(!$nhan_su){
			$_SESSION['msg'] = 'Lỗi !. Thông tin nhân sự không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/gioi-thieu/nhan-su');
		}
		
		$nhan_su->delete();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/gioi-thieu/nhan-su');
    }
    
	public function suaNhanSuAction()
    {
		$id = $this->_getParam('id', null);
		$nhan_su = Khcn_Api::_()->getItem('default_nhan_su', $id);
		
		if(!$nhan_su){
			$_SESSION['msg'] = 'Lỗi !. Thông tin nhân sự không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/gioi-thieu/nhan-su');
		}
		
    	$this->view->form = $form = new Admin_Form_NhanSu_Edit();
		$form->populate($nhan_su->toArray());
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
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
							'width' => 200,
							'height' => 400,
							'keepRatio' => true,
						)));
			$form->getValue('file');
			$nhan_su->ten_file = $file;
		}
		
		$values = $form->getValues();
		$nhan_su->setFromArray($values);
		$nhan_su->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/gioi-thieu/nhan-su');
    }
    
	public function lienHeAction(){
		$form = new Admin_Form_LienHe();
        $this->view->form = $form;
		
		$form->populate(array(
			'lien_he' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('lien_he', '')
		));
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('lien_he', $values['lien_he']);
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
	}
}

<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_SinhHoatChuyenDeController extends Khcn_Controller_Action_Admin
{
    public function indexAction() 
    {
        //Set the properties for the pagination
		$table = Khcn_Api::_()->getDbTable('sinh_hoat_chuyen_de', 'default');
		$select = $table->select()->order('ngay_tao DESC');
        $shcds = $table->fetchAll($select);
        $this->view->paginator = $paginator = Zend_Paginator::factory($shcds);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_SHCD();
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}		

		$table = Khcn_Api::_()->getDbTable('sinh_hoat_chuyen_de', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$sinh_hoat_chuyen_de = $table->createRow();			
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
								'width' => 720,
								'height' => 720,
								'keepRatio' => true,
							)));
				$form->getValue('file');
				$sinh_hoat_chuyen_de->ten_file = $file;
			}
			$values = $form->getValues();	
			$sinh_hoat_chuyen_de -> setFromArray($values);
			$sinh_hoat_chuyen_de->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			if($form->submitCon->isChecked()){
				$this->_redirect('/admin/sinh-hoat-chuyen-de/them');
			}else{
				$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
			}
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$sinh_hoat_chuyen_de = Khcn_Api::_()->getItem('default_sinh_hoat_chuyen_de', $id);
			if($sinh_hoat_chuyen_de){
				$sinh_hoat_chuyen_de->delete();
			}	
		}		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$sinh_hoat_chuyen_de = Khcn_Api::_()->getItem('default_sinh_hoat_chuyen_de', $id);
    		if($sinh_hoat_chuyen_de){	
				$sinh_hoat_chuyen_de->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa.';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã tài liệu không tồn tại.';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
    		}
    	}else{
    		$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
    	}
    }
    
	public function suaAction()
    {
    	$this->view->form = $form = new Admin_Form_SHCD();
		$id = $this->_getParam('id');
		$sinh_hoat_chuyen_de = Khcn_Api::_()->getItem('default_sinh_hoat_chuyen_de', $id);
		$form->populate($sinh_hoat_chuyen_de->toArray());
		$form->removeElement('submitCon');			
		$form->submitExit->setLabel('Lưu');
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('sinh_hoat_chuyen_de', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {	
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
									'width' => 720,
									'height' => 720,
									'keepRatio' => true,
								)));
				$form->getValue('file');	
				$sinh_hoat_chuyen_de->ten_file = $file;
			}
			$values = $form->getValues();
			$sinh_hoat_chuyen_de -> setFromArray($values);
			$sinh_hoat_chuyen_de->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/sinh-hoat-chuyen-de/index');
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
	
	public function hinhAnhAction()
    {
		$id = $this->_getParam('id');
		$this->view->sinh_hoat_chuyen_de = $sinh_hoat_chuyen_de = Khcn_Api::_()->getItem('default_sinh_hoat_chuyen_de', $id);
		$hinhAnhs = Khcn_Api::_()->getDbTable('hinh_anh_chuyen_de', 'default')->getHinhAnhByChuyenDe($id);
        $paginator = Zend_Paginator::factory($hinhAnhs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
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
		$id = $this->_getParam('id');
		$this->view->sinh_hoat_chuyen_de = $sinh_hoat_chuyen_de = Khcn_Api::_()->getItem('default_sinh_hoat_chuyen_de', $id);
        $form = new Admin_Form_HinhAnhChuyenDe();
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
		$table = Khcn_Api::_()->getDbTable('hinh_anh_chuyen_de', 'default');
		$row = $table->createRow();
		$row->ten_file = $file;
		$row->chuyen_de_id = $id;
		$row->save();
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
		$_SESSION['type_msg'] = 'success';
		if($form->submitCon->isChecked()){
			$this->_redirect('/admin/sinh-hoat-chuyen-de/them-ha/id/' . $id);					
		}else{
			$this->_redirect('/admin/sinh-hoat-chuyen-de/hinh-anh/id/' . $id);
		}
    }
	
    public function xoasHaAction()
    {
		$id = $this->_getParam('id');
		if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/sinh-hoat-chuyen-de/hinh-anh');
		}
		foreach($_POST['item'] as $id){			
			$hinh_anh = Khcn_Api::_()->getItem('default_hinh_anh_chuyen_de', $id);	
			if($hinh_anh){
				$hinh_anh->delete();
			}			
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/sinh-hoat-chuyen-de/hinh-anh/id/' . $id);
    }
    
	public function xoaHaAction()
    {
    	$id = $this->_getParam('id');
		
		$hinh_anh_id = $this->_getParam('hinh_anh_id');
		$hinh_anh = Khcn_Api::_()->getItem('default_hinh_anh_chuyen_de', $hinh_anh_id);	
		
		if(!$hinh_anh){
			$_SESSION['msg'] = 'Lỗi !. Hình ảnh không tồn tại .';
			$_SESSION['type_msg'] = 'error';
			return $this->_redirect('/admin/sinh-hoat-chuyen-de/hinh-anh');
		}
		
		$hinh_anh->delete();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
		$_SESSION['type_msg'] = 'success';
		return $this->_redirect('/admin/sinh-hoat-chuyen-de/hinh-anh/id/' . $id);
    }
}

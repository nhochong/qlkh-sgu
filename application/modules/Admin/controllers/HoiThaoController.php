<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_HoiThaoController extends Khcn_Controller_Action_Admin
{
	protected $hoi_thao = null;
	
	public function init ()
    {
        $this->hoi_thao = new Default_Model_HoiThao();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
    	$this->view->form = $form = new Admin_Form_FilterHT(); 	
		$params = Default_Model_Functions::filterParams($this->_getAllParams());	
		$_SESSION['filterHT'] = $_SERVER['QUERY_STRING'];
		if(empty($params)){
			$params['nam'] = date('Y');
		}
		if( empty($params['order']) ) {
			$params['order'] = 'ngay_to_chuc';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'DESC';
		} 		
        $form->populate($params);
        $hoiThaos = Khcn_Api::_()->getDbTable('hoi_thao', 'default')->loc($params);
		if($hoiThaos == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}
		
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($hoiThaos);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $this->view->paginator = $paginator;
		$this->view->filterValues = $params;
		$this->view->order = $params['order'];
		$this->view->direction = $params['direction'];
		$this->view->capQLs = $capQLs = Default_Model_Constraints::hoithao_capquanly();
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_HoiThao();
        $form->removeElement('image');
        $this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}		

		$table = Khcn_Api::_()->getDbTable('hoi_thao', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$hoi_thao = $table->createRow();
			
			if($form->file_anh_trang_bia->getFileName(null,false) != null){
				//determine filename and extension 
				$info = pathinfo($form->file_anh_trang_bia->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$anh_trang_bia = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				$form->file_anh_trang_bia->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$anh_trang_bia, 
								"overwrite"=>true)))
						   ->addFilter(new Khcn_Filter_File_Resize(array(
								'width' => 720,
								'height' => 720,
								'keepRatio' => true,
							)));
				$form->getValue('file_anh_trang_bia');
				$hoi_thao->anh_trang_bia = $anh_trang_bia;
			}
			
			if($form->file_thong_cao_bao_chi->getFileName(null,false) != null){
				//determine filename and extension 
				$info = pathinfo($form->file_thong_cao_bao_chi->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$thong_cao_bao_chi = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				$form->file_thong_cao_bao_chi->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$thong_cao_bao_chi, 
								"overwrite"=>true)));
				$form->getValue('file_thong_cao_bao_chi');
				$hoi_thao->thong_cao_bao_chi = $thong_cao_bao_chi;
			}
			$values = $form->getValues();
			if(!empty($values['ngay_to_chuc'])){
				$values['ngay_to_chuc'] = date('Y-m-d',strtotime($values['ngay_to_chuc']));
			}		
			$hoi_thao -> setFromArray($values);
			$hoi_thao->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			if($form->submitCon->isChecked()){
				$this->_redirect('/admin/hoi-thao/them');					
			}else{
				$this->_redirect('/admin/hoi-thao/index');
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
			$this->_redirect('/admin/hoi-thao/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$hoi_thao = Khcn_Api::_()->getItem('default_hoi_thao', $id);
			if($hoi_thao)
			{
				if($hoi_thao->anh_trang_bia != '' && file_exists( APPLICATION_PATH . '/../public/upload/images/hoi_thao/' . $hoi_thao->anh_trang_bia))
						unlink(APPLICATION_PATH . '/../public/upload/images/hoi_thao/' . $hoi_thao->anh_trang_bia);
				if($hoi_thao->thong_cao_bao_chi != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/hoi_thao/' . $hoi_thao->thong_cao_bao_chi))
						unlink(APPLICATION_PATH . '/../public/upload/files/hoi_thao/' . $hoi_thao->thong_cao_bao_chi);
				$hoi_thao->delete();
			}	
		}		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/hoi-thao/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$hoi_thao = Khcn_Api::_()->getItem('default_hoi_thao', $id);
    		if($hoi_thao){	
    			if($hoi_thao->anh_trang_bia != '' && file_exists( APPLICATION_PATH . '/../public/upload/images/hoi_thao/' . $hoi_thao->anh_trang_bia))
						unlink(APPLICATION_PATH . '/../public/upload/images/hoi_thao/' . $hoi_thao->anh_trang_bia);
				if($hoi_thao->thong_cao_bao_chi != '' && file_exists( APPLICATION_PATH . '/../public/upload/files/hoi_thao/' . $hoi_thao->thong_cao_bao_chi))
						unlink(APPLICATION_PATH . '/../public/upload/files/hoi_thao/' . $hoi_thao->thong_cao_bao_chi);
				$hoi_thao->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/hoi-thao/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã hội thảo không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hoi-thao/index');
    		}
    	}else{
    		$this->_redirect('/admin/hoi-thao/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_HoiThao();
    	$form->removeElement('submitCon');
        $this->view->form = $form;        
		$id = $this->_getParam('id');
		$hoi_thao = Khcn_Api::_()->getItem('default_hoi_thao', $id);
		$form->populate($hoi_thao->toArray());
		
		if($hoi_thao['anh_trang_bia'] != '')
			$form->image->setImage(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/images/hoi_thao/' . $hoi_thao['anh_trang_bia']);
		else 
			$form->removeElement('image');	
						
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('hoi_thao', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {	
			if($form->file_anh_trang_bia->getFileName(null,false) != null)
			{
				//determine filename and extension 
				$info = pathinfo($form->file_anh_trang_bia->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$anh_trang_bia = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				
				$form->file_anh_trang_bia->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$anh_trang_bia, 
								"overwrite"=>true)))
						   ->addFilter(new Khcn_Filter_File_Resize(array(
									'width' => 720,
									'height' => 720,
									'keepRatio' => true,
								)));
				$form->getValue('file_anh_trang_bia');	
				$hoi_thao->anh_trang_bia = $anh_trang_bia;
			}
			if($form->file_thong_cao_bao_chi->getFileName(null,false) != null)
			{
				//determine filename and extension 
				$info = pathinfo($form->file_thong_cao_bao_chi->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$thong_cao_bao_chi = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				$form->file_thong_cao_bao_chi->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$thong_cao_bao_chi, 
								"overwrite"=>true)));
				$form->getValue('file_thong_cao_bao_chi');
				$hoi_thao->thong_cao_bao_chi = $thong_cao_bao_chi;
			}
			$values = $form->getValues();
			if(!empty($values['ngay_to_chuc'])){
				$values['ngay_to_chuc'] = date('Y-m-d',strtotime($values['ngay_to_chuc']));
			}	
			$hoi_thao -> setFromArray($values);
			$hoi_thao->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/hoi-thao/index');
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$hoi_thao = Khcn_Api::_()->getItem('default_hoi_thao', $id);
    		if($hoi_thao){
				$hoi_thao->trang_thai = 1 - $status;
				$hoi_thao->save();
	    		$this->_redirect('/admin/hoi-thao/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã hội thảo không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hoi-thao/index');
    		}
    	}else{
    		$this->_redirect('/admin/hoi-thao/index');
    	}
    }
}

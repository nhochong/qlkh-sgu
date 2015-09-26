<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_BaiBaoController extends Khcn_Controller_Action_Admin
{
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        //Set the properties for the pagination
        $this->view->paginator = $paginator = Khcn_Api::_()->getDbTable('bai_bao', 'default')->getBaiBaosPaginator();
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
    }
    
	public function newfieldAction() {
	    $id = $_POST['id'];
		$donVis = Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc();
		unset($donVis['1']);
		$defaultDonVi = 2;
		$dvOptions = array("multiOptions" => $donVis);	
		$ma_don_vi = new Zend_Form_Element_Select('don_vi_' .$id,$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setValue($defaultDonVi)
				  ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
				  ->setAttribs(array('id' => 'don_vi_' .$id,'onchange' => 'change(this,' . $id . ')'));
							    
		$gvOptions = array("multiOptions" => Khcn_Api::_()->getDbTable('giang_vien', 'default')->getGiangViensByDonViAssoc($defaultDonVi));					    
		$thanh_vien = new Zend_Form_Element_Select('thanh_vien_' .$id,$gvOptions);
		$thanh_vien->setRequired(true)
				   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
				   ->setAttribs(array('class' => 'text-input','id' => 'thanh_vien_' .$id));
	    $result = '<tr id="dk_tv_' . $id . '"><td></td><td><fieldset><legend>Thành viên</legend>';
		$result .= $ma_don_vi->__toString() . $thanh_vien->__toString();
		$result .= '</td></fieldset></tr>';
	    echo $result;
	    $this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
	}
	
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $this->view->form = $form = new Admin_Form_BaiBao_Create();
		
		if(!$this->getRequest()->isPost()){
			return;
		}		
		$form->preValidation($_POST);
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}		

		$table = Khcn_Api::_()->getDbTable('bai_bao', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$bai_bao = $table->createRow();			
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
				$bai_bao->ten_file = $file;
			}
			$values = $form->getValues();
			$bai_bao -> setFromArray($values);
			$bai_bao->save();
			
			$bai_bao_id = $bai_bao->bai_bao_id;
			for($i = 0 ; $i< $values['code'] ; $i++){
				$row = Khcn_Api::_()->getDbTable('bai_bao_tac_gia', 'default')->createRow();
				$row->bai_bao_id = $bai_bao_id;
				$row->giang_vien_id = $values['thanh_vien_' . $i];
				$row->save();
			}
					
			$db->commit();
			
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
			$_SESSION['type_msg'] = 'success';
			if($form->submitCon->isChecked()){
				$this->_redirect('/admin/bai-bao/add/id/' . $bai_bao->bai_bao_id);					
			}else{
				$this->_redirect('/admin/bai-bao/index');
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
			$this->_redirect('/admin/bai-bao/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			$bai_bao = Khcn_Api::_()->getItem('default_bai_bao', $id);
			if($bai_bao){
				$bai_bao->delete();
			}	
		}		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/bai-bao/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$bai_bao = Khcn_Api::_()->getItem('default_bai_bao', $id);
    		if($bai_bao){	
				$bai_bao->delete();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/bai-bao/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã hội thảo không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/bai-bao/index');
    		}
    	}else{
    		$this->_redirect('/admin/bai-bao/index');
    	}
    }
    
	public function suaAction()
    {
    	$this->view->form = $form = new Admin_Form_BaiBao_Edit();
		$id = $this->_getParam('id');
		$bai_bao = Khcn_Api::_()->getItem('default_bai_bao', $id);
		$form->populate($bai_bao->toArray());
		$form->removeElement('submitCon');			
		$form->submitExit->setLabel('Lưu');
		if(!$this->getRequest()->isPost()){
			//populate thành viên
			$thanhViens = $bai_bao->getGiangViens();
			$code = count($thanhViens);
			$form->code->setValue($code);
			$donVis = Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc();
			unset($donVis['1']);
			$dvOptions = array("multiOptions" => $donVis);            	
			$i = 0;
			foreach ($thanhViens as $thanh_vien)
			{	            						
				$don_vi = new Zend_Form_Element_Select('don_vi_' . $i,$dvOptions);
				$don_vi->setValue($thanh_vien['ma_don_vi'])
					   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
					   ->setAttribs(array('class' => 'text-input','id' => 'don_vi_' . $i,'onchange' => 'change(this,' . $i . ')'));
					   
				$gvOptions = array("multiOptions" => Khcn_Api::_()->getDbTable('giang_vien', 'default')->getGiangViensByDonViAssoc($thanh_vien->ma_don_vi));
				$ma_giang_vien = $thanh_vien->getIdentity();
				$thanh_vien = new Zend_Form_Element_Select('thanh_vien_' . $i,$gvOptions);
				$thanh_vien->setRequired(true)
						   ->setValue($ma_giang_vien)
						   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
						   ->setAttribs(array('class' => 'text-input','id' => 'thanh_vien_' . $i))
						   ->setRegisterInArrayValidator(false);
								   
				$form->addElements(array($don_vi,$thanh_vien));
				
				$form->addDisplayGroup(array('don_vi_' . $i,'thanh_vien_' . $i),'dk_tv_' . $i,array(
					'order' => $i + 6,
					'legend' => 'Thành viên',
					'decorators' => array(
						 'FormElements',
						 'Fieldset',
						 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
						 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
						 array('HtmlTag', array('tag' => 'tr', 'id' => 'dk_tv_' . $i)),
					),
				));
				
				$i++;
			}
			return;
		}
		
		$form->preValidation($_POST);
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('bai_bao', 'default');
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
				$bai_bao->ten_file = $file;
			}
			$values = $form->getValues();
			$bai_bao -> setFromArray($values);
			$bai_bao->save();
			
			// Update thanh vien
			// Clear all
			Khcn_Api::_()->getDbTable('bai_bao_tac_gia', 'default')->delete(array(
				'bai_bao_id = ?' => $bai_bao->getIdentity()
			));
			
			// Them thanh vien
			for($i = 0 ; $i< $values['code'] ; $i++){
				$row = Khcn_Api::_()->getDbTable('bai_bao_tac_gia', 'default')->createRow();
				$row->bai_bao_id = $bai_bao->getIdentity();
				$row->giang_vien_id = $values['thanh_vien_' . $i];
				$row->save();
			}
			
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
			$this->_redirect('/admin/bai-bao/index');
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
	
	public function addAction()
    {
    	$this->view->form = $form = new Admin_Form_BaiBao_Add();
		$id = $this->_getParam('id');
		$this->view->bai_bao = $bai_bao = Khcn_Api::_()->getItem('default_bai_bao', $id);
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$table = Khcn_Api::_()->getDbTable('tac_gia', 'default');
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {	
			$values = $form->getValues();	
			$tac_gia = $table->createRow();
			$tac_gia->bai_bao_id = $bai_bao->bai_bao_id;
			$tac_gia->giang_vien_id = $values['giang_vien_id'];
			$tac_gia->save();
			$db->commit();
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ.';
			$_SESSION['type_msg'] = 'success';
			if($form->submitCon->isChecked()){
				$this->_redirect('/admin/bai-bao/add/id/' . $bai_bao->bai_bao_id);					
			}else{
				$this->_redirect('/admin/bai-bao/index');
			}
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
	
	public function removeAction()
    {
    	$bai_bao_id = $this->_getParam('bai_bao');
		$giang_vien_id = $this->_getParam('giang_vien');
		$bai_bao = Khcn_Api::_()->getItem('default_bai_bao', $bai_bao_id);
		
		$tac_gia = $bai_bao->getTacGia($giang_vien_id);
		$tac_gia->delete();
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
		$_SESSION['type_msg'] = 'success';
		return $this->_redirect('/admin/bai-bao/index');
    }
	
	public function importAction(){
		$form = new Admin_Form_BaiBao_Import();
    	$this->view->form = $form;
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		//copy file to folder temp
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
		
		try{
			$data = array();
			$data = Khcn_Api::_()->admin()->getDataImport(BASE_PATH . '/upload/files/temp/' . $file, $info['extension']);
			$baiBaoTable = Khcn_Api::_()->getDbTable('bai_bao', 'default');
			$giangVientable = Khcn_Api::_()->getDbTable('giang_vien', 'default');
			$tacGiaTable = Khcn_Api::_()->getDbTable('bai_bao_tac_gia', 'default');	
			$line_start = 2;
			for($i = $line_start; $i<=count($data); $i++){
				$giang_vien = null;
				if(!empty($data[$i]['B'])){
					$baiBao = $baiBaoTable->createRow();
					$baiBao->ten = $data[$i]['B'];
					$baiBao->thong_tin = $data[$i]['F'];
					$baiBao->noi_dang = $data[$i]['G'];
					$baiBao->ngay_dang = $data[$i]['H'];
					$baiBao->so = $data[$i]['I'];
					$baiBao->chi_so = $data[$i]['J'];
					$baiBao->diem_cong_trinh = $data[$i]['K'];
					
					if(!empty($data[$i]['C'])){
						$don_vi = Khcn_Api::_()->getItem('default_don_vi', $data[$i]['C']);
						$baiBao->don_vi_id = $data[$i]['C'];
					}
					
					$baiBao->save();
				}
				
				if(!empty($data[$i]['D'])){
					$giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $data[$i]['D']);
					
					if($giang_vien){
						$tac_gia = $tacGiaTable->createRow();
						$tac_gia->bai_bao_id = $baiBao->bai_bao_id;
						$tac_gia->giang_vien_id = $giang_vien->getIdentity();
						$tac_gia->save();
					}
				}
			}
			
			//remove file in temp
			unlink(BASE_PATH . '/upload/files/temp/' . $file);
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ.';
			$_SESSION['type_msg'] = 'success';
		}catch (Zend_Exception $ex){
			echo $ex;die;
			//xóa file trong temp
			unlink(BASE_PATH . '/upload/files/temp/' . $file);
			$_SESSION['msg'] = 'Lỗi !. File không đúng định dạng, vui lòng kiểm tra lại.';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/bai-bao/import');
		}
	}
}

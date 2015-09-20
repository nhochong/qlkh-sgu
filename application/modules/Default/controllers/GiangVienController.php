<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Default_GiangVienController extends Khcn_Controller_Action_Standard
{    
	public function init()
	{
		
	}
	
    public function indexAction ()
    {     
    	
    }   

    public function dangKyAction()
    {
		// Set up require's
		$viewer = Khcn_Api::_()->getViewer();
		if( !$this->_helper->requireUser()->isValid() ) return;
		if( !$this->_helper->requireAuth()->setAuthParams('giang_vien', $viewer, 'create')->isValid() ) return;
	
		$this->view->user = $user = $viewer;
		if($user->isGiangVien()) {
			return $this->_helper->redirector->gotoRoute(array(), 'default', true);
		}
		
		$tableGV = Khcn_Api::_()->getDbTable('giang_vien', 'default');
		
		$verify_teacher = Khcn_Api::_()->getApi('settings', 'default')->getSetting('default_verify_teacher', true);			

    	$this->view->form = $form = new Default_Form_GiangVien_Create();
		$form->removeElement('ma_giang_vien');
		
		$queue = Khcn_Api::_()->getDbTable('queue', 'default')->getQueueByND($user->id);
		$this->view->is_queue = $is_queue = false;
		if($queue){
			$this->view->is_queue = $is_queue = true;
			$this->view->queue = $queue;
		}
			
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		$db = $tableGV->getAdapter();
		$db->beginTransaction();
		try {
			$values = $form->getValues();	
			if($verify_teacher){
				$tableQueue = Khcn_Api::_()->getDbTable('queue', 'default');
				$row = $tableQueue->getQueueByND($user->id);
				if(!$row){
					$row = $tableQueue->createRow();	
					$row->nguoi_dung_id = $user->id;
					$row->ma_giang_vien = $values['ma'];
					$row->ho = $values['ho'];
					$row->ten = $values['ten'];
					$row->email = $values['email'];
					$row->don_vi_id = $values['ma_don_vi'];
					$row->hoc_vi_id = $values['ma_hoc_vi'];
					$row->so_dien_thoai = $values['so_dien_thoai'];
					$row->chuc_vu = $values['chuc_vu'];
					$row -> save();
				}
				$autoRedirect = false;
				$message = "Thông tin giảng viên của bạn cần được xác nhận. Xin vui lòng liên hệ phòng Khoa học Công nghệ để được kích hoạt nhanh nhất.";
			}else{
				$giang_vien = $tableGV->getGiangVienByOptions(array('ma_giang_vien' => $values['ma']));
				if(!$giang_vien){
					$giang_vien = $tableGV->createRow();
					$giang_vien->ma = $values['ma'];
				}
				$giang_vien->ho = $values['ho'];
				$giang_vien->ten = $values['ten'];
				$giang_vien->email = $values['email'];
				$giang_vien->so_dien_thoai = $values['so_dien_thoai'];
				$giang_vien->chuc_vu = $values['chuc_vu'];
				$giang_vien->ma_don_vi = $values['ma_don_vi']	;
				$giang_vien->ma_hoc_vi = $values['ma_hoc_vi'];
				$giang_vien->save();
				
				$user->giang_vien_id = $giang_vien->id;
				$user->ma_quyen = Khcn_Api::_()->getDbTable('quyen', 'default')->getLevelIdByType('teacher');
				$user->save();
				$autoRedirect = true;
				$message = "Thành công. Thông tin giảng viên đã được cập nhật.";
			}
			$db->commit();
			return $this->_forward('thong-bao', 'index', 'default', array(
				'messages' => array(Zend_Registry::get('Zend_Translate') -> _($message)),
				//'autoRedirect' => $autoRedirect
			));
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
	
	public function capNhatAction()
    {
		// Set up require's
		$viewer = Khcn_Api::_()->getViewer();
		if( !$this->_helper->requireUser()->isValid() ) return;
		if( !$this->_helper->requireAuth()->setAuthParams('giang_vien', $viewer, 'edit')->isValid() ) return;
		
		$this->view->user = $user = $viewer;
		$this->view->giang_vien = $giang_vien = $user->getGiangVien();
		if(!$giang_vien){
			return $this->_helper->requireAuth->forward();
		}		
    	$this->view->form = $form = new Default_Form_GiangVien_Edit();
		$form->removeElement('ma');
		if($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())){
			$values = $form->getValues();
			$giang_vien -> setFromArray($values);
			$giang_vien->save();
			$form->addNotice('Thành công. Thông tin giảng viên đã được cập nhật.');
		}
		
		$form->populate($giang_vien->toArray());
		$form->ma_giang_vien->setValue($giang_vien->ma);
    }
	
	public function thongKeAction(){
		$this->view->viewer = $viewer = Khcn_Api::_()->getViewer();
		$id = $this->_getParam('id',null);
		if(!empty($id)){
			$giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $id);
		}else if ($viewer && $viewer->getIdentity()){
			$giang_vien = $viewer->getGiangVien();
		}		
		if(!$giang_vien){
			return $this->_helper->requireSubject()->forward();
		}
		$params = $this->_getAllParams();	
		
		$deTais = $giang_vien->getDSDeTaiByGiangVien($params);
		$datas = array();
		foreach($deTais as $de_tai){
			$datas[$de_tai->getNam()][] = $de_tai;
		}
		krsort($datas, SORT_NUMERIC );
		$this->view->datas = $datas;
		$this->view->tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
		$this->view->giang_vien = $giang_vien;
	}
	
	public function nghienCuuSinhAction(){
		$this->view->viewer = $viewer = Khcn_Api::_()->getViewer();
		$id = $this->_getParam('id',null);
		if(!empty($id)){
			$giang_vien = Khcn_Api::_()->getItem('default_giang_vien', $id);
		}else if ($viewer && $viewer->getIdentity()){
			$giang_vien = $viewer->getGiangVien();
		}		
		if(!$giang_vien){
			return $this->_helper->requireSubject()->forward();
		}
		$this->view->giang_vien = $giang_vien;
		$this->view->form = $form = new Default_Form_NCS();
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		//$values = $form->getValues();
		$tenChuyenDeArray = $_POST['ten_chuyen_de'];
		$thoiGianChuyenDeArray = $_POST['thoi_gian_chuyen_de'];
		var_dump($tenChuyenDeArray, $thoiGianChuyenDeArray);die;
	}
}

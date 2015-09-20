<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_DeTaiController extends Khcn_Controller_Action_Admin
{
	protected $de_tai = null;
	protected $dang_ky = null;
	public function init ()
    {
        $this->de_tai = new Default_Model_DeTai();
        $this->dang_ky = new Default_Model_DangKy();
    }
    
    //indexAction phan trang khong dung ajax
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action	
    	$this->view->form = $form = new Admin_Form_FilterDT();
        $params = Default_Model_Functions::filterParams($this->_getAllParams());
		if(empty($params['nam'])){
			$params['nam'] = date('Y');
		}
		if( empty($params['cap_quan_ly']) ) {
			$params['cap_quan_ly'] = 2;
		} 
		if( empty($params['order']) ) {
			$params['order'] = '';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = '';
		} 
		if(!empty($params['ma_don_vi'])){
			$boMons = Khcn_Api::_()->getDbTable('bo_mon', 'default')->getBoMonByDonViAssoc($params['ma_don_vi']);
			$form->bo_mon_id->setMultiOptions($boMons)->setValue($params['ma_don_vi']);
		}
		$form->populate($params);       
		$deTais = $this->de_tai->loc($params);
		if($deTais == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}     
        
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($deTais);
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
   
	public function loadAction() {
      	// If we use Ajax to load response of this action
      	// set no render
      	$this->_helper->getHelper('viewRenderer')->setNoRender();
      	// If you use layout, disable it
      	$this->_helper->layout()->disableLayout();
      
      	// Get the id from request
      	$nam = $_POST['nam'];
      	$ma_don_vi = $_POST['ma_don_vi'];
      	// Query from database
      	$data = $this->de_tai->getDSDTSelect(array('nam' => $nam,'ma_don_vi' => $ma_don_vi));
      	if($data == null){
      		echo "NO,<option value='-1'>Không có dữ liệu.</option>";
      	}else{
	      	// Response
	      	$result = '';
	      	foreach ($data as $k=>$v)
	      	{
	      		$result .= '<option value=' . $k . '>' . $v .'</option>';
	      	}
	      	echo "YES," . $result;
      	}
    }
    
    //ham nay dung de phan trang = ajax
    public function danhSachAction()
    {    	
    	$deTais = $this->de_tai->getAll();
    	$session = new Zend_Session_Namespace('filterDT');
        if($session->deTais != null)
        {
        	$deTais = $session->deTais;
        }
        $paginator = Zend_Paginator::factory($deTais);
        //Check if the user is not on page 1
        $currentPage = $this->_getParam('page',1);
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination_ajax.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
        $this->_helper->layout->disableLayout();
    }
    
    public function kiemTraMaAction()
    {  	
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if(!Default_Model_Functions::kiem_tra_ma($ma, null,true,2)){
    			echo "ERROR";
    		}else if($this->de_tai->kiem_tra_ma($ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function kiemTraIdMaAction()
    {  	
    	$id = $_POST['id'];
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if(!Default_Model_Functions::kiem_tra_ma($ma, null,true,2)){
    			echo "ERROR";
    		}else if($this->de_tai->kiem_tra_id_ma($id,$ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function newfieldAction() {
	    $id = $_POST['id'];
	    $don_vi = new Default_Model_DonVi();
		$donVis = $don_vi->getDSDV();
		unset($donVis['1']);
		$dvOptions = array("multiOptions" => $donVis);	
		$ma_don_vi = new Zend_Form_Element_Select('don_vi_' .$id,$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
				  ->setAttribs(array('id' => 'don_vi_' .$id,'onchange' => 'change(this,' . $id . ')'));
							    
		$giang_vien = new Default_Model_GiangVien();
		$gvOptions = array("multiOptions" => $giang_vien->getDSGVByDV(2));					    
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
        $form = new Admin_Form_DeTai();
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'de-tai','action' => 'index'),null,true);
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu')
        			 ->setAttribs(array('onclick' => 'window.location.href="' . $link . '"'));
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$form->preValidation($_POST);
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{	
				$tableDK = Khcn_Api::_()->getDbTable('dang_ky', 'default');
				$db = $tableDK->getAdapter();
				$db->beginTransaction();
				try
				{
					$tableDT = Khcn_Api::_()->getDbTable('de_tai', 'default');
					$de_tai = $tableDT->createRow();
					
					if($form->file_tom_tat->getFileName(null,false) != null){
						//determine filename and extension 
						$info = pathinfo($form->file_tom_tat->getFileName(null,false)); 
						$filename = $info['filename']; 
						$ext = $info['extension']?".".$info['extension']:""; 
						//filter for renaming.. prepend with current time 
						$file_tom_tat = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
						$form->file_tom_tat->addFilter(new Zend_Filter_File_Rename(array( 
										"target"=>$file_tom_tat, 
										"overwrite"=>true)));
						$form->getValue('file_tom_tat');
						$de_tai->file_tom_tat = $file_tom_tat;
					}
			
					$values = $form->getValues();
					$ma = $form->getValue('ma');
					if(!empty($ma)){
						if(!Default_Model_Functions::kiem_tra_ma($form->getValue('ma'), null,true,2)){
							$_SESSION['msg'] = 'Lỗi !. Mã đề tài không đúng định dạng, vui lòng kiểm tra lại .';
							$_SESSION['type_msg'] = 'error';
							$this->_redirect('/admin/de-tai');
						}
						if($form->getValue('ma') != '' && $this->de_tai->kiem_tra_ma($form->getValue('ma'))){
							$_SESSION['msg'] = 'Lỗi !. Mã đề tài đã tồn tại, vui lòng kiểm tra lại .';
							$_SESSION['type_msg'] = 'error';
							$this->_redirect('/admin/de-tai');
						}						
						$ma = trim($form->getValue('ma'));
					}
					if(empty($values['ngay_gia_han'])){
						$values['ngay_gia_han'] = new Zend_Db_Expr('NULL');
					}
					$values['ma'] = $ma;
					$values['kinh_phi'] = ($values['kinh_phi'] != '') ? str_ireplace(',','',$values['kinh_phi']) : 0;
					$de_tai -> setFromArray($values);
					$de_tai->save();
						
					$dt_id = $de_tai->id;
					$thanhViens = array();
					$thanhViens[] = array(
						'giang_vien_id' => $values['chu_nhiem'],
						'nhiem_vu' => 1
					);
					for($i = 0 ; $i< $values['code'] ; $i++)
					{	
						$thanhViens[] = array(
							'giang_vien_id' => $values['thanh_vien_' . $i],
							'nhiem_vu' => 0
						);
					}
					$tableDK->setChucVu($dt_id, $thanhViens);
					$db->commit();
					
					$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
					$_SESSION['type_msg'] = 'success';
					if($form->submitCon->isChecked()){
						$this->_redirect('/admin/de-tai/them');					
					}else{
						$this->_redirect('/admin/de-tai');
					}
				} catch( Exception $e ){
					$db->rollBack();
					throw $e;
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
				}
			}else{
				//danh sach chu nhiem ban dau chi co gia tri trong don vi dau tien,vi vay khi invalidate ta phai cap nhat lai danh sach giang vien
				if(isset($formData['chu_nhiem'])){
					$giang_vien = new Default_Model_GiangVien();
					$gvOptions = $giang_vien->getDSGVByDV($formData['ma_don_vi']);
					$form->chu_nhiem->setMultiOptions($gvOptions)->setValue($formData['chu_nhiem']);
				}else{
					$form->chu_nhiem->setMultiOptions(array());
				}
				$form->populate($formData);
			}
		}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			header('Location: '.$_SERVER['HTTP_REFERER']);exit;
		}
		
		$db = Zend_Registry::get('connectDB');
		$hdnt = new Default_Model_Hdnt();
    	$str = '';
		foreach($_POST['item'] as $id){			
			$de_tai = $this->de_tai->getDeTai($id);			
			if($de_tai != NULL)
			{			
				if($hdnt->KiemTraDT($id))
				{
					$str .= $de_tai['ma'] . ', ';
					continue;
				}
				
				$db->beginTransaction();
				try{			
					//xoa database
					$this->de_tai->xoa($id);
					$this->dang_ky->xoa_dk_by_mdt($id);		
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$str .= $de_tai['ma'] . ', ';
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các đề tài sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			header('Location: '.$_SERVER['HTTP_REFERER']);exit;	
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$de_tai = $this->de_tai->getDeTai($id);
    		if($de_tai != null){
    			$hdnt = new Default_Model_Hdnt();
    			if($hdnt->KiemTraDT($id))
    			{
    				$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    			}
				$db = Zend_Registry::get('connectDB');	
    			$db->beginTransaction();
				try{			
					//xoa database
					$this->de_tai->xoa($id);
					$this->dang_ky->xoa_dk_by_mdt($id);			
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
				}	  
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã đề tài không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    		}
    	}else{
    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    	}
    }
    
	public function suaAction()
    {
		$de_tai_id = $this->_getParam('id');
		$de_tai = Khcn_Api::_()->getItem('default_de_tai', $de_tai_id);
		$tableDK = Khcn_Api::_()->getDbTable('dang_ky', 'default');
		
    	$form = new Admin_Form_DeTai();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;  
		
		if (!$this -> getRequest() -> isPost()) {
			//populate chủ nhiệm
			$giang_vien = new Default_Model_GiangVien();
			$gvOptions = $giang_vien->getDSGVByDV($de_tai->ma_don_vi);
			$chu_nhiem = $this->dang_ky->getMaChuNhiemByDT($de_tai_id);
			$form->chu_nhiem->setMultiOptions($gvOptions)->setValue($chu_nhiem);
			
			//populate thành viên
			$thanhViens = $this->dang_ky->getDSTVByDT($de_tai_id);
			$code = count($thanhViens);
			$form->code->setValue($code);	
			$don_vi = new Default_Model_DonVi();
			$donVis = $don_vi->getDSDV();
			unset($donVis['1']);
			$dvOptions = array("multiOptions" => $donVis);            	
			$i = 0;
			foreach ($thanhViens as $thanh_vien)
			{	            						
				$don_vi = new Zend_Form_Element_Select('don_vi_' . $i,$dvOptions);
				$don_vi->setValue($thanh_vien['ma_don_vi'])
					   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
					   ->setAttribs(array('class' => 'text-input','id' => 'don_vi_' . $i,'onchange' => 'change(this,' . $i . ')'));
					   
				$giang_vien = new Default_Model_GiangVien();
				$gvOptions = array("multiOptions" => $giang_vien->getDSGVByDV($thanh_vien['ma_don_vi']));
				$ma_giang_vien = $thanh_vien['ma_giang_vien'];
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
			$url = new Zend_View_Helper_Url();
			if($de_tai->ma_hd_duyet != null){
				$hd_duyet = new Default_Model_Hdd();
				$hdd = $hd_duyet->getHDD($de_tai->ma_hd_duyet);
				$link = $url->url(array('module' => 'admin','controller' => 'hoi-dong','action' => 'sua-hdd','id' => $de_tai->ma_hd_duyet),null,true);
				$element = new Zend_Form_Element_Text('hdd');       
				$element->setLabel('Hội đồng duyệt')
						->setValue($hdd['ma'])
						->setDescription('<a href="' . $link . '">Xem hội đồng duyệt</a>')
						->setDecorators(array(
										'ViewHelper',
										array('Description', array('tag' => 'span','escape' => false)),
										array(array('data' => 'HtmlTag'), array('tag' => 'td')),
										array('Label', array('tag' => 'td')),
										array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
						->setAttribs(array('class' => 'text-input','disabled' => 'disabled'))
						->setOrder(100);
				$form->addElement($element);
			}  	
			// Popuate Bo Mon
			if(!empty($de_tai->bo_mon_id)){
				$boMons = Khcn_Api::_()->getDbTable('bo_mon', 'default')->getBoMonByDonViAssoc($de_tai->ma_don_vi);
				$form->bo_mon_id->setMultiOptions($boMons)->setValue($de_tai->bo_mon_id);
			}
			
			$form->populate($de_tai->toArray());
			return;
		}
		
		$form->preValidation($_POST);
		if (!$form -> isValid($this -> getRequest() -> getPost())) {
			return;
		}		
        		
		$ma = trim($form->getValue('ma'));
		if(!empty($ma)){
			if(!Default_Model_Functions::kiem_tra_ma($ma, null,true,2)){
				$_SESSION['msg'] = 'Lỗi !. Mã đề tài không đúng định dạng, vui lòng kiểm tra lại .';
				$_SESSION['type_msg'] = 'error';
				$this->_redirect('/admin/de-tai');
			}
			if($this->de_tai->kiem_tra_id_ma($de_tai_id, $ma)){
				$_SESSION['msg'] = 'Lỗi !. Mã đề tài đã tồn tại, vui lòng kiểm tra lại .';
				$_SESSION['type_msg'] = 'error';
				$this->_redirect('/admin/de-tai');
			}
		}
		$db = Zend_Registry::get('connectDB');			
		$db->beginTransaction();
		try{	
			if($form->file_tom_tat->getFileName(null,false) != null){
				//determine filename and extension 
				$info = pathinfo($form->file_tom_tat->getFileName(null,false)); 
				$filename = $info['filename']; 
				$ext = $info['extension']?".".$info['extension']:""; 
				//filter for renaming.. prepend with current time 
				$file_tom_tat = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
				$form->file_tom_tat->addFilter(new Zend_Filter_File_Rename(array( 
								"target"=>$file_tom_tat, 
								"overwrite"=>true)));
				$form->getValue('file_tom_tat');
				$de_tai->file_tom_tat = $file_tom_tat;
			}
					
			$values = $form->getValues();
			if(empty($values['file_tom_tat'])){
				unset($values['file_tom_tat']);
			}
			if(empty($values['ngay_gia_han'])){
				$values['ngay_gia_han'] = new Zend_Db_Expr('NULL');
			}
			$values['ma'] = $ma;
			$values['kinh_phi'] = ($values['kinh_phi'] != '') ? str_ireplace(',','',$values['kinh_phi']) : 0;		
			$de_tai -> setFromArray($values);
			$de_tai->save();

			$thanhViens = array();
			$thanhViens[] = array(
				'giang_vien_id' => $values['chu_nhiem'],
				'nhiem_vu' => 1
			);
			for($i = 0 ; $i< $values['code'] ; $i++)
			{	
				$thanhViens[] = array(
					'giang_vien_id' => $values['thanh_vien_' . $i],
					'nhiem_vu' => 0
				);
			}
			$tableDK->setChucVu($de_tai_id, $thanhViens);
			$db->commit();
		}catch (Zend_Db_Exception $e){
			$db->rollBack();
			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'error';
			$this->_redirect('/admin/de-tai');
		}
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/de-tai');
    }
    
	public function capNhatTtAction()
    {
    	$id = $_GET['id'];
    	$status = $_GET['status'];
    	if(!empty($id)){
    		$de_tai = $this->de_tai->getDeTai($id);
    		if($de_tai != null){
	    		$kq = $this->de_tai->CapNhatTT($id,$status);
	    		if($kq)
	    			echo "YES";
	    		else
	    			echo "NO";
    		}else{
    			echo "NO";
    		}
    	}else{
    		echo "NO";
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
    }
    
    public function themHddAction()
    {
    	$session = new Zend_Session_Namespace('them_hdd');
    	$arr = array();
    	foreach($_POST['item'] as $id){			
			$arr[] = $id;				
		}
		$session->dsdt = $arr;
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
    }
}

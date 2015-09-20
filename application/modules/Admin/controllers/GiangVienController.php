<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_GiangVienController extends Khcn_Controller_Action_Admin
{
	protected $giang_vien = null;
	
	public function init ()
    {
        $this->giang_vien = new Default_Model_GiangVien();
    }
    
    //indexAction khong dung phan tragn ajax
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action\
    	$this->view->form = $form = new Admin_Form_FilterGV();
		$params = Default_Model_Functions::filterParams($this->_getAllParams());	
		$_SESSION['filterGV'] = $_SERVER['QUERY_STRING'];
		if( empty($params['order']) ) {
			$params['order'] = 'ho_ten';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'ASC';
		} 		
        $form->populate($params);
        $giangViens = $this->giang_vien->loc($params);
		if($giangViens == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}
        
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($giangViens);
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
    
    //indexAction phan trang dung ajax
//	public function indexAction() 
//    {
//        // TODO Auto-generated {0}::indexAction() default action       
//    	$session = new Zend_Session_Namespace('filterGV');
//    	$session->giangViens = null;
//    	$form = new Admin_Form_FilterGV();
//    	$this->view->form = $form;
//                          
//    	if ($this->getRequest()->isPost()) {
//            $formData = $this->getRequest()->getPost();
//            if ($form->isValid($formData)) {
//            	$ma = $form->getValue('ma');
//                $ho = $form->getValue('ho');
//                $ten = $form->getValue('ten');
//                $ma_don_vi = $form->getValue('ma_don_vi');
//                $giangViens = $this->giang_vien->loc($ma,$ho,$ten,$ma_don_vi);
//                if($giangViens == null){
//                	$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
//					$_SESSION['type_msg'] = 'attention';
//                }
//                $session = new Zend_Session_Namespace('filterGV');
//                $session->giangViens = $giangViens;    
//            }
//        }
//    }
    
    //ham nay dung de phan trang = ajax
    public function danhSachAction(){    	
    	$giangViens = $this->giang_vien->getAll();
    	$session = new Zend_Session_Namespace('filterGV');
        if($session->giangViens != null)
        {
        	$giangViens = $session->giangViens;
        }
        $paginator = Zend_Paginator::factory($giangViens);
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
    
    public function kiemTraMaAction() {  	
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if($this->giang_vien->kiem_tra_ma($ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function kiemTraIdMaAction() {  	
    	$id = $_POST['id'];
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if($this->giang_vien->kiem_tra_id_ma($id,$ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function loadAction() {
      	// If we use Ajax to load response of this action
      	// set no render
      	$this->_helper->getHelper('viewRenderer')->setNoRender();
      	// If you use layout, disable it
      	$this->_helper->layout()->disableLayout();
      
      	// Get the id from request
      	$id = $_POST['id'];
      	if($id != 0){
	      	// Query from database
	      	$data = Khcn_Api::_()->getDbTable('giang_vien','default')->getGiangViensByDonViAssoc($id);

	      	$result = '';
	      	foreach ($data as $k=>$v)
	      	{
	      		$result .= '<option value=' . $k . '>' . $v .'</option>';
	      	}
	      	echo $result;
      	}else{
      		echo '<option value="0">===== Chọn giảng viên =====</option>';
      	}
    }
    
	public function themAction(){
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_GiangVien();
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'giang-vien','action' => 'index'),null,true);
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
		$form->cancel->setLabel('Không lưu')
        			 ->setAttribs(array('onclick' => 'window.location.href="' . $link . '"'));
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{				
				if($form->getValue('ma') != '' && $this->giang_vien->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã giảng viên đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/giang-vien/index');
				}	
				$giang_vien = new Default_Model_GiangVien();
				$ma = trim($form->getValue('ma'));
            	$ma = $ma != '' ? $ma : null;
				$ho_ten = Default_Model_Functions::tach_ho_ten($form->getValue('ho_ten'));
				$giang_vien->setMa($ma)
						   ->setHo($ho_ten['ho'])
		                   ->setTen($ho_ten['ten'])
		                   ->setChucVu($form->getValue('chuc_vu'))
		                   ->setMaDonVi($form->getValue('ma_don_vi'))
		                   ->setMaHocVi($form->getValue('ma_hoc_vi'))
		                   ->setEmail($form->getValue('email'))
		                   ->setSoDienThoai($form->getValue('so_dien_thoai'))
		                   ->setTrangThai(1);
                
				$kq = $giang_vien->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/giang-vien/index');
				}
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/giang-vien/them');					
				}else{
					$this->_redirect('/admin/giang-vien/index');
				}
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
    
    public function themPopupAction(){
    	//$data = $_POST;
    	if($_POST['ma'] != '' && $this->giang_vien->kiem_tra_ma($_POST['ma'])){
			echo "EXIST";
		}else if($_POST['ho_ten'] == ''){
			echo "NO_NAME";
		}else{
			$giang_vien = new Default_Model_GiangVien();
			$ma = trim($_POST['ma']);
	        $ma = $ma != '' ? $ma : null;
			$ho_ten = Default_Model_Functions::tach_ho_ten($_POST['ho_ten']);
			$giang_vien->setMa($ma)
					   ->setHo($ho_ten['ho'])
	                   ->setTen($ho_ten['ten'])
	                   ->setChucVu($_POST['chuc_vu'])
	                   ->setMaDonVi($_POST['ma_don_vi'])
	                   ->setMaHocVi($_POST['ma_hoc_vi'])
	                   ->setTrangThai(1)
	                   ->setEmail($_POST['email'])
	                   ->setSoDienThoai($_POST['so_dien_thoai']);              
			$kq = $giang_vien->them();	
			if(!$kq)
				echo "ERROR";
			echo "YES";
		}
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
    public function xoasAction(){
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			header('Location: '.$_SERVER['HTTP_REFERER']);exit;	
		}
	
		$dang_ky = new Default_Model_DangKy();
		$pc_duyet = new Default_Model_Pcd();
		$pc_nghiem_thu = new Default_Model_Pcnt();
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$giang_vien = $this->giang_vien->getGiangVien($id);			
			if($giang_vien != NULL)
			{			
				if($pc_duyet->KiemTraGV($giang_vien['id']) || $pc_nghiem_thu->KiemTraGV($giang_vien['id']))
				{
					$str .= $giang_vien['ma'] . '-' . $giang_vien['ho'] . ' ' . $giang_vien['ten'] . ', ';
					continue;
				}
				//xoa database
				$kq = $this->giang_vien->xoa($id);
				if(!$kq){
					$str .= $giang_vien['ma'] . '-' . $giang_vien['ho'] . ' ' . $giang_vien['ten'] . ', ';
					continue;
				}
				$nguoi_dung = Khcn_Api::_()->getDbTable('nguoi_dung', 'default')->getByGiangVien($id);
				if($nguoi_dung){
					$nguoi_dung->giang_vien_id = 0;
					$nguoi_dung->save();
				}
			}			
		}
		#lỗi		
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các giảng viên sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			header('Location: '.$_SERVER['HTTP_REFERER']);exit;	
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    }
    
	public function xoaAction() {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$giang_vien = $this->giang_vien->getGiangVien($id);
    		if($giang_vien != null){
    			
				$dang_ky = new Default_Model_DangKy();
				$pc_duyet = new Default_Model_Pcd();
				$pc_nghiem_thu = new Default_Model_Pcnt();
				if($pc_duyet->KiemTraGV($giang_vien['id']) || $pc_nghiem_thu->KiemTraGV($giang_vien['id']))
				{
					$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
				}
				
    			$kq = $this->giang_vien->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    			}
				$nguoi_dung = Khcn_Api::_()->getDbTable('nguoi_dung', 'default')->getByGiangVien($giang_vien['id']);
				if($nguoi_dung){
					$nguoi_dung->giang_vien_id = 0;
					$nguoi_dung->save();
				}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã giảng viên không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    		}
    	}else{
    		header('Location: '.$_SERVER['HTTP_REFERER']);exit;
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_GiangVien();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;   
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	if($form->getValue('ma') != '' && $this->giang_vien->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã giảng viên đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/giang-vien?' . $_SESSION['filterGV']);
				}
            	$giang_vien = new Default_Model_GiangVien();
            	$ho_ten = Default_Model_Functions::tach_ho_ten($form->getValue('ho_ten'));
            	$ma = trim($form->getValue('ma'));
            	$ma = $ma != '' ? $ma : null;
            	$giang_vien->setId($form->getValue('id'))
            			   ->setMa($ma)
						   ->setHo($ho_ten['ho'])
		                   ->setTen($ho_ten['ten'])
		                   ->setChucVu($form->getValue('chuc_vu'))
		                   ->setMaDonVi($form->getValue('ma_don_vi'))
		                   ->setMaHocVi($form->getValue('ma_hoc_vi'))
		                   ->setEmail($form->getValue('email'))
		                   ->setSoDienThoai($form->getValue('so_dien_thoai'));
                $kq = $giang_vien->sua();
                if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/giang-vien?' . $_SESSION['filterGV']);
                }              
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';				
                $this->_redirect('/admin/giang-vien?' . $_SESSION['filterGV']);
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->giang_vien->getGiangVien($id);
	            if($data != null){
	            	$data = $this->giang_vien->GiangVienToArray($data);	  
	            	$data['ho_ten'] = $data['ho'] . ' ' . $data['ten'];          	
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã giảng viên không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/giang-vien?' . $_SESSION['filterGV']);
	            }
        	}else{
            	$this->_redirect('/admin/giang-vien?' . $_SESSION['filterGV']);
            }
        }
    }
    
	public function capNhatTtAction(){
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$giang_vien = $this->giang_vien->getGiangVien($id);
    		if($giang_vien != null){
	    		$kq = $this->giang_vien->cap_nhat($id,array('trang_thai' => 1 - $status));
	    		if(!$kq){
	    			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
	    		}else{
		    		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
					$_SESSION['type_msg'] = 'success';
	    		}
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã giảng viên không tồn tại .';
				$_SESSION['type_msg'] = 'error';
    		}
    	}
    	header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
    }
    
    public function dsNgoaiSguAction()
    {
    	$this->view->form = $form = new Admin_Form_FilterGVNgoaiSGU();    	
		$params = Default_Model_Functions::filterParams($this->_getAllParams());
		$_SESSION['filterGV'] = $_SERVER['QUERY_STRING'];	
        $form->populate($params);
		if( empty($params['order']) ) {
			$params['order'] = 'ho_ten';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'ASC';
		} 		
		$params['ma_don_vi'] = 33;
        $giangViens = $this->giang_vien->loc($params);
		if($giangViens == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}                       

        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($giangViens);
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
        $don_vi = new Default_Model_DonVi();
    	$this->view->donVis = $don_vi->getDSDV();
    }
    
	public function suaGvNgoaiSguAction()
    {
    	$form = new Admin_Form_GiangVien();
    	$don_vi = new Default_Model_DonVi();
    	$form->removeElement('submitCon');
    	$form->removeElement('ma');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->ma_don_vi->setMultiOptions($don_vi->getDSDVNgoaiSGU());
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	$giang_vien = new Default_Model_GiangVien();
            	$ho_ten = Default_Model_Functions::tach_ho_ten($form->getValue('ho_ten'));
            	$giang_vien->setId($form->getValue('id'))
            			   ->setMa(null)
						   ->setHo($ho_ten['ho'])
		                   ->setTen($ho_ten['ten'])
		                   ->setChucVu($form->getValue('chuc_vu'))
		                   ->setMaDonVi($form->getValue('ma_don_vi'))
		                   ->setMaHocVi($form->getValue('ma_hoc_vi'))
		                   ->setEmail($form->getValue('email'))
		                   ->setSoDienThoai($form->getValue('so_dien_thoai'));
                $kq = $giang_vien->sua();
                if(!kq){
                	$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/ds-ngoai-sgu?' . $_SESSION['filterGV']);
                }               
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';				
                $this->_redirect('/admin/ds-ngoai-sgu?' . $_SESSION['filterGV']);
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->giang_vien->getGiangVien($id);
	            if($data != null){
	            	$data = $this->giang_vien->GiangVienToArray($data);	  
	            	$data['ho_ten'] = $data['ho'] . ' ' . $data['ten'];          	
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã giảng viên không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/ds-ngoai-sgu?' . $_SESSION['filterGV']);
	            }
        	}else{
            	$this->_redirect('/admin/ds-ngoai-sgu?' . $_SESSION['filterGV']);
            }
        }
    }
    
    public function capNhatDvAction()
    {
    	$id = $_GET['id'];
    	$ma_don_vi = $_GET['ma_don_vi'];
    	if(!empty($id)){
    		$giang_vien = $this->giang_vien->getGiangVien($id);
    		if($giang_vien != null){
	    		$kq = $this->giang_vien->cap_nhat($id,array('ma_don_vi' => $ma_don_vi));
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
    
}

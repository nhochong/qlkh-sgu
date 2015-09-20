<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_DonViController extends Khcn_Controller_Action_Admin
{
    
	protected $don_vi = null;
	
	public function init ()
    {
        $this->don_vi = new Default_Model_DonVi();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $donVis = $this->don_vi->getAll();
        
        $paginator = Zend_Paginator::factory($donVis);
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
    
    public function kiemTraMaAction()
    {  	
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if($this->don_vi->kiem_tra_ma($ma)){
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
	    	if($this->don_vi->kiem_tra_id_ma($id,$ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_DonVi();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{				
				if($form->getValue('ma') != '' && $this->don_vi->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã đơn vị đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/don-vi/index');
				}	
				$don_vi = new Default_Model_DonVi();
				$ma = $form->getValue('ma') != '' ? $form->getValue('ma') : null;
				$don_vi->setMa($ma);
                $don_vi->setTen($form->getValue('ten'));
                $don_vi->setThuocSGU($form->getValue('thuoc_sgu'));
                if($form->getValue('thuoc_sgu') == 1){
                	$don_vi->setLaKhoa($form->getValue('la_khoa'));
                }else{
                	$don_vi->setLaKhoa(0);
                }
				$kq = $don_vi->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/don-vi/index');
				}
				
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/don-vi/them');					
				}else{
					$this->_redirect('/admin/don-vi/index');
				}
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
    
	public function themPopupAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action				
		if($_POST['ma'] != '' && $this->don_vi->kiem_tra_ma($_POST['ma'])){
			echo "EXIST";
		}else if($_POST['ten'] == ''){
			echo "NO_NAME";
		}else{
			$db = Zend_Registry::get('connectDB');
			$don_vi = new Default_Model_DonVi();
			$ma = $_POST['ma'] != '' ? strtoupper($_POST['ma']) : null;
			$don_vi->setMa($ma);
            $don_vi->setTen($_POST['ten']);
            $don_vi->setThuocSGU($_POST['thuoc_sgu']);
            if($_POST['thuoc_sgu'] == '1'){
               	$don_vi->setLaKhoa($_POST['la_khoa']);
            }else{
                $don_vi->setLaKhoa(0);
            }
			$kq = $don_vi->them();	
			if(!$kq){
				echo "ERROR";
			}else{
				$dv_id = $db->lastInsertId();
				echo "YES," . $dv_id;
			}
		}
		$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/don-vi/index');
		}
	
		$giang_vien	= new Default_Model_GiangVien();
    	$str = '';
		foreach($_POST['item'] as $id){
			$don_vi = $this->don_vi->getDonVi($id);	
			//khong dc xoa don vi SGU va ngoai SGU
			if($id == '1' || $id == '33'){
				$str .= $don_vi['ten'] . ', ';
				continue;
			}				
			if($don_vi != NULL){			
				if($giang_vien->KiemTraDV($don_vi['id'])){
					$str .= $don_vi['ten'] . ', ';
					continue;
				}
				//xoa database
				$kq = $this->don_vi->xoa($id);
				if(!$kq){
					$str .= $don_vi['ten'] . ', ';
				}					
			}		
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các đơn vị sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/don-vi/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/don-vi/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		if($id == '1' || $id == '33'){
    			$_SESSION['msg'] = 'Lỗi !. Đơn vị này không được xóa .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/don-vi/index');
    		}
    		$don_vi = $this->don_vi->getDonVi($id);
    		if($don_vi != null){    			
				$giang_vien	= new Default_Model_GiangVien();
				if($giang_vien->KiemTraDV($don_vi['id']))
				{
					$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/don-vi/index');
				}				
    			$kq = $this->don_vi->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/don-vi/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/don-vi/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã đơn vị không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/don-vi/index');
    		}
    	}else{
    		$this->_redirect('/admin/don-vi/index');
    	}
    }
    
	public function suaAction()
    {
    	$form = new Admin_Form_DonVi();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;  

		$donvi_id = $this->_getParam('id');
		$don_vi = Khcn_Api::_()->getItem('default_don_vi',$donvi_id);
		
		if($don_vi->thuoc_sgu == 0){
			$form->la_khoa->setDecorators(array(
						'ViewHelper',
						'Errors',
						array(array('data' => 'HtmlTag'), array('tag' => 'td')),
						array('Label', array('tag' => 'td')),
						array(array('row' => 'HtmlTag'), array('tag' => 'tr','id' => 'la_khoa','style' => 'display : none'))));
			$form->submit->setDecorators(array(
										'FormElements',
										 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
										 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
										 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn','class' => 'bgwhite')),
									));
		}
					
		$form->populate($don_vi->toArray());
		
		if( !$this->getRequest()->isPost() ) {
            return;
        }
		
        if(!$form->isValid($this->getRequest()->getPost())){
            return;
		}

		$table = Khcn_Api::_()->getItemTable('default_don_vi');
        $db = $table->getAdapter();
        $db->beginTransaction();

        try
        {
			$values = $form->getValues();
			if($this->don_vi->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
				$_SESSION['msg'] = 'Lỗi !. Mã đơn vị đã tồn tại, vui lòng kiểm tra lại .';
				$_SESSION['type_msg'] = 'error';
				return $this->_redirect('/admin/don-vi/index');
			}
			$ma = $values['ma'] != '' ? $values['ma'] : null;
			$don_vi->ma = $ma;
			$don_vi->ten = $values['ten'];
			$don_vi->thuoc_sgu = $values['thuoc_sgu'];
			if($values['thuoc_sgu'] == 1){
				$don_vi->la_khoa = $values['la_khoa'];
			}else{
				$don_vi->la_khoa = 0;
			}
			$don_vi->save();
			
			// Commit
            $db->commit();
			
			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
			$_SESSION['type_msg'] = 'success';
		} catch( Exception $e ){
			$db->rollBack();
			throw $e;
			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'error';
        }
		$this->_redirect('/admin/don-vi/index');
    }
}

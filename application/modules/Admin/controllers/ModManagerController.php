<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_ModManagerController extends Khcn_Controller_Action_Admin
{
	protected $quan_tri = null;
	
	public function init ()
    {
        $this->quan_tri = new Default_Model_QuanTri();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $mods = $this->quan_tri->getDSMod();       
        $paginator = Zend_Paginator::factory($mods);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function kiemTraModAction()
    {  	
    	$ten_dang_nhap = $_POST['ten_dang_nhap'];
    	$quan_tri = new Default_Model_QuanTri();
    	if(!empty($ten_dang_nhap)){
	    	if($quan_tri->kiem_tra_mod($ten_dang_nhap)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    } 
    
    public function kiemTraEmailAction()
    {
    	$email = $_POST['email'];    	
    	if(!empty($email)){
	    	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo "ERROR";
			}else{
	    		$quan_tri = new Default_Model_QuanTri();    	
		    	if($quan_tri->kiem_tra_email($email)){
		    		echo "YES";
		    	}else{
		    		echo "NO";
		    	}   
			}
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function themAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_CreateMod();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{
				$quan_tri = new Default_Model_QuanTri(); 
				if($quan_tri->kiem_tra_mod($form->getValue('ten_dang_nhap'))){
					$_SESSION['msg'] = 'Lỗi. Tên đăng nhập đã được sử dụng.';
					$_SESSION['type_msg'] = 'error';
	                $this->_redirect('/admin/mod-manager/them');
				}	
				if($quan_tri->kiem_tra_email($form->getValue('email'))){
					$_SESSION['msg'] = 'Lỗi. E-mail ' . $form->getValue('email') . ' đã được sử dụng .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/mod-manager/them');
				}  					
                $quan_tri->setTenDangNhap($form->getValue('ten_dang_nhap'));
          		$quan_tri->setMatKhau(md5($form->getValue('mat_khau')));
          		$quan_tri->setHo($form->getValue('ho'));
				$quan_tri->setTen($form->getValue('ten'));
				$quan_tri->setNgaySinh(date('Y-m-d',strtotime($form->getValue('ngay_sinh'))));
				$quan_tri->setEmail($form->getValue('email'));
				$quan_tri->setNgayTao(new Zend_Db_Expr('NOW()'));
				$quan_tri->setTrangThai('1');
				$quan_tri->setMaQuyen('2');
				$kq = $quan_tri->them();
				if(!kq){					
                	$_SESSION['msg'] = 'Lỗi. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->view->form = $form;
                }else{				
					$_SESSION['msg'] = 'Thành công. Tài khoản moderator đã được tạo.';
					$_SESSION['type_msg'] = 'success';
	                $this->_redirect('/admin/mod-manager/index');
                }		
    		}else{
    			$this->view->form = $form;
    		}
    	}
    }
    
    public function xoasAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/mod-manager/index');
		}
	
    	$str = '';
		foreach($_POST['item'] as $id){
			
			$quan_tri = $this->quan_tri->getQuanTri($id);
			if($quan_tri != NULL)
			{
				//xoa database
				$kq = $this->quan_tri->xoa($id);
				if(!$kq){
					$str .= $quan_tri['ten_dang_nhap'] . ', ';
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các moderator sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/mod-manager/index');	
		}
		
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/mod-manager/index');
    }
    
	public function xoaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$quan_tri = $this->quan_tri->getQuanTri($id);
    		if($quan_tri != null){
    			$kq = $this->quan_tri->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/mod-manager/index');
    			}
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/mod-manager/index');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã moderator không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/mod-manager/index');
    		}
    	}else{
    		$this->_redirect('/admin/mod-manager/index');
    	}
    }
    
	public function capNhatTtAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$quan_tri = $this->quan_tri->getQuanTri($id);
    		if($quan_tri != null){
	    		$kq = $this->quan_tri->CapNhatTT($id,$status);
	    		if(!$kq){
	    			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/mod-manager/index');
	    		}
	    		$this->_redirect('/admin/mod-manager/index');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã moderator không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/mod-manager/index');
    		}
    	}else{
    		$this->_redirect('/admin/mod-manager/index');
    	}
    }
}

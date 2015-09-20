<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_AccountInfoController extends Khcn_Controller_Action_Admin
{
	protected $quan_tri = null;
	
	public function init ()
    {
        $this->quan_tri = new Default_Model_QuanTri();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_CreateMod();
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $form->removeElement('ten_dang_nhap');
        $form->removeElement('mat_khau');
        $form->removeElement('mat_khau_2');
        $form->removeElement('submitCon');
        $this->view->form = $form; 
        $auth = Zend_Auth::getInstance();
    	if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {      
            	$quan_tri = new Default_Model_QuanTri(); 
            	if($quan_tri->kiem_tra_email($form->getValue('email'),$form->getValue('id'))){
					$_SESSION['msg'] = 'Lỗi. E-mail ' . $form->getValue('email') . ' đã được sử dụng .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/account-info/index');
				}         	
            	$quan_tri->setId($form->getValue('id'))
		          		   ->setHo($form->getValue('ho'))
						   ->setTen($form->getValue('ten'))
						   ->setNgaySinh(date('Y-m-d',strtotime($form->getValue('ngay_sinh'))))
						   ->setEmail($form->getValue('email'));
                $kq = $quan_tri->sua();
                if(!kq){              	
                	$_SESSION['msg'] = 'Lỗi. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/account-info/index');
                }
                $data = $quan_tri->getQuanTri($form->getValue('id'));
                unset($data->mat_khau);
                $auth->getStorage()->write($data);
                
                $_SESSION['msg'] = 'Thành công. Thông tin tài khoản đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/account-info/index');
            } else {
                $form->populate($formData);
            }
        } else {        	
            $data = array('id' => $auth->getStorage()->read()->id,
            			  'ho' => $auth->getStorage()->read()->ho,
            			  'ten' => $auth->getStorage()->read()->ten,
            			  'ngay_sinh' => date('d-m-Y',strtotime($auth->getStorage()->read()->ngay_sinh)),
            			  'email' => $auth->getStorage()->read()->email
            );	            	
            $form->populate($data);//dua du lieu len form dua vao bien array
        }
    }
    
    public function changePassAction()
    {		
    	$form = new Admin_Form_ChangePass();
        $form->submit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;    
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$auth = Zend_Auth::getInstance();
            	$quan_tri = new Default_Model_QuanTri();
	    		$id = $auth->getStorage()->read()->id;
	    		$quanTri = $quan_tri->getQuanTri($id);
	    		if($quanTri['mat_khau'] != md5($form->getValue('mat_khau'))){
	    			$_SESSION['msg'] = 'Lỗi. Mật khẩu cũ không đúng, vui lòng kiểm tra lại.';
					$_SESSION['type_msg'] = 'error';
	    			$this->view->form = $form; 
	    		}else{	    			
		    		$mat_khau = $form->getValue('mat_khau1');
		    		$quan_tri->change_pass($id, md5($mat_khau));
		    		$_SESSION['msg'] = 'Thành công. Dữ liệu đã được cập nhật .';
					$_SESSION['type_msg'] = 'success';
	                $this->_redirect('/admin/index/index');
	    		}
	    	}
    	}
    }
}

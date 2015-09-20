<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Default_NguoiDungController extends Khcn_Controller_Action_User
{    
	public function init()
	{
		
	}
	
    public function indexAction ()
    {     
    	
    }   

    public function suaAction()
    {
		// Set up require's
		$this->_helper->requireUser();	
		$this->view->user = $user = Khcn_Api::_()->getViewer();
    	$form = new Default_Form_Register();
        $form->submit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
		$form->removeElement('account');
        $form->removeElement('ten_dang_nhap');
        $form->removeElement('mat_khau');
        $form->removeElement('mat_khau_2');
        $form->removeElement('captcha');
		$form->removeElement('email');
        $this->view->form = $form;  
		$form->setAttrib('class', 'global_form form_user_signup form_user_edit');
		$form->populate($user->toArray());
			
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		if(!empty($values['ngay_sinh']) && $values['ngay_sinh'] != '0000-00-00'){
			$values['ngay_sinh'] = date('Y-m-d',strtotime($values['ngay_sinh']));
		}else{
			$values['ngay_sinh'] = null;
		}
		$user -> setFromArray($values);
		$user->setTenHienThi(array('ho' => $values['ho'], 'ten' => $values['ten']));
		$user->save();
			
		return $this->_forward('thong-bao', 'index', 'default', array(
			'messages' => array(Zend_Registry::get('Zend_Translate') -> _('Thành công. Thông tin tài khoản đã được cập nhật.')),
		));
    }
    
    public function changePassAction()
    {
		// Set up require's
		$this->_helper->requireUser();
		
		$viewer = Khcn_Api::_()->getViewer();
		// Can specifiy custom id
		$id = $this->_getParam('id', null);
		if( null === $id ) {
			$user = $viewer;
		} else {
			$user = Khcn_Api::_()->getItem('default_nguoi_dung', $id);
		}
		
    	$form = new Default_Form_ChangePass();
        $form->submit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;    
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->checkIsValid($this->getRequest()->getPost(), $user)){
			return;
		}
		
		$values = $form->getValues();  			
		$mat_khau = $values['mat_khau1'];
		$user->mat_khau = md5($mat_khau);
		$user->save();
		return $this->_forward('thong-bao', 'index', 'default', array(
			'messages' => array(Zend_Registry::get('Zend_Translate') -> _('Thành công. Dữ liệu đã được cập nhật.')),
		));
    }
}

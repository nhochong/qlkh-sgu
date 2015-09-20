<?php
class Default_Form_ChangePass extends Khcn_Form
{
	public function init()
	{
		 $this->setMethod('post')
        	  ->setAttribs(array('class' => 'global_form form_change_pass'));
        
        $password = new Khcn_Form_Element_Password('mat_khau');
        $password->setLabel('Mật khẩu cũ')
        	   ->setOptions(array('size' => '25'))  
               ->setRequired(true)             
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');  
		$this->addElement($password);
		
		$password1 = new Khcn_Form_Element_Password('mat_khau1');
        $password1->setLabel('Mật khẩu mới')
        	   ->setOptions(array('size' => '25'))  
               ->setRequired(true)              
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');  
		$this->addElement($password1);
		
        $repassword = new Khcn_Form_Element_Password('mat_khau2');
        $repassword->setLabel('Nhập lại mật khẩu')
        	   ->setOptions(array('size' => '25'))  
               ->setRequired(true)             
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator(new Zend_Validate_Identical('mat_khau1'));    
		$this->addElement($repassword);
		
		$this->addElement('Button', 'submit', array(
		  'label' => 'Lưu',
		  'type' => 'submit',
		  'ignore' => true,
		  'decorators' => array('ViewHelper',),
		  'attribs' => array('class' => 'art-button')
		));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'default','controller' => 'index','action' => 'index'));		
		$this->addElement('Cancel', 'cancel', array(
		  'label' => 'Không lưu',
		  'onclick' => 'window.location.href="' . $link . '"',
		  'decorators' => array(
			'ViewHelper',
		  ),
		  'attribs' => array('class' => 'art-button')
		));
        
		$this->addDisplayGroup(array('mat_khau','mat_khau1','mat_khau2'),'change_pass');
        
        $this->addDisplayGroup(array('submit','cancel'),'submitbtn'); 
	}
	
	public function checkIsValid($values, $user){
		$valid = parent::isValid($values);
		if($valid) {
			if($user->mat_khau != md5($values['mat_khau'])){
				$this->addError("Lỗi. Mật khẩu cũ không đúng, vui lòng kiểm tra lại.");
				return false;
			}
		}
		return $valid;
	}
}
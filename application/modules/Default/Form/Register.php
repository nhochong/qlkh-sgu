<?php
class Default_Form_Register extends Khcn_Form
{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post')
			 ->setAttrib('class', 'global_form form_user_signup');
        	 
        $id = new Khcn_Form_Element_Hidden('id');
        $id->addFilter('Int')         
           ->removeDecorator('label');
		   
		$this->addElement('Heading', 'account', array(
			'value' => 'Thông tin tài khoản',
		));
		$this->account->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
		  
        $username = new Khcn_Form_Element_Text('ten_dang_nhap');       
        $username->setLabel('Tên đăng nhập (*)')
               	 ->setRequired(true)
               	 ->addFilter('StripTags')
               	 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('NotEmpty')
				 ->addValidator('Alnum')
                 ->addValidator(new Zend_Validate_StringLength(0, 32))
				 ->setAttribs(array('id' => 'ten_dang_nhap'));
		$this->addElement($username);
		
		$this->ten_dang_nhap->addValidator('Db_NoRecordExists', true, array('nguoi_dung', 'ten_dang_nhap'));
		$this->ten_dang_nhap->getValidator('Db_NoRecordExists')->setMessage('Tên đăng nhập đã được sử dụng.', 'recordFound');	
		
        $password = new Khcn_Form_Element_Password('mat_khau');
        $password->setLabel('Mật khẩu (*)')
               ->setRequired(true)              
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
			   ->setAttribs(array('id' => 'mat_khau'));  
		$this->addElement($password);
		
        $repassword = new Khcn_Form_Element_Password('mat_khau_2');
        $repassword->setLabel('Nhập lại mật khẩu (*)')
               	   ->setRequired(true)             
               	   ->addFilter('StripTags')
               	   ->addFilter('StringTrim')
               	   ->addValidator(new Zend_Validate_Identical('mat_khau'))
			   	   ->setAttribs(array('id' => 'mat_khau_2'));           
        $this->addElement($repassword);
		
		$this->addElement('Heading', 'contact', array(
			'value' => 'Thông tin người dùng',
		));
		$this->contact->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
			
		$ho = new Khcn_Form_Element_Text('ho');
        $ho->setLabel('Họ (*)')
           ->setOptions(array('size' => '36'))  
           ->setRequired(true)             
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addValidator('NotEmpty')
           ->addValidator(new Zend_Validate_StringLength(0, 128))
		   ->setAttribs(array('id' => 'ho'));             
        $this->addElement($ho);
		
		$ten = new Khcn_Form_Element_Text('ten');
        $ten->setLabel('Tên (*)')
        	->setOptions(array('size' => '36'))  
            ->setRequired(true)              
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(0, 32))
			->setAttribs(array('id' => 'ten'));               
        $this->addElement($ten);
		
		$ngay_sinh = new Khcn_Form_Element_Text('ngay_sinh');
        $ngay_sinh->setLabel('Ngày sinh')   
		       	  ->setAttribs(array('id' => 'ngay_sinh'));
		$this->addElement($ngay_sinh);
		
        $email = new Khcn_Form_Element_Text('email');
        $email->setLabel('Email (*)')
              ->setRequired(true)
              ->setOptions(array('size' => '36'))              
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator(new Zend_Validate_EmailAddress())
			  ->setAttribs(array('id' => 'email'));  
		$this->addElement($email);
		
		$this->email->addValidator('Db_NoRecordExists', true, array('nguoi_dung', 'email'));
		$this->email->getValidator('Db_NoRecordExists')->setMessage('Email đã được sử dụng.', 'recordFound');		
		
        $captcha = $this->createElement('captcha', 'captcha',
						array(  'required' => true,
								'captcha' => array('captcha' => 'Image',
								'font' => APPLICATION_PATH . '/templates/default/fonts/arialn.ttf',
								'fontSize' => '24',
								'wordLen' => 6,
								'height' => '50',
								'width' => '150',
								'imgDir' => APPLICATION_PATH.'/../public/captcha',
								'imgUrl' => Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/captcha',
								'dotNoiseLevel' => 50,
								'lineNoiseLevel' => 5)));		
		$captcha->setLabel('Nhập mã bảo vệ (*)');	
		$this->addElement($captcha);
        
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
		
		$this->addDisplayGroup(array('submit','cancel'),'submitbtn'); 
    }
}

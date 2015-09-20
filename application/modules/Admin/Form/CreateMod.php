<?php
class Admin_Form_CreateMod extends Zend_Form
{
public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post')
        	 ->setAttribs(array('id' => 'user'));
        	 
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int')         
           ->removeDecorator('label');

        $username = new Zend_Form_Element_Text('ten_dang_nhap');       
        $username->setLabel('Tên đăng nhập (*)') 
               	 ->setRequired(true)
               	 ->addFilter('StripTags')
               	 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('NotEmpty')
                 ->addValidator(new Zend_Validate_StringLength(0, 32))
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 83%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 ->setAttribs(array('id' => 'ten_dang_nhap','class' => 'text-input'));
                 
        $password = new Zend_Form_Element_Password('mat_khau');
        $password->setLabel('Mật khẩu (*)')
               ->setRequired(true)              
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttribs(array('id' => 'mat_khau','class' => 'text-input'));  
							              
        $repassword = new Zend_Form_Element_Password('mat_khau_2');
        $repassword->setLabel('Nhập lại mật khẩu (*)')
               	   ->setRequired(true)             
               	   ->addFilter('StripTags')
               	   ->addFilter('StringTrim')
               	   ->addValidator(new Zend_Validate_Identical('mat_khau'))
               	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   	   ->setAttribs(array('id' => 'mat_khau_2','class' => 'text-input'));           
        
		$ho = new Zend_Form_Element_Text('ho');
        $ho->setLabel('Họ (*)') 
           ->setRequired(true)             
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addValidator('NotEmpty')
           ->addValidator(new Zend_Validate_StringLength(0, 100))
           ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 83%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
		   ->setAttribs(array('id' => 'ho','class' => 'text-input'));             
        
		$ten = new Zend_Form_Element_Text('ten');
        $ten->setLabel('Tên (*)') 
            ->setRequired(true)              
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(0, 20))
            ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'ten','class' => 'text-input'));               
        
		$ngay_sinh = new Zend_Form_Element_Text('ngay_sinh');
        $ngay_sinh->setLabel('Ngày sinh (*)')    
        		  ->setDescription('(dd-mm-YYYY)')   	   
               	  ->setRequired(true)             
               	  ->addFilter('StripTags')
               	  ->addFilter('StringTrim')
               	  ->addValidator('NotEmpty')
               	  ->setDecorators(array('ViewHelper',
								    'Errors',
               	  					array('Description', array('tag' => 'span')),
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
		       	  ->setAttribs(array('id' => 'ngay_sinh','class' => 'text-input'));
							                     
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email (*)')
              ->setRequired(true)           
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator(new Zend_Validate_EmailAddress())
              ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			  ->setAttribs(array('id' => 'email','class' => 'text-input'));  			  	         
		
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
			   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button'));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'index','action' => 'index'));
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   ->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			
		$this->addElements(array($id,$username,$password,$repassword,$ho,$ten,$ngay_sinh,$email,$submitCon,$submitExit,$cancel));						
        
		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submitbtn',array(
            'decorators' => array(
                 'FormElements',
				 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn')),
            ),
        )); 
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table')),
					'Form',
					));
    }
}

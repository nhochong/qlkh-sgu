<?php
class Admin_Form_ChangePass extends Zend_Form
{
	public function init()
	{
		 $this->setName('ChangePass')
        	  ->setMethod('post')
        	  ->setAttribs(array('id' => 'user'));
        	 
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int')
           ->removeDecorator('label');
        
        $password = new Zend_Form_Element_Password('mat_khau');
        $password->setLabel('Mật khẩu cũ (*)')
        	   ->setOptions(array('size' => '25'))  
               ->setRequired(true)             
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 83%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input');  
							    
		$password1 = new Zend_Form_Element_Password('mat_khau1');
        $password1->setLabel('Mật khẩu mới (*)')
        	   ->setOptions(array('size' => '25'))  
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
			   ->setAttrib('class', 'text-input');    
							              
        $repassword = new Zend_Form_Element_Password('mat_khau2');
        $repassword->setLabel('Nhập lại mật khẩu (*)')
        	   ->setOptions(array('size' => '25'))  
               ->setRequired(true)             
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator(new Zend_Validate_Identical('mat_khau1'))
               ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input');  
							       							    
		$submit = new Zend_Form_Element_Submit('submit');		
        $submit->setLabel('Lưu')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'l')),
							    ))
			   ->setAttribs(array('class' => 'button')); 
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'index','action' => 'index'));
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'l')),
							    ))
			  ->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($id,$password,$password1,$repassword,$submit,$cancel));
        
        $this->addDisplayGroup(array('submit','cancel'),'submitbtn',array(
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
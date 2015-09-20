<?php
class Default_Form_LoginDefault extends Zend_Form{
	public function init()
    {  	
        $this->setMethod('post')
        	 ->setAttribs(array('id' => 'user'));

		 // Set default action
		$this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array('controller' => 'index', 'action' => 'login'), null, true));
	
        $Username = new Zend_Form_Element_Text('Username');       
        $Username->setLabel('Tên đăng nhập')
        		 ->setOptions(array('size' => '32')) 
               	 ->setRequired(true)
               	 ->addFilter('StripTags')
               	 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('NotEmpty')
                 ->addValidator(new Zend_Validate_StringLength(0, 32))
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    'Label',
							    array(array('row' => 'HtmlTag'), array('tag' => 'div'))));
                 
        $Password = new Zend_Form_Element_Password('Password');
        $Password->setLabel('Mật khẩu')
               ->setRequired(true)            
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    'Label',
							    array(array('row' => 'HtmlTag'), array('tag' => 'div'))));            
        
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Đăng nhập');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
				->setAttribs(array('class' => 'art-button'));        
		$this->addElements(array($Username,$Password,$submit));						
		
		 $this->addElement('Hidden', 'return_url', array(
      
		));
	
		$this->addDisplayGroup(array('Username','Password'),'user_login',array(
			'Legend' => 'Đăng nhập',
            'decorators' => array(
                'FormElements',
			  	array('fieldset', array('class' => 'user_login')),
				array(array('row' => 'HtmlTag'), array('tag' => 'div')),
            ),
        ));
        
		$this->addDisplayGroup(array('submit'),'submitbtn',array(
            'decorators' => array(
                'FormElements',
				 array(array('row' => 'HtmlTag'), array('tag' => 'div','align' => 'center')),
            ),
        )); 
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'div')),
					'Form',
					));
    }
}
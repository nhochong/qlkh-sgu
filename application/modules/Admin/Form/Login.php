<?php
class Admin_Form_Login extends Zend_Form{
	public function init()
    {  	
        $this->setName('login')
        	 ->setMethod('post');

        $Username = new Zend_Form_Element_Text('Username');       
        $Username->setLabel('Username')
        		 ->setOptions(array('size' => '36')) 
               	 ->setRequired(true)
               	 ->addFilter('StripTags')
               	 ->addFilter('StringTrim')
                 ->addFilter('StringToLower')
                 ->addValidator('NotEmpty')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'SubHead')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input');
                 
        $Password = new Zend_Form_Element_Password('Password');
        $Password->setLabel('Password')
               ->setRequired(true)            
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'SubHead')),
							    array('Label', array('tag' => 'td','class' => 'pwd')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input');            
        
		$Remember = new Zend_Form_Element_Checkbox('Remember');
		$Remember->setLabel('Remember')
				 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span','placement' => 'append'))))
				 ->setValue(1)
				 ->setAttrib('class', 'chkRemember');	   
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Log in');
        $submit->setDecorators(array(
							        'ViewHelper',
							       array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan'=>'2','align'=>'right')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
							    ))
			   ->setAttribs(array('class' => 'button btnsubmit'));        
		$this->addElements(array($Username,$Password,$Remember));						

		$this->addDisplayGroup(array('Remember'),'remember',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'class' => 'remember'))
            ),
        ));
        
        $this->addElement($submit);
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'tblLogin')),
					'Form',
					));
    }
}
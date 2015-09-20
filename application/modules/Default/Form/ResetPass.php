<?php
class Default_Form_ResetPass extends Zend_Form
{
public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post')
        	 ->setAttribs(array('id' => 'user'));

        $username = new Zend_Form_Element_Text('ten_dang_nhap');       
        $username->setLabel('Tên đăng nhập (*)')
        		 ->setOptions(array('size' => '36')) 
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
							    array(array('row' => 'HtmlTag'), array('tag' => 'div'))))
				 ->setAttribs(array('id' => 'ten_dang_nhap'));
				 	  	         
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
								'lineNoiseLevel' => 5,
								'decorators' => array('ViewHelper',
												      'Errors',
												      'Label',
													  array(array('data' => 'HtmlTag'), array('tag' => 'span')),
												      array(array('row' => 'HtmlTag'), array('tag' => 'div'))))));		
		$captcha->setLabel('Nhập mã bảo vệ (*)');	
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setDecorators(array(
							        'ViewHelper',							        
        							array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
				->setAttribs(array('class' => 'art-button')); 

		$this->addElements(array($username,$captcha,$submit));						

		$this->addDisplayGroup(array('ten_dang_nhap','captcha'),'reset_pass',array(
			'Legend' => 'Thông tin tài khoản',
            'decorators' => array(
                'FormElements',
			  	array('fieldset', array('class' => 'contact')),
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

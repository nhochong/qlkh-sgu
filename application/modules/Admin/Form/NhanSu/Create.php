<?php
class Admin_Form_NhanSu_Create extends Zend_Form{

	public function init()
    {  	
        $this->setName('f2')
			 ->setAttrib('class', 'form_create_nhan_su');
        
        $ho_ten = new Zend_Form_Element_Text('ho_ten');       
        $ho_ten->setLabel('Họ tên (*)')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input medium-input');
			   
		$chuc_vu = new Zend_Form_Element_Text('chuc_vu');       
        $chuc_vu->setLabel('Chức vụ')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input medium-input');	
			   
		$email = new Zend_Form_Element_Text('email');       
        $email->setLabel('Email')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input medium-input');

		$website = new Zend_Form_Element_Text('website');       
        $website->setLabel('Website')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input medium-input');

		$so_dien_thoai = new Zend_Form_Element_Text('so_dien_thoai');       
        $so_dien_thoai->setLabel('Số điện thoại')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input medium-input');			   
		
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Ảnh cá nhân')
			 		  ->setDescription('(*.jgp, *.gif, *.png , < 10MB )')
			 		  ->setDestination(BASE_PATH . '/upload/files/nhan_su/')
			 		  ->addValidator(new Zend_Validate_File_Extension(array('jpg,gif,png')))
			 		  ->addValidator(new Zend_Validate_File_FilesSize(array('min' => 1, 
		            													    'max' => 10485760,
		            													    'bytestring' => true)))
			 		  ->setDecorators(array(
									    'File',
									    'Errors',	
					 					array('Description', array('escape' => false, 'tag' => 'div', 'placement' => 'append')),		 					
									    array('HtmlTag', array('tag' => 'td')),
									    array('Label', array('tag' => 'td')),
									    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));	
		
		$maxOrder = Khcn_Api::_()->getDbTable('nhan_su', 'default')->getMaxOrder();
		$order = new Zend_Form_Element_Text('order');       
        $order->setLabel('Số thứ tự')
			   ->setValue($maxOrder)
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input tinysmall-input');	
			   
		$submit = new Zend_Form_Element_Submit('submit');		
        $submit->setLabel('Lưu')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 

	    $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'gioi-thieu','action' => 'nhan-su'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($ho_ten, $chuc_vu, $email, $website, $so_dien_thoai, $file, $order, $submit, $cancel));						

		$this->addDisplayGroup(array('submit','cancel'),'submitbtn',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table')),
					'Form',
					));
    }
}
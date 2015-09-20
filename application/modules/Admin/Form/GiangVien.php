<?php
class Admin_Form_GiangVien extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');

       	$id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $ma = new Zend_Form_Element_Text('ma');       
        $ma->setLabel('Mã')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator(new Zend_Validate_StringLength(0, 10))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input'));

		$ho_ten = new Zend_Form_Element_Text('ho_ten');       
        $ho_ten->setLabel('Họ tên (*)')
            	->setRequired(true)
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
            	->addValidator('NotEmpty')
            	->addValidator(new Zend_Validate_StringLength(0, 120))
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input medium-input');
			
		$chuc_vu = new Zend_Form_Element_Text('chuc_vu');       
        $chuc_vu->setLabel('Chức vụ')
            	->addFilter('StripTags')
	            ->addFilter('StringTrim')
	        	->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input medium-input');

		$don_vi = new Default_Model_DonVi();
		$dvOptions = array("multiOptions" => $don_vi->getDSDV());	
		$ma_don_vi = new Zend_Form_Element_Select('ma_don_vi',$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setLabel('Đơn vị (*)')
				  ->setValue(Default_Model_Constraints::ID_DHSG)
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
							    
		$hoc_vi = new Default_Model_HocVi();
		$hvOptions = array("multiOptions" => $hoc_vi->getDSHV());	
		$ma_hoc_vi = new Zend_Form_Element_Select('ma_hoc_vi',$hvOptions);
		$ma_hoc_vi->setRequired(true)
				  ->setLabel('Học vị (*)')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
				
		$email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')           
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator(new Zend_Validate_EmailAddress())
              ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			  ->setAttribs(array('class' => 'text-input', 'id' => 'email'));  
			  
		
		$so_dien_thoai = new Zend_Form_Element_Text('so_dien_thoai');       
        $so_dien_thoai->setLabel('Số điện thoại')
            	 	->addFilter('StringTrim')
            	 	->addValidator(new Zend_Validate_Int())
        		 	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('class' => 'text-input','onkeypress' => 'return inputNumber(event)'));
				  
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

		$link = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('module' => 'admin','controller' => 'giang-vien','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($id,$ma,$ho_ten,$ma_don_vi,$ma_hoc_vi,$chuc_vu,$email,$so_dien_thoai,$submitCon,$submitExit,$cancel));						

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'giang_vien')),
					'Form',
					));
    }
}
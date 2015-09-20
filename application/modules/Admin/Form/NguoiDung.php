<?php
class Admin_Form_NguoiDung extends Khcn_Form{
	public function init()
    {  			
        $ten_dang_nhap = new Khcn_Form_Element_Heading('ten_dang_nhap');       
        $ten_dang_nhap->setLabel('Tên đăng nhập')
					  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('class' => 'text-input', 'disabled' => 'disabled'));
		$this->addElement($ten_dang_nhap);
		
		$email = new Khcn_Form_Element_Heading('email');       
        $email->setLabel('Email')
				->setDecorators(array(
						'ViewHelper',
						'Errors',
						array(array('data' => 'HtmlTag'), array('tag' => 'td')),
						array('Label', array('tag' => 'td')),
						array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('class' => 'text-input', 'disabled' => 'disabled'));
		$this->addElement($email);
		
		$ho = new Khcn_Form_Element_Text('ho');       
        $ho->setLabel('Họ (*)')
            	->setRequired(true)
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
            	->addValidator('NotEmpty')
				->addValidator(new Zend_Validate_StringLength(0, 128))
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input');
		$this->addElement($ho);
		
		$ten = new Khcn_Form_Element_Text('ten');       
        $ten->setLabel('Tên (*)')
            	->setRequired(true)
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
            	->addValidator('NotEmpty')
				->addValidator(new Zend_Validate_StringLength(0, 32))
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input');
		$this->addElement($ten);
		
		$ngay_sinh = new Khcn_Form_Element_Text('ngay_sinh');       
        $ngay_sinh->setLabel('Ngày sinh')
        				  ->setDescription('(dd-mm-YYYY)')
               	 	 	  ->setRequired(true)
               	 	 	  ->addFilter('StripTags')
                 	 	  ->addValidator('NotEmpty')
        		 	 	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	 	  		array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	 	  ->setAttribs(array('class' => 'text-input','id' => 'ngay_sinh'));
		$this->addElement($ngay_sinh);
		
		$this->addElement('Checkbox', 'is_giang_vien', array(
			'label' => 'Giảng viên?',
			'value' => 0,
			'decorators' => array(
				'ViewHelper',
				'Errors',
				array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
			),
		));
		
		$don_vi = new Default_Model_DonVi();
		$this->addElement('Select', 'don_vi_id', array(
			'label' => 'Đơn vị (*)',
			'multiOptions' => $don_vi->getDSDVSGU(),
			'value' => 1,
			'decorators' => array(
				'ViewHelper',
				'Errors',
				array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'don_vi_id-wrapper'))
			),
		));
		
		$giangViens = Khcn_Api::_()->getDbTable('giang_vien','default')->getGiangViensByDonViAssoc(Default_Model_Constraints::ID_DHSG);
		$this->addElement('Select', 'giang_vien_id', array(
			'label' => 'Giảng viên (*)',
			'multiOptions' => $giangViens,
			'decorators' => array(
				'ViewHelper',
				'Errors',
				array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'giang_vien_id-wrapper'))
			),
		));
		$this->giang_vien_id->setRegisterInArrayValidator(false);				
		
		$submit = new Khcn_Form_Element_Submit('submit');	
		$submit->setLabel('Lưu');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 
		$this->addElement($submit);
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'nguoi-dung','action' => 'index'),null,true);
		$cancel = new Khcn_Form_Element_Button('cancel');
		$cancel->setLabel('Không Lưu');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
		$this->addElement($cancel);	   
		
		$this->addDisplayGroup(array('submit','cancel'),'submit_btn',array(
			'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'submit_btn')),
            ),
        ));
		
        $this->setDecorators(array(
					'FormElements',
        			'Fieldset',
					array('HtmlTag', array('tag' => 'table','class' => 'form_edit_nguoi_dung')),
					'Form',
					));
    }
}
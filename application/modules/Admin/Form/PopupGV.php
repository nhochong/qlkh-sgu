<?php
class Admin_Form_PopupGV extends Zend_Form{
	public function init()
    {  	
        $this->setName('popup_gv')
        	 ->setMethod('post');
        	 
        $ma_gv = new Zend_Form_Element_Text('popup_gv_ma');       
        $ma_gv->setLabel('Mã')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator(new Zend_Validate_StringLength(0, 10))
        	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 80%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			  ->setAttribs(array('class' => 'text-input','onblur' => 'kiem_tra_gv(this)'));

		$ho_ten = new Zend_Form_Element_Text('popup_gv_ho_ten');       
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
			
		$chuc_vu = new Zend_Form_Element_Text('popup_gv_chuc_vu');       
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
		$ma_don_vi = new Zend_Form_Element_Select('popup_gv_ma_don_vi',$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setLabel('Đơn vị (*)')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
							    
		$hoc_vi = new Default_Model_HocVi();
		$hvOptions = array("multiOptions" => $hoc_vi->getDSHV());	
		$ma_hoc_vi = new Zend_Form_Element_Select('popup_gv_ma_hoc_vi',$hvOptions);
		$ma_hoc_vi->setRequired(true)
				  ->setLabel('Học vị (*)')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
							    
		$email = new Zend_Form_Element_Text('popup_gv_email');
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
			  
		
		$so_dien_thoai = new Zend_Form_Element_Text('popup_gv_so_dien_thoai');       
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
				  
		$submit = new Zend_Form_Element_Button('popup_gv_submit');
        $submit->setLabel('Lưu')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   ->setAttribs(array('class' => 'button','onclick' => 'add_gv(this.form)'));
			   
		$this->addElements(array($ma_gv,$ho_ten,$ma_don_vi,$ma_hoc_vi,$chuc_vu,$email,$so_dien_thoai,$submit));						

		$this->addDisplayGroup(array('popup_gv_submit'),'btn_submit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'popup_gv')),
					'Form',
					));
    }
}
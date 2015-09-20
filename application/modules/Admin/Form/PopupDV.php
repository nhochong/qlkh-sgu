<?php
class Admin_Form_PopupDV extends Zend_Form{
	public function init()
    {  	
        $this->setName('popup_dv')
        	 ->setMethod('post');
        	 
        $ma = new Zend_Form_Element_Text('popup_dv_ma');       
        $ma->setLabel('Mã')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addFilter('StringToUpper')
            ->addValidator(new Zend_Validate_StringLength(0, 10))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 80%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input','onblur' => 'kiem_tra_dv(this)'));
			
        $ten = new Zend_Form_Element_Text('popup_dv_ten');       
        $ten->setLabel('Tên (*)')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(0, 250))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttrib('class', 'text-input medium-input');

		$ofSGUOptions = array(
        "multiOptions" => array('1' => 'Thuộc',
								'0' => 'Không thuộc'
		));	
		$thuoc_sgu = new Zend_Form_Element_Radio('popup_dv_thuoc_sgu',$ofSGUOptions);
		$thuoc_sgu->setRequired(true)
				  ->setLabel('Thuộc SGU')
				  ->setValue('1')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','class' => 'thuoc_sgu')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('id' => 'popup_dv_thuoc_sgu','onchange' => 'change_thuoc_sgu(this)'));	   
		
		$deptOptions = array(
        "multiOptions" => array('1' => 'Khoa - Bộ môn TT',
								'0' => 'Phòng ban - Trung tâm'
		));	
		$la_khoa = new Zend_Form_Element_Radio('popup_dv_la_khoa',$deptOptions);
		$la_khoa->setRequired(true)
				->setLabel('Loại đơn vị')
				->setValue('1')
				->setSeparator('')
				->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','class' => 'la_khoa')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr','id' => 'la_khoa'))));
				  
		$submit = new Zend_Form_Element_Button('popup_dv_submit');
        $submit->setLabel('Lưu')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   ->setAttribs(array('class' => 'button','onclick' => 'add_dv(this.form)'));
			   
		$this->addElements(array($ma,$ten,$thuoc_sgu,$la_khoa,$submit));						

		$this->addDisplayGroup(array('popup_dv_submit'),'btn_submit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'popup_dv')),
					'Form',
					));
    }
}
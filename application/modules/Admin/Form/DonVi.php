<?php
class Admin_Form_DonVi extends Zend_Form{
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
            ->addFilter('StringToUpper')
            ->addValidator(new Zend_Validate_StringLength(0, 10))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input'));
			
        $ten = new Zend_Form_Element_Text('ten');       
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
		$thuoc_sgu = new Zend_Form_Element_Radio('thuoc_sgu',$ofSGUOptions);
		$thuoc_sgu->setRequired(true)
				  ->setLabel('Thuộc SGU')
				  ->setValue('1')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'class' => 'radio_inline'))))
				  ->setAttribs(array('id' => 'thuoc_sgu'));	   
		
		$deptOptions = array(
        "multiOptions" => array('1' => 'Khoa - Bộ môn TT',
								'0' => 'Phòng ban - Trung tâm'
		));	
		$la_khoa = new Zend_Form_Element_Radio('la_khoa',$deptOptions);
		$la_khoa->setRequired(true)
				->setLabel('Loại đơn vị')
				->setValue('1')
				->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr','id' => 'la_khoa', 'class' => 'radio_inline'))));
				  
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
		$link = $url->url(array('module' => 'admin','controller' => 'don-vi','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($id,$ma,$ten,$thuoc_sgu,$la_khoa,$submitCon,$submitExit,$cancel));						

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
					array('HtmlTag', array('tag' => 'table','class' => 'don_vi')),
					'Form',
					));
    }
}
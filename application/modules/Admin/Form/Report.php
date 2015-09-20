<?php
class Admin_Form_Report extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('post');

		$mauOptions = array("multiOptions" => Default_Model_Constraints::report());
		$mau = new Zend_Form_Element_Select('mau',$mauOptions);
		$mau->setRequired(true)
			->setLabel('Mẫu báo cáo (*)')
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width : 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'mau'));
		
		$namOptions = array("multiOptions" => Default_Model_Constraints::nam());	
		$nam = new Zend_Form_Element_Select('nam',$namOptions);
		$nam->setRequired(true)
			->setLabel('Năm (*)')
			->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'nam'));

		$quyet_dinh = new Zend_Form_Element_Text('quyet_dinh');       
        $quyet_dinh->setLabel('Quyết định')
            	   ->addFilter('StripTags')
            	   ->addFilter('StringTrim')
        		   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				   ->setAttrib('class', 'text-input medium-input');

		$loai_lv = new Default_Model_LoaiLinhVuc();
		$llvOptions =  array("multiOptions" => $loai_lv->getMultiOptions());	
		$ma_loai = new Zend_Form_Element_Select('ma_loai',$llvOptions);
		$ma_loai->setLabel('Loại')
				->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr','id' => 'ma_loai-wrapper'))));
					
		$options = array(
        "multiOptions" => array('1' => 'Có',
								'0' => 'Không'
		));	
		$thong_bao = new Zend_Form_Element_Radio('thong_bao',$options);
		$thong_bao->setRequired(true)
				->setLabel('Tạo thông báo mới')
				->setValue('0')
				->setSeparator('')
				->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','class' => 'thong_bao')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr','id' => 'thong_bao-wrapper'))))
				->setAttribs(array('id' => 'thong_bao'));;
							    
		$fileTypeOptions = array(
			"multiOptions" => array(
				'excel' => 'Excel',
				'pdf' => 'Pdf'
		));	
		$file_type = new Zend_Form_Element_Select('file_type',$fileTypeOptions);
		$file_type->setRequired(true)
				->setLabel('Xuất Thành File')
				->setSeparator('')
				->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','class' => 'file_type')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr','id' => 'file_type-wrapper'))))
				->setAttribs(array('id' => 'file_type'));
				
				
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Xuất')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button','id' => 'submit'));

		$this->addElements(array($mau,$nam,$quyet_dinh,$ma_loai,$thong_bao,$file_type,$submit));						

		$this->addDisplayGroup(array('submit'),'report',array(
            'decorators' => array(
                'FormElements',
				 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'report')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'report_dt')),
					'Form',
					));
    }
}
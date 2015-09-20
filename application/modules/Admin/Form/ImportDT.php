<?php
class Admin_Form_ImportDT extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setAttrib('enctype', 'multipart/form-data')
        	 ->setMethod('post')
        	 ->setAttribs(array('onsubmit' => 'return kiem_tra()','name' => 'f3'));

		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDVSGU();
		unset($dv[Default_Model_Constraints::ID_DHSG]);
		$dv['0'] = '============= Chọn đơn vị =============';
		ksort($dv);
		$dvOptions = array("multiOptions" => $dv);
		$ma_don_vi = new Zend_Form_Element_Select('ma_don_vi',$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setLabel('Đơn vị (*)')
				  ->setValue('0')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width : 90%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('id' => 'ma_don_vi'));
		
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
			
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Upload file')
		 	 ->setRequired(true)
	 		 ->setDescription('(*.xlsx)')
		 	 ->setDestination(BASE_PATH . '/upload/files/temp/')
		 	 ->addValidator(new Zend_Validate_File_Extension(array('xls','xlsx')))
		 	 ->setDecorators(array(
							    'File',
							    'Errors',	
			 					array('Description', array('escape' => false, 'tag' => 'div', 'placement' => 'append')),		 					
							    array('HtmlTag', array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttribs(array('id' => 'file'));;	

		$xem_du_lieu = new Zend_Form_Element_Button('xem_du_lieu');
        $xem_du_lieu->setLabel('Xem dữ liệu')
        			->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			    	->setAttribs(array('class' => 'button','id' => 'xem_du_lieu'));
			    
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Lưu vào csdl')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button'));

		$this->addElements(array($ma_don_vi,$nam,$file,$submit));						

		$this->addDisplayGroup(array('submit'),'import',array(
            'decorators' => array(
                'FormElements',
				 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'import')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'import_dt')),
					'Form',
					));
    }
}
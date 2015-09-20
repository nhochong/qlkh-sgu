<?php
class Admin_Form_TinTuc extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
        	 ->setMethod('post');
			 
        $this->addElement('Hidden', 'search', array(
			'value' => 1
		));
		
        $tieu_de = new Zend_Form_Element_Text('tieu_de');       
        $tieu_de->setLabel('Tiêu đề (*)')
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
				->setAttrib('class', 'text-input large-input');
			  
		$quan_trong = new Zend_Form_Element_Select('quan_trong');
        $quan_trong->setLabel('Quan Trọng')
        	 ->setRequired(true)
			 ->setValue(0)
			 ->addMultiOptions(array(
				0 => 'Không',
				1 => 'Có'
			 ))
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
								
		$noi_bat = new Zend_Form_Element_Select('noi_bat');
        $noi_bat->setLabel('Nổi Bật')
        	 ->setRequired(true)
			 ->setValue(0)
			 ->addMultiOptions(array(
				0 => 'Không',
				1 => 'Có'
			 ))
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
								
		$photo = new Zend_Form_Element_File('photo');
		$photo->setLabel('Upload hình')
			 ->setDescription('(*.jgp, *.gif, *.png , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/tin_tuc')
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
	    $image = new Zend_Form_Element_Image('image');
	    $image->setLabel('')
	    	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$statusOptions = array(
        "multiOptions" => Default_Model_Constraints::trang_thai());	
		$trang_thai = new Zend_Form_Element_Radio('trang_thai',$statusOptions);
		$trang_thai->setRequired(true)
				   ->setLabel('Trạng thái')
				   ->setValue('1')
				   ->setSeparator('')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
							        
		$mo_ta_tom_tat = new Zend_Form_Element_Textarea('mo_ta_tom_tat');       
        $mo_ta_tom_tat->setLabel('Mô tả tóm tắt')
	               	  ->addFilter('StripTags')
               		  ->addFilter('StringTrim')
	        		  ->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					 ->setAttribs(array('id' => 'mo_ta_tom_tat','class' => 'textarea','rows' => '4'));
							    
		$mo_ta_chi_tiet = new Zend_Form_Element_Textarea('mo_ta_chi_tiet');       
        $mo_ta_chi_tiet->setLabel('Mô tả chi tiết (*)')
	               	   ->setRequired(true)
	                   ->addValidator('NotEmpty')
	        		   ->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('id' => 'mo_ta_chi_tiet','class' => 'text-input textarea'));
		
		$pdf = new Zend_Form_Element_File('pdf');
		$pdf->setLabel('Upload PDF')
			 ->setDescription('(*.pdf < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/tin_tuc')
			 ->addValidator(new Zend_Validate_File_Extension(array('pdf')))
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
		$link = $url->url(array('module' => 'admin','controller' => 'tin-tuc','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($tieu_de, $quan_trong, $noi_bat, $photo, $image, $pdf, $trang_thai, $mo_ta_tom_tat, $mo_ta_chi_tiet, $submitCon, $submitExit, $cancel));

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'tin_tuc')),
					'Form',
					));
    }
}
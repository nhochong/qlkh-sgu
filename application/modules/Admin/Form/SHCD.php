<?php
class Admin_Form_SHCD extends Zend_Form{

	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
			 ->setAttrib('class', 'form_create_tai_lieu');
        
		$this->addElement('Hidden', 'search', array(
			'value' => 1
		));
		
        $ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Chuyên đề (*)')
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
				   
		$noi_dung = new Zend_Form_Element_Textarea('noi_dung');       
        $noi_dung->setLabel('Nội dung (*)')
               	 ->setRequired(true)
                 ->addValidator('NotEmpty')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'noi_dung','class' => 'text-input textarea'));
		
		$thoi_gian = new Zend_Form_Element_Text('thoi_gian');       
        $thoi_gian->setLabel('Ngày tổ chức')
					  ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array('Description', array('tag' => 'span')),
								array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('class' => 'text-input','id' => 'thoi_gian'));	   
							    
								
		$dia_diem = new Zend_Form_Element_Text('dia_diem');       
        $dia_diem->setLabel('Địa điểm')
			   ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input medium-input');		
			   
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Upload file')
			 ->setDescription('(*.doc, *.docx, *.pdf , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/sinh_hoat_chuyen_de')
			 ->addValidator(new Zend_Validate_File_Extension(array('doc,docx,pdf')))
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
        $submitCon->setLabel('Lưu và tiếp tục')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
			   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setLabel('Lưu và thoát')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 

	    $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'sinh-hoat-chuyen-de','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($ten, $noi_dung, $thoi_gian, $dia_diem, $file, $submitCon, $submitExit, $cancel));						

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
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
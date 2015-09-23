<?php
class Admin_Form_BaiBao_Create extends Zend_Form{

	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
			 ->setAttrib('class', 'form_create_bai_bao');
			 
        $this->addElement('Hidden', 'search', array(
			'value' => 1
		)); 
		
        $ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên sản phẩm (*)')
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
			   
		$so_luong_thanh_vien = new Zend_Form_Element_Text('so_luong_thanh_vien');       
        $so_luong_thanh_vien->setRequired(true)
        			 ->setLabel('Số lượng thành viên')
					 ->addValidator(new Zend_Validate_Int())
					  ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array('Description', array('tag' => 'span')),
								array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('class' => 'text-input','id' => 'so_luong_thanh_vien'))
					  ->setAttrib('class', 'text-input small-input');	   
					  
		$mo_ta = new Zend_Form_Element_Textarea('mo_ta');       
        $mo_ta->setLabel('Nội dung')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'mo_ta','class' => 'text-input textarea'));
				
		$thong_tin = new Zend_Form_Element_Text('thong_tin');       
        $thong_tin->setRequired(true)
        			 ->setLabel('Thông tin')
					  ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array('Description', array('tag' => 'span')),
								array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('class' => 'text-input','id' => 'thong_tin'))
					  ->setAttrib('class', 'text-input large-input');	   
							    
		$thangOptions = Default_Model_Constraints::lichct_thang();					
		$thang = new Zend_Form_Element_Select('thang');       
        $thang->setLabel('Tháng')
				->addMultiOptions($thangOptions)
				->setValue(date('m'))
			   ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));												
		
		$namOptions = Default_Model_Constraints::years();					
		$nam = new Zend_Form_Element_Select('nam');       
        $nam->setLabel('Năm')
				->addMultiOptions($namOptions)
				->setValue(date('Y'))
			   ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
		
		$dot = new Zend_Form_Element_Text('dot');       
        $dot->setRequired(true)
        			 ->setLabel('Đợt')
					 ->addValidator(new Zend_Validate_Int())
					  ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array('Description', array('tag' => 'span')),
								array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('class' => 'text-input','id' => 'dot'));	 
					  
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Upload file')
			 ->setDescription('(*.doc, *.docx, *.pdf , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/bai_bao')
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
		$link = $url->url(array('module' => 'admin','controller' => 'bai-bao','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($ten, $thong_tin, $mo_ta, $so_luong_thanh_vien, $thang, $nam, $dot, $file, $submitCon, $submitExit, $cancel));						

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
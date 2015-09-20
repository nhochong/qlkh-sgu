<?php
class Admin_Form_HinhAnh extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
        	 ->setMethod('post');
        
        $statusOptions = array(
        "multiOptions" => Default_Model_Constraints::trang_thai());	
		$slideshow = new Zend_Form_Element_Radio('slideshow',$statusOptions);
		$slideshow->setRequired(true)
				   ->setLabel('Hiển thị slideshow')
				   ->setValue(0)
				   ->setSeparator('')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$file = new Zend_Form_Element_File('ten_file');
		$file->setLabel('Upload file')
			 ->setDescription('(*.jpg, *.gif, *.png , < 10MB )')
			 ->setDestination(BASE_PATH . '/flash/image-scroller/images/')
			 ->setRequired(true)
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
		$link = $url->url(array('module' => 'admin','controller' => 'gioi-thieu','action' => 'hinh-anh'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($slideshow,$file,$submitCon,$submitExit,$cancel));						

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
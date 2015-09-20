<?php
class Admin_Form_TuyenSinh extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
        	 ->setMethod('post');

       	$id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên (*)')
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
			->setAttrib('class', 'text-input medium-input');

		$file = new Zend_Form_Element_File('ten_file');
		$file->setLabel('Upload file')
			 ->setRequired(true)
			 ->setDescription('(*.doc, *.docx, *.pdf , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/tuyen_sinh')
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
		$link = $url->url(array('module' => 'admin','controller' => 'tuyen-sinh','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($id,$ten,$file,$submitCon,$submitExit,$cancel));						

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
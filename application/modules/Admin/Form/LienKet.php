<?php
class Admin_Form_LienKet extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');
        
        $ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên (*)')
        	->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(0, 255))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input medium-input'));
		
		$statusOptions = array(
        "multiOptions" => array(
			1 => 'Thuộc SGU',
			0 => 'Liên kết trang mạng'
		));	
		$is_sgu = new Zend_Form_Element_Radio('is_sgu',$statusOptions);
		$is_sgu->setRequired(true)
				   ->setLabel('Liên kết')
				   ->setValue('1')
				   ->setSeparator('')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
								
		$url = new Zend_Form_Element_Text('url');       
        $url->setLabel('Url (*)')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(0, 255))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttrib('class', 'text-input medium-input');			
		
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Upload hình')
			 ->setDescription('(*.jgp, *.gif, *.png , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/small/images/lien_ket')
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
		
		$maxOrder = Khcn_Api::_()->getDbTable('lien_ket', 'default')->getMaxOrderItem();
		$order = new Zend_Form_Element_Text('order');       
        $order->setLabel('Thứ tự *')
			->setValue($maxOrder->order + 1)
            ->addValidator(new Zend_Validate_Int())
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input tinysmall-input'));
			
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
		$Url = new Zend_View_Helper_Url();
		$link = $Url->url(array('module' => 'admin','controller' => 'lien-ket','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($ten, $is_sgu, $url, $file, $order, $submitCon, $submitExit, $cancel));						

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
					array('HtmlTag', array('tag' => 'table','class' => 'lien_ket')),
					'Form',
					));
    }
	
	public function isValid($values, $item = null){
		$valid = parent::isValid($values);
		if($valid) {
			if($values['is_sgu'] == 0){
				if( !$item || ($item && empty($item->ten_file))){
					$file = $this->file->getFileName(null,false);
					if(!$file){
						$this->file->addError('Vui lòng upload logo cho liên kết trang mạng!.');
						return false;
					}
				}
			}
		}
		return $valid;
	}
}
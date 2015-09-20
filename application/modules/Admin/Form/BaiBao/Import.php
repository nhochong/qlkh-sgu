<?php
class Admin_Form_BaiBao_Import extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setAttrib('enctype', 'multipart/form-data')
        	 ->setMethod('post')
        	 ->setAttribs(array('onsubmit' => 'return kiem_tra()','name' => 'f3'));
					
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Upload file')
		 	 ->setRequired(true)
	 		 ->setDescription('(*.xlsx, *.xls)')
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
			    
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Lưu vào csdl')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button'));

		$this->addElements(array($file,$submit));						

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
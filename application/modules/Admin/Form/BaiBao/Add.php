<?php
class Admin_Form_BaiBao_Add extends Zend_Form{

	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data')
			 ->setAttrib('class', 'form_bai_bao_giang_vien');       
        
		$dvOptions = array("multiOptions" => Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc());	
		$don_vi_id = new Zend_Form_Element_Select('don_vi_id',$dvOptions);
		$don_vi_id->setRequired(true)
				  ->setLabel('Đơn vị (*)')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('class' => 'text-input','id' => 'don_vi_id'));
							    				    
		$giang_vien_id = new Zend_Form_Element_Select('giang_vien_id');
		$giang_vien_id->setRequired(true)
				   ->setLabel('Tác giả (*)')
				   ->setDecorators(array(
					 		    'ViewHelper',
				   				'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				   ->setAttribs(array('class' => 'text-input','id' => 'giang_vien_id'))
				   ->setRegisterInArrayValidator(false);	
		
		$chuc_vu = new Zend_Form_Element_Text('chuc_vu');       
        $chuc_vu->setRequired(true)
        			 ->setLabel('Chức vụ')
					  ->setDecorators(array(
								'ViewHelper',
								'Errors',
								array('Description', array('tag' => 'span')),
								array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'td')),
								array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					  ->setAttribs(array('class' => 'text-input','id' => 'thong_tin'))
					  ->setAttrib('class', 'text-input large-input');
					  
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
			   
		$this->addElements(array($don_vi_id, $giang_vien_id, $chuc_vu, $submitCon, $submitExit, $cancel));						

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
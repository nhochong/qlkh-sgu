<?php
class Admin_Form_LichCongTac_HoatDong extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');

       	$ma_cong_tac = new Zend_Form_Element_Hidden('ma_cong_tac');
        $this->addElement($ma_cong_tac);
        
		$ngay = new Zend_Form_Element_Text('ngay');       
        $ngay->setLabel('Ngày (*)')
        			 ->setDescription('(dd-mm-YYYY)')
               	 	 ->setRequired(true)
               	 	 ->addFilter('StripTags')
                 	 ->addValidator('NotEmpty')
        		 	 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	 			array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	 ->setAttribs(array('class' => 'text-input','id' => 'ngay'));
		$this->addElement($ngay);
		
        $buoiOptions = Default_Model_Constraints::lichct_buoi();
        $buoi = new Zend_Form_Element_Select('buoi');
        $buoi->setLabel('Buổi (*)')
        	 ->setRequired(true)
			 ->addMultiOptions($buoiOptions)
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttrib('class', 'text-input');        
		$this->addElement($buoi);
        
		$noi_dung = new Zend_Form_Element_Textarea('noi_dung');       
        $noi_dung->setLabel('Nội dung')
	        	->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'ghi_chu','class' => 'text-input textarea','rows' => 4));
		$this->addElement($noi_dung);
					
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
		$this->addElement($quan_trong);
		
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setLabel('Lưu và tiếp tục')->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
		$this->addElement($submitCon);
		   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setLabel('Lưu và thoát')->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button'));
		$this->addElement($submitExit);
		 
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'history.go(-1); return false;'));
		$this->addElement($cancel);	
		
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
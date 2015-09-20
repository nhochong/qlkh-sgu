<?php
class Admin_Form_LichCT extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');

       	$id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $this->addElement($id);
        
        $tuanOptions = Default_Model_Constraints::lichct_tuan();
        $tuan = new Zend_Form_Element_Select('tuan');
        $tuan->setLabel('Tuần (*)')
        	 ->setRequired(true)
			 ->addMultiOptions($tuanOptions)
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttrib('class', 'text-input');        
		$this->addElement($tuan);
		
		$thangOptions = Default_Model_Constraints::lichct_thang();
        $thang = new Zend_Form_Element_Select('thang');
        $thang->setLabel('Tháng (*)')
        	  ->setRequired(true)
			  ->addMultiOptions($thangOptions)
              ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			  ->setAttrib('class', 'text-input');
        $this->addElement($thang);
        
		$ngay_bat_dau = new Zend_Form_Element_Text('ngay_bat_dau');       
        $ngay_bat_dau->setLabel('Ngày bắt đầu (*)')
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
				 	 ->setAttribs(array('class' => 'text-input','id' => 'ngay_bat_dau'));
		$this->addElement($ngay_bat_dau);
				 
		$ngay_ket_thuc = new Zend_Form_Element_Text('ngay_ket_thuc');       
        $ngay_ket_thuc->setLabel('Ngày kết thúc (*)')
        			  ->setDescription('(dd-mm-YYYY)')
               	 	  ->setRequired(true)
               	 	  ->addFilter('StripTags')
                 	  ->addValidator('NotEmpty')
        		 	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	  			array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	  ->setAttribs(array('class' => 'text-input','id' => 'ngay_ket_thuc'));	   
		$this->addElement($ngay_ket_thuc);
		
		$ghi_chu = new Zend_Form_Element_Textarea('ghi_chu');       
        $ghi_chu->setLabel('Ghi chú')
	        	->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'ghi_chu','class' => 'text-input textarea','rows' => 4));
		$this->addElement($ghi_chu);
		
		$thus = Default_Model_Constraints::lct_thu();
		foreach ($thus as $k=>$v){
			$this->addElement('textarea',$k . '_s',array(
								'label' => $k == '7' ? ($v . ' - sáng') : ('Thứ ' . $v . ' - sáng'),
								'decorators' => array('ViewHelper',
											    	 'Errors',
											    	 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
											    	 array('Label', array('tag' => 'td')),
											    	 array(array('row' => 'HtmlTag'), array('tag' => 'tr'))),
								'attribs' => array('class' => 'text-input','id' => $k . '_s')
								
			));
			$this->addElement('textarea',$k . '_c',array(
								'label' => $k == '7' ? ($v . ' - chiều') : ('Thứ ' . $v . ' - chiều'),
								'decorators' => array('ViewHelper',
											    	 'Errors',
											    	 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
											    	 array('Label', array('tag' => 'td')),
											    	 array(array('row' => 'HtmlTag'), array('tag' => 'tr'))),
								'attribs' => array('class' => 'text-input','id' => $k . '_c')
								
			));
			$this->addElement('textarea',$k . '_gc',array(
								'label' => $k == '7' ? ($v . ' - ghi chú') : ('Thứ ' . $v . ' - ghi chú'),
								'decorators' => array('ViewHelper',
											    	 'Errors',
											    	 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
											    	 array('Label', array('tag' => 'td')),
											    	 array(array('row' => 'HtmlTag'), array('tag' => 'tr'))),
								'attribs' => array('class' => 'text-input','id' => $k . '_gc')
								
			));
		}			  
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
		$this->addElement($submitCon);
		   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button'));
		$this->addElement($submitExit);
		 
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'lich-cong-tac','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
		$this->addElement($cancel);	   
		//$this->addElements(array($id,$tuan,$thang,$ngay_bat_dau,$ngay_ket_thuc,$ghi_chu,$submitCon,$submitExit,$cancel));						

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
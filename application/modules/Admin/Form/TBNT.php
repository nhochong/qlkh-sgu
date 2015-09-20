<?php
class Admin_Form_TBNT extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');
        
        $nams = Default_Model_Constraints::nam();
		$namOption = array("multiOptions" => $nams);
		$nam = new Zend_Form_Element_Select('nam',$namOption);
		$nam->setValue(date('Y'))
			->setLabel('Năm')
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 90%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'nam'));
		
		$don_vi = new Default_Model_DonVi();
		$donVis = $don_vi->getDSDVSGU();
		unset($donVis['1']);
		$dvOptions = array("multiOptions" => $donVis);	
		$ma_don_vi = new Zend_Form_Element_Select('ma_don_vi',$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setLabel('Đơn vị')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('class' => 'text-input','id' => 'ma_don_vi'));
				  
		$bizDeTai = new Default_Model_DeTai();
		$deTais = $bizDeTai->getDSDTSelect(array('nam' => date('Y'),'ma_don_vi' => '2'));
		if($deTais == null){
			$deTaisOptions = array("multiOptions" => array('-1' => 'Không có dữ liệu'));
		}else{
			$deTaisOptions = array("multiOptions" => $deTais);
		}	
		$noi_nhan = new Zend_Form_Element_Select('noi_nhan',$deTaisOptions);
		$noi_nhan->setRequired(true)
				  ->setLabel('Đề tài (*)')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('id' => 'noi_nhan'))
				  ->setRegisterInArrayValidator(false);
		
        $tieu_de = new Zend_Form_Element_Text('tieu_de');       
        $tieu_de->setLabel('Tiêu đề (*)')
               	->setRequired(true)
               	->addFilter('StripTags')
               	->addFilter('StringTrim')
                ->addValidator('NotEmpty')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
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
			   
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   ->setAttribs(array('class' => 'button'));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'hoi-dong','action' => 'ds-mail-tb'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($nam,$ma_don_vi,$noi_nhan,$tieu_de,$noi_dung,$submit,$cancel));						

		$this->addDisplayGroup(array('submit','cancel'),'btn_submit',array(
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
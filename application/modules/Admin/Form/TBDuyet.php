<?php
class Admin_Form_TBDuyet extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');
        
        $nams = Default_Model_Constraints::nam();
		$namOption = array("multiOptions" => $nams);
		$nam = new Zend_Form_Element_Select('nam',$namOption);
		$nam->setValue(date('Y'))
			->setLabel('Năm (*)')
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 90%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'nam'));
		
		$bizHDD = new Default_Model_Hdd();
		$hdds = $bizHDD->getDSHDByNam(date('Y'));
		if($hdds == null){
			$hdsOptions = array("multiOptions" => array('-1' => '== Chưa thành lập =='));
		}else{
			$hdds = array('0' => '== Tất cả ==') + $hdds;
			$hddsOptions = array("multiOptions" => $hdds);
		}	
		$noi_nhan = new Zend_Form_Element_Select('noi_nhan',$hddsOptions);
		$noi_nhan->setRequired(true)
				  ->setLabel('Hội đồng')
				  ->setValue('0')
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
			   
		$this->addElements(array($nam,$noi_nhan,$tieu_de,$noi_dung,$submit,$cancel));						

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
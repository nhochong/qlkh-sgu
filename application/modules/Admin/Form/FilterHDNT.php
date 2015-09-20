<?php
class Admin_Form_FilterHDNT extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');
				   
		$linh_vuc = new Default_Model_LinhVuc();
		$lv = $linh_vuc->getDSLV();
		$lv = array('0' => '========= Tất cả =========') + $lv;
		$lvOptions = array("multiOptions" => $lv);	
		$ma_linh_vuc = new Zend_Form_Element_Select('ma_linh_vuc',$lvOptions);
		$ma_linh_vuc->setRequired(true)
				  ->setLabel('Lĩnh vực')
				  ->setValue('0')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
				  ->setAttribs(array('id' => 'ma_linh_vuc'));;
				  
		$nams = Default_Model_Constraints::nam();
		$nams = array('0' => '== Tất cả ==') + $nams;
		ksort($nams);
		$namOption = array("multiOptions" => $nams);
		$nam = new Zend_Form_Element_Select('nam',$namOption);
		$nam->setLabel('Năm')
			->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
			->setAttribs(array('id' => 'nam'));;
				  
		$submit = new Zend_Form_Element_Submit('loc');
        $submit->setLabel('Lọc')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button'));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'hoi-dong','action' => 'danh-sach-hdnt'),null,true);
		$reset = new Zend_Form_Element_Button('reset');
        $reset->setLabel('Làm mới')
        	  ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'filter_btn_r')),
							    ))
				->setAttribs(array('class' => 'button','id' => 'reset','onclick' => 'window.location.href="' . $link . '"'));
	   
		$this->addElements(array($ma_linh_vuc,$nam,$submit,$reset));						 
        
		// Element: order
		$this->addElement('Hidden', 'order', array(
			'order' => 10004,
		));

		// Element: direction
		$this->addElement('Hidden', 'direction', array(
			'order' => 10005,
		));
		
        $this->addDisplayGroup(array('ma_linh_vuc','nam','loc','reset'),'group1',array(
            'order' => 1,
			'decorators' => array(
                'FormElements',
				array('HtmlTag', array('tag' => 'tr','align' => 'left','class' => 'text')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'filter_hdnt','style' => 'width : 65%')),
					'Form',
					));
    }
}
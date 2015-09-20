<?php
class Admin_Form_BaiBao_Filter extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');

		$nams = Default_Model_Constraints::years();
		$nams[''] = '';
		ksort($nams);
		$namOption = array("multiOptions" => $nams);
		$nam = new Zend_Form_Element_Select('nam',$namOption);
		$nam->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
			->setAttribs(array('id' => 'nam'));
			
		$ho = new Zend_Form_Element_Text('ho');       
        $ho->setLabel('Họ')
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
				->setAttribs(array('class' => 'text-input','style' => 'width: 100px'));	

		$ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên')
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
				->setAttribs(array('class' => 'text-input','style' => 'width: 50px','id' => 'ten'));

		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDV();
		$dv = array('0' => '=============== Tất cả ===============') + $dv;
		$dvOptions = array("multiOptions" => $dv);
		$don_vi_id = new Zend_Form_Element_Select('don_vi_id',$dvOptions);
		$don_vi_id->setRequired(true)
				  ->setLabel('Đơn vị')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
				  ->setAttribs(array('id' => 'don_vi_id'));;
				  
		$submit = new Zend_Form_Element_Button('loc',array('type' => 'submit'));
        $submit->setLabel('Lọc')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button'));

		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'bai-bao','action' => 'index'),null,true);
		$reset = new Zend_Form_Element_Button('reset');
        $reset->setLabel('Làm mới')
        	  ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'filter_btn_r')),
							    ))
				->setAttribs(array('class' => 'button','id' => 'reset','onclick' => 'window.location.href="' . $link . '"'));
				
		$this->addElements(array($nam, $ho, $ten, $don_vi_id, $submit, $reset));						

		// Element: order
		$this->addElement('Hidden', 'order', array(
			'order' => 10004,
		));

		// Element: direction
		$this->addElement('Hidden', 'direction', array(
			'order' => 10005,
		));
		
		$this->addDisplayGroup(array('nam', 'ho','ten','don_vi_id','loc','reset'),'filter',array(
			'order' => '0',
            'decorators' => array(
                'FormElements',
				 array('HtmlTag', array('tag' => 'tr','align' => 'left','class' => 'text')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'filter_gv')),
					'Form',
					));
    }
}
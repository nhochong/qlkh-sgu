<?php
class Default_Form_FilterDT extends Zend_Form{
	
	public function init()
	{
		$this->setName('f2')
        	 ->setMethod('get');
        	 //->setAction(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/de-tai/cap-nhat-session');

		$sorts = array(
			'' => '',
			'ma' => 'Mã',
			'nam' => 'Năm'
		);
		$sortsOption = array("multiOptions" => $sorts);
		$order = new Zend_Form_Element_Select('order',$sortsOption);
		$order->setLabel('<strong>Sắp xếp theo</strong> : ')
			 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span','escape' => false)),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'order'))))
			 ->setAttribs(array('id' => 'order'));
		
		$directions = array(
			'asc' => 'Tăng dần',
			'desc' => 'Giảm dần'
		);
		$directionsOption = array("multiOptions" => $directions);
		$direction = new Zend_Form_Element_Select('direction',$directionsOption);
		$direction->setLabel('')
			 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span','escape' => false)),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'direction'))))
			 ->setAttribs(array('id' => 'direction','style' => 'display : none'));
		
        $nams = array();
		for($i = 2005 ; $i<2030 ; $i++)
			$nams[$i] = $i;
		$nams = array('0' => '------') + $nams;		
		$namsOption = array("multiOptions" => $nams);
				
		$from = new Zend_Form_Element_Select('from',$namsOption);
		$from->setLabel('<strong>Danh sách đề tài</strong> : Từ ')
		     ->setValue(date('Y'))
			 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span','escape' => false)),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'from'))))
			 ->setAttribs(array('id' => 'from'));
			 
		$to = new Zend_Form_Element_Select('to',$namsOption);
		$to->setLabel('Đến ')
		   ->setValue(date('Y') + 1)
		   ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'to'))))
		   ->setAttribs(array('id' => 'to'));

			
		$submit = new Zend_Form_Element_Submit('loc');
        $submit->setLabel('Lọc');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ));        
								
		
		$this->addElements(array($order,$direction,$from,$to,$submit));						       
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'span','class' => 'search_dt')),
					'Form',
					));
	}
}
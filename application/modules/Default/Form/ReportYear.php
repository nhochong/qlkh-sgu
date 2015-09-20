<?php
class Default_Form_ReportYear extends Zend_Form{
	
	public function init()
	{
		$this->setName('year_report')
        	 ->setMethod('post');
        	 
        $nams = array();
		for($i = 2005 ; $i<2030 ; $i++)
			$nams[$i] = $i;
		$namOption = array("multiOptions" => $nams);
		
        $from = new Zend_Form_Element_Select('year_from',$namOption);     
        $from->setLabel('Từ : ')
        	 ->setValue(date('Y'))
             ->setRequired(true)
        	 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'from'))))
			->setAttribs(array('style' => 'width:10%'));
							    
		$to = new Zend_Form_Element_Select('year_to',$namOption);     
        $to->setLabel('Đến : ')
        	 ->setValue(date('Y') + 1)
             ->setRequired(true)
        	 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'to'))))
			->setAttribs(array('style' => 'width:10%'));

		$amounts = array();
		for($i = 1 ; $i <= 10 ; $i++){
			$amounts[$i * 10] = $i * 10;
		}
		$amountOptions = array("multiOptions" => $amounts);	
		$amount = new Zend_Form_Element_Select('year_amount',$amountOptions);     
        $amount->setLabel('Số lượng GV : ')
        	 ->setValue(10)
             ->setRequired(true)
        	 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'amount'))));
							    				    
		$submit = new Zend_Form_Element_Button('year_submit');
        $submit->setLabel('Xem');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span','align'=>'left')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','style' => 'margin-left : 10px')),
							    ));        
		
		$this->addElements(array($from, $to, $amount, $submit));						       
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'div','class' => 'year_report')),
					'Form',
					));
	}
}
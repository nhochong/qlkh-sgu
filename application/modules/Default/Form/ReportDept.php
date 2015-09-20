<?php
class Default_Form_ReportDept extends Zend_Form{
	
	public function init()
	{
		$this->setName('dept_report')
        	 ->setMethod('post');
        	 
        $nams = array();
		for($i = 2005 ; $i<2030 ; $i++)
			$nams[$i] = $i;
		$namOption = array("multiOptions" => $nams);
		
        $from = new Zend_Form_Element_Select('dept_from',$namOption);     
        $from->setLabel('Từ : ')
        	 ->setValue(date('Y'))
             ->setRequired(true)
        	 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'from','style' => 'margin-left : 23px'))))
			->setAttribs(array('style' => 'width:10%'));
							    
		$to = new Zend_Form_Element_Select('dept_to',$namOption);     
        $to->setLabel('Đến : ')
        	 ->setValue(date('Y') + 1)
             ->setRequired(true)
        	 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'to'))))
			->setAttribs(array('style' => 'width:10%'));	

		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDVSGU();
		unset($dv['1']);
		$dvOptions = array("multiOptions" => $dv);
		$ma_don_vi = new Zend_Form_Element_Select('dept_don_vi',$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setLabel('Đơn vị : ')
				  ->setValue('0')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'style' => 'margin-bottom: 10px;'))))
				  ->setAttribs(array('id' => 'dept_don_vi','style' => 'width : 50%'));
		
		$amounts = array();
		for($i = 1 ; $i <= 10 ; $i++){
			$amounts[$i * 10] = $i * 10;
		}
		$amountOptions = array("multiOptions" => $amounts);	
		$amount = new Zend_Form_Element_Select('dept_amount',$amountOptions);     
        $amount->setLabel('Số lượng GV : ')
        	 ->setValue(10)
             ->setRequired(true)
        	 ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'amount'))));
								
		$submit = new Zend_Form_Element_Button('dept_submit');
        $submit->setLabel('Xem');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span','align'=>'left')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','style' => 'margin-left : 10px')),
							    ));        
		
		$this->addElements(array($ma_don_vi, $from, $to, $amount, $submit));						       
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'div','class' => 'dept_report')),
					'Form',
					));
	}
}
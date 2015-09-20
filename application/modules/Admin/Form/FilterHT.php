<?php
class Admin_Form_FilterHT extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');
				   
		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDVSGU();
		$dv['0'] = '=============== Tất cả ===============';
		ksort($dv);
		$dvOptions = array("multiOptions" => $dv);
		$don_vi_id = new Zend_Form_Element_Select('don_vi_id',$dvOptions);
		$don_vi_id->setRequired(true)
				  ->setLabel('Đơn vị quản lý')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'div')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'div'))))
				  ->setAttribs(array('id' => 'don_vi_phu_trach'));;
				  
		$nams = Default_Model_Constraints::nam();
		$nams['0'] = '== Tất cả ==';
		ksort($nams);
		$namOption = array("multiOptions" => $nams);
		$nam = new Zend_Form_Element_Select('nam',$namOption);
		$nam->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'div')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'div'))))
			->setAttribs(array('id' => 'nam','onchange' => 'this.form.submit()'));
				  
		
		$this->addElements(array($nam));						 
        
		// Element: order
		$this->addElement('Hidden', 'order', array(
			'order' => 10004,
		));

		// Element: direction
		$this->addElement('Hidden', 'direction', array(
			'order' => 10005,
		));
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'div','class' => 'filter_ht')),
					'Form',
					));
    }
}
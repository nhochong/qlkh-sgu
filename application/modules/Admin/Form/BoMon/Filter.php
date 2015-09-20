<?php
class Admin_Form_BoMon_Filter extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');

		$dv = Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc();
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
		
		$this->addElements(array($don_vi_id, $submit));
		
		$this->addDisplayGroup(array('don_vi_id','loc'),'filter',array(
			'order' => '0',
            'decorators' => array(
                'FormElements',
				 array('HtmlTag', array('tag' => 'tr','align' => 'left','class' => 'text')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'filter_bm','style' => 'width : 47%')),
					'Form',
					));
    }
}
<?php
class Admin_Form_FilterTB extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');
				  
		$loais = Khcn_Api::_()->getDbTable('loai_thong_bao', 'default')->getListAssoc();
		$loais['0'] = '===== Chọn loại =====';
		ksort($loais);
		$loaiOption = array("multiOptions" => $loais);
		$loai = new Zend_Form_Element_Select('loai',$loaiOption);
		$loai->setLabel('Loại thông báo')
			 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
			 ->setAttribs(array('id' => 'loai', 'onchange' => 'this.form.submit()'));;
		
	   
		$this->addElements(array($loai));						 
        
		// Element: order
		$this->addElement('Hidden', 'order', array(
			'order' => 10004,
		));

		// Element: direction
		$this->addElement('Hidden', 'direction', array(
			'order' => 10005,
		));
		
        $this->addDisplayGroup(array('loai','loc','reset'),'group1',array(
            'order' => 1,
			'decorators' => array(
                'FormElements',
				array('HtmlTag', array('tag' => 'tr','align' => 'left','class' => 'text')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'filter_tb','style' => 'width : 47%')),
					'Form',
					));
    }
}
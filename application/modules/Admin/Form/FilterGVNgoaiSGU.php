<?php
class Admin_Form_FilterGVNgoaiSGU extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');

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
				->setAttribs(array('class' => 'text-input','style' => 'width: 120px'));	

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
				  
		$submit = new Zend_Form_Element_Button('loc',array('type' => 'submit'));
        $submit->setLabel('Lọc')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button'));

		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'giang-vien','action' => 'reset-ngoai-sgu'),null,true);
		$reset = new Zend_Form_Element_Button('reset');
        $reset->setLabel('Làm mới')
        	  ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'filter_btn_r')),
							    ))
				->setAttribs(array('class' => 'button','id' => 'reset','onclick' => 'window.location.href="' . $link . '"'));
				
		$this->addElements(array($ho,$ten,$submit,$reset));						

		$this->addDisplayGroup(array('ma','ho','ten','ma_don_vi','loc','reset'),'filter',array(
			'order' => '0',
            'decorators' => array(
                'FormElements',
				 array('HtmlTag', array('tag' => 'tr','align' => 'left','class' => 'text')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'filter_gv_ngoai_sgu','style' => 'width : 47%')),
					'Form',
					));
    }
}
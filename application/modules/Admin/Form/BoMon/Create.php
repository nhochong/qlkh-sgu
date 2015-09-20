<?php
class Admin_Form_BoMon_Create extends Zend_Form{
	public function init()
    {  	
		$ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input');
		
		$dv = Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc();
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
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('id' => 'don_vi_id'));;
			   		  
		$submit = new Zend_Form_Element_Submit('submit');		
        $submit->setLabel('Lưu')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'bo-mon','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			
		$this->addElements(array($ten, $don_vi_id, $submit, $cancel));						

		$this->addDisplayGroup(array('submit','cancel'),'submitbtn',array(
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
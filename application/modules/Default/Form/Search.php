<?php
class Default_Form_Search extends Khcn_Form{
	
	public function init()
	{
		$this->setName('search')
        	 ->setMethod('get')
        	 ->setAction(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/index/search');
        $keyWord = new Zend_Form_Element_Text('keyword');      
        $keyWord->setLabel('Từ khóa : ')
               	 ->setRequired(true)
               	 ->addFilter('StripTags')
               	 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'tr', 'class' => 'SubHead')),
							    array('Label', array('tag' => 'tr')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
		$keyWord->setAttribs(array('style' => 'width : 195px;'));
		
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Tìm')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan'=>'2','align'=>'left')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'class' => 'btnsm')),
							    ))
				->setAttribs(array('class' => 'art-button'));        
		$this->addElements(array($keyWord,$submit));						

		$this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table')),
					'Form',
					));
	}
}
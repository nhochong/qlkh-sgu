<?php
class Admin_Form_CauHinh extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');
        
        $ten_phong = new Zend_Form_Element_Text('ten_phong');       
        $ten_phong->setLabel('Tên phòng')
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
				->setAttrib('class', 'text-input large-input');
			
		$truong_phong = new Zend_Form_Element_Text('truong_phong');       
        $truong_phong->setLabel('Trưởng phòng')
               		->addFilter('StripTags')
               		->addFilter('StringTrim')
        			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					->setAttrib('class', 'text-input medium-input');
					
        $hieu_truong = new Zend_Form_Element_Text('hieu_truong');       
        $hieu_truong->setLabel('Hiệu trưởng')
	               	->addFilter('StripTags')
	               	->addFilter('StringTrim')
	        		->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					->setAttrib('class', 'text-input medium-input');
	
		$domain = new Zend_Form_Element_Text('domain');       
        $domain->setLabel('Tên website')
	               	->setDescription('(http://domain.com)')
	               	->addFilter('StripTags')
	               	->addFilter('StringTrim')
	        		->setDecorators(array(
								    'ViewHelper',
								    'Errors',
	        						array('Description', array('tag' => 'span')),
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					->setAttrib('class', 'text-input medium-input');
			   
		$cesti_info = new Zend_Form_Element_Textarea('cesti_info');       
        $cesti_info->setLabel('Cổng thông tin Cesti')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'cesti_info','class' => 'text-input textarea'));
				
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Lưu')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   ->setAttribs(array('class' => 'button'));
			   	  
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'index','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   ->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($ten_phong,$truong_phong,$hieu_truong,$domain, $cesti_info,$submit,$cancel));						

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
<?php
class Admin_Form_Backup extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');

       	$id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

		$cateOptions = Default_Model_Constraints::backup_loai();
        $loai = new Zend_Form_Element_Select('loai');
        $loai->setLabel('Loại')
			 ->addMultiOptions($cateOptions)
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttrib('class', 'text-input');  
			           
		$saveOptions = array('0' => 'Lưu trên host',
							 '1' => 'Tải về máy');
		$save = new Zend_Form_Element_Select('save');
        $save->setLabel('Save')
			 ->addMultiOptions($saveOptions)
             ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			 ->setAttrib('class', 'text-input');   
			          
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
			   		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'database','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($id,$loai,$save,$submit,$cancel));						

		$this->addDisplayGroup(array('submit','cancel'),'btnsubmit',array(
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
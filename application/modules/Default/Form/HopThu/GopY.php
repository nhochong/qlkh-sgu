<?php
class Default_Form_HopThu_GopY extends Khcn_Form
{
	public function init()
    {  	
        $this->setAttrib('class', 'global_form form_hop_thu_gop_y');
        	 
		$cateOptions = Khcn_Api::_()->getDbTable('loai_gy', 'default')->getLoaiGYAssoc();
		$this->addElement('Select', 'loai_id', array(
			'label' => 'Loại',
			'multiOptions' => $cateOptions
		));
		
		$this->addElement('Text', 'ten', array(
			'label' => 'Chủ đề',
			'allowEmpty' => false,
			'required' => true,
			'filters' => array(
				'StripTags',
			),
		));
		
		$this->addElement('Textarea', 'mo_ta', array(
			'label' => 'Mô tả',
			'allowEmpty' => false,
			'required' => true,
			'filters' => array(
				'StripTags',
			),
		));
		
		$this->addElement('Button', 'submit', array(
		  'label' => 'Góp Ý',
		  'type' => 'submit',
		  'ignore' => true,
		  'decorators' => array('ViewHelper',),
		  'attribs' => array('class' => 'art-button')
		));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'default','controller' => 'index','action' => 'index'));		
		$this->addElement('Cancel', 'cancel', array(
		  'label' => 'Hủy',
		  'onclick' => 'window.location.href="' . $link . '"',
		  'decorators' => array(
			'ViewHelper',
		  ),
		  'attribs' => array('class' => 'art-button')
		));
		
		$this->addDisplayGroup(array('submit','cancel'),'submitbtn'); 
    }
}

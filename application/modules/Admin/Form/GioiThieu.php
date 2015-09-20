<?php
class Admin_Form_GioiThieu extends Khcn_Form{
	public function init()
    {  	
		$this->addElement('Textarea', 'gioi_thieu', array(
		));
		
		$this->addElement('Button', 'submit', array(
		  'label' => 'Lưu',
		  'type' => 'submit',
		  'ignore' => true,
		  'decorators' => array('ViewHelper',),
		  'attribs' => array('class' => 'art-button button')
		));
    }
}
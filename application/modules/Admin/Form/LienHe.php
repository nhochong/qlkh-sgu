<?php
class Admin_Form_LienHe extends Khcn_Form{
	public function init()
    {  	
		$this->addElement('Textarea', 'lien_he', array(
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
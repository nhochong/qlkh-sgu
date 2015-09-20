<?php
class Default_Form_AdvSearch extends Khcn_Form{
	
	public function init()
	{
		$this->setName('adv_form_search')
        	 ->setMethod('get')
        	 ->setAction(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/index/search');
		
		$this->addElement('Text', 'keyword', array(
			'label' => 'Từ khóa : ',
			'allowEmpty' => true,
			'filters' => array(
				'StripTags'
			),
		));   	
								
		$this->addElement('Radio', 'search_full', array(
			'multiOptions' => array(
				0 => 'Tất cả các từ',
				1 => 'Tìm chính xác cụm từ'
			),
		));
		$this->search_full->removeDecorator('Label');
			
		$typesOptions = Khcn_Api::_()->getDbTable('searchtypes', 'default')->getSearchTypesEnabledAssoc();
		if(count($typesOptions) > 0){
			$this->addElement('MultiCheckbox', 'types', array(
				'label' => 'Tìm kiếm theo : ',
				'multiOptions' => $typesOptions
			));	
		}		

		// Element: submit
		$this->addElement('Button', 'submit', array(
			'label' => 'Tìm kiếm',
			'type' => 'submit',
		));	
	}
}
<?php
class Default_Form_SearchGV extends Khcn_Form{
	
	public function init()
	{
		$this->setName('form_search_gv')
        	 ->setMethod('get')
        	 ->setAction(Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/index/search');
			 
		$this->addElement('Text', 'name', array(
			'label' => 'Họ tên : ',
			'allowEmpty' => false,
			'required' => true,
			'filters' => array(
				'StripTags'
			),
		));         
							    
		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDV();
		unset($dv['1']);
		$dv = array( '0' => '=============== Tất cả ===============') + $dv;
		
		$this->addElement('Select', 'ma_don_vi', array(
			'label' => 'Đơn vị : ',
			'multiOptions' => $dv
		));	

		// Element: submit
		$this->addElement('Button', 'submit', array(
			'label' => 'Tìm kiếm',
			'type' => 'submit',
		));
	}
}
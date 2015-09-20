<?php
class Default_Model_BoMon extends Khcn_Model_Item_Abstract{
	
	public function getDonVi(){
		return Khcn_Api::_()->getItem('default_don_vi', $this->don_vi_id);
	}
}
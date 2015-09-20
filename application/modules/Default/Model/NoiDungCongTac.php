<?php
class Default_Model_NoiDungCongTac extends Khcn_Model_Item_Abstract{
	public function getThu(){
		$thus = Default_Model_Constraints::lct_thu();
		return $thus[date('N',strtotime($this->ngay))];
	}
}
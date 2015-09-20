<?php
class Default_Model_BieuMau extends Khcn_Model_Item_Abstract{
	
	public function getHref($params = array()){
		return Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/bieu_mau/' . $this->ten_file;
	}
	
	public function getLoaiBM(){
		return Khcn_Api::_()->getItem('default_loai_bieu_mau', $this->ma_loai);
	}
}
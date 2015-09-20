<?php
class Default_Model_HoSo extends Khcn_Model_Item_Abstract{
	
	public function getHref($params = array()){
		return Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/ho_so/' . $this->ten_file;
	}
	
	public function getLoaiHS(){
		return Khcn_Api::_()->getItem('default_loai_ho_so', $this->ma_loai);
	}
}
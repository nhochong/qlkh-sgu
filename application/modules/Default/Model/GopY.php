<?php
class Default_Model_GopY extends Khcn_Model_Item_Abstract{
	public function getNguoiDung(){
		return Khcn_Api::_()->getItem('default_nguoi_dung', $this->nguoi_dung_id);
	}
	
	public function getLoai(){
		return Khcn_Api::_()->getItem('default_loai_gy', $this->loai_id);
	}
}
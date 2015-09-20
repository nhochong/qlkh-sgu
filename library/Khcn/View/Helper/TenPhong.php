<?php
class Khcn_View_Helper_TenPhong extends Zend_View_Helper_Abstract
{
	public function tenPhong()
	{
    	return Khcn_Api::_()->getApi('settings', 'default')->getSetting('ten_phong', 'Phòng Khoa học - Công nghệ - Trường Đại học Sài Gòn');
	}	
}
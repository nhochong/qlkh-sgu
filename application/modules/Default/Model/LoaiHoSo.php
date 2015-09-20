<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiHoSo extends Khcn_Model_Item_Abstract
{
	public function getDanhSachHoSo(){
		return Khcn_Api::_()->getDbTable('ho_so', 'default')->getDanhSachHoSo(array('ma_loai' => $this->getIdentity())); 
	}
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiBieuMau extends Khcn_Model_Item_Abstract
{
	public function getDanhSachBieuMau(){
		return Khcn_Api::_()->getDbTable('bieu_mau', 'default')->getDanhSachBieuMau(array('ma_loai' => $this->getIdentity())); 
	}
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiThongBao extends Khcn_Model_Item_Abstract
{
	public function getDSThongBaosByLoai(){
		return Khcn_Api::_()->getDbTable('thong_bao', 'default')->getDSThongBaos(array('loai' => $this->getIdentity())); 
	}
}

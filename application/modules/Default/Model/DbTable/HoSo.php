<?php
class Default_Model_DbTable_HoSo extends Khcn_Db_Table{
	
	protected $_name = 'ho_so';
	
	protected $_rowClass = 'Default_Model_HoSo';
    
	public function getDanhSachHoSo($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['ma_loai']) && !empty($params['ma_loai'])){
			$select->where('ma_loai = ?', $params['ma_loai']);
		}
		
		return $this->fetchAll($select);
	}
	
	public function getHSsByLoai($ma_loai){
		$select = $this->select()->where('ma_loai = ?', $ma_loai);
		return $this->fetchAll($select);
	}
}
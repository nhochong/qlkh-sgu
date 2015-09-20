<?php
class Default_Model_DbTable_LichCongTac extends Khcn_Db_Table{
	
	protected $_name = 'lich_cong_tac';
	
	protected $_rowClass = 'Default_Model_LichCongTac';
	
	public function getLichCTs($params = array()){
		$select = $this->select()
						->order('YEAR(ngay_ket_thuc) DESC')
						->order('thang DESC')
						->order('tuan DESC');
						
		if(isset($params['trang_thai'])){
			$select->where('trang_thai = ?', $params['trang_thai']);
		}
		if(!empty($params['limit'])){
			$select->limit($limit);
		}
		return $this->fetchAll($select);
	}
	
	public function getLichCTByCurrentDate(){
		$current_date = date('Y-m-d');
		$select = $this->select()
						->where('ngay_bat_dau <= ?', $current_date)
						->where('ngay_ket_thuc >= ?', $current_date)
						->limit(1);
		return $this->fetchRow($select);
	}
}
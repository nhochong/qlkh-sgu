<?php
class Default_Model_DbTable_NoiDungCongTac extends Khcn_Db_Table{
	
	protected $_name = 'noi_dung_cong_tac';
	
	protected $_rowClass = 'Default_Model_NoiDungCongTac';
	
	public function getNDCTByDate($date){
		$select = $this->select()->where('ngay = ?', $date);
		return $this->fetchAll($select);
	}
}
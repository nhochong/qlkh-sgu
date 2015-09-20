<?php
class Default_Model_DbTable_NhanSu extends Khcn_Db_Table{
	
	protected $_name = 'nhan_su';
	
	protected $_rowClass = 'Default_Model_NhanSu';
	
	public function getMaxOrder(){
		$select = $this->select()->order('order DESC')->limit(1);
		$row = $this->fetchRow($select);
		if($row){
			return $row->order + 1;
		}
		return 0;
	}
}
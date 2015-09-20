<?php
class Default_Model_DbTable_QuiDinh extends Khcn_Db_Table{
	
	protected $_name = 'qui_dinh';
	
	protected $_rowClass = 'Default_Model_QuiDinh';
	
	public function getQDByLoai($loai){
		$select = $this->select()
						->where('trang_thai = 1')
						->where('loai = ?', $loai);
		return $this->fetchAll($select);
	}
}
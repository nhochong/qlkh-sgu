<?php
class Default_Model_DbTable_HinhAnhChuyenDe extends Khcn_Db_Table{
	
	protected $_name = 'hinh_anh_chuyen_de';
	
	protected $_rowClass = 'Default_Model_HinhAnhChuyenDe';
	
	public function getHinhAnhByChuyenDe($chuyen_de_id){
		$select = $this->select()->where('chuyen_de_id = ?', $chuyen_de_id);
		return $this->fetchAll($select);
	}
}
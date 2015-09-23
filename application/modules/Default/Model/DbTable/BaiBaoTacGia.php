<?php
class Default_Model_DbTable_BaiBaoTacGia extends Khcn_Db_Table{
	
	protected $_name = 'bai_bao_tac_gia';
	
	protected $_rowClass = 'Default_Model_BaiBaoTacGia';
	
	public function getTacGias($bai_bao_id){
		$select = $this->select()->where('bai_bao_id = ?', $bai_bao_id);
		return $this->fetchAll($select);
	}
}
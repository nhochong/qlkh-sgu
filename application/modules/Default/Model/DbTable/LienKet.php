<?php
class Default_Model_DbTable_LienKet extends Khcn_Db_Table{
	
	protected $_name = 'lien_ket';
	
	protected $_rowClass = 'Default_Model_LienKet';
	
	public function getLienKets($params = array()){
		$select = $this->select();
		
		if(isset($params['is_sgu'])){
			$select->where('is_sgu = ?', $params['is_sgu']);
		}
		return $this->fetchAll($select);
	}
	
	public function getMaxOrderItem(){
		$select = $this->select()->order('order DESC')->limit(1);
		return $this->fetchRow($select);
	}
	
}
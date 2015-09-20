<?php
class Default_Model_DbTable_Searchtypes extends Khcn_Db_Table{
	
	protected $_name = 'searchtypes';
	
	public function getSearchTypesEnabled(){
		$select = $this->select()->where('enabled = 1')->order('order ASC');
		return $this->fetchAll($select);
	}
	
	public function getSearchTypesEnabledAssoc(){
		$rows = $this->getSearchTypesEnabled();
		$results = array();
		foreach($rows as $row){
			$results[$row->type] = $row->title;
		}
		return $results;
	}
}
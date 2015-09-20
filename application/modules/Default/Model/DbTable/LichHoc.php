<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LichHoc extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
	
    protected $_name = 'lich_hoc';
	
	protected $_rowClass = 'Default_Model_LichHoc';
	
	public function getPaginator($params = array()){
		$select = $this->select();
		
		if(!empty($params['he_cao_hoc'])){
			$select->where('he_cao_hoc = ?', $params['he_cao_hoc']);
		}
		return $this->fetchAll($select);
	}
}

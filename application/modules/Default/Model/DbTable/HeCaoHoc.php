<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_HeCaoHoc extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
	
    protected $_name = 'he_cao_hoc';
	
	protected $_rowClass = 'Default_Model_HeCaoHoc';
	
	public function getListAssoc(){
		$data = array();
		foreach($this->fetchAll() as $key => $item)
			$data[$item->getIdentity()] = $item->getTitle();
		return $data;
	}
}

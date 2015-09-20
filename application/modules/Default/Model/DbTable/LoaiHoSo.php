<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiHoSo extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'loai_ho_so';
	
	protected $_rowClass = 'Default_Model_LoaiHoSo';
	
	public function getAll(){
		$select = $this->select()->order('order ASC');
		return $this->fetchAll($select);
	}
	
	public function getListAssoc($parent_id = 0, &$results = array(), $level = 0){
		foreach($this->getByParent($parent_id) as $row){
			$title = ($level == 0) ? $row->ten : '| ' . $row->ten;
			$results[$row->id] = str_pad('', $level*2, '-', STR_PAD_LEFT) . $title;
			if($this->hasChild($row->getIdentity())){
				$this->getListAssoc($row->getIdentity(), $results, ++$level);
				--$level;
			}
		}
		return $results;
	}
	
	public function getByParent($parent_id){
		return $this->fetchAll($this->select()->where('parent_id = ?', $parent_id));
	}
	
	public function hasChild($parent_id){
		$row = $this->fetchRow($this->select()->where('parent_id = ?', $parent_id));
		if($row)
			return true;
		return false;
	}
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiThongBao extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
	
    protected $_name = 'loai_thong_bao';
	
	protected $_rowClass = 'Default_Model_LoaiThongBao';
	
	const HE_CAO_HOC_DHSG = 5;
	const HE_CAO_HOC_DHVINH = 6;
	const NGHIEN_CUU_KHOA_HOC = 1;
	const HOI_NGHI_HOI_THAO = 2;
	const DAO_TAO_SAU_DAI_HOC = 3;
	
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
	
	public function getDanhSachLTB($params = array()){
		$select = $this->select();
		if(isset($params['he_cao_hoc'])){
			$select->where('he_cao_hoc = ?', $params['he_cao_hoc']);
		}
		return $this->fetchAll($select);
	}
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiGy extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'loai_gop_y';
	
	protected $_rowClass = 'Default_Model_LoaiGy';
	
	public function getLoaiGYAssoc(){
		$loaiGopYs = $this->fetchAll();
		$datas = array();
		foreach($loaiGopYs as $loai_gop_y){
			$datas[$loai_gop_y->id] =  $loai_gop_y->ten;
		}
    	return $datas;
	}
}

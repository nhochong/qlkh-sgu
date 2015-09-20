<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiLinhVuc extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'loai_linh_vuc';
	
	protected $_rowClass = 'Default_Model_LoaiLinhVuc';
	
    public function getLoaiLV($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function them($loai_lv)
    {
    	$data = array(
			'ma' => $loai_lv->getMa(),
            'ten' => $loai_lv->getTen(),
        );
        return $this->insert($data);
    }
    
    public function sua($loai_lv)
    {
		$data = array(
            'ma' => $loai_lv->getMa(),
            'ten' => $loai_lv->getTen(),
        );
        return $this->update($data, 'id = '. (int)$loai_lv->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
	
	public function getMultiOptions(){
		$datas = array();
		foreach($this->fetchAll() as $row){
			$datas [$row->getIdentity()] = $row->ten;
		}
		return $datas;
	}
}

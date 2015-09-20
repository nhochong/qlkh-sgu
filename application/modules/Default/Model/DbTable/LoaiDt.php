<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LoaiDt extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'loai_de_tai';
	
	protected $_rowClass = 'Default_Model_LoaiDt';
	
    public function getLoaiDT($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getDSLDT()
    {
    	$cols = array('id','ten');
    	$statement = $this->select()
    					  ->from($this->_name,$cols);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function kiem_tra_ma($ma)
    {
    	$statement = $this->select()
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	$statement = $this->select()
    					  ->where('id != ?',$id)
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
	public function them($loai_dt)
    {
    	$data = array(
    		'ma' => $loai_dt->getMa(),
            'ten' => $loai_dt->getTen(),
            'ghi_chu' => $loai_dt->getGhiChu()
        );
        return $this->insert($data);
    }
    
    public function sua($loai_dt)
    {
		$data = array(
    		'ma' => $loai_dt->getMa(),
            'ten' => $loai_dt->getTen(),
            'ghi_chu' => $loai_dt->getGhiChu()
        );
        return $this->update($data, 'id = '. (int)$loai_dt->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}

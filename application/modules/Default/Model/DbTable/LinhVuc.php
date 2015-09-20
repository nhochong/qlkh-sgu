<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_LinhVuc extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'linh_vuc';
	
	protected $_rowClass = 'Default_Model_LinhVuc';
	
    public function getLinhVuc($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getIdByMa($ma) 
    {
    	$cols = array('id');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['id'];
    }
	
	public function getLVByMa($ma_linh_vuc) 
    {
    	$statement = $this->select()
    					  ->where('ma = ?',$ma_linh_vuc)
    					  ->limit(1);
    	$row = $this->_db->fetchRow($statement);
		if($row)
			return $row;
		return null;
    }
    
	public function getDSLV()
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
    
	public function them($linh_vuc)
    {
    	$data = array(
    		'ma' => $linh_vuc->getMa(),
            'ten' => $linh_vuc->getTen(),
            'mo_ta' => $linh_vuc->getMoTa(),
			'ma_loai' => $linh_vuc->getMaLoai()
        );
        return $this->insert($data);
    }
    
    public function sua($linh_vuc)
    {
		$data = array(
    		'ma' => $linh_vuc->getMa(),
            'ten' => $linh_vuc->getTen(),
            'mo_ta' => $linh_vuc->getMoTa(),
			'ma_loai' => $linh_vuc->getMaLoai()
        );
        return $this->update($data, 'id = '. (int)$linh_vuc->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}

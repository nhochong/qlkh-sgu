<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_HocVi extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'hoc_vi';
	
	protected $_rowClass = 'Default_Model_HocVi';
	
    public function getHocVi($id) 
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
    	if($rows)
			return $rows[0]['id'];
		return null;
    }
    
	public function getDSHV()
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
    
	public function them($hoc_vi)
    {
    	$data = array(
    		'ma' => $hoc_vi->getMa(),
            'ten' => $hoc_vi->getTen(),
            'ghi_chu' => $hoc_vi->getGhiChu()
        );
        return $this->insert($data);
    }
    
    public function sua($hoc_vi)
    {
		$data = array(
    		'ma' => $hoc_vi->getMa(),
            'ten' => $hoc_vi->getTen(),
            'ghi_chu' => $hoc_vi->getGhiChu()
        );
        return $this->update($data, 'id = '. (int)$hoc_vi->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}

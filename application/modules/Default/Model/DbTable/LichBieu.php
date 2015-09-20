<?php
class Default_Model_DbTable_LichBieu extends Khcn_Db_Table{
	
	protected $_name = 'lich_bieu';
	
	protected $_rowClass = 'Default_Model_LichBieu';
	
	public function getLichBieu($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getDSLB()
    {
    	$statement = $this->select()
    					  ->where('trang_thai = ?',1)
    					  ->order('id DESC');;
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('trang_thai DESC')
    					  ->order('id DESC');;
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getFile($id)
    {
    	$cols = array('id','ten_file');
    	$statement = $this->select()
    					  ->from('lich_bieu',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    public function them($lich_bieu)
    {
    	$data = array(
            'ten' => $lich_bieu->getTen(),
            'ten_file' => $lich_bieu->getTenFile()
        );
        return $this->insert($data);
    }
    
    public function sua($lich_bieu)
    {
    	if($lich_bieu->getTenFile() != null){
	    	$data = array(
	            'ten' => $lich_bieu->getTen(),
	            'ten_file' => $lich_bieu->getTenFile()
	        );
    	}else{
    		$data = array(
            	'ten' => $lich_bieu->getTen()
        	);
    	}
        return $this->update($data, 'id = '. (int)$lich_bieu->getId());
    }
    
    public function CapNhatTT($id,$status)
    {
    	$data = array(
	            'trang_thai' => 1 - $status,
	        );
	    return $this->update($data, 'id = '. (int)$id);
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}
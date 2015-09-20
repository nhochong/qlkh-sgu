<?php
class Default_Model_DbTable_TuyenSinh extends Khcn_Db_Table{
	
	protected $_name = 'tuyen_sinh';
	
	protected $_rowClass = 'Default_Model_TuyenSinh';
	
	public function getTuyenSinh($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getDSTS()
    {
    	$statement = $this->select()
    					  ->where('trang_thai = ?',1)
    					  ->order('id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('trang_thai DESC')
    					  ->order('id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getFile($id)
    {
    	$cols = array('id','ten_file');
    	$statement = $this->select()
    					  ->from('tuyen_sinh',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    public function them($tuyen_sinh)
    {
    	$data = array(
            'ten' => $tuyen_sinh->getTen(),
            'ten_file' => $tuyen_sinh->getTenFile()
        );
        return $this->insert($data);
    }
    
    public function sua($tuyen_sinh)
    {
    	if($tuyen_sinh->getTenFile() != null){
	    	$data = array(
	            'ten' => $tuyen_sinh->getTen(),
	            'ten_file' => $tuyen_sinh->getTenFile()
	        );
    	}else{
    		$data = array(
            	'ten' => $tuyen_sinh->getTen()
        	);
    	}
        return $this->update($data, 'id = '. (int)$tuyen_sinh->getId());
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
<?php
class Default_Model_DbTable_Backup extends Khcn_Db_Table{
	
	protected $_name = 'backup';
	
	public function getBackup($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getAll()
    {
    	$statement = $this->select()
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }

    public function getFile($id)
    {
    	$cols = array('id','ten_file');
    	$statement = $this->select()
    					  ->from('backup',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    public function them($backup)
    {
    	$data = array(
            'ten_file' => $backup->getTenFile(),
        	'loai' => $backup->getLoai(),
    		'ngay_tao' => $backup->getNgayTao()
        );
        return $this->insert($data);
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}
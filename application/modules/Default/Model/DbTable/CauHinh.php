<?php
class Default_Model_DbTable_CauHinh extends Khcn_Db_Table{
	
	protected $_name = 'cau_hinh';
	
	protected $_rowClass = 'Default_Model_CauHinh';
	
	public function getCauHinh($tu_khoa) 
    {
    	$statement = $this->select()
    					  ->where('tu_khoa = ?',$tu_khoa);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]; 
    }
    
    public function capNhat($tu_khoa,$noi_dung)
    {
    	$data = array(
	            'noi_dung' => $noi_dung,
	    );
	    $where = 'tu_khoa = "' . $tu_khoa . '"';
	    $this->update($data, $where);
    }
}
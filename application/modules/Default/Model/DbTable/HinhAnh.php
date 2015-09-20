<?php
class Default_Model_DbTable_HinhAnh extends Khcn_Db_Table{
	
	protected $_name = 'hinh_anh';
	
	protected $_rowClass = 'Default_Model_HinhAnh';
	
	public function getHinhAnh($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
 	public function getSlideshow()
    {
    	$statement = $this->select()
    					  ->where('trang_thai = ?',1)
						  ->where('slideshow = ?',1);
    	return $this->fetchAll($statement);
    }
}
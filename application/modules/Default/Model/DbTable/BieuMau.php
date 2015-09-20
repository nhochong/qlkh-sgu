<?php
class Default_Model_DbTable_BieuMau extends Khcn_Db_Table{
	
	protected $_name = 'bieu_mau';
	
	protected $_rowClass = 'Default_Model_BieuMau';
	
	public function getBieuMau($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getDSBM()
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
    					  ->order('ma_loai')
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
    					  ->from('bieu_mau',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    public function them($bieu_mau)
    {
    	$data = array(
            'ten' => $bieu_mau->getTen(),
            'ten_file' => $bieu_mau->getTenFile(),
			'ma_loai' => $bieu_mau->getMaLoai(),
        );
        return $this->insert($data);
    }
    
    public function sua($bieu_mau)
    {
    	if($bieu_mau->getTenFile() != null){
	    	$data = array(
	            'ten' => $bieu_mau->getTen(),
	            'ten_file' => $bieu_mau->getTenFile(),
				'ma_loai' => $bieu_mau->getMaLoai(),
	        );
    	}else{
    		$data = array(
            	'ten' => $bieu_mau->getTen(),
				'ma_loai' => $bieu_mau->getMaLoai(),
        	);
    	}
        return $this->update($data, 'id = '. (int)$bieu_mau->getId());
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
	
	public function getDanhSachBieuMau($params = array()){
		$select = $this->select()->where('trang_thai = 1');
		
		if(isset($params['ma_loai']) && !empty($params['ma_loai'])){
			$select->where('ma_loai = ?', $params['ma_loai']);
		}
		
		return $this->fetchAll($select);
	}
	
	public function getBMsByLoai($ma_loai){
		$select = $this->select()->where('ma_loai = ?', $ma_loai);
		return $this->fetchAll($select);
	}
}
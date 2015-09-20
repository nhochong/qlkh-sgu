<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_Hdd extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'hoi_dong_duyet';
	
	protected $_rowClass = 'Default_Model_Hdd';
	
    public function getHDD($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
    public function getAll()
    {
    	$cols = array('id','ma','ngay_thanh_lap','ghi_chu');
    	$tableInfo = array('hdd' => 'hoi_dong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->joinLeft(array('dt' => 'de_tai'),
    					  		'dt.ma_hd_duyet = hdd.id',
    					  		null)
    					  ->joinLeft(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('linh_vuc' => 'lv.ten'))
    					  ->group('hdd.id')
    					  ->order('hdd.id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getLinhVucByHD($id)
    {
    	$cols = array();
    	$tableInfo = array('hdd' => 'hoi_dong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dt' => 'de_tai'),
    					  		'dt.ma_hd_duyet = hdd.id',
    					  		array('ma_linh_vuc' => 'dt.ma_linh_vuc'))
    					  ->where('hdd.id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function loc($params = array())
    {
    	$cols = array('id','ma','ngay_thanh_lap','ghi_chu');
    	$tableInfo = array('hdd' => 'hoi_dong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->joinLeft(array('dt' => 'de_tai'),
    					  		'dt.ma_hd_duyet = hdd.id',
    					  		null)
    					  ->joinLeft(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('linh_vuc' => 'lv.ten'))
    					  ->group('hdd.id');
						  
    	if(!empty($params['ma_linh_vuc'])){
    		$statement->where('lv.id = ?',$params['ma_linh_vuc']);
    	}
    	if(!empty($params['nam'])){
    		$statement->where('SUBSTRING(hdd.ma FROM 4 FOR 4) = ?',$params['nam']);
    	}
		if(!empty($params['order'])){
			if($params['order'] == 'ma'){
				$statement->order("SUBSTRING(hdd.ma FROM 9) " . $params['direction']);
			}else{
				$statement->order($params['order']." ".$params['direction']);
			}
		}else{
    		$statement->order('hdd.id');
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function getDSHDForExport($nam)
    {
    	$cols = array('id','ma','ghi_chu');
    	$tableInfo = array('hdd' => 'hoi_dong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dt' => 'de_tai'),
    					  		'dt.ma_hd_duyet = hdd.id',
    					  		null)
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('linh_vuc' => 'lv.ten'))
    					  ->where('SUBSTRING(hdd.ma FROM 4 FOR 4) = ?',$nam)
    					  ->group('hdd.id');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getDSHDByNam($nam)
    {
    	$cols = array('id','ma');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('SUBSTRING(ma FROM 4 FOR 4) = ?',$nam)
    					  ->order('id');
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
    
	public function them($hdd)
    {
    	$data = array(
    		'ma' => $hdd->getMa(),
            'ngay_thanh_lap' => $hdd->getNgayThanhLap(),
    		'ghi_chu' => $hdd->getGhiChu()
        );
        return $this->insert($data);
    }
    
    public function sua($hdd)
    {
		$data = array(
    		'ma' => $hdd->getMa(),
            'ngay_thanh_lap' => $hdd->getNgayThanhLap(),
    		'ghi_chu' => $hdd->getGhiChu()
        );
        return $this->update($data, 'id = '. (int)$hdd->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_DbTable_Hdnt extends Khcn_Db_Table
{
	/**
	 * The default table name 
	 */
    protected $_name = 'hoi_dong_nghiem_thu';
	
	protected $_rowClass = 'Default_Model_Hdnt';
	
    public function getHDNT($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getAll()
    {
    	$cols = array('id','ma','ngay_thanh_lap','ghi_chu');
    	$tableInfo = array('hdnt' => 'hoi_dong_nghiem_thu');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->joinLeft(array('dt' => 'de_tai'),
    					  		'dt.id = hdnt.ma_de_tai',
    					  		array('id_de_tai' => 'dt.id',
    					  			  'ma_de_tai' => 'dt.ma',
    					  			  'ten_de_tai' => 'dt.ten'
    					  		))
    					  ->joinLeft(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('ten_linh_vuc' => 'lv.ten'))
    					  ->order('hdnt.id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function loc($params = array())
    {
    	$cols = array('id','ma','ngay_thanh_lap','ghi_chu');
    	$tableInfo = array('hdnt' => 'hoi_dong_nghiem_thu');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->joinLeft(array('dt' => 'de_tai'),
    					  		'dt.id = hdnt.ma_de_tai',
    					  		array('id_de_tai' => 'dt.id',
    					  			  'ma_de_tai' => 'dt.ma',
    					  			  'ten_de_tai' => 'dt.ten'
    					  		))
    					  ->joinLeft(array('lv' => 'linh_vuc'),
    					  		'lv.id = dt.ma_linh_vuc',
    					  		array('ten_linh_vuc' => 'lv.ten'));

		if(!empty($params['ma_linh_vuc'])){
    		$statement->where('lv.id = ?',$params['ma_linh_vuc']);
    	}
    	if(!empty($params['nam'])){
    		$statement->where('SUBSTRING(hdnt.ma FROM 5 FOR 4) = ?',$params['nam']);
    	}
		if(!empty($params['order'])){
			if($params['order'] == 'ma'){
				$statement->order("SUBSTRING(hdnt.ma FROM 10) " . $params['direction']);
			}else{
				$statement->order($params['order']." ".$params['direction']);
			}
		}else{
    		$statement->order('hdnt.id');
		}
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getLinhVucByDT($id)
    {
    	$cols = array();
    	$tableInfo = array('hdnt' => 'hoi_dong_nghiem_thu');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->joinLeft(array('dt' => 'de_tai'),
    					  		'dt.id = hdnt.ma_de_tai',
    					  		array('ma_linh_vuc' => 'dt.ma_linh_vuc'
    					  		))
    					  ->where('hdnt.id = ?',$id);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['ma_linh_vuc']; 
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
    
	public function them($hdnt)
    {
    	$data = array(
    		'ma' => $hdnt->getMa(),
            'ma_de_tai' => $hdnt->getMaDeTai(),
            'ngay_thanh_lap' => $hdnt->getNgayThanhLap(),
    		'ghi_chu' => $hdnt->getGhiChu()
        );
        return $this->insert($data);
    }
    
    public function sua($hdnt)
    {
		$data = array(
    		'ma' => $hdnt->getMa(),
            'ma_de_tai' => $hdnt->getMaDeTai(),
            'ngay_thanh_lap' => $hdnt->getNgayThanhLap(),
			'ghi_chu' => $hdnt->getGhiChu()
        );
        return $this->update($data, 'id = '. (int)$hdnt->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
	public function KiemTraDT($ma_de_tai)
    {
    	$ma_de_tai = (int) $ma_de_tai;
        $row = $this->fetchRow('ma_de_tai = ' . $ma_de_tai);
        if($row)
        	return true;
        return false;
    }
}

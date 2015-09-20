<?php
class Default_Model_DbTable_DonVi extends Khcn_Db_Table{
	
	protected $_name = 'don_vi';
	
	protected $_rowClass = 'Default_Model_DonVi';
	
	public function getDonVi($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getTenDonViById($id)
    {
    	$cols = array('ten');
    	$statement = $this->select()
    					  ->from('don_vi',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1);
    	return $this->_db->fetchRow($statement);
    }
    
	public function getIdByMa($ma,$thuoc_sgu = null) 
    {
    	$cols = array('id');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	if($thuoc_sgu != null)
    		$statement->where('thuoc_sgu = ?',$thuoc_sgu);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
    	if($rows)
			return $rows[0]['id'];
		return null;
    }
    
    public function getDSByLaKhoa($laKhoa)
    {
    	$cols = array('id','ten');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('la_khoa = ?',$laKhoa)
    					  ->where('thuoc_sgu = 1')
    					  ->where('id != 1');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getDSDVSGU()
    {
    	$cols = array('id','ten');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('thuoc_sgu = 1')
    					  ->order('la_khoa DESC')
    					  ->order('id');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getDSDVNgoaiSGU()
    {
    	$cols = array('id','ten');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('thuoc_sgu = 0');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getDSDV()
    {
    	$cols = array('id','ten');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->order('thuoc_sgu DESC')
    					  ->order('la_khoa DESC')
    					  ->order('id');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
    public function getAll()
    {
    	$statement = $this->select()
    					  ->order('thuoc_sgu DESC')
    					  ->order('la_khoa DESC')
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
    
	public function them($don_vi)
    {
    	$data = array(
    		'ma' => $don_vi->getMa(),
            'ten' => $don_vi->getTen(),
            'thuoc_sgu' => $don_vi->getThuocSGU(),
    		'la_khoa' => $don_vi->getLaKhoa()
        );
        return $this->insert($data);
    }
    
    public function sua($don_vi)
    {
		$data = array(
    		'ma' => $don_vi->getMa(),
            'ten' => $don_vi->getTen(),
            'thuoc_sgu' => $don_vi->getThuocSGU(),
    		'la_khoa' => $don_vi->getLaKhoa()
        );
        return $this->update($data, 'id = '. (int)$don_vi->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
	
	public function getDonVisAssoc($params = array()){
		$datas = array();
		$datas[''] = '';
		$select = $this->select();
		if(isset($params['thuoc_sgu']) && !empty($params['thuoc_sgu'])){
			$select->where('thuoc_sgu = ?', $params['thuoc_sgu']);
		}
		if(isset($params['la_khoa']) && !empty($params['la_khoa'])){
			$select->where('la_khoa = ?', $params['la_khoa']);
		}
		$results = $this->fetchAll($select);
		foreach($results as $result){
			$datas[$result->id] = $result->ten;
		}
		return $datas;
	}
}
<?php
class Default_Model_DbTable_NguoiDung extends Khcn_Db_Table {
	
	protected $_name = 'nguoi_dung';
	
	protected $_rowClass = 'Default_Model_NguoiDung';
	
	public function getNguoiDung($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('enabled DESC')
    					  ->order('ngay_tao DESC');
    	$rows = $this->fetchAll($statement);
		return $rows; 
    }
    
	public function getDSViPham()
    {
    	$statement = $this->select()
    					  ->where('enabled = ?',0)
    					  ->order('enabled DESC');
    	$rows = $this->fetchAll($statement);
		return $rows;
    }
    
	public function kiem_tra_user($user)
    {
    	$statement = $this->select()
    					  ->where('ten_dang_nhap = ?',$user)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }

	public function kiem_tra_email($email,$id)
    {
    	$statement = $this->select()
    					  ->where('email = ?',$email)
    					  ->limit(1,0);
    	if($id != null)
    		$statement->where('id != ?',$id);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
        if(!$row)
        	return false;
        return true;
    }
    
	public function CapNhatTT($id,$status)
    {
    	$data = array(
	            'enabled' => 1 - $status,
	        );
	    return $this->update($data, 'id = '. (int)$id);
    }
    
	public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
    public function getNDByTDN($ten_dang_nhap)
    {
    	$row = $this->fetchRow('ten_dang_nhap = "' . $ten_dang_nhap . '"');
        return $row;
    }
	
	public function getNguoiDungByMaGiangVien($ma_giang_vien){
		$tableGV = Khcn_Api::_()->getDbTable('giang_vien', 'default');
		$selectGV = $tableGV->select()->where('ma = ?', $ma_giang_vien);
		$rowGV = $tableGV->fetchRow($selectGV);
		if($rowGV === null)
			return null;
		$select = $this->select()->where('giang_vien_id = ?', $rowGV->getIdentity())->limit(1);
		return $this->fetchRow($select);
	}
	
	public function getByGiangVien($giang_vien_id){
		$select = $this->select()->where('giang_vien_id = ?', $giang_vien_id)->limit(1);
		return $this->fetchRow($select);
	}
}

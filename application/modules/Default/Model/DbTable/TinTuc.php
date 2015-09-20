<?php
class Default_Model_DbTable_TinTuc extends Khcn_Db_Table{
	
	protected $_name = 'tin_tuc';
	
	protected $_rowClass = 'Default_Model_TinTuc';
	
	public function getTinTuc($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
	
    public function danhsachhienthi($params = array())
    {
		$select = $this->select()
						->where('trang_thai = 1')
						->order('noi_bat DESC')
						->order('ngay_tao DESC');
						
		if(!empty($params['limit'])){
			$select->limit($params['limit']);
		}
		return $this->fetchAll($select);
    }
    
	public function GetDSTT()
    {
    	$cols = array('id','tieu_de','mo_ta_tom_tat','ngay_tao','file');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function GetDSTTForRSS()
    {
    	$cols = array('id','tieu_de','mo_ta_tom_tat','ngay_tao');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->order('ngay_tao DESC')
    					  ->limit(15,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
    public function GetTinTucKhac($id1,$id2)
    {
    	$cols = array('id','tieu_de','ngay_tao');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('trang_thai = ?','1')
    					  ->where('id != ?',$id1)
    					  ->where('id != ?',$id2)
    					  ->order('ngay_tao DESC')
    					  ->limit(3,0);
    	$result = $this->_db->query($statement);
    	$row = $result->fetchAll();
    	return $row;
    }
    
	public function getFile($id)
    {
    	$cols = array('id','file');
    	$statement = $this->select()
    					  ->from('tin_tuc',$cols)
    					  ->where('id = ?',$id)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows;
    }
    
	public function getAll()
    {
    	$statement = $this->select()
    					  ->order('trang_thai DESC')
    					  ->order('ngay_tao DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function them($tin_tuc)
    {
    	$mo_ta_chi_tiet = Default_Model_Functions::strip_magic_slashes($tin_tuc->getMoTaChiTiet());
    	$data = array(
    				 'tieu_de' => $tin_tuc->getTieuDe(),
    				 'file' => $tin_tuc->getHinh(),
    				 'trang_thai' => $tin_tuc->getTrangThai(),
    				 'mo_ta_tom_tat' => $tin_tuc->getMoTaTomTat(),
    				 'mo_ta_chi_tiet' => $mo_ta_chi_tiet,
    				 'ngay_tao' => $tin_tuc->getNgayTao(),
    				 'ma_quan_tri' => $tin_tuc->getMaQuanTri(),
    				 'so_lan_xem' => 1,
        );
        return $this->insert($data);
    }
    
    public function sua($tin_tuc)
    {
    	$mo_ta_chi_tiet = Default_Model_Functions::strip_magic_slashes($tin_tuc->getMoTaChiTiet());
    	if($tin_tuc->getHinh() != null){
	    	$data = array(
    				 'tieu_de' => $tin_tuc->getTieuDe(),
    				 'file' => $tin_tuc->getHinh(),
    				 'trang_thai' => $tin_tuc->getTrangThai(),
    				 'mo_ta_tom_tat' => $tin_tuc->getMoTaTomTat(),
    				 'mo_ta_chi_tiet' => $mo_ta_chi_tiet,  				 
        	);
    	}else{
    		$data = array(
    				 'tieu_de' => $tin_tuc->getTieuDe(),
    				 'trang_thai' => $tin_tuc->getTrangThai(),
    				 'mo_ta_tom_tat' => $tin_tuc->getMoTaTomTat(),
    				 'mo_ta_chi_tiet' => $mo_ta_chi_tiet,
        	);
    	}		
        return $this->update($data, 'id = '. (int)$tin_tuc->getId());
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
    
	public function CapNhatSLX($id,$so_lan_xem)
    {
    	$data = array(
	            'so_lan_xem' => $so_lan_xem + 1,
	        );
	    return $this->update($data, 'id = '. (int)$id);
    }
	
	public function getTinTucs($params = array()){
		$select = $this->select();
		
		if(isset($params['trang_thai'])){
			$select->where('trang_thai = ?', $params['trang_thai']);
		}
		
		if(isset($params['quan_trong'])){
			$select->where('quan_trong = ?', $params['quan_trong']);
		}
		
		if(isset($params['noi_bat'])){
			$select->where('noi_bat = ?', $params['noi_bat']);
		}
		
		if(isset($params['not_ids']) && !empty($params['not_ids'])){
			$select->where('id not in (?)', $params['not_ids']);
		}
		
		if(isset($params['order'])){
			$direction = isset($params['direction']) ? $params['direction'] : 'DESC';
			$select->order($params['order'] . ' ' . $direction);
		}else{
			$select->order('ngay_tao DESC');
		}
		
		if(isset($params['limit']) && !empty($params['limit'])){
			$select->limit($params['limit']);
		}
		
		return $this->fetchAll($select);
	}
	
	
}
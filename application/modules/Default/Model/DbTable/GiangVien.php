<?php
class Default_Model_DbTable_GiangVien extends Khcn_Db_Table{
	
	protected $_name = 'giang_vien';
	
	protected $_rowClass = 'Default_Model_GiangVien';
	
	public function getGiangVien($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            return null;
        }
        return $row;
    }
    
	public function getIdByMa($ma) 
    {
    	$cols = array('id');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('ma = ?',$ma)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows[0]['id'];
    }
    
	public function getGVByMa($ma)
    {
    	$ma = '"' . $ma . '"';
        $row = $this->fetchRow('ma = ' . $ma);
        return $row;
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
    
	public function KiemTraHV($ma_hoc_vi)
    {
    	$ma_hoc_vi = (int) $ma_hoc_vi;
        $row = $this->fetchRow('ma_hoc_vi = ' . $ma_hoc_vi);
        if($row)
        	return true;
        return false;
    }
    
	public function KiemTraDV($ma_don_vi)
    {
    	$ma_don_vi = (int) $ma_don_vi;
        $row = $this->fetchRow('ma_don_vi = ' . $ma_don_vi);
        if($row)
        	return true;
        return false;
    }
    
	public function getAll()
    {
    	$cols = array('id','ma','ho','ten','chuc_vu','trang_thai');
    	$tableInfo = array('gv' => 'giang_vien');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array( 'dv' => 'don_vi'),
    					  		 'dv.id = gv.ma_don_vi',
    					  		 array('ten_don_vi' => 'dv.ten')
    					  		)
    					  ->order('trang_thai DESC')
    					  ->order('ma_don_vi')
    					  ->order('gv.id');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function them($giang_vien)
    {
    	$data = array(
    				 'ma' => $giang_vien->getMa(),
    				 'ho' => $giang_vien->getHo(),
    				 'ten' => $giang_vien->getTen(),
    				 'email' => $giang_vien->getEmail(),
    				 'so_dien_thoai' => $giang_vien->getSoDienThoai(),
    				 'chuc_vu' => $giang_vien->getChucVu(),
    				 'ma_don_vi' => $giang_vien->getMaDonVi(),
    				 'ma_hoc_vi' => $giang_vien->getMaHocVi(),
        );
        return $this->insert($data);
    }
    
    public function sua($giang_vien)
    {
    	$data = array(
    				 'ma' => $giang_vien->getMa(),
    				 'ho' => $giang_vien->getHo(),
    				 'ten' => $giang_vien->getTen(),
    				 'email' => $giang_vien->getEmail(),
    				 'so_dien_thoai' => $giang_vien->getSoDienThoai(),
    				 'chuc_vu' => $giang_vien->getChucVu(),
    				 'ma_don_vi' => $giang_vien->getMaDonVi(),
    				 'ma_hoc_vi' => $giang_vien->getMaHocVi(),
        );
        return $this->update($data, 'id = '. (int)$giang_vien->getId());
    }
    
	public function cap_nhat($id,$conds)
    {
    	$data = array();
    	if($conds != null)
    		foreach ($conds as $k=>$v){
    			$data[$k] = $v;
    		}
    	return $this->update($data, 'id = '. (int)$id);
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
    public function loc($params = array())
    {
    	$cols = array('id','ma','ho','ten','chuc_vu','trang_thai');
    	$tableInfo = array('gv' => 'giang_vien');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array( 'dv' => 'don_vi'),
    					  		 'dv.id = gv.ma_don_vi',
    					  		 array('ten_don_vi' => 'dv.ten')
    					  		)
    					  ->order('trang_thai DESC')
    					  ->order('ma_don_vi');
    	if(!empty($params['ma']))
    		$statement->where('gv.ma = ?',$params['ma']);
    	if(!empty($params['ma_don_vi']))
    	{
			$statement->where('gv.ma_don_vi = ?',$params['ma_don_vi']);
    	}
    	if(!empty($params['ho']))
    		$statement->where('gv.ho LIKE ?', '%' . $params['ho'] . '%');
    	if(!empty($params['ten']))
    		$statement->Where('gv.ten LIKE ?', $params['ten']);
    	if(!empty($params['order'])){
			if($params['order'] == 'ho_ten'){
				$statement->order("gv.ten " . $params['direction']);
				//$statement->order("gv.ho " . $params['direction']);
			}else{
				$statement->order($params['order']." ".$params['direction']);
			}
		}else{
    		$statement->order('gv.id');
		}
		
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getDSGVByDV($ma_don_vi)
    {
    	$cols = array('id','ma','ho','ten');
    	$tableInfo = array('gv' => 'giang_vien');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->where('trang_thai = 1')
    					  ->order('ten');
    	if($ma_don_vi != '0')
    		$statement->where('ma_don_vi = ?',$ma_don_vi);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    
	public function getDSDTByGV($ho_ten,$ma_don_vi)
    {
    	$ho_ten = Default_Model_Functions::tach_ho_ten($ho_ten);
    	$ho = $ho_ten['ho'];
    	$ten = $ho_ten['ten'];
    	
    	$cols = array();
    	$tableInfo = array('gv' => 'giang_vien');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('dk' => 'dang_ky'),
    					  		'gv.id = dk.ma_giang_vien',null)
    					  ->join(array('dt' => 'de_tai'),
    					  		'dk.ma_de_tai = dt.id',
    					  		array('id' => 'dt.id',
    					  			  'ma' => 'dt.ma',
    					  			  'ten' => 'dt.ten',
    					  			  'thoi_gian_bat_dau' => 'dt.thoi_gian_bat_dau',
    					  			  'tinh_trang' => 'dt.tinh_trang'
    					  		))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array('lv' => 'linh_vuc'),
    					  		'dt.ma_linh_vuc = lv.id',
    					  		array('linh_vuc' => 'lv.ten'
    					  		))
    					  ->order('thoi_gian_bat_dau DESC');
    	if($ho != null)
    		$statement->where('gv.ho = ?',$ho);
    	if($ten != null)
    		$statement->where('gv.ten = ?',$ten);
    	if($ma_don_vi != '0')
    		$statement->where('gv.ma_don_vi = ?',$ma_don_vi);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function kiem_tra_giang_vien($ho_ten,$ma_don_vi,$ma_hoc_vi)
    {
    	$ho_ten = Default_Model_Functions::tach_ho_ten($ho_ten);
    	$ho = $ho_ten['ho'];
    	$ten = $ho_ten['ten'];
    	
    	$cols = array('id');
    	$tableInfo = array('gv' => 'giang_vien');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		null)
						  ->where('gv.ma is null')
    					  ->limit(1,0);
    	if($ho != null)
    		$statement->where('gv.ho = ?',$ho);
    	if($ten != null)
    		$statement->where('gv.ten = ?',$ten);
    	if($ma_don_vi != null)
    		$statement->where('gv.ma_don_vi = ?',$ma_don_vi);
		if($ma_hoc_vi != null)
			$statement->where('hv.id = ?',$ma_hoc_vi);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		if($rows)
			return $rows[0]['id'];
		return null;
    }
    
	public function getGVNgoaiSGU()
    {
    	$cols = array('id','ho','ten','chuc_vu','trang_thai');
    	$tableInfo = array('gv' => 'giang_vien');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->where('ma_don_vi = 33')
    					  ->order('trang_thai DESC')
    					  ->order('gv.id DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
	
	public function getGiangVienByOptions($params = array()){
		$select = $this->select();
		if(!empty($params['ma_giang_vien'])){
			$select->where('ma = ?', $params['ma_giang_vien']);
		}
		$row = $this->fetchRow($select);
		if($row)
			return $row;
		return null;
	}
	
	public function getGiangViensByDonVi($don_vi_id){
		$select = $this->select()->where('ma_don_vi = ?', $don_vi_id);
		return $this->fetchAll($select);
	}
	
	public function getGiangViensByDonViAssoc($don_vi_id){
		$giangViens = $this->getGiangViensByDonVi($don_vi_id);
		$datas = array();
		foreach($giangViens as $giang_vien){
			$datas[$giang_vien->getIdentity()] = $giang_vien->getDisplayname();
		}
		return $datas;
	}
	
	public function checkExistImport($ho_ten, $ma_don_vi = null, $ma_hoc_vi = null){
		$ho_ten = Default_Model_Functions::tach_ho_ten($ho_ten);
    	$ho = $ho_ten['ho'];
    	$ten = $ho_ten['ten'];
		
		$select = $this->select()
						->where("ho = ?", $ho)
						->where("ten = ?", $ten);
						
		if(!empty($ma_don_vi)){
			$select->where("ma_don_vi = ?", $ma_don_vi);
		}
		
		if(!empty($ma_hoc_vi)){
			$select->where("ma_hoc_vi = ?", $ma_hoc_vi);
		}
		
		$row = $this->fetchRow($select);
		if($row)
			return $row;
		return null;
	}
	
	public function isExist($params = array()){
		$select = $this->select();
		if(isset($params['ma_giang_vien']) && !empty($params['ma_giang_vien'])){
			$select->orWhere('ma = ?', $params['ma_giang_vien']);
		}
		return $this->fetchRow($select);
	}
	
	public function getGiangVienByHoTen($ho_ten){
		$ho_ten = Default_Model_Functions::tach_ho_ten($ho_ten);
    	$ho = $ho_ten['ho'];
    	$ten = $ho_ten['ten'];
		var_dump($ho_ten);
		$select = $this->select()
						->where('ho = ?', $ho)
						->where('ten = ?', $ten);
		echo $select;die;
		return $this->fetchRow($select);
	}
}
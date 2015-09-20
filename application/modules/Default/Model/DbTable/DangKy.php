<?php
class Default_Model_DbTable_DangKy extends Khcn_Db_Table{
	
	protected $_name = 'dang_ky';
	
	protected $_rowClass = 'Default_Model_DangKy';
	
	public function getDangKy($id) 
    {
    	$id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        return $row;
    }
    
	public function KiemTraGV($ma_giang_vien)
    {
    	$ma_giang_vien = (int) $ma_giang_vien;
        $row = $this->fetchRow('ma_giang_vien = ' . $ma_giang_vien);
        if($row)
        	return true;
        return false;
    }
    
	public function KiemTraDT($ma_de_tai)
    {
    	$ma_de_tai = (int) $ma_de_tai;
        $row = $this->fetchRow('ma_de_tai = ' . $ma_de_tai);
        if($row)
        	return true;
        return false;
    }
    
    public function getDSDKByMaDeTai($ma_de_tai)
    {
    	$cols = array('nhiem_vu');
    	$tableInfo = array('dk' => 'dang_ky');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'dk.ma_giang_vien = gv.id',
    					  		 array(
									   'id_gv' => 'gv.id',
									   'ho_gv' => 'gv.ho',
    					  		 	   'ten_gv' => 'gv.ten',
    					  		 	   'ma_gv' => 'gv.ma'))
    					  ->join(array('hv' => 'hoc_vi'),
    					  		'hv.id = gv.ma_hoc_vi',
    					  		array('hoc_vi' => 'hv.ma'
    					  		))
    					  ->join(array( 'dv' => 'don_vi'),
    					  		 'dv.id = gv.ma_don_vi',
    					  		 array('ten_don_vi' => 'dv.ten')
    					  		)
    					  ->where('ma_de_tai = ?',$ma_de_tai)
    					  ->order('nhiem_vu DESC');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function getChuNhiemDT($ma_de_tai)
    {
    	$cols = array('ma_giang_vien');
    	$tableInfo = array('dk' => 'dang_ky');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'dk.ma_giang_vien = gv.id',
    					  		 array('ho' => 'gv.ho',
    					  		 	   'ten' => 'gv.ten',
    					  		 ))
    					  ->join(array( 'hv' => 'hoc_vi'), 
    					  		 'gv.ma_hoc_vi = hv.id',
    					  		 array('hoc_vi' => 'hv.ma',
    					  		 ))
    					  ->where('ma_de_tai = ?',$ma_de_tai)
    					  ->where('nhiem_vu = ?',1)
    					  ->limit(1,0);
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getDSTVByDT($ma_de_tai)
    {
    	$cols = array('ma_giang_vien');
    	$tableInfo = array('dk' => 'dang_ky');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'dk.ma_giang_vien = gv.id',
    					  		 array('ma_don_vi' => 'gv.ma_don_vi'))
    					  ->where('ma_de_tai = ?',$ma_de_tai)
    					  ->where('nhiem_vu = 0');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getMaChuNhiemByDT($ma_de_tai)
    {
    	$cols = array('ma_giang_vien');
    	$statement = $this->select()
    					  ->from($this->_name,$cols)
    					  ->where('ma_de_tai = ?',(int)$ma_de_tai)
    					  ->where('nhiem_vu = 1');
		return $this->fetchRow($statement); 
    }
    
	public function them($dang_ky)
    {
    	$data = array(
    		'ma_de_tai' => $dang_ky->getMaDeTai(),
            'ma_giang_vien' => $dang_ky->getMaGiangVien(),
            'nhiem_vu' => $dang_ky->getNhiemVu()
        );
        return $this->insert($data);
    }
    
    public function sua($dang_ky)
    {
    	$data = array(
    		'ma_de_tai' => $dang_ky->getMaDeTai(),
            'ma_giang_vien' => $dang_ky->getMaGiangVien(),
            'nhiem_vu' => $dang_ky->getNhiemVu()
        );
        return $this->update($data, 'id = '. (int)$dang_ky->getId());
    }
    
	public function sua_chu_nhiem($dang_ky)
    {  	
    	$data = array(
            'ma_giang_vien' => $dang_ky->getMaGiangVien(),
        );
        return $this->update($data, 'nhiem_vu = 1 and ma_de_tai = '. (int)$dang_ky->getMaDeTai());
    }
    
	public function xoa_dk_by_mdt($ma_de_tai)
    {
    	return $this->delete('ma_de_tai =' . (int)$ma_de_tai);
    }
    
	public function xoa_tv_by_mdt($ma_de_tai)
    {
    	return $this->delete('nhiem_vu != 1 and ma_de_tai =' . (int)$ma_de_tai);
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
	public function setChucVu($ma_de_tai, $thanhViens){
		$select = $this->select()
						->where('ma_de_tai = ?', $ma_de_tai);
		$rows = $this->fetchAll($select);
		foreach($rows as $row){
			$row->delete();
		}
		
		foreach($thanhViens as $thanh_vien){
			$row = $this->createRow();
			$row->ma_de_tai = $ma_de_tai;
			$row->ma_giang_vien = $thanh_vien['giang_vien_id'];
			$row->nhiem_vu = $thanh_vien['nhiem_vu'];
			$row->save();
		}
	}
	
	public function getThanhViens($params = array()){
		$select = $this->select();
		if(!empty($params['ma_de_tai'])){
			$select->where('ma_de_tai = ?', $params['ma_de_tai']);
		}
		if(!empty($params['ma_giang_vien'])){
			$select->where('ma_giang_vien = ?', $params['ma_giang_vien']);
		}
		if(isset($params['nhiem_vu'])){
			$select->where('nhiem_vu = ?', $params['nhiem_vu']);
		}
		return $this->fetchAll($select);
	}
}
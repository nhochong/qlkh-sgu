<?php
class Default_Model_DbTable_Pcd extends Khcn_Db_Table{
	
	protected $_name = 'phan_cong_duyet';
	
	public function getPCD($id) 
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
    
	public function KiemTraHD($ma_hd_duyet)
    {
    	$ma_hd_duyet = (int) $ma_hd_duyet;
        $row = $this->fetchRow('ma_hd_duyet = ' . $ma_hd_duyet);
        if($row)
        	return true;
        return false;
    }
    
	public function getDSGVByHDD($ma_hd_duyet)
    {
    	$cols = array('ma_giang_vien','chuc_danh');
    	$tableInfo = array('pcd' => 'phan_cong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'pcd.ma_giang_vien = gv.id',
    					  		 array('ma_don_vi' => 'gv.ma_don_vi'))
    					  ->where('ma_hd_duyet = ?',$ma_hd_duyet)
    					  ->order('chuc_danh');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function getCTTKByHDD($ma_hd_duyet){
    	$cols = array('chuc_danh');
    	$tableInfo = array('pcd' => 'phan_cong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'pcd.ma_giang_vien = gv.id',
    					  		 array(	'ho_gv' => 'gv.ho',
    					  		 	    'ten_gv' => 'gv.ten'
    					  		 ))
    					  ->join(array( 'hv' => 'hoc_vi'), 
    					  		 'gv.ma_hoc_vi = hv.id',
    					  		 array(	'hoc_vi' => 'hv.ma',
    					  		 ))
    					  ->where('ma_hd_duyet = ?',$ma_hd_duyet)
    					  ->where('chuc_danh = 0 || chuc_danh = 2')
    					  ->order('chuc_danh');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 	
    }
    
	public function getDSGVForExport($ma_hd_duyet)
    {
    	$cols = array('chuc_danh');
    	$tableInfo = array('pcd' => 'phan_cong_duyet');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'pcd.ma_giang_vien = gv.id',
    					  		 array( 'ho_gv' => 'gv.ho',
    					  		 		'ten_gv' => 'gv.ten',
    					  		 		'chuc_vu' => 'gv.chuc_vu'
    					  		 ))
    					  ->join(array( 'hv' => 'hoc_vi'), 
    					  		 'gv.ma_hoc_vi = hv.id',
    					  		 array( 'ma_hoc_vi' => 'hv.ma'
    					  		 ))
    					  ->join(array( 'dv' => 'don_vi'), 
    					  		 'gv.ma_don_vi = dv.id',
    					  		 array( 'thuoc_sgu' => 'dv.thuoc_sgu',
    					  		 		'ten_don_vi' => 'dv.ten'
    					  		 ))
    					  ->where('ma_hd_duyet = ?',$ma_hd_duyet)
    					  ->order('chuc_danh');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
    public function them($pc_duyet)
    {
    	$data = array(
    		'chuc_danh' => $pc_duyet->getChucDanh(),
            'ma_giang_vien' => $pc_duyet->getMaGiangVien(),
            'ma_hd_duyet' => $pc_duyet->getMaHdDuyet()
        );
        return $this->insert($data);
    }
    
    public function sua($pc_duyet)
    {
    	$data = array(
    		'chuc_danh' => $pc_duyet->getChucDanh(),
            'ma_giang_vien' => $pc_duyet->getMaGiangVien(),
            'ma_hd_duyet' => $pc_duyet->getMaHdDuyet()
        );
        return $this->update($data, 'id = '. (int)$pc_duyet->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
    
	public function xoa_tv_by_mhd($ma_hd_duyet)
    {
    	return $this->delete('ma_hd_duyet =' . (int)$ma_hd_duyet);
    }
}
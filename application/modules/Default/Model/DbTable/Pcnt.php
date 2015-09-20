<?php
class Default_Model_DbTable_Pcnt extends Khcn_Db_Table{
	
	protected $_name = 'phan_cong_nghiem_thu';
	
	public function getPCNT($id) 
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
    
	public function KiemTraHD($ma_hd_nghiem_thu)
    {
    	$ma_hd_nghiem_thu = (int) $ma_hd_nghiem_thu;
        $row = $this->fetchRow('ma_hd_nghiem_thu = ' . $ma_hd_nghiem_thu);
        if($row)
        	return true;
        return false;
    }
    
	public function getDSGVByHDNT($ma_hd_nghiem_thu)
    {
    	$cols = array('ma_giang_vien','chuc_danh');
    	$tableInfo = array('pcnt' => 'phan_cong_nghiem_thu');
    	$statement = $this->select()
    					  ->setIntegrityCheck(false)
    					  ->from($tableInfo,$cols)
    					  ->join(array( 'gv' => 'giang_vien'), 
    					  		 'pcnt.ma_giang_vien = gv.id',
    					  		 array('ma_don_vi' => 'gv.ma_don_vi'))
    					  ->where('ma_hd_nghiem_thu = ?',$ma_hd_nghiem_thu)
    					  ->order('chuc_danh');
    	$result = $this->_db->query($statement);
    	$rows = $result->fetchAll();
		return $rows; 
    }
    
	public function xoa_tv_by_mhd($ma_hd_nghiem_thu)
    {
    	return $this->delete('ma_hd_nghiem_thu =' . (int)$ma_hd_nghiem_thu);
    }
    
    public function them($pc_nghiem_thu)
    {
    	$data = array(
    		'chuc_danh' => $pc_nghiem_thu->getChucDanh(),
            'ma_giang_vien' => $pc_nghiem_thu->getMaGiangVien(),
            'ma_hd_nghiem_thu' => $pc_nghiem_thu->getMaHdNghiemThu()
        );
        return $this->insert($data);
    }
    
    public function sua($pc_nghiem_thu)
    {
    	$data = array(
    		'chuc_danh' => $pc_nghiem_thu->getChucDanh(),
            'ma_giang_vien' => $pc_nghiem_thu->getMaGiangVien(),
            'ma_hd_nghiem_thu' => $pc_nghiem_thu->getMaHdNghiemThu()
        );
        return $this->update($data, 'id = '. (int)$pc_nghiem_thu->getId());
    }
    
    public function xoa($id)
    {
    	return $this->delete('id =' . (int)$id);
    }
}
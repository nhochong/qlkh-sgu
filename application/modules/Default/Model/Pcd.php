<?php
class Default_Model_Pcd extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_chuc_danh;
	private $_ma_giang_vien;
	private $_ma_hd_duyet;
	protected $pc_duyet = null;
	
	public function init()
    {
    	$this->pc_duyet = new Default_Model_DbTable_Pcd();	
    }
    
	public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }    
    public function getId()
    {
        return $this->_id;
    }
    
	public function setChucDanh($chuc_danh)
    {
        $this->_chuc_danh = $chuc_danh;
        return $this;
    }    
    public function getChucDanh()
    {
        return $this->_chuc_danh;
    }
    
	public function setMaGiangVien($ma_giang_vien)
    {
        $this->_ma_giang_vien = $ma_giang_vien;
        return $this;
    }    
    
    public function getMaGiangVien()
    {
        return $this->_ma_giang_vien;
    }
    
	public function setMaHdDuyet($ma_hd_duyet)
    {
        $this->_ma_hd_duyet = $ma_hd_duyet;
        return $this;
    }    
    public function getMaHdDuyet()
    {
        return $this->_ma_hd_duyet;
    }   
    
	public function them()
    {
    	return $this->pc_duyet->them($this);
    }
    
    public function sua()
    {
    	return $this->pc_duyet->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->pc_duyet->xoa($id);
    }
    
	public function KiemTraGV($ma_giang_vien)
    {
    	return $this->pc_duyet->KiemTraGV($ma_giang_vien);
    }

	public function KiemTraHD($ma_hd_duyet)
    {
    	return $this->pc_duyet->KiemTraHD($ma_hd_duyet);
    }
    
    public function getDSGVByHDD($ma_hd_duyet)
    {
    	$thanhViens = $this->pc_duyet->getDSGVByHDD($ma_hd_duyet);
    	$result = array();
    	foreach ($thanhViens as $thanh_vien)
    	{
    		$result[] = array('ma_giang_vien' => $thanh_vien['ma_giang_vien'],
    						  'ma_don_vi' => $thanh_vien['ma_don_vi'],
    						  'chuc_danh' => $thanh_vien['chuc_danh']
    		);
    	}
    	return $result;
    }
    
    public function getCTTKByHDD($ma_hd_duyet){
    	$thanhViens = $this->pc_duyet->getCTTKByHDD($ma_hd_duyet);
    	$result = array();
    	foreach ($thanhViens as $thanh_vien)
    	{
    		$result[] = array('ho_ten' => $thanh_vien['ho_gv'] . ' ' . $thanh_vien['ten_gv'],
    						  'hoc_vi' => $thanh_vien['hoc_vi'] == '0' ? '' : $thanh_vien['hoc_vi'] . '. ',
    						  'chuc_danh' => $thanh_vien['chuc_danh']
    		);
    	}
    	return $result;	
    }
    
    public function capNhatTV($ma_hd_duyet,$thanhViens)
    {
    	$this->pc_duyet->xoa_tv_by_mhd($ma_hd_duyet);
    	foreach ($thanhViens as $thanh_vien)
    	{
    		$pc_duyet = new Default_Model_Pcd();
			$pc_duyet->setMaGiangVien($thanh_vien['ma_giang_vien'])
					 ->setMaHdDuyet($ma_hd_duyet)
					 ->setChucDanh($thanh_vien['chuc_danh']);
			$pc_duyet->them();
    	}
    }
    
    public function xoa_tv_by_mhd($ma_hd_duyet)
    {
    	return $this->pc_duyet->xoa_tv_by_mhd($ma_hd_duyet);
    }
    
    public function getDSGVForExport($ma_hd_duyet)
    {
    	$thanhViens = $this->pc_duyet->getDSGVForExport($ma_hd_duyet);
    	$result = array();
    	foreach ($thanhViens as $thanh_vien)
    	{
    		$result[] = array('chuc_danh' => $thanh_vien['chuc_danh'],
    						  'ma_hoc_vi' => $thanh_vien['ma_hoc_vi'],
    						  'ho_ten' => $thanh_vien['ho_gv'] . ' ' . $thanh_vien['ten_gv'],
    						  'chuc_vu' => $thanh_vien['chuc_vu'],
    						  'don_vi' => $thanh_vien['thuoc_sgu'] == 1 ? 'Trường ĐH Sài Gòn' : $thanh_vien['ten_don_vi'] 
    		);
    	}
    	return $result;
    }
}
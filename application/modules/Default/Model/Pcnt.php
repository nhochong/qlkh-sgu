<?php
class Default_Model_Pcnt extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_chuc_danh;
	private $_ma_giang_vien;
	private $_ma_hd_nghiem_thu;
	protected $pc_nghiem_thu = null;
	
	public function init()
    {
    	$this->pc_nghiem_thu = new Default_Model_DbTable_Pcnt();	
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
    
	public function setMaHdNghiemThu($ma_hd_nghiem_thu)
    {
        $this->_ma_hd_nghiem_thu = $ma_hd_nghiem_thu;
        return $this;
    }    
    public function getMaHdNghiemThu()
    {
        return $this->_ma_hd_nghiem_thu;
    }   
    
	public function them()
    {
    	return $this->pc_nghiem_thu->them($this);
    }
    
    public function sua()
    {
    	return $this->pc_nghiem_thu->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->pc_nghiem_thu->xoa($id);
    }
    
	public function KiemTraGV($ma_giang_vien)
    {
    	return $this->pc_nghiem_thu->KiemTraGV($ma_giang_vien);
    }

	public function KiemTraHD($ma_hd_nghiem_thu)
    {
    	return $this->pc_nghiem_thu->KiemTraHD($ma_hd_nghiem_thu);
    }
    
	public function getDSGVByHDNT($ma_hd_nghiem_thu)
    {
    	$thanhViens = $this->pc_nghiem_thu->getDSGVByHDNT($ma_hd_nghiem_thu);
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
    
    public function capNhatTV($ma_hd_nghiem_thu,$thanhViens)
    {
    	$this->pc_nghiem_thu->xoa_tv_by_mhd($ma_hd_nghiem_thu);
    	foreach ($thanhViens as $thanh_vien)
    	{
    		$pc_nghiem_thu = new Default_Model_Pcnt();
			$pc_nghiem_thu->setMaGiangVien($thanh_vien['ma_giang_vien'])
					 	  ->setMaHdNghiemThu($ma_hd_nghiem_thu)
					 	  ->setChucDanh($thanh_vien['chuc_danh']);
			$pc_nghiem_thu->them();
    	}
    }
    
    public function xoa_tv_by_mhd($ma_hd_nghiem_thu)
    {
    	return $this->pc_nghiem_thu->xoa_tv_by_mhd($ma_hd_nghiem_thu);
    }
}
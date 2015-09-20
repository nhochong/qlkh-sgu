<?php
class Default_Model_DangKy extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ma_de_tai;
	private $_ma_giang_vien;
	private $_nhiem_vu;
	protected $dang_ky = null;
	
	public function init()
    {
    	$this->dang_ky = new Default_Model_DbTable_DangKy();	
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
    
	public function setMaDeTai($maDeTai)
    {
        $this->_ma_de_tai = $maDeTai;
        return $this;
    }    
    public function getMaDeTai()
    {
        return $this->_ma_de_tai;
    }
    
	public function setMaGiangVien($maGiangVien)
    {
        $this->_ma_giang_vien = $maGiangVien;
        return $this;
    }    
    public function getMaGiangVien()
    {
        return $this->_ma_giang_vien;
    }
    
	public function setNhiemVu($nhiemVu)
    {
        $this->_nhiem_vu = $nhiemVu;
        return $this;
    }    
    public function getNhiemVu()
    {
        return $this->_nhiem_vu;
    }
    

    public function getAll()
    {
    	return $this->dang_ky->fetchAll();
    }
    
    public function getDangKy($id)
    {
    	return $this->dang_ky->getDangKy($id);
    }
    
    public function getDSDKByMaDeTai($ma_de_tai)
    {
    	$dangKys = $this->dang_ky->getDSDKByMaDeTai($ma_de_tai);
    	$dsDangKys = array();
    	$nhiemVus = Default_Model_Constraints::dangky_nhiemvu();
    	foreach ($dangKys as $dang_ky)
    	{
    		$dsDangKys[] = array(
								 'id' => $dang_ky['id_gv'],
								 'ma_thanh_vien' => $dang_ky['ma_gv'],
    							 'ten_don_vi' => $dang_ky['ten_don_vi'],
    							 'hoc_vi' => ($dang_ky['hoc_vi']) == '0' ? '' : $dang_ky['hoc_vi'] . '. ',
    							 'ten_thanh_vien' => $dang_ky['ho_gv'] . ' ' . $dang_ky['ten_gv'],
    							 'nhiem_vu' => $nhiemVus[$dang_ky['nhiem_vu']]
    							);
    	}
    	return $dsDangKys; 
    }
    
    public function getChuNhiemDT($ma_de_tai)
    {
    	$chuNhiem = $this->dang_ky->getChuNhiemDT($ma_de_tai);
    	return array(
    				'id' => $chuNhiem[0]['ma_giang_vien'],
    				'hoc_vi' => ($chuNhiem[0]['hoc_vi']) == '0' ? '' : $chuNhiem[0]['hoc_vi'] . '. ',
    				'ho' => $chuNhiem[0]['ho'],
    				'ten' => $chuNhiem[0]['ten']
    	);
    }
    
	public function KiemTraGV($ma_giang_vien)
    {
    	return $this->dang_ky->KiemTraGV($ma_giang_vien);
    }
    
	public function KiemTraDT($ma_de_tai)
    {
    	return $this->dang_ky->KiemTraDT($ma_de_tai);
    }
    
	public function them()
    {
    	return $this->dang_ky->them($this);
    }
    
	public function sua()
    {
    	return $this->dang_ky->sua($this);
    }
    
	public function sua_chu_nhiem()
    {
    	return $this->dang_ky->sua_chu_nhiem($this);
    }
    
	public function sua_thanh_vien($ma_de_tai,$arr)
    {
    	$this->dang_ky->xoa_tv_by_mdt($ma_de_tai);
    	foreach ($arr as $data)
    	{
    		$dang_ky = new Default_Model_DangKy();
			$dang_ky->setMaDeTai($ma_de_tai)
					->setMaGiangVien($data['ma_giang_vien'])
					->setNhiemVu('0');
			$dang_ky->them();
    	}
    }
    
    public function xoa_dk_by_mdt($ma_de_tai)
    {
    	$this->dang_ky->xoa_dk_by_mdt($ma_de_tai);
    }
    
    public function xoa($id)
    {
    	return $this->dang_ky->xoa($id);
    }
    
    public function getDSTVByDT($ma_de_tai)
    {
    	$thanhViens = $this->dang_ky->getDSTVByDT($ma_de_tai);
    	$result = array();
    	foreach ($thanhViens as $thanh_vien)
    	{
    		$result[] = array('ma_giang_vien' => $thanh_vien['ma_giang_vien'],
    						  'ma_don_vi' => $thanh_vien['ma_don_vi']
    		);
    	}
    	return $result;
    }
    
	public function getMaChuNhiemByDT($ma_de_tai)
    {
    	$result = $this->dang_ky->getMaChuNhiemByDT($ma_de_tai);
    	return $result['ma_giang_vien'];
    }
	
	public function getDeTai(){
		return Khcn_Api::_()->getItem('default_de_tai', $this->ma_de_tai);
	}
	
	public function getGiangVien(){
		return Khcn_Api::_()->getItem('default_giang_vien', $this->ma_giang_vien);
	}
	
	public function getTenNhiemVu(){
		$nhiemVus = Default_Model_Constraints::dangky_nhiemvu();
		return $nhiemVus[$this->nhiem_vu];
	}
}
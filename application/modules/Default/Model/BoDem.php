<?php
class Default_Model_BoDem extends Khcn_Model_Item_Abstract{
	private $_id;
	private $_dia_chi_ip;
	private $_trinh_duyet;
	private $_thoi_gian;
	private $_url;
    protected $bo_dem = null;
    
    public function init()
    {
    	$this->bo_dem = new Default_Model_DbTable_BoDem();	
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
    
	public function setDiaChiIP($diaChiIP)
    {
        $this->_dia_chi_ip = $diaChiIP;
        return $this;
    }    
    public function getDiaChiIP()
    {
        return $this->_dia_chi_ip;
    }
    
	public function setTrinhDuyet($trinhDuyet)
    {
        $this->_trinh_duyet = $trinhDuyet;
        return $this;
    }    
    public function getTrinhDuyet()
    {
        return $this->_trinh_duyet;
    }
    
	public function setThoiGian($thoiGian)
    {
        $this->_thoi_gian = $thoiGian;
        return $this;
    }    
    public function getThoiGian()
    {
        return $this->_thoi_gian;
    }
    
	public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }    
    public function getUrl()
    {
        return $this->_url;
    }
    
    public function add()
    {
    	$this->bo_dem->add($this);
    }
    
    public function so_luong_hom_nay()
    {
    	return $this->bo_dem->so_luong_hom_nay();
    }
    
	public function so_luong_tuan_nay()
    {
    	return $this->bo_dem->so_luong_tuan_nay();
    }
    
	public function so_luong_thang_nay()
    {
    	return $this->bo_dem->so_luong_thang_nay();
    }
    
	public function so_luong()
    {
    	return $this->bo_dem->so_luong();
    }
    
    public function so_luong_theo_ngay($ngay)
    {
    	return $this->bo_dem->so_luong_theo_ngay($ngay);
    }
    
    public function tong_luot_truy_cap()
    {
		return $this->bo_dem->so_luong();
    }
}
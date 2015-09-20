<?php
class Default_Model_CauHinh extends Khcn_Model_Item_Abstract{
	
	private $_tu_khoa;
	private $_noi_dung;
	protected $cau_hinh = null;
	
	public function init()
    {
    	$this->cau_hinh = new Default_Model_DbTable_CauHinh();	
    }
    
	public function setTuKhoa($tu_khoa)
    {
        $this->_tu_khoa = $tu_khoa;
        return $this;
    }    
    public function getTuKhoa()
    {
        return $this->_tu_khoa;
    }
    
	public function setNoiDung($noi_dung)
    {
        $this->_noi_dung = $noi_dung;
        return $this;
    }    
    public function getNoiDung()
    {
        return $this->_noi_dung;
    }
    
    public function getCauHinh($tu_khoa)
    {
    	return $this->cau_hinh->getCauHinh($tu_khoa);
    }

    public function capNhat($tu_khoa,$noi_dung)
    {
    	$this->cau_hinh->capNhat($tu_khoa,$noi_dung);
    }
}
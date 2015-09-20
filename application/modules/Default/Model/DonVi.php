<?php
class Default_Model_DonVi extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ten;
	private $_ma;
	private $_thuoc_sgu;
	private $_la_khoa;
	protected $don_vi = null;
	
	public function init()
    {
    	$this->don_vi = new Default_Model_DbTable_DonVi();		
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
    
	public function setTen($ten)
    {
        $this->_ten = $ten;
        return $this;
    }    
    public function getTen()
    {
        return $this->_ten;
    }
    
	public function setMa($ma)
    {
        $this->_ma = $ma;
        return $this;
    }    
    
    public function getMa()
    {
        return $this->_ma;
    }
    
	public function setThuocSGU($thuoc_sgu)
    {
        $this->_thuoc_sgu = $thuoc_sgu;
        return $this;
    }    
    public function getThuocSGU()
    {
        return $this->_thuoc_sgu;
    }
    
	public function setLaKhoa($la_khoa)
    {
        $this->_la_khoa = $la_khoa;
        return $this;
    }    
    
    public function getLaKhoa()
    {
        return $this->_la_khoa;
    }
    
    public function getDonVi($id)
    {
    	return $this->don_vi->getDonVi($id);
    }
  	
	public function getIdByMa($ma,$thuoc_sgu = null)
    {
    	return $this->don_vi->getIdByMa($ma,$thuoc_sgu);	
    }
    
	public function getTenDonViById($id)
    {
    	return $this->don_vi->getTenDonViById($id);
    }
    
    public function getDSByLaKhoa($laKhoa)
    {
    	return $this->don_vi->getDSByLaKhoa($laKhoa);
    }
    
    public function getDSDVSGU()
    {
    	$result = $this->don_vi->getDSDVSGU();
    	$data = array();
    	foreach ($result as $don_vi){
    		$data[$don_vi['id']] = $don_vi['ten'];
    	}
    	return $data;
    }
    
	public function getDSDVNgoaiSGU()
    {
    	$result = $this->don_vi->getDSDVNgoaiSGU();
    	$data = array();
    	foreach ($result as $don_vi){
    		$data[$don_vi['id']] = $don_vi['ten'];
    	}
    	return $data;
    }
    
	public function getDSDV()
    {
    	$result = $this->don_vi->getDSDV();
    	$data = array();
    	foreach ($result as $don_vi){
    		$data[$don_vi['id']] = $don_vi['ten'];
    	}
    	return $data;
    }
    
	public function getAll()
    {   	
    	return  $this->don_vi->getAll();
    }
    
	public function them()
    {
    	return $this->don_vi->them($this);
    }
    
    public function DonViToArray($don_vi)
    {
    	return array('id' => $don_vi->id,   	
    				 'ma' => $don_vi->ma,
    				 'ten' => $don_vi->ten,
    				 'thuoc_sgu' => $don_vi->thuoc_sgu,
    				 'la_khoa' => $don_vi->la_khoa
    	);
    } 
    
    public function sua()
    {
    	return $this->don_vi->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->don_vi->xoa($id);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->don_vi->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->don_vi->kiem_tra_id_ma($id,$ma);
    }
}
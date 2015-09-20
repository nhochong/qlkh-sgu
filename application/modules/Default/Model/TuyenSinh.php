<?php
class Default_Model_TuyenSinh extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ten;
	private $_ten_file;
	private $_trang_thai;
	protected $tuyen_sinh = null;
	
	public function init()
    {
    	$this->tuyen_sinh = new Default_Model_DbTable_TuyenSinh();	
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
    
	public function setTenFile($ten_file)
    {
        $this->_ten_file = $ten_file;
        return $this;
    }    
    
    public function getTenFile()
    {
        return $this->_ten_file;
    }
    
	public function setTrangThai($trangThai)
    {
        $this->_trang_thai = $trangThai;
        return $this;
    }    
    public function getTrangThai()
    {
        return $this->_trang_thai;
    }
    
    public function getDSTS()
    {
    	return $this->tuyen_sinh->getDSTS();
    }
    
    public function getTSById($id)
    {
    	return $this->tuyen_sinh->getTuyenSinh($id);
    }
    
	public function getAll()
    {
    	return $this->tuyen_sinh->getAll();	
    }
    
	public function them()
    {
    	return $this->tuyen_sinh->them($this);
    }
    
    public function getTuyenSinh($id) 
    {
    	return $this->tuyen_sinh->getTuyenSinh($id);
    }
    
    public function TuyenSinhToArray($tuyen_sinh)
    {
    	return array('id' => $tuyen_sinh->id,
    				 'ten' => $tuyen_sinh->ten,
    				 'ten_file' => $tuyen_sinh->ten_file,
    	);
    } 
    
    public function getFile($id)
    {
    	$hinh = $this->tuyen_sinh->getFile($id);
    	return $hinh[0]['ten_file'];
    }
    
    public function sua()
    {
    	return $this->tuyen_sinh->sua($this);
    }
    
    public function CapNhatTT($id,$status)
    {
    	return $this->tuyen_sinh->CapNhatTT($id,$status);
    }
    
    public function xoa($id)
    {
    	return $this->tuyen_sinh->xoa($id);
    }
}
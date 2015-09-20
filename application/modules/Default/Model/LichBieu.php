<?php
class Default_Model_LichBieu extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ten;
	private $_ten_file;
	private $_trang_thai;
	protected $lich_bieu = null;
	
	public function init()
    {
    	$this->lich_bieu = new Default_Model_DbTable_LichBieu();	
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
    
    public function getDSLB()
    {
    	return $this->lich_bieu->getDSLB();
    }
    
    public function getLBById($id)
    {
    	return $this->lich_bieu->getLichBieu($id);
    }
    
	public function getAll()
    {
    	return $this->lich_bieu->getAll();	
    }
    
	public function them()
    {
    	return $this->lich_bieu->them($this);
    }
    
    public function getLichBieu($id) 
    {
    	return $this->lich_bieu->getLichBieu($id);
    }
    
    public function LichBieuToArray($lich_bieu)
    {
    	return array('id' => $lich_bieu->id,
    				 'ten' => $lich_bieu->ten,
    				 'ten_file' => $lich_bieu->ten_file,
    	);
    } 
    
    public function getFile($id)
    {
    	$hinh = $this->lich_bieu->getFile($id);
    	return $hinh[0]['ten_file'];
    }
    
    public function sua()
    {
    	return $this->lich_bieu->sua($this);
    }
    
    public function CapNhatTT($id,$status)
    {
    	return $this->lich_bieu->CapNhatTT($id,$status);
    }
    
    public function xoa($id)
    {
    	return $this->lich_bieu->xoa($id);
    }
}
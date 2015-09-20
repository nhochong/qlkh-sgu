<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiDt extends Khcn_Model_Item_Abstract
{
	/**
	 * The default table name 
	 */
	private $_id;
	private $_ma;
	private $_ten;
	private $_ghi_chu;
	
    protected $loai_dt = null;
    
    public function init()
    {
    	$this->loai_dt = new Default_Model_DbTable_LoaiDt();	
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
    
	public function setMa($ma)
    {
        $this->_ma = $ma;
        return $this;
    }    
    public function getMa()
    {
        return $this->_ma;
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
    
	public function setGhiChu($ghi_chu)
    {
        $this->_ghi_chu = $ghi_chu;
        return $this;
    }    
    public function getGhiChu()
    {
        return $this->_ghi_chu;
    }
    
    public function getLoaiDT($id)
    {
    	return $this->loai_dt->getLoaiDT($id);
    }
    
    public function getAll()
    {   	
    	return $this->loai_dt->fetchAll();
    }
    
	public function getDSLDT()
    {
    	$result = $this->loai_dt->getDSLDT();
    	$data = array();
    	foreach ($result as $loai_dt){
    		$data[$loai_dt['id']] = $loai_dt['ten'];
    	}
    	return $data;
    }
    
	public function them()
    {
    	return $this->loai_dt->them($this);
    }
    
    public function LoaiDTToArray($loai_dt)
    {
    	return array('id' => $loai_dt->id,   	
    				 'ma' => $loai_dt->ma,
    				 'ten' => $loai_dt->ten,
    				 'ghi_chu' => $loai_dt->ghi_chu,
    	);
    } 
    
    public function sua()
    {
    	return $this->loai_dt->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->loai_dt->xoa($id);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->loai_dt->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->loai_dt->kiem_tra_id_ma($id,$ma);
    }
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LoaiLinhVuc extends Khcn_Model_Item_Abstract
{
	/**
	 * The default table name 
	 */
	private $_id;
	private $_ma;
	private $_ten;
	
    protected $loai_lv = null;
    
    public function init()
    {
    	$this->loai_lv = new Default_Model_DbTable_LoaiLinhVuc();	
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
		
    public function getLoaiLV($id)
    {
    	return $this->loai_lv->getLoaiLV($id);
    }
    
    public function getAll()
    {   	
    	return $this->loai_lv->fetchAll();
    }
    
	public function them()
    {
    	return $this->loai_lv->them($this);
    }
    
    public function LoaiLVToArray($loai_lv)
    {
    	return array('id' => $loai_lv->id,  
					 'ma' => $loai_lv->ma,  
    				 'ten' => $loai_lv->ten
    	);
    } 
    
    public function sua()
    {
    	return $this->loai_lv->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->loai_lv->xoa($id);
    }
	
	public function getMultiOptions()
    {
    	$result = $this->getAll();
    	$data = array();
		$data[0] = '';
    	foreach ($result as $loai_lv){
    		$data[$loai_lv['id']] = $loai_lv['ten'];
    	}
    	return $data;
    }
}

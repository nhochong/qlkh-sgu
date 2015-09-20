<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_HocVi extends Khcn_Model_Item_Abstract
{
	/**
	 * The default table name 
	 */
	private $_id;
	private $_ma;
	private $_ten;
	private $_ghi_chu;
	
    protected $hoc_vi = null;
    
    public function init()
    {
    	$this->hoc_vi = new Default_Model_DbTable_HocVi();	
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
    
    public function getHocVi($id)
    {
    	return $this->hoc_vi->getHocVi($id);
    }
    
	public function getIdByMa($ma)
    {
    	return $this->hoc_vi->getIdByMa($ma);	
    }
    
    public function getAll()
    {   	
    	return $this->hoc_vi->fetchAll();
    }
    
	public function getDSHV()
    {
    	$result = $this->hoc_vi->getDSHV();
    	$data = array();
    	foreach ($result as $hoc_vi){
    		$data[$hoc_vi['id']] = $hoc_vi['ten'];
    	}
    	return $data;
    }
    
	public function them()
    {
    	return $this->hoc_vi->them($this);
    }
    
    public function HocViToArray($hoc_vi)
    {
    	return array('id' => $hoc_vi->id,   	
    				 'ma' => $hoc_vi->ma,
    				 'ten' => $hoc_vi->ten,
    				 'ghi_chu' => $hoc_vi->ghi_chu,
    	);
    } 
    
    public function sua()
    {
    	return $this->hoc_vi->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->hoc_vi->xoa($id);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->hoc_vi->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->hoc_vi->kiem_tra_id_ma($id,$ma);
    }
}

<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_LinhVuc extends Khcn_Model_Item_Abstract
{
	/**
	 * The default table name 
	 */
	private $_id;
	private $_ma;
	private $_ten;
	private $_mo_ta;
	private $_ma_loai;
	
    protected $linh_vuc = null;
    
    public function init()
    {
    	$this->linh_vuc = new Default_Model_DbTable_LinhVuc();	
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
    
	public function setMoTa($mo_ta)
    {
        $this->_mo_ta = $mo_ta;
        return $this;
    }    
    public function getMoTa()
    {
        return $this->_mo_ta;
    }
    
	public function setMaLoai($ma_loai)
    {
        $this->_ma_loai = $ma_loai;
        return $this;
    }    
    public function getMaLoai()
    {
        return $this->_ma_loai;
    }
	
    public function getLinhVuc($id)
    {
    	return $this->linh_vuc->getLinhVuc($id);
    }
    
	public function getIdByMa($ma)
    {
    	return $this->linh_vuc->getIdByMa($ma);	
    }
    
    public function getAll()
    {	
		$loai_lv = new Default_Model_LoaiLinhVuc();
		$linhVucs = $this->linh_vuc->fetchAll();	
    	$dsLinhVucs = array();
    	$loais = $loai_lv->getMultiOptions();
    	foreach ($linhVucs as $linh_vuc){
    		$dsLinhVucs[] = array( 'id' => $linh_vuc['id'],
									'ma' => $linh_vuc['ma'],
    							 	'ten' => $linh_vuc['ten'],
									'mo_ta' => $linh_vuc['mo_ta'],
    								'loai' => $loais[$linh_vuc['ma_loai']]
    		);
    	}
    	return $dsLinhVucs;
    }
    
	public function getDSLV()
    {
    	$result = $this->linh_vuc->getDSLV();
    	$data = array();
    	foreach ($result as $linh_vuc){
    		$data[$linh_vuc['id']] = $linh_vuc['ten'];
    	}
    	return $data;
    }
    
	public function them()
    {
    	return $this->linh_vuc->them($this);
    }
    
    public function LinhVucToArray($linh_vuc)
    {
    	return array('id' => $linh_vuc->id,   	
    				 'ma' => $linh_vuc->ma,
    				 'ten' => $linh_vuc->ten,
    				 'mo_ta' => $linh_vuc->mo_ta,
					 'ma_loai' => $linh_vuc->ma_loai
    	);
    } 
    
    public function sua()
    {
    	return $this->linh_vuc->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->linh_vuc->xoa($id);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->linh_vuc->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->linh_vuc->kiem_tra_id_ma($id,$ma);
    }
	
	public function getLVByMa($ma_linh_vuc){
		return $this->linh_vuc->getLVByMa($ma_linh_vuc);	
	}
}

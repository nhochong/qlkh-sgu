<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_Hdd extends Khcn_Model_Item_Abstract
{
	/**
	 * The default table name 
	 */
	private $_id;
	private $_ma;
	private $_ngay_thanh_lap;
	private $_ghi_chu;
	
    protected $hdd = null;
    
    public function init()
    {
    	$this->hdd = new Default_Model_DbTable_Hdd();	
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
    
	public function setNgayThanhLap($ngay_thanh_lap)
    {
        $this->_ngay_thanh_lap = $ngay_thanh_lap;
        return $this;
    }    
    public function getNgayThanhLap()
    {
        return $this->_ngay_thanh_lap;
    }
    
	public function setGhiChu($ghiChu)
    {
        $this->_ghi_chu = $ghiChu;
        return $this;
    }    
    public function getGhiChu()
    {
        return $this->_ghi_chu;
    }
    
    public function getHDD($id)
    {
    	return $this->hdd->getHDD($id);
    }
    
    public function getAll()
    {   	
    	$hdds = $this->hdd->getAll();
    	$result = array();
    	foreach ($hdds as $hdd){
    		$result[] = array('id' => $hdd['id'],
    						  'ma' => $hdd['ma'],
    						  'ngay_thanh_lap' => date('d-m-Y',strtotime($hdd['ngay_thanh_lap'])),
    						  'linh_vuc' => $hdd['linh_vuc'],
    						  'ghi_chu' => $hdd['ghi_chu']
    		);
    	}
    	return $result;
    }
    
	public function them()
    {
    	return $this->hdd->them($this);
    }
    
    public function HDDToArray($hdd)
    {
    	return array('id' => $hdd->id,   	
    				 'ma' => $hdd->ma,
    				 'ngay_thanh_lap' => date('d-m-Y',strtotime($hdd->ngay_thanh_lap)),
    				 'ghi_chu' => $hdd->ghi_chu
    	);
    } 
    
    public function sua()
    {
    	return $this->hdd->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->hdd->xoa($id);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->hdd->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->hdd->kiem_tra_id_ma($id,$ma);
    }
    
    public function getLinhVucByHD($id)
    {
    	$result = $this->hdd->getLinhVucByHD($id);
    	if($result == null)
    		return 1;
    	return $result[0]['ma_linh_vuc'];
    } 

	public function loc($params = array())
    {
    	$hdds = $this->hdd->loc($params);
    	$result = array();
    	foreach ($hdds as $hdd){
    		$result[] = array('id' => $hdd['id'],
    						  'ma' => $hdd['ma'],
    						  'ngay_thanh_lap' => date('d-m-Y',strtotime($hdd['ngay_thanh_lap'])),
    						  'linh_vuc' => $hdd['linh_vuc'],
    						  'ghi_chu' => $hdd['ghi_chu']
    		);
    	}
    	return $result;
    }
    
	public function getDSHDForExport($nam)
    {
    	$hdds = $this->hdd->getDSHDForExport($nam);
    	$result = array();
    	foreach ($hdds as $hdd){
    		$result[] = array('id' => $hdd['id'],
    						  'ma' => $hdd['ma'],
    						  'linh_vuc' => $hdd['linh_vuc'],
    						  'ghi_chu' => $hdd['ghi_chu']
    		);
    	}
    	return $result;
    }
    
	public function getDSHDByNam($nam)
    {
    	$result = $this->hdd->getDSHDByNam($nam);
    	$data = array();
    	foreach ($result as $hoi_dong){
    		$data[$hoi_dong['id']] = $hoi_dong['ma'];
    	}
    	return $data;
    }
}

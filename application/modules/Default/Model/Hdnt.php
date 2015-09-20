<?php

/**
 * {0}
 *  
 * @author bj
 * @version 
 */
class Default_Model_Hdnt extends Khcn_Model_Item_Abstract
{
	/**
	 * The default table name 
	 */
	private $_id;
	private $_ma;
	private $_ma_de_tai;
	private $_ngay_thanh_lap;
	private $_ghi_chu;
	
    protected $hdnt = null;
    
    public function init()
    {
    	$this->hdnt = new Default_Model_DbTable_Hdnt();	
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
    
	public function setMaDeTai($ma_de_tai)
    {
        $this->_ma_de_tai = $ma_de_tai;
        return $this;
    }    
    public function getMaDeTai()
    {
        return $this->_ma_de_tai;
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
    
    public function getHDNT($id)
    {
    	return $this->hdnt->getHDNT($id);
    }
    
    public function getAll()
    {   	
    	$hdnts = $this->hdnt->getAll();
    	$result = array();
    	foreach ($hdnts as $hdnt){
    		$result[] = array('id' => $hdnt['id'],
    						  'ma' => $hdnt['ma'],
    						  'ngay_thanh_lap' => date('d-m-Y',strtotime($hdnt['ngay_thanh_lap'])),
    						  'id_de_tai' => $hdnt['id_de_tai'],
    						  'ma_de_tai' => $hdnt['ma_de_tai'],
    						  'ten_de_tai' => $hdnt['ten_de_tai'],
    						  'ghi_chu' => $hdnt['ghi_chu'],
    						  'ten_linh_vuc' => $hdnt['ten_linh_vuc']
    		);
    	}
    	return $result;
    }
    
	public function loc($params = array())
    {   	
    	$hdnts = $this->hdnt->loc($params);
    	$result = array();
    	foreach ($hdnts as $hdnt){
    		$result[] = array('id' => $hdnt['id'],
    						  'ma' => $hdnt['ma'],
    						  'ngay_thanh_lap' => date('d-m-Y',strtotime($hdnt['ngay_thanh_lap'])),
    						  'id_de_tai' => $hdnt['id_de_tai'],
    						  'ma_de_tai' => $hdnt['ma_de_tai'],
    						  'ten_de_tai' => $hdnt['ten_de_tai'],
    						  'ghi_chu' => $hdnt['ghi_chu'],
    						  'ten_linh_vuc' => $hdnt['ten_linh_vuc']
    		);
    	}
    	return $result;
    }
    
	public function them()
    {
    	return $this->hdnt->them($this);
    }
    
    public function HDNTToArray($hdnt)
    {
    	return array('id' => $hdnt->id,   	
    				 'ma' => $hdnt->ma,
    				 'ma_de_tai' => $hdnt->ma_de_tai,
    				 'ngay_thanh_lap' => date('d-m-Y',strtotime($hdnt->ngay_thanh_lap)),
    				 'ghi_chu' => $hdnt->ghi_chu
    	);
    } 
    
    public function sua()
    {
    	return $this->hdnt->sua($this);
    }
    
    public function xoa($id)
    {
    	return $this->hdnt->xoa($id);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->hdnt->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->hdnt->kiem_tra_id_ma($id,$ma);
    }
    
    public function KiemTraDT($ma_de_tai)
    {
    	return $this->hdnt->KiemTraDT($ma_de_tai);
    }
    
    public function getLinhVucByDT($id)
    {
    	return $this->hdnt->getLinhVucByDT($id);
    }
}

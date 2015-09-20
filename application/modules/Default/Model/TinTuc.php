<?php
class Default_Model_TinTuc extends Khcn_Model_Item_Abstract{

	protected  $tin_tuc = null;
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'tin-tuc',
			'action' => 'chi-tiet',
			'reset' => true,
			'id' => $this->getIdentity()
		), $params);
		$route = $params['route'];
		$reset = $params['reset'];
		unset($params['route']);
		unset($params['reset']);
		return Zend_Controller_Front::getInstance()->getRouter()
		  ->assemble($params, $route, $reset);
	}
	
	public function init()
	{
		$this->tin_tuc = new Default_Model_DbTable_TinTuc();
	}
    
    public function getAll()
    {    	 
    	return $this->tin_tuc->getAll();
    }
    
    public function GetDSTT()
    {
    	$tinTucs = $this->tin_tuc->GetDSTT();
    	$dsTinTucs = array();
    	foreach ($tinTucs as $tinTuc){
    		$tin_moi = 0;
    		if(strtotime($tinTuc['ngay_tao']) > strtotime('-10 days'))
    			$tin_moi = 1;
    		$dsTinTucs[] = array('id' => $tinTuc['id'],
    							 'tieu_de' => $tinTuc['tieu_de'],
    							 'mo_ta_tom_tat' => $tinTuc['mo_ta_tom_tat'],
    							 'file' => $tinTuc['file'],
    							 'ngay_tao' => date('d/m/Y',strtotime($tinTuc['ngay_tao'])),
    							 'tin_moi' => $tin_moi
    		);
    	}
    	return $dsTinTucs;
    }
    
	public function GetDSTTForRSS()
    {
    	$tinTucs = $this->tin_tuc->GetDSTTForRSS();
    	$dsTinTucs = array();
    	foreach ($tinTucs as $tinTuc){
    		$dsTinTucs[] = array('id' => $tinTuc['id'],
    							 'tieu_de' => $tinTuc['tieu_de'],
    							 'mo_ta_tom_tat' => $tinTuc['mo_ta_tom_tat'],
    							 'ngay_tao' => date('d-m-Y',strtotime($tinTuc['ngay_tao']))
    		);
    	}
    	return $dsTinTucs;
    }
    
    public function GetTinTucKhac($id1,$id2)
    {
    	$tinTucs = $this->tin_tuc->GetTinTucKhac($id1,$id2);
    	$dsTinTucs = array();
    	foreach ($tinTucs as $tinTuc){
    		$tin_moi = 0;
    		if(strtotime($tinTuc['ngay_tao']) > strtotime('-10 days'))
    			$tin_moi = 1;
    		$dsTinTucs[] = array('id' => $tinTuc['id'],
    							 'tieu_de' => $tinTuc['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($tinTuc['ngay_tao'])),
    							 'tin_moi' => $tin_moi
    		);
    	}
    	return $dsTinTucs;
    }
    
    public function getTinTuc($id)
    {
    	return $this->tin_tuc->getTinTuc($id);
    }
    
    public function GetTinTucKhacCT($id)
    {
    	$tinTucs = $this->tin_tuc->GetTinTucKhacCT($id);
    	$dsTinTucs = array();
    	foreach ($tinTucs as $tinTuc){
    		$tin_moi = 0;
    		if(strtotime($tinTuc['ngay_tao']) > strtotime('-10 days'))
    			$tin_moi = 1;
    		$dsTinTucs[] = array('id' => $tinTuc['id'],
    							 'tieu_de' => $tinTuc['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($tinTuc['ngay_tao'])),
    							 'tin_moi' => $tin_moi
    		);
    	}
    	return $dsTinTucs;
    }
    
	public function getFile($id)
    {
    	$hinh = $this->tin_tuc->getFile($id);
    	return $hinh[0]['file'];
    }
    
	public function them()
    {
    	return $this->tin_tuc->them($this);
    }
    
    public function TinTucToArray($tin_tuc)
    {
    	return array('id' => $tin_tuc->id,
    				 'tieu_de' => $tin_tuc->tieu_de,
    				 'file' => $tin_tuc->hinh,
    				 'trang_thai' => $tin_tuc->trang_thai,
    				 'mo_ta_tom_tat' => $tin_tuc->mo_ta_tom_tat,
    				 'mo_ta_chi_tiet' => $tin_tuc->mo_ta_chi_tiet,
    				 'ngay_tao' => $tin_tuc->ngay_tao,
    				 'so_lan_xem' => $tin_tuc->so_lan_xem,
    				 'ma_quan_tri' => $tin_tuc->ma_quan_tri
    	);
    } 
    
    public function sua()
    {
    	return $this->tin_tuc->sua($this);
    }
    
    public function CapNhatTT($id,$status)
    {
    	return $this->tin_tuc->CapNhatTT($id,$status);
    }
    
    public function xoa($id)
    {
    	return $this->tin_tuc->xoa($id);
    }
    
	public function updateLuceneIndex($id)
    {       
        $tin_tuc = $this->getTinTuc($id);
		
		$link = new Zend_View_Helper_Url();
		$url = $link->url(array(    
			            'controller' => 'tin-tuc',  
			            'action'     => 'chi-tiet',  
			            'id'   => $tin_tuc['id'],  
			        ),null,true);
		
		$data = array(  'pk' => 'tt_' . $tin_tuc['id'], 
            			'code' => '', 
            			'title' => $tin_tuc['tieu_de'], 
            			'description' => '<span style="font-size: 11px;color: graytext;">Ngày đăng : ' . $tin_tuc['ngay_tao'] . '</span><div>' . $tin_tuc['mo_ta_tom_tat'] . '...</div>', 
            			'cate' => '1', 
            			'link' => $url);
		
        // add job to the index
        Default_Model_LuceneIndex::update($data);
    }
    
    public function deleteLuceneIndex($id)
    {
    	$pk = 'tt_' . $id;
    	Default_Model_LuceneIndex::delete($pk);
    }
    
    public function CapNhatSLX($id,$so_lan_xem)
    {
    	$this->tin_tuc->CapNhatSLX($id,$so_lan_xem);
    }
	
	public function isNew($noi_bat = false){
		$isNew = false;
		$tin_tuc_moi = Khcn_Api::_()->getApi('settings', 'default')->getSetting('tin_tuc_moi', 10);
		
		if($noi_bat == true){
			$isNew = $this->noi_bat;
		}
		if(strtotime($this->ngay_tao) > strtotime("-$tin_tuc_moi days")){
			$isNew = true;
		}
		return $isNew;
	}
	
	public function getPhotoUrl($type = null){
		if(empty($this->file))
			return Zend_Registry::get('Zend_View')->getBaseUrl() . '/images/no_photo_thumb.jpg';
		return parent::getPhotoUrl();
	}
	
	public function getMoTaTomTat(){
		if(!empty($this->mo_ta_tom_tat))
			return $this->mo_ta_tom_tat;
		return $this->getTitle();
	}
}
<?php
class Default_Model_ThongBao extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_tieu_de;
	private $_noi_dung;
	private $_ngay_tao;
	private $_so_lan_xem;
	private $_trang_thai;
	private $_ma_quan_tri;
	private $_loai;
	protected  $thong_bao = null;
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'thong-bao',
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
		$this->thong_bao = new Default_Model_DbTable_ThongBao();
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
    
	public function setTieuDe($tieuDe)
    {
        $this->_tieu_de = $tieuDe;
        return $this;
    }    
    public function getTieuDe()
    {
        return $this->_tieu_de;
    }
    
	public function setNoiDung($noi_dung)
    {
        $this->_noi_dung = $noi_dung;
        return $this;
    }    
    
    public function getNoiDung()
    {
        return $this->_noi_dung;
    }
    
	public function setNgayTao($ngay_tao)
    {
        $this->_ngay_tao = $ngay_tao;
        return $this;
    }    
    public function getNgayTao()
    {
        return $this->_ngay_tao;
    }
    
	public function setSoLanXem($so_lan_xem)
    {
        $this->_so_lan_xem = $so_lan_xem;
        return $this;
    }    
    public function getSoLanXem()
    {
        return $this->_so_lan_xem;
    }
    
	public function setTrangThai($trang_thai)
    {
        $this->_trang_thai = $trang_thai;
        return $this;
    }    
    public function getTrangThai()
    {
        return $this->_trang_thai;
    }
    
	public function setMaQuanTri($ma_quan_tri)
    {
        $this->_ma_quan_tri = $ma_quan_tri;
        return $this;
    }    
    public function getMaQuanTri()
    {
        return $this->_ma_quan_tri;
    }
    
	public function setLoai($loai)
    {
        $this->_loai = $loai;
        return $this;
    }    
    public function getLoai()
    {
        return $this->_loai;
    }
    
    public function getDSTB()
    {    	 
    	$thongBaos = $this->thong_bao->getDSTB();
    	$dsThongBaos = array();
    	foreach ($thongBaos as $thongBao){
    		$tb_moi = 0;
    		if(strtotime($thongBao['ngay_tao']) > strtotime('-10 days'))
    			$tb_moi = 1;
    		$dsThongBaos[] = array('id' => $thongBao['id'],
    							 'tieu_de' => $thongBao['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($thongBao['ngay_tao'])),
    							 'tb_moi' => $tb_moi
    		);
    	}
    	return $dsThongBaos;
    }
    
	public function getDSTBForRSS()
    {    	 
    	$thongBaos = $this->thong_bao->getDSTBForRSS();
    	$dsThongBaos = array();
    	foreach ($thongBaos as $thongBao){
    		$dsThongBaos[] = array('id' => $thongBao['id'],
    							 'tieu_de' => $thongBao['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($thongBao['ngay_tao']))
    		);
    	}
    	return $dsThongBaos;
    }
    
    public function danhsachhienthi($loai)
    {
    	$thongBaos = $this->thong_bao->danhsachhienthi($loai);
    	$dsThongBaos = array();
    	foreach ($thongBaos as $thongBao){
    		$tb_moi = 0;
    		if(strtotime($thongBao['ngay_tao']) > strtotime('-10 days'))
    			$tb_moi = 1;
    		$dsThongBaos[] = array('id' => $thongBao['id'],
    							 'tieu_de' => $thongBao['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($thongBao['ngay_tao'])),
    							 'tb_moi' => $tb_moi
    		);
    	}
    	return $dsThongBaos;
    }
    
    public function GetThongBaoByLoai($loai)
    {
    	$thongBaos = $this->thong_bao->GetThongBaoByLoai($loai);
    	$dsThongBaos = array();
    	foreach ($thongBaos as $thongBao){
    		$tb_moi = 0;
    		if(strtotime($thongBao['ngay_tao']) > strtotime('-10 days'))
    			$tb_moi = 1;
    		$dsThongBaos[] = array('id' => $thongBao['id'],
    							 'tieu_de' => $thongBao['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($thongBao['ngay_tao'])),
    							 'tb_moi' => $tb_moi
    		);
    	}
    	return $dsThongBaos;
    }
    
    public function getThongBao($id)
    {
    	return $this->thong_bao->getThongBao($id);
    }
    
    public function getSearch()
    {
    	$thongBaos = $this->thong_bao->getSearch();
    	$dsThongBaos = array();
    	foreach ($thongBaos as $thongBao){
    		$dsThongBaos[] = array('id' => $thongBao['id'],
    							 'tieu_de' => $thongBao['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($thongBao['ngay_tao']))
    		);
    	}
    	return $dsThongBaos;
    }
    
	public function getTBMoi()
    {
    	$thongBaos = $this->thong_bao->getTBMoi();
    	$dsThongBaos = array();
    	foreach ($thongBaos as $thongBao){
    		$tb_moi = 0;
    		if(strtotime($thongBao['ngay_tao']) > strtotime('-10 days'))
    			$tb_moi = 1;
    		$dsThongBaos[] = array('id' => $thongBao['id'],
    							 'tieu_de' => $thongBao['tieu_de'],
    							 'ngay_tao' => date('d/m/Y',strtotime($thongBao['ngay_tao'])),
    							 'tb_moi' => $tb_moi
    		);
    	}
    	return $dsThongBaos;
    }
    
	public function getAll()
    {
    	$thongBaos = $this->thong_bao->getAll();	
    	$dsThongBaos = array();
    	$loais = Khcn_Api::_()->getDbTable('loai_thong_bao', 'default')->getListAssoc();
    	foreach ($thongBaos as $thong_bao){
    		$dsThongBaos[] = array( 'id' => $thong_bao['id'],
    							 	'tieu_de' => $thong_bao['tieu_de'],
    							 	'ngay_tao' => date('H:i d/m/Y',strtotime($thong_bao['ngay_tao'])),
    								'loai' => $loais[$thong_bao['loai']],
    								'trang_thai' => $thong_bao['trang_thai']
    		);
    	}
    	return $dsThongBaos;
    }
    
	public function them()
    {
    	return $this->thong_bao->them($this);
    }
    
    public function ThongBaoToArray($thong_bao)
    {
    	return array('id' => $thong_bao->id,
    				 'tieu_de' => $thong_bao->tieu_de,
    				 'noi_dung' => $thong_bao->noi_dung,
    				 'trang_thai' => $thong_bao->trang_thai,
    				 'loai' => $thong_bao->loai,
    				 'ngay_tao' => $thong_bao->ngay_tao,
    				 'so_lan_xem' => $thong_bao->so_lan_xem,
    				 'ma_quan_tri' => $thong_bao->ma_quan_tri
    	);
    } 
    
    public function sua()
    {
    	return $this->thong_bao->sua($this);
    }
    
    public function CapNhatTT($id,$status)
    {
    	return $this->thong_bao->CapNhatTT($id,$status);
    }
    
    public function xoa($id)
    {
    	return $this->thong_bao->xoa($id);
    }
    
    public function loc($params = array())
    {
    	$thongBaos = $this->thong_bao->loc($params);
    	$dsThongBaos = array();
    	$loais = Khcn_Api::_()->getDbTable('loai_thong_bao', 'default')->getListAssoc();
    	foreach ($thongBaos as $thong_bao){
    		$dsThongBaos[] = array( 'id' => $thong_bao['id'],
    							 	'tieu_de' => $thong_bao['tieu_de'],
    							 	'ngay_tao' => date('H:i d/m/Y',strtotime($thong_bao['ngay_tao'])),
    								'loai' => $loais[$thong_bao['loai']],
    								'trang_thai' => $thong_bao['trang_thai']
    		);
    	}
    	return $dsThongBaos;
    }
    
	public function updateLuceneIndex($id)
    {       
        $thong_bao = $this->getThongBao($id);
		
		$link = new Zend_View_Helper_Url();
		$url = $link->url(array(    
			            'controller' => 'thong-bao',  
			            'action'     => 'chi-tiet',  
			            'id'   => $thong_bao['id'],  
			        ),null,true);
		
		$data = array(  'pk' => 'tb_' . $thong_bao['id'], 
            			'code' => '', 
            			'title' => $thong_bao['tieu_de'], 
            			'description' => '<span style="font-size: 11px;color: graytext;">Ngày đăng : ' . $thong_bao['ngay_tao'] . '</span>', 
            			'cate' => '2', 
            			'link' => $url);
		
        // add job to the index
        Default_Model_LuceneIndex::update($data);
    }
    
    public function deleteLuceneIndex($id)
    {
    	$pk = 'tb_' . $id;
    	Default_Model_LuceneIndex::delete($pk);
    }
    
	public function CapNhatSLX($id,$so_lan_xem)
    {
    	$this->thong_bao->CapNhatSLX($id,$so_lan_xem);
    }
	
	public function getTenLoai(){
		$loais = Khcn_Api::_()->getDbTable('loai_thong_bao', 'default')->getListAssoc();
		return $loais[$this->loai];
	}
	
	public function isNew(){
		$thong_bao_moi = Khcn_Api::_()->getApi('settings', 'default')->getSetting('thong_bao_moi', 10);
		if(strtotime($this->ngay_tao) > strtotime("-$thong_bao_moi days"))
			return true;
		return false;
	}
	
	public function getPhotoUrl($type = null){
		if(empty($this->file))
			return Zend_Registry::get('Zend_View')->getBaseUrl() . '/images/no_photo_thumb.jpg';
		return parent::getPhotoUrl();
	}
}
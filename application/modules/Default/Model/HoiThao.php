<?php
class Default_Model_HoiThao extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_chu_de;
	private $_doi_tac;
	private $_don_vi_phu_trach;
	private $_cap_quan_ly;
	private $_ngay_to_chuc;
	private $_thong_cao_bao_chi;
	private $_anh_trang_bia;
	private $_trang_thai;
	protected $hoi_thao = null;
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'hoi-thao',
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
    	$this->hoi_thao = new Default_Model_DbTable_HoiThao();	
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
    
	public function setChuDe($chuDe)
    {
        $this->_chu_de = $chuDe;
        return $this;
    }    
    public function getChuDe()
    {
        return $this->_chu_de;
    }
    
	public function setDoiTac($doiTac)
    {
        $this->_doi_tac = $doiTac;
        return $this;
    }    
    
    public function getDoiTac()
    {
        return $this->_doi_tac;
    }
    
	public function setDonViPhuTrach($donViPhuTrach)
    {
        $this->_don_vi_phu_trach = $donViPhuTrach;
        return $this;
    }    
    public function getDonViPhuTrach()
    {
        return $this->_don_vi_phu_trach;
    }
    
	public function setCapQuanLy($capQuanLy)
    {
        $this->_cap_quan_ly = $capQuanLy;
        return $this;
    }    
    public function getCapQuanLy()
    {
        return $this->_cap_quan_ly;
    }
    
	public function setNgayToChuc($ngayToChuc)
    {
        $this->_ngay_to_chuc = $ngayToChuc;
        return $this;
    }    
    public function getNgayToChuc()
    {
        return $this->_ngay_to_chuc;
    }
    
	public function setThongCaoBaoChi($thongCaoBaoChi)
    {
        $this->_thong_cao_bao_chi = $thongCaoBaoChi;
        return $this;
    }    
    public function getThongCaoBaoChi()
    {
        return $this->_thong_cao_bao_chi;
    }
    
	public function setAnhTrangBia($anhTrangBia)
    {
        $this->_anh_trang_bia = $anhTrangBia;
        return $this;
    }    
    public function getAnhTrangBia()
    {
        return $this->_anh_trang_bia;
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
    
    public function getDSHT()
    {
    	$hoiThaos = $this->hoi_thao->getDSHT();
    	$dsHoiThaos = array();
    	$capQLs = Default_Model_Constraints::hoithao_capquanly();
    	foreach ($hoiThaos as $hoi_thao)
    	{
    		$dsHoiThaos[] = array('id' => $hoi_thao['id'],
    							  'chu_de' => $hoi_thao['chu_de'],
    							  'doi_tac' => $hoi_thao['doi_tac'],
    							  'cap_quan_ly' => $capQLs[$hoi_thao['cap_quan_ly']],
    							  'ngay_to_chuc' =>  date('d-m-Y',strtotime($hoi_thao['ngay_to_chuc'])),
    							  'don_vi_phu_trach' => $hoi_thao['don_vi_phu_trach']
    		); 
    	}
    	return $dsHoiThaos;
    }
    
    public function getHoiThao($id)
    {   	
    	return $this->hoi_thao->getHoiThao($id);
    }
    
    public function getSearch()
    {
    	$hoiThaos = $this->hoi_thao->getSearch();
    	$dsHoiThaos = array();
    	foreach ($hoiThaos as $hoi_thao)
    	{
    		$dsHoiThaos[] = array('id' => $hoi_thao['id'],
    							  'chu_de' => $hoi_thao['chu_de'],
    							  'doi_tac' => $hoi_thao['doi_tac'],
    							  'don_vi_phu_trach' =>  $hoi_thao['don_vi_phu_trach'],
    							  'ngay_to_chuc' => $hoi_thao['ngay_to_chuc'] == null ? '' : date('d-m-Y',strtotime($hoi_thao['ngay_to_chuc'])),
    		); 
    	}
    	return $dsHoiThaos;
    }
    
	public function getAll()
    {
    	$hoiThaos = $this->hoi_thao->getAll();
    	$dsHoiThaos = array();
    	$capQLs = Default_Model_Constraints::hoithao_capquanly();
    	foreach ($hoiThaos as $hoi_thao)
    	{
    		$dsHoiThaos[] = array('id' => $hoi_thao['id'],
    							  'chu_de' => $hoi_thao['chu_de'],
    							  'cap_quan_ly' => $capQLs[$hoi_thao['cap_quan_ly']],
    						 	  'doi_tac' => $hoi_thao['doi_tac'],
    							  'don_vi_phu_trach' => $hoi_thao['don_vi_phu_trach'],
    							  'ngay_to_chuc' => $hoi_thao['ngay_to_chuc'] == null ? '' : date('d-m-Y',strtotime($hoi_thao['ngay_to_chuc'])),
    							  'trang_thai' => $hoi_thao['trang_thai']
    		); 
    	}
    	return $dsHoiThaos;
    }
    
	public function them()
    {
    	return $this->hoi_thao->them($this);
    }
    
    public function HoiThaoToArray($hoi_thao)
    {
    	$data = array('id' => $hoi_thao->id,
    				'chu_de' => $hoi_thao->chu_de,
    				'cap_quan_ly' => $hoi_thao->cap_quan_ly,
    				'doi_tac' => $hoi_thao->doi_tac,
    				'don_vi_phu_trach' => $hoi_thao->don_vi_phu_trach,
    				'ngay_to_chuc' => $hoi_thao->ngay_to_chuc == null ? '' : date('d-m-Y',strtotime($hoi_thao->ngay_to_chuc)),
    				'anh_trang_bia' => $hoi_thao->anh_trang_bia,
    				'thong_cao_bao_chi' => $hoi_thao->thong_cao_bao_chi,
    				'trang_thai' => $hoi_thao->trang_thai
    		); 	
    	return $data;
    } 

	public function getATB($id)
    {
    	$hinh = $this->hoi_thao->getATB($id);
    	return $hinh[0]['anh_trang_bia'];
    }
    
	public function getTCBC($id)
    {
    	$hinh = $this->hoi_thao->getTCBC($id);
    	return $hinh[0]['thong_cao_bao_chi'];
    }
    
    public function sua()
    {
    	return $this->hoi_thao->sua($this);
    }
    
    public function CapNhatTT($id,$status)
    {
    	return $this->hoi_thao->CapNhatTT($id,$status);
    }
    
    public function xoa($id)
    {
    	return $this->hoi_thao->xoa($id);
    }
    
	public function updateLuceneIndex()
    {      
        $capQLs = Default_Model_Constraints::hoithao_capquanly();
		$don_vi = new Default_Model_DonVi();
		$link = new Zend_View_Helper_Url();
		$url = $link->url(array(    
			            'controller' => 'hoi-thao',  
			            'action'     => 'chi-tiet',  
			            'id'   => $this->id,  
			        ),null,true);
			        
		$description = '<table><tr>';
        $description .= '<td width="50%">Cấp quản lý : ' . $capQLs[$this->cap_quan_ly] . '</td>';
        $description .= '<td>Ngày tổ chức : ' . date('d/m/Y', strtotime($this->ngay_to_chuc)) . '</td>';
        $description .= '</tr><tr>';
        $description .= '<td colspan="2">Đơn vị phụ trách : ' . $this->don_vi_phu_trach . '</td>';
        $description .= '</tr></table>';
		$data = array(  'pk' => 'ht_' . $this->id, 
            			'code' => '', 
            			'title' => $this->chu_de, 
            			'description' => $description, 
            			'cate' => '3', 
            			'link' => $url);
						
        // add job to the index
        Default_Model_LuceneIndex::update($data);
    }
    
    public function deleteLuceneIndex()
    {
    	$pk = 'ht_' . $this->id;
    	Default_Model_LuceneIndex::delete($pk);
    }	
}
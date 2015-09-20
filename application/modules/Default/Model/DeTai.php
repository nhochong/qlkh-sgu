<?php
class Default_Model_DeTai extends Khcn_Model_Item_Abstract{
	
	private $_id;
	private $_ma;
	private $_ten;
	private $_thoi_gian_bat_dau;
	private $_thoi_gian_hoan_thanh;
	private $_tinh_trang;
	private $_so_thang_gia_han;
	private $_kinh_phi;
	private $_cap_quan_ly;
	private $_xep_loai;
	private $_ma_linh_vuc;
	private $_ma_hd_duyet;
	private $_ma_loai;
	private $_ma_don_vi;
	private $_ghi_chu;
	
	protected $de_tai = null;
	
	public function getHref($params = array()){
		$params = array_merge(array(
			'route' => 'default',
			'module' => 'default',
			'controller' => 'de-tai',
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
    	$this->de_tai = new Default_Model_DbTable_DeTai();	
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
    
	public function setThoiGianBatDau($thoiGianBatDau)
    {
        $this->_thoi_gian_bat_dau = $thoiGianBatDau;
        return $this;
    }    
    public function getThoiGianBatDau()
    {
        return $this->_thoi_gian_bat_dau;
    }
    
	public function setThoiGianHoanThanh($thoiGianHoanThanh)
    {
        $this->_thoi_gian_hoan_thanh = $thoiGianHoanThanh;
        return $this;
    }    
    public function getThoiGianHoanThanh()
    {
        return $this->_thoi_gian_hoan_thanh;
    }
    
	public function setTinhTrang($tinhTrang)
    {
        $this->_tinh_trang = $tinhTrang;
        return $this;
    }    
    
    public function getTinhTrang()
    {
        return $this->_tinh_trang;
    }
    
	public function setSoThangGiaHan($soThangGiaHan)
    {
        $this->_so_thang_gia_han = $soThangGiaHan;
        return $this;
    }    
    public function getSoThangGiaHan()
    {
        return $this->_so_thang_gia_han;
    }
    
	public function setKinhPhi($kinhPhi)
    {
        $this->_kinh_phi = $kinhPhi;
        return $this;
    }    
    public function getKinhPhi()
    {
        return $this->_kinh_phi;
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
    
	public function setXepLoai($xepLoai)
    {
        $this->_xep_loai = $xepLoai;
        return $this;
    }    
    public function getXepLoai()
    {
        return $this->_xep_loai;
    }
    
	public function setMaLinhVuc($maLinhVuc)
    {
        $this->_ma_linh_vuc = $maLinhVuc;
        return $this;
    }    
    public function getMaLinhVuc()
    {
        return $this->_ma_linh_vuc;
    }
    
	public function setMaHDDuyet($maHDDuyet)
    {
        $this->_ma_hd_duyet = $maHDDuyet;
        return $this;
    }    
    public function getMaHDDuyet()
    {
        return $this->_ma_hd_duyet;
    }
    
	public function setMaLoai($maLoai)
    {
        $this->_ma_loai = $maLoai;
        return $this;
    }    
    public function getMaLoai()
    {
        return $this->_ma_loai;
    }
    
	public function setMaDonVi($maDonVi)
    {
        $this->_ma_don_vi = $maDonVi;
        return $this;
    }    
    public function getMaDonVi()
    {
        return $this->_ma_don_vi;
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
    
    public function getAll()
    {
    	return $this->de_tai->getAll();
    }
    
    public function getDeTai($id)
    {
    	return $this->de_tai->getDeTai($id);
    }
    public function getChiTietDeTai($id)
    {
    	$result = $this->de_tai->getChiTietDeTai($id);
    	if($result != null){
	    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
	    	$capQLs = Default_Model_Constraints::detai_capquanly();
	    	$xepLoais = Default_Model_Constraints::detai_xeploai();
	    	return array('id' => $result['id'],
	    				 'ma' => $result['ma'],
	    				 'ten' => $result['ten'],
	    				 'ten_linh_vuc' => $result['ten_linh_vuc'],
	    				 'cap_quan_ly' => $capQLs[$result['cap_quan_ly']],
	    				 'hoc_vi' => ($result['hoc_vi']) == '0' ? '' : $result['hoc_vi'] . '. ',
    					 'ten_chu_nhiem' => $result['ho_cn'] . ' ' . $result['ten_cn'],
	    				 'loai_de_tai' => $result['ten_loai'],
	    				 'thoi_gian_bat_dau' => date('d-m-Y',strtotime($result['thoi_gian_bat_dau'])),
	    				 'thoi_gian_hoan_thanh' => ($result['thoi_gian_hoan_thanh'] == null )? '' : date('d-m-Y',strtotime($result['thoi_gian_hoan_thanh'])),
	    				 'tinh_trang' => $tinhTrangs[$result['tinh_trang']],
	    				 'xep_loai' => $xepLoais[$result['xep_loai']],
	    				 'so_thang_gia_han' => $result['so_thang_gia_han'],
	    				 'kinh_phi' => $result['kinh_phi'],
	    				 'ten_don_vi' => $result['ten_don_vi'],
	    				 'ghi_chu' => $result['ghi_chu'] == null ? '' : $result['ghi_chu'],
	    	);
    	}
    	return null;
    }

	public function getDSDT($conds)
    {
    	$deTais = $this->de_tai->getDSDT($conds);
    	$dsDeTais = array();
    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang(); 
    	$capQLs = Default_Model_Constraints::detai_capquanly();
    	$xepLoais = Default_Model_Constraints::detai_xeploai();
    	foreach ($deTais as $deTai)
    	{
    		$dsDeTais[] = array('id' => $deTai['id'],
    							'ma' => $deTai['ma'],
    							'hoc_vi' => ($deTai['hoc_vi']) == '0' ? '' : $deTai['hoc_vi'] . '. ',
    							'ten_chu_nhiem' => $deTai['ho_cn'] . ' ' . $deTai['ten_cn'],
    							'ten' => $deTai['ten'],
    							'ten_linh_vuc' => $deTai['ten_linh_vuc'],
    							'ten_don_vi' => $deTai['ten_don_vi'],
    							'tinh_trang' => $tinhTrangs[$deTai['tinh_trang']],
    							'thoi_gian_bat_dau' => date('d-m-Y',strtotime($deTai['thoi_gian_bat_dau'])),
    							'cap_quan_ly' => $capQLs[$deTai['cap_quan_ly']],
    							'xep_loai' => $xepLoais[$deTai['xep_loai']]
    		);
    	}
    	return $dsDeTais;
    }
	
	public function getDSDTCapTruong($conds)
    {
    	$deTais = $this->de_tai->getDSDTCapTruong($conds);
    	$dsDeTais = array();
    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang(); 
    	$capQLs = Default_Model_Constraints::detai_capquanly();
    	$xepLoais = Default_Model_Constraints::detai_xeploai();
    	foreach ($deTais as $deTai)
    	{
    		$dsDeTais[] = array('id' => $deTai['id'],
    							'ma' => $deTai['ma'],
    							'hoc_vi' => ($deTai['hoc_vi']) == '0' ? '' : $deTai['hoc_vi'] . '. ',
    							'ten_chu_nhiem' => $deTai['ho_cn'] . ' ' . $deTai['ten_cn'],
    							'ten' => $deTai['ten'],
    							'ten_linh_vuc' => $deTai['ten_linh_vuc'],
    							'ten_don_vi' => $deTai['ten_don_vi'],
    							'tinh_trang' => $tinhTrangs[$deTai['tinh_trang']],
    							'thoi_gian_bat_dau' => date('d-m-Y',strtotime($deTai['thoi_gian_bat_dau'])),
    							'cap_quan_ly' => $capQLs[$deTai['cap_quan_ly']],
    							'xep_loai' => $xepLoais[$deTai['xep_loai']]
    		);
    	}
    	return $dsDeTais;
    }
	
	public function getDSDTCapKhoa($conds)
    {
    	$deTais = $this->de_tai->getDSDTCapKhoa($conds);
    	$dsDeTais = array();
    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang(); 
    	$capQLs = Default_Model_Constraints::detai_capquanly();
    	$xepLoais = Default_Model_Constraints::detai_xeploai();
    	foreach ($deTais as $deTai)
    	{
    		$dsDeTais[] = array('id' => $deTai['id'],
    							'ma_don_vi' => $deTai['ma_don_vi'],
								'nam' => date('Y',strtotime($deTai['thoi_gian_bat_dau'])),
    							'hoc_vi' => ($deTai['hoc_vi']) == '0' ? '' : $deTai['hoc_vi'] . '. ',
    							'ten_chu_nhiem' => $deTai['ho_cn'] . ' ' . $deTai['ten_cn'],
    							'ten' => $deTai['ten'],
    							'ten_linh_vuc' => $deTai['ten_linh_vuc'],
    							'ten_don_vi' => $deTai['ten_don_vi'],
    							'tinh_trang' => $tinhTrangs[$deTai['tinh_trang']],
    							'thoi_gian_bat_dau' => date('d-m-Y',strtotime($deTai['thoi_gian_bat_dau'])),
    							'cap_quan_ly' => $capQLs[$deTai['cap_quan_ly']],
    							'xep_loai' => $xepLoais[$deTai['xep_loai']]
    		);
    	}
    	return $dsDeTais;
    }
	
	public function getDSDTCapNgoaiTruong($conds)
    {
    	$deTais = $this->de_tai->getDSDTCapNgoaiTruong($conds);
    	$dsDeTais = array();
    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang(); 
    	$capQLs = Default_Model_Constraints::detai_capquanly();
    	$xepLoais = Default_Model_Constraints::detai_xeploai();
    	foreach ($deTais as $deTai)
    	{
    		$dsDeTais[] = array('id' => $deTai['id'],
								'ma_don_vi' => $deTai['ma_don_vi'],
								'nam' => date('Y',strtotime($deTai['thoi_gian_bat_dau'])),
    							'hoc_vi' => ($deTai['hoc_vi']) == '0' ? '' : $deTai['hoc_vi'] . '. ',
    							'ten_chu_nhiem' => $deTai['ho_cn'] . ' ' . $deTai['ten_cn'],
    							'ten' => $deTai['ten'],
    							'ten_linh_vuc' => $deTai['ten_linh_vuc'],
    							'ten_don_vi' => $deTai['ten_don_vi'],
    							'tinh_trang' => $tinhTrangs[$deTai['tinh_trang']],
    							'thoi_gian_bat_dau' => date('d-m-Y',strtotime($deTai['thoi_gian_bat_dau'])),
    							'cap_quan_ly' => $capQLs[$deTai['cap_quan_ly']],
    							'xep_loai' => $xepLoais[$deTai['xep_loai']]
    		);
    	}
    	return $dsDeTais;
    }

    public function KiemTraLV($ma_linh_vuc)
    {
    	return $this->de_tai->KiemTraLV($ma_linh_vuc);
    }
    
	public function KiemTraLDT($ma_loai)
    {
    	return $this->de_tai->KiemTraLDT($ma_loai);
    }
    
	public function KiemTraHDD($ma_hd_duyet)
    {
    	return $this->de_tai->KiemTraHDD($ma_hd_duyet);
    }
    
	public function kiem_tra_ma($ma)
    {
    	return $this->de_tai->kiem_tra_ma($ma);
    }
    
	public function kiem_tra_id_ma($id,$ma)
    {
    	return $this->de_tai->kiem_tra_id_ma($id,$ma);
    }
    
	public function kiem_tra_cung_linh_vuc($deTais)
    {
    	$count = $this->de_tai->kiem_tra_cung_linh_vuc($deTais);
    	if(count($count) == 1)
    		return true;
    	return false;
    }
    
	public function them()
    {
    	return $this->de_tai->them($this);
    }
    
    public function DeTaiToArray($de_tai)
    { 
    	return array('id' => $de_tai->id,
    				 'ma' => $de_tai->ma,
    				 'ten' => $de_tai->ten,
    				 'ma_linh_vuc' => $de_tai->ma_linh_vuc,
    				 'cap_quan_ly' => $de_tai->cap_quan_ly,
    				 'ma_loai' => $de_tai->ma_loai,
    				 'thoi_gian_bat_dau' => date('d-m-Y',strtotime($de_tai->thoi_gian_bat_dau)),
    				 'thoi_gian_hoan_thanh' => $de_tai->thoi_gian_hoan_thanh == null ? '' : date('d-m-Y',strtotime($de_tai->thoi_gian_hoan_thanh)),
    				 'tinh_trang' => $de_tai->tinh_trang,
    				 'xep_loai' => $de_tai->xep_loai,
    				 'so_thang_gia_han' => $de_tai->so_thang_gia_han,
    				 'kinh_phi' => $de_tai->kinh_phi,
    				 'ma_hd_duyet' => $de_tai->ma_hd_duyet,
    				 'ma_don_vi' => $de_tai->ma_don_vi,
    				 'ghi_chu' => $de_tai->ghi_chu,
					 'nam' => $de_tai->nam
    	);
    } 
    
    public function sua()
    {
    	return $this->de_tai->sua($this);
    }
    
    public function CapNhatTT($id,$status)
    {
    	return $this->de_tai->CapNhatTT($id,$status);
    }
    
    public function xoa($id)
    {
    	return $this->de_tai->xoa($id);
    }
    
	public function loc($params = array())
    {
    	return $this->de_tai->loc($params);
    }
    
    public function getDSDTByLVN($linh_vuc,$nam,$arr = array())
    {
    	$deTais = $this->de_tai->getDSDTByLVN($linh_vuc,$nam,$arr);
    	$dsDeTais = array();
    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
    	foreach ($deTais as $deTai)
    	{
    		$dsDeTais[] = array('id' => $deTai['id'],
    							'ma' => $deTai['ma'],
    							'ten' => $deTai['ten'],
    							'ten_don_vi' => $deTai['ten_don_vi'],
    							'tinh_trang' => $tinhTrangs[$deTai['tinh_trang']],
    		);
    	}
    	return $dsDeTais;
    }
    
    public function getDSDTByHDD($ma_hd_duyet)
    {
    	$deTais = $this->de_tai->getDSDTByHDD($ma_hd_duyet);
    	$dsDeTais = array();
    	$tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
    	foreach ($deTais as $de_tai)
    	{
    		$dsDeTais[] = array('id' => $de_tai['id'],
    							'ma' => $de_tai['ma'],
    							'ten' => $de_tai['ten'],
    							'ten_don_vi' => $de_tai['ten_don_vi'],
    							'tinh_trang' => $tinhTrangs[$de_tai['tinh_trang']],
    							'ten_linh_vuc' => $de_tai['ten_linh_vuc']
    		);
    	}
    	return $dsDeTais;
    }
    
	public function getDSDTByHDDAndDV($ma_hd_duyet,$ma_don_vi)
    {
    	$deTais = $this->de_tai->getDSDTByHDDAndDV($ma_hd_duyet,$ma_don_vi);
    	$dsDeTais = array();
    	foreach ($deTais as $de_tai)
    	{
    		$dsDeTais[] = array('id' => $de_tai['id'],
    							'ma' => $de_tai['ma'],
    							'ten' => $de_tai['ten'],
    							'thoi_gian_bat_dau' => date('m/Y',strtotime($de_tai['thoi_gian_bat_dau'])),
    				 			'thoi_gian_hoan_thanh' => $de_tai['thoi_gian_hoan_thanh'] == null ? '' : date('m/Y',strtotime($de_tai['thoi_gian_hoan_thanh'])),
								'ngay_bat_dau' => $de_tai['thoi_gian_bat_dau'],
    				 			'ngay_hoan_thanh' => $de_tai['thoi_gian_hoan_thanh'],
    							'kinh_phi' => $de_tai['kinh_phi']
    		);
    	}
    	return $dsDeTais;
    }
    
    public function getDTArray($id,$cols)
    {
    	$result = $this->de_tai->getChiTietDeTai($id);
		if($result){
			$data = array();
			$tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
			$capQLs = Default_Model_Constraints::detai_capquanly();
			$xepLoais = Default_Model_Constraints::detai_xeploai();
			foreach ($cols as $col)
			{
				if($col == 'tinh_trang')
					$data[$col] = $tinhTrangs[$result[$col]];
				else if($col == 'cap_quan_ly')
					$data[$col] = $capQLs[$result[$col]];
				else if($col == 'xep_loai')
					$data[$col] = $xepLoais[$result[$col]];
				else 
					$data[$col] = $result[$col];
			}
			return $data;
		}
    	return null;
    }
    
    public function capNhatHdd($id,$ma_hd_duyet)
    {
    	$this->de_tai->capNhatHdd($id,$ma_hd_duyet);
    }
    
    public function clearHdd($ma_hd_duyet)
    {
    	$this->de_tai->clearHdd($ma_hd_duyet);
    }
    
	public function updateLuceneIndex ($id)
    {       
        $de_tai = $this->getChiTietDeTai($id);
        $description = '<table><tr>';
		$description .= '<td>Chủ nhiệm : ' . $de_tai['hoc_vi'] . ' ' . $de_tai['ten_chu_nhiem'] . '</td>';
		$description .= '<td>Lĩnh vực : ' . $de_tai['ten_linh_vuc'] . '</td>';
		$description .= '</tr><tr>';
		$description .= '<td width="50%">Đơn vị : ' . $de_tai['ten_don_vi'] . '</td>';	
		$description .= '<td>Tình trạng : ' . $de_tai['tinh_trang'] . '</td>';	
		$description .= '</tr></table>';
		
		$link = new Zend_View_Helper_Url();
		$url = $link->url(array(    
			            'controller' => 'de-tai',  
			            'action'     => 'chi-tiet',  
			            'id'   => $de_tai['id'],  
			        ),null,true);
		
		$data = array(  'pk' => 'dt_' . $de_tai['id'], 
            			'code' => $de_tai['ma'], 
            			'title' => $de_tai['ten'], 
            			'description' => $description, 
            			'cate' => '0', 
            			'link' => $url);
		
        // add job to the index
        Default_Model_LuceneIndex::update($data);
    }
    
    public function deleteLuceneIndex($id)
    {
    	$pk = 'dt_' . $id;
    	Default_Model_LuceneIndex::delete($pk);
    }
    
    public function getDSDV($nam = null,$cap_quan_ly = null,$ma_loai = null)
    {
    	return $this->de_tai->getDSDV($nam,$cap_quan_ly,$ma_loai);
    } 
    
    public function getDSDVByHDD($nam = '0',$ma_hd_duyet)
    {
    	return $this->de_tai->getDSDVByHDD($nam,$ma_hd_duyet);
    } 
    
    public function getDSDTChapThuan($ma_don_vi,$nam,$cap_quan_ly,$ma_loai = null)
    {
    	$deTais = $this->de_tai->getDSDTChapThuan($ma_don_vi,$nam,$cap_quan_ly,$ma_loai);
    	$dsDeTais = array();
    	foreach ($deTais as $de_tai)
    	{
    		$dsDeTais[] = array('id' => $de_tai['id'],
    							'ma' => $de_tai['ma'],
    							'ten' => $de_tai['ten'],
    							'thoi_gian_bat_dau' => date('m/Y',strtotime($de_tai['thoi_gian_bat_dau'])),
    				 			'thoi_gian_hoan_thanh' => $de_tai['thoi_gian_hoan_thanh'] == null ? '' : date('m/Y',strtotime($de_tai['thoi_gian_hoan_thanh'])),
    							'ngay_bat_dau' => $de_tai['thoi_gian_bat_dau'],
    				 			'ngay_hoan_thanh' => $de_tai['thoi_gian_hoan_thanh'],
								'kinh_phi' => $de_tai['kinh_phi']
    		);
    	}
    	return $dsDeTais;
    }
    
    public function getSLDTByHDD($ma_hd_duyet)
    {
    	return $this->de_tai->getSLDTByHDD($ma_hd_duyet);
    }
    
	public function thong_ke($from, $to, $ma_don_vi = NULL, $limit = 10)
    {
    	try{
	    	$result = array();
	    	$don_vi = new Default_Model_DonVi();
	    	for ($i = $to ; $i >= $from ; $i--){
	    		$arr_don_vi = array();
				$giangVienArr = array();
	    		if($ma_don_vi == null){
		    		$arr_ma_don_vi = $this->de_tai->getDSDV($i);
		    		foreach ($arr_ma_don_vi as $ma_dv){
		    			$arr_don_vi[] = array(  'ten_don_vi' => $don_vi->getTenDonViById($ma_dv),
		    									'so_luong' => $this->de_tai->thong_ke($i,null,$ma_dv)
		    			);
		    		}
					$giangVienArr = Khcn_Api::_()->getDbTable('de_tai', 'default')->getThongKeGVByNam($i, $limit);
	    		}else{
					$giangVienArr = Khcn_Api::_()->getDbTable('de_tai', 'default')->getThongKeGVByNam($i, $limit, $ma_don_vi);
				}
				
	    		$result[] = array(  'nam' => $i,
	    							'tong_so_dt' => $this->de_tai->thong_ke($i,null,$ma_don_vi),
	    							'cap_truong' => $this->de_tai->thong_ke($i,array('cap_quan_ly' => 2),$ma_don_vi),
	    							'cap_khoa' => $this->de_tai->thong_ke($i,array('cap_quan_ly' => 1),$ma_don_vi),
	    							'cac_cap_ngoai_truong' => $this->de_tai->thong_ke($i,array('cap_quan_ly' => 3),$ma_don_vi),
	    							'chua_duyet' => $this->de_tai->thong_ke($i,array('tinh_trang' => 1),$ma_don_vi),
						    		'khong_duyet' => $this->de_tai->thong_ke($i,array('tinh_trang' => 2),$ma_don_vi),
						    		'da_duyet' => $this->de_tai->thong_ke($i,array('tinh_trang' => 3),$ma_don_vi),
						    		'da_nghiem_thu' => $this->de_tai->thong_ke($i,array('tinh_trang' => 4),$ma_don_vi),
						    		'khong_nghiem_thu' => $this->de_tai->thong_ke($i,array('tinh_trang' => 5),$ma_don_vi),
						    		'trung_binh' => $this->de_tai->thong_ke($i,array('xep_loai' => 1),$ma_don_vi),
						    		'kha' => $this->de_tai->thong_ke($i,array('xep_loai' => 2),$ma_don_vi),
						    		'gioi' => $this->de_tai->thong_ke($i,array('xep_loai' => 3),$ma_don_vi),
						    		'xuat_sac' => $this->de_tai->thong_ke($i,array('xep_loai' => 4),$ma_don_vi),
	    							'khong_dat' => $this->de_tai->thong_ke($i,array('xep_loai' => 5),$ma_don_vi),
	    							'don_vi' => $arr_don_vi,
									'giang_vien_arr' => $giangVienArr
	    		);
	    	}   	
	    	return $result;
    	}catch (Zend_Db_Exception $ex){
    		throw $ex;
    	}
    }
    
    public function getEmailCNByDT($ma_de_tai)
    {
    	return $this->de_tai->getEmailCNByDT($ma_de_tai);
    }
    
    public function getDSDTSelect($conds)
    {
    	$deTais = $this->de_tai->getDSDTSelect($conds);
    	$result = array();
    	foreach ($deTais as $de_tai){
    		$result[$de_tai['id']] = $de_tai['ma'];
    	}
    	return $result;
    }
	
	public function getNam(){
		if(!empty($this->nam))
			return $this->nam;
		if(!empty($this->ma)){
			$nam = substr($this->ma, 2, 4);
			if(is_numeric($nam))
				return $nam;
		}
		if(!empty($this->thoi_gian_bat_dau))
			return date('Y', strtotime($this->thoi_gian_bat_dau));
		return date('Y');
	}
	
	public function getDonVi(){
		return Khcn_Api::_()->getItem('default_don_vi', $this->ma_don_vi);
	}
	
	public function getChucVuByGV($giang_vien){
		$nhiemVus = Default_Model_Constraints::dangky_nhiemvu();
		$table = Khcn_Api::_()->getDbTable('dang_ky', 'default');
		$select = $table->select()
						->where('ma_de_tai = ?', $this->getIdentity())
						->where('ma_giang_vien = ?', $giang_vien->getIdentity());
		$row = $table->fetchRow($select);
		if($row){
			return $nhiemVus[$row->nhiem_vu];
		}
		return $nhiemVus[1];
	}
	
	public function getLinhVuc(){
		return Khcn_Api::_()->getItem('default_linh_vuc', $this->ma_linh_vuc);
	}
	
	public function getBoMon(){
		return Khcn_Api::_()->getItem('default_bo_mon', $this->bo_mon_id);
	}
	
	public function getLoaiDeTai(){
		return Khcn_Api::_()->getItem('default_loai_dt', $this->ma_loai);
	}
	
	public function getChuNhiem(){
		$table = Khcn_Api::_()->getDbTable('dang_ky', 'default');
		$select = $table->select()
						->where('ma_de_tai = ?', $this->getIdentity())
						->where('nhiem_vu = 1')
						->limit(1);
		$row = $table->fetchRow($select);
		return Khcn_Api::_()->getItem('default_giang_vien', $row->ma_giang_vien); 
	}
	
	public function getTenCapQuanLy(){
		$capQLs = Default_Model_Constraints::detai_capquanly();
		return $capQLs[$this->cap_quan_ly];
	}
	
	public function getTenTinhTrang(){
		$tinhTrangs = Default_Model_Constraints::detai_tinhtrang();
		return $tinhTrangs[$this->tinh_trang];
	}
	
	public function getTenXepLoai(){
		$xepLoais = Default_Model_Constraints::detai_xeploai();
		return $xepLoais[$this->xep_loai];
	}
	
	public function soNamThucHien(){
		return date('Y', strtotime($this->thoi_gian_hoan_thanh)) - date('Y', strtotime($this->thoi_gian_bat_dau));
	}
}
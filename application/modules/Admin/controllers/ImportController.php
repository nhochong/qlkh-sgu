<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */
set_time_limit(0);
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel/IOFactory.php';

class Admin_ImportController extends Khcn_Controller_Action_Admin
{
	protected $de_tai = null;
	protected $giang_vien = null;
	protected $linh_vuc = null;
	protected $dang_ky = null;
	protected $don_vi = null;
	protected $hoc_vi = null;
	protected $loai_lv = null;
	
	public function init ()
    {
        $this->de_tai = new Default_Model_DeTai();
		$this->giang_vien = new Default_Model_GiangVien();
		$this->dang_ky = new Default_Model_DangKy();
		$this->linh_vuc = new Default_Model_LinhVuc();
		$this->don_vi = new Default_Model_DonVi();
		$this->hoc_vi = new Default_Model_HocVi();
		$this->loai_lv = new Default_Model_LoaiLinhVuc();
    }
    
    public function indexAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        
    }
	
    public function importDtAction()
    {
    	$form = new Admin_Form_ImportDT();
    	$this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{
				if($form->getValue('ma_don_vi') == '0'){
					$_SESSION['msg'] = 'Lỗi !. Bạn chưa chọn đơn vị để import, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/import/import-dt');
				}
				//copy file to folder temp
				//determine filename and extension 
                $info = pathinfo($form->file->getFileName(null,false));
                $filename = $info['filename']; 
                $ext = $info['extension']?".".$info['extension']:""; 
                //filter for renaming.. prepend with current time 
                $file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
                $form->file->addFilter(new Zend_Filter_File_Rename(array( 
                                "target"=>$file, 
                                "overwrite"=>true)));
                $form->getValue('file');
                
                try{
	                $this->import_dt(BASE_PATH . '/upload/files/temp/' . $file);
                }catch (Zend_Exception $ex){
                	//xóa file trong temp
                	unlink(BASE_PATH . '/upload/files/temp/' . $file);
                	$_SESSION['msg'] = 'Lỗi !. File không đúng định dạng, vui lòng kiểm tra lại.';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/import/import-dt');
                } 
                     
	            $session = new Zend_Session_Namespace('import_dt');
	            $this->save_dt($form->getValue('ma_don_vi'),$form->getValue('nam'),$session->deTais,$session->thanhViens);
              	//remove file in temp
              	unlink(BASE_PATH . '/upload/files/temp/' . $file);
	            $this->_redirect('/admin/import/finish-dt');        
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
    
	public function import_dt($inputFileName)
    {
    	try{
			//$inputFileType = 'Excel2007';
			$inputFileType = 'Excel5';
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			$data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
	    	$result = '';
	    	$session = new Zend_Session_Namespace('import_dt');
	    	$deTais = array();
	    	$thanhViens = array();
	    	$count = -1;
	    	for($row = 10; $row <= count($data) ; $row++)    
	        {       
	        	//if cell[$row,B] là đề tài mới
	        	if(!empty($data[$row]['B'])){
	        		//luu de tai
					$cap_quan_ly = Default_Model_Functions::convert_vi_to_en(strtolower(trim($data[$row]['M'])));
	        		$deTais[] = array(
	        						'ten' => $data[$row]['B'],
	        						'linh_vuc' => trim($data[$row]['C']),
	        						'thoi_gian_bat_dau' => trim($data[$row]['K']),
	        						'thoi_gian_hoan_thanh' => trim($data[$row]['L']),
	        						'cap_quan_ly' => $cap_quan_ly,
									'kinh_phi' => trim($data[$row]['N'])
	        		);
	        		//luu chu nhiem        		
	        		$count++;
	        		$thanhViens[$count][] = array('ma_giang_vien' => trim($data[$row]['E']),
	        									  'ho_ten' => preg_replace('/\s+/u', ' ', trim($data[$row]['F'])),
	        									  'hoc_vi' => trim($data[$row]['G']),
	        									  'ghi_chu' => trim($data[$row]['H']),
	        									  'nhiem_vu' => '1',
	        									  'email' => trim($data[$row]['I']),
	        									  'so_dien_thoai' => trim($data[$row]['J']),
	        		);
	        	}else{
	        		//luu thanh vien neu co
	        		if(!empty($data[$row]['F'])){
		        		$thanhViens[$count][] = array('ma_giang_vien' => trim($data[$row]['E']),
		        									  'ho_ten' => preg_replace('/\s+/u', ' ', trim($data[$row]['F'])),
		        									  'hoc_vi' => trim($data[$row]['G']),
		        									  'ghi_chu' => trim($data[$row]['H']),
		        									  'nhiem_vu' => '0',
	        									  	  'email' => trim($data[$row]['I']),
	        									  	  'so_dien_thoai' => trim($data[$row]['J']),
		        		);
	        		}
	        	}
	        }
	        $session->deTais = $deTais;
	        $session->thanhViens = $thanhViens;	
    	}catch (Zend_Exception $ex){
    		throw $ex;
    	}
    }

    public function save_dt($id_don_vi,$nam,$deTais,$thanhViens)
    {
		$tableDT = Khcn_Api::_()->getDbTable('de_tai', 'default');
		$tableGV = Khcn_Api::_()->getDbTable('giang_vien', 'default');
    	$don_vi = $this->don_vi->getDonVi($id_don_vi);
    	$ma_don_vi = $don_vi['ma'];   	
    	$str = '';
    	$dts = array();
    	$tong_so_gv = 0;
    	$gv_sai_ma_don_vi = array();
    	$gv_sai_ma_hoc_vi = array();
    	$session = new Zend_Session_Namespace('imported_dt');
    	$session->ma_don_vi = $id_don_vi;
    	$session->nam = $nam;
    	$db = $tableDT->getAdapter();
		$db->beginTransaction();
		try{
			for($i = 0 ; $i<count($deTais) ; $i++){	
				//tao ma cho de tai			
				//linh vuc
				$ma_loai_lv = 'CS';
				$linh_vuc = $this->linh_vuc->getLVByMa($deTais[$i]['linh_vuc']);
				$loai_lv = $this->loai_lv->getLoaiLV($linh_vuc['ma_loai']);
				if($loai_lv)
					$ma_loai_lv = $loai_lv['ma'];			
				$id_linh_vuc = $linh_vuc['id'];
				$cap_quan_ly = $deTais[$i]['cap_quan_ly'];
				$ma = '';	
				if($cap_quan_ly != 'cap-khoa'){
					$count_m_t = 1;
					while ($ma == ''){    	
						if($count_m_t < 10)
							$temp_m = $ma_loai_lv . $nam .'-0' . $count_m_t++; 
						else 
							$temp_m = $ma_loai_lv . $nam .'-' . $count_m_t++; 	
						
						if(!$this->de_tai->kiem_tra_ma($temp_m)){
							$ma = $temp_m;
						}
					}
				}
				
				//dinh dang ngay thang
				$sperator = array('/',' ');
				$tgbd = '01-' . str_replace($sperator,'-',$deTais[$i]['thoi_gian_bat_dau']);
				$tght = '01-' . str_replace($sperator,'-',$deTais[$i]['thoi_gian_hoan_thanh']);
				$thoi_gian_bat_dau = date('Y-m-d',strtotime($tgbd));
				$thoi_gian_hoan_thanh = date('Y-m-d',strtotime($tght));
				
				//cap quan ly
				if($cap_quan_ly == 'cap-khoa')
					$cap_quan_ly = 1;
				else 
					$cap_quan_ly = 2;   			
				
				$kinh_phi = 0;
				if(!empty($deTais[$i]['kinh_phi']) && is_numeric($deTais[$i]['kinh_phi']))
					$kinh_phi = $deTais[$i]['kinh_phi'];
				
				try{
					//them de tai
					$de_tai = $tableDT->createRow();
					$de_tai->ma = $ma;
					$de_tai->ten = $deTais[$i]['ten'];
					$de_tai->thoi_gian_bat_dau = $thoi_gian_bat_dau;
					$de_tai->thoi_gian_hoan_thanh = $thoi_gian_hoan_thanh;
					$de_tai->tinh_trang = 1;
					$de_tai->kinh_phi = $kinh_phi;
					$de_tai->cap_quan_ly = $cap_quan_ly;
					$de_tai->ma_linh_vuc = $id_linh_vuc;
					$de_tai->ma_don_vi = $id_don_vi;
					$de_tai->nam = $nam;
						
					$kq = $de_tai->save();
				}catch(Zend_Db_Exception $e){
					$str .= $deTais[$i]['ten'] . ', ';
					continue;
				}			
				
				$dt_id = $de_tai->id;
				$dts[$dt_id] = $dt_id;
				//them thanh vien
				$tvs = $thanhViens[$i];
				foreach ($tvs as $thanh_vien){
					$tong_so_gv++;
					$tv_id = null;
					$sai_ma_hv = false;
					$sai_ma_dv = false;
					//kiem tra neu co nhap ma giang vien
					$ho_ten = Default_Model_Functions::tach_ho_ten($thanh_vien['ho_ten']);
					
					// Get ID Hoc Vi
					$id_hv = $this->hoc_vi->getIdByMa($thanh_vien['hoc_vi']);
					if($id_hv == null){
						$sai_ma_hv = true;
						//set hoc vi la chua xac dinh
						$id_hv = 9;
					}
					
					// Get ID Don Vi
					if(!empty($thanh_vien['ghi_chu'])){
						//kiem tra neu nhap sai ma don vi,thi dua vao danh sach gv chua xac dinh don vi
						$id_dv = $this->don_vi->getIdByMa($thanh_vien['ghi_chu']);
						if($id_dv == null){
							$sai_ma_dv = true;
							$id_dv = $id_don_vi;  
						}						
					}else{
						$id_dv = $id_don_vi;					
					}
					
					if(!empty($thanh_vien['ma_giang_vien'])){
						//kiem tra ton tai ma giang vien
						$giang_vien = $tableGV->getGVByMa($thanh_vien['ma_giang_vien']);
						if($giang_vien){
							$tv_id = $giang_vien->id;					
						}
					}
					// Get GV By ho_ten, dv, hv
					if($tv_id == null){
						$giang_vien = $tableGV->checkExistImport($thanh_vien['ho_ten'],$id_dv,$id_hv);
						if($giang_vien == null){	
							$giang_vien = $tableGV->createRow();
							$giang_vien->ho = $ho_ten['ho'];
							$giang_vien->ten = $ho_ten['ten'];
							$giang_vien->ma_hoc_vi = $id_hv;
							$giang_vien->ma_don_vi = $id_dv;
							$giang_vien->trang_thai = 1;
							$giang_vien->save();
						}
						$tv_id = $giang_vien->id;
					}
					//neu co nhap email - so dien thoai thi cap nhat lai
					if(!empty($thanh_vien['email']))
						$giang_vien->email = $thanh_vien['email'];
					if(!empty($thanh_vien['so_dien_thoai']))
						$giang_vien->so_dien_thoai = $thanh_vien['so_dien_thoai'];  	
					$giang_vien->save();
					
					// Them dang ky
					$dang_ky = new Default_Model_DangKy();
					$dang_ky->setMaDeTai($dt_id)
							->setMaGiangVien($tv_id)
							->setNhiemVu($thanh_vien['nhiem_vu']);
					$dang_ky->them();
					
					if($sai_ma_dv)
						$gv_sai_ma_don_vi[$tv_id] = $thanh_vien['ho_ten'];
					if($sai_ma_hv)
						$gv_sai_ma_hoc_vi[$tv_id] = $thanh_vien['ho_ten'];
				}
			}
			$db->commit();
			if($str != ''){
				$_SESSION['msg'] = "Lỗi. Các đề tài sau đây không import được : " . $str;
				$_SESSION['type_msg'] = "error";
			}else{
				$_SESSION['msg'] = "Thành công! Dữ liệu đã được lưu trữ.";
				$_SESSION['type_msg'] = "success";
			}
			$session->deTais = $dts;
			$session->tong_so_gv = $tong_so_gv;
			$session->gv_sai_ma_hoc_vi = $gv_sai_ma_hoc_vi;
			$session->gv_sai_ma_don_vi = $gv_sai_ma_don_vi;
		} catch( Exception $e ){
			$db->rollBack();
			throw $e;
		}
    }
    
    public function finishDtAction()
    {
    	$session = new Zend_Session_Namespace('imported_dt');
    	if(isset($session->deTais)){
	    	$deTais = array();
	    	$cols = array('id','ma','ten','ten_linh_vuc');
	    	foreach ($session->deTais as $id){
	    		$data = $this->de_tai->getDTArray($id,$cols);
				if(!empty($data))
					$deTais[] = $data;
	    	}
	    	
	    	$don_vi = $this->don_vi->getDonVi($session->ma_don_vi);
	    	$this->view->deTais = $deTais;
	    	$this->view->ten_don_vi = $don_vi['ten'];
	    	$this->view->nam = $session->nam;
	    	$this->view->tong_so_dt = count($session->deTais);
	    	$this->view->tong_so_gv = $session->tong_so_gv;
	    	$this->view->gv_sai_ma_hoc_vi = $session->gv_sai_ma_hoc_vi;
	    	$this->view->gv_sai_ma_don_vi = $session->gv_sai_ma_don_vi;
    	}
    }
    
    public function previewAction()
    {
    	
    }
}

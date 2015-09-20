<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_HoiDongController extends Khcn_Controller_Action_Admin
{
	protected $hd_duyet = null;
	protected $hd_nghiem_thu = null;
	protected $pc_duyet = null;
	protected $pc_nghiem_thu = null;
	
	public function init ()
    {
        $this->hd_duyet = new Default_Model_Hdd();
        $this->hd_nghiem_thu = new Default_Model_Hdnt();
        $this->pc_duyet = new Default_Model_Pcd();
        $this->pc_nghiem_thu = new Default_Model_Pcnt();
    }
    
    public function indexAction() 
    {
        
    }
    
    public function danhSachHddAction()
    {    	   	
    	$this->view->form = $form = new Admin_Form_FilterHDD();    
		$params = Default_Model_Functions::filterParams($this->_getAllParams());	
		$_SESSION['filterHDD'] = $_SERVER['QUERY_STRING'];
		if(empty($params)){
			$params['nam'] = date('Y');
		}
		if( empty($params['order']) ) {
			$params['order'] = 'ma';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'ASC';
		} 		
        $form->populate($params);
        $hdds = $this->hd_duyet->loc($params);
		if($hdds == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}	
                	      
        //Set the properties for the pagination
        $paginator = Zend_Paginator::factory($hdds);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
		$this->view->filterValues = $params;
		$this->view->order = $params['order'];
		$this->view->direction = $params['direction'];
    }
    
	public function danhSachHdntAction()
    {    	  	
    	$this->view->form = $form = new Admin_Form_FilterHDNT();  
		$params = Default_Model_Functions::filterParams($this->_getAllParams());	
		$_SESSION['filterHDNT'] = $_SERVER['QUERY_STRING'];
		if(empty($params)){
			$params['nam'] = date('Y');
		}
		if( empty($params['order']) ) {
			$params['order'] = 'ma';
		}
		if( empty($params['direction']) ) {
			$params['direction'] = 'ASC';
		} 	
        $form->populate($params);	
        $hdnts = $this->hd_nghiem_thu->loc($params);
		if($hdnts == null){
			$_SESSION['msg'] = 'Không tìm thấy dữ liệu, vui lòng thử lại .';
			$_SESSION['type_msg'] = 'attention';
		}	      	

        //Set the properties for the pagination                        	
        $paginator = Zend_Paginator::factory($hdnts);
        $paginator->setItemCountPerPage(20);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
		$this->view->filterValues = $params;
		$this->view->order = $params['order'];
		$this->view->direction = $params['direction'];
    }
    
    public function kiemTraMaHddAction()
    {  	
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
    		if(!Default_Model_Functions::kiem_tra_ma($ma, 'HDD',true)){
    			echo "ERROR";
    		}else if($this->hd_duyet->kiem_tra_ma($ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function kiemTraIdMaHddAction()
    {  	
    	$id = $_POST['id'];
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if(!Default_Model_Functions::kiem_tra_ma($ma, 'HDD',true)){
    			echo "ERROR";
    		}else if($this->hd_duyet->kiem_tra_id_ma($id,$ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function kiemTraMaHdntAction()
    {  	
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if(!Default_Model_Functions::kiem_tra_ma($ma, 'HDNT',true)){
    			echo "ERROR";
    		}else if($this->hd_nghiem_thu->kiem_tra_ma($ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }
    
	public function kiemTraIdMaHdntAction()
    {  	
    	$id = $_POST['id'];
    	$ma = $_POST['ma'];
    	if(!empty($ma)){
	    	if(!Default_Model_Functions::kiem_tra_ma($ma, 'HDNT',true)){
    			echo "ERROR";
    		}else if($this->hd_nghiem_thu->kiem_tra_id_ma($id,$ma)){
	    		echo "YES";
	    	}else{
	    		echo "NO";
	    	}   
    	}
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    }

	public function themHddAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_HDD();
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'hoi-dong','action' => 'danh-sach-hdd'),null,true);
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu')
        			 ->setAttribs(array('onclick' => 'window.location.href="' . $link . '"'));
        $this->view->form = $form;
    	
    	if($this->getRequest()->isPost()){
			$form->preValidation($_POST);
			$formData = $this->getRequest()->getPost();
			foreach ($formData as $k=>$v){
				if(strpos($k, 'thanh_vien_') !== false && $v == '0')
					$formData[$k] = null;
			}
			if($form->isValid($formData)){	
				if(!Default_Model_Functions::kiem_tra_ma($form->getValue('ma'), 'HDD',true)){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng duyệt không đúng định dạng, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
				}
				if($this->hd_duyet->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng duyệt đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
				}	
				//kiem tra linh vuc cua danh sach de tai						
				$de_tai = new Default_Model_DeTai();	
				$deTais = array();
				if(isset($_POST['item_selected'])){
					if(isset($_POST['item'])){
						$deTais = array_merge($_POST['item_selected'],$_POST['item']);
					}else{
						$deTais = $_POST['item_selected'];
					}
				}else{
					if(isset($_POST['item']))
						$deTais = $_POST['item'];
				}
				if($deTais && !$de_tai->kiem_tra_cung_linh_vuc($deTais)){
					$_SESSION['msg'] = 'Lỗi !. Các đề tài được chọn không cùng lĩnh vực .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
				}
				$db = Zend_Registry::get('connectDB');									
				$hd_duyet = new Default_Model_Hdd();
				$hd_duyet->setMa($form->getValue('ma'))
		                 ->setNgayThanhLap(date('Y-m-d',strtotime($form->getValue('ngay_thanh_lap'))))
		                 ->setGhiChu($form->getValue('ghi_chu'));
                
				$kq = $hd_duyet->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
				}
				
				//them phan cong hoi dong
				$hdd_id = $db->lastInsertId();
				for($i = 0 ; $i<= 5 ; $i++){		
					//kiem tra co chon giang vien
					if($form->getValue('thanh_vien_' . $i) != '0'){
						$pc_duyet = new Default_Model_Pcd();
						$pc_duyet->setMaGiangVien($form->getValue('thanh_vien_' . $i))
								 ->setMaHdDuyet($hdd_id);
						if($i == 0)
							$pc_duyet->setChucDanh('0');
						else if($i == 5)
							$pc_duyet->setChucDanh('2');
						else 
							$pc_duyet->setChucDanh('1');
						$pc_duyet->them();
					}
				}	

				//update hdd cho de tai					
				foreach ($deTais as $id){
					$de_tai->capNhatHdd($id,$hdd_id);
				}

				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/hoi-dong/them-hdd');					
				}else{
					$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
				}
			}else{
				$form->populate($formData);
			}
		}
    }
    
    public function listDtAction()
    {
    	$ma_linh_vuc = $_POST['ma_linh_vuc'];
    	$nam = $_POST['nam'];
    	$de_tai = new Default_Model_DeTai();
    	if(isset($_POST['item_selected']) && !empty($_POST['item_selected'])){
    		$deTais = $de_tai->getDSDTByLVN($ma_linh_vuc,$nam,$_POST['item_selected']);
    	}else{
    		$deTais = $de_tai->getDSDTByLVN($ma_linh_vuc,$nam);
    	}    	    	
    	$hd = $this->_getParam('hd');
    	$this->view->hd = $hd;
    	$this->view->deTais = $deTais;
    	$this->view->checked = '';
        $this->_helper->layout->disableLayout();
    }
    
	public function filterDtAction()
    {
    	$de_tai = new Default_Model_DeTai();
    	$deTais = array();
    	$cols = array('id','ma','ten','ten_don_vi');
    	foreach ($_POST['item'] as $id)
    	{
    		$data = $de_tai->getDTArray($id,$cols);
    		$deTais[] = $data;
    	}
    	$hd = $this->_getParam('hd');
    	$this->view->hd = $hd;
    	$this->view->checked = 'checked';
    	$this->view->deTais = $deTais;
    	$this->_helper->viewRenderer('list-dt');
        $this->_helper->layout->disableLayout();	
    }
    
	public function selectedDtAction()
    { 	
	    $de_tai = new Default_Model_DeTai();	    
	    $hd = $this->_getParam('hd');
	    $deTais = array();
	    if($hd == 'hdd'){	    	
		    //kiem tra neu dsdt dc chon tu suaHddAction(HoiDongController) hay themHddAction(DeTaiController)
	    	$session = new Zend_Session_Namespace('them_hdd');
	    	if(isset($session->dsdt)){
	    		$cols = array('id','ma','ten','ten_don_vi','ten_linh_vuc');
		    	foreach ($session->dsdt as $id)
		    	{
		    		$data = $de_tai->getDTArray($id,$cols);
		    		$deTais[] = $data;
		    	}
		    	$session->dsdt = null;
		    	$this->view->field_linh_vuc = true;
	    	}else if(isset($_POST['id'])){
		    	$id = $_POST['id'];
		    	$deTais = $de_tai->getDSDTByHDD($id);
		    	$this->view->field_linh_vuc = true;
	    	}    	
	    }else{
	    	$hdnt = $this->hd_nghiem_thu->getHDNT($_POST['id']);
	    	$cols = array('id','ma','ten','ten_don_vi','ten_linh_vuc');
	    	$deTais[] = $de_tai->getDTArray($hdnt['ma_de_tai'],$cols);
	    	$this->view->field_linh_vuc = true;
	    }
	    
    	if($deTais){
    		$this->view->hd = $hd;
	    	$this->view->deTais = $deTais;
	    	$this->view->checked = 'checked';
    	}else{
    		$this->_helper->viewRenderer->setNoRender();
    	}
        $this->_helper->layout->disableLayout();	
    }
    
    public function xoasHddAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
		}
		
		$db = Zend_Registry::get('connectDB');
		$de_tai = new Default_Model_DeTai();
    	$str = '';
		foreach($_POST['item'] as $id){			
			$hdd = $this->hd_duyet->getHDD($id);			
			if($hdd != NULL)
			{			
				if($de_tai->KiemTraHDD($id))
				{
					$str .= $hdd['ma'] . ', ';
					continue;
				}
				
				$db->beginTransaction();
				try{			
					//xoa database
					$this->hd_duyet->xoa($id);
					$this->pc_duyet->xoa_tv_by_mhd($id);			
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$str .= $hdd['ma'] . ', ';
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các hội đồng duyệt sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoi-dong/danh-sach-hdd');	
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
    }
    
	public function xoaHddAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$hdd = $this->hd_duyet->getHDD($id);
    		if($hdd != null){
    			$de_tai = new Default_Model_DeTai();
    			if($de_tai->KiemTraHDD($id))
    			{
    				$_SESSION['msg'] = 'Lỗi !. Tồn tại dữ liệu liên quan.Vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
    			}
				$db = Zend_Registry::get('connectDB');	
    			$db->beginTransaction();
				try{			
					//xoa database
					$this->hd_duyet->xoa($id);
					$this->pc_duyet->xoa_tv_by_mhd($id);			
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
				}	  
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã hội đồng duyệt không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
    		}
    	}else{
    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd');
    	}
    }
    
	public function suaHddAction()
    {
    	$form = new Admin_Form_HDD();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
        	$form->preValidation($_POST);
            $formData = $this->getRequest()->getPost();
			foreach ($formData as $k=>$v){
				if(strpos($k, 'thanh_vien_') !== false && $v == '0')
					$formData[$k] = null;
			}
            if ($form->isValid($formData)) {
            	if(!Default_Model_Functions::kiem_tra_ma($form->getValue('ma'), 'HDD',true)){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng duyệt không đúng định dạng, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd?' . $_SESSION['filterHDD']);
				}
            	if($this->hd_duyet->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng duyệt đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd?' . $_SESSION['filterHDD']);
				}
            	$db = Zend_Registry::get('connectDB');			
				$db->beginTransaction();
				try{											
					$hdd = new Default_Model_Hdd();
					$id = $form->getValue('id');
					$hdd->setId($id)
						->setMa($form->getValue('ma'))
			            ->setNgayThanhLap(date('Y-m-d',strtotime($form->getValue('ngay_thanh_lap'))))
			            ->setGhiChu($form->getValue('ghi_chu'));
	                
					$hdd->sua();
					
					//cat nhat thanh vien hoi dong
					$pc_duyet = new Default_Model_Pcd();
					$thanhViens = array();
					for($i = 0 ; $i<= 5 ; $i++){		
						//kiem tra co chon giang vien
						if($form->getValue('thanh_vien_' . $i) != 0){
							if($i == 0)
								$thanhViens[] = array('ma_giang_vien' => $form->getValue('thanh_vien_' . $i),
													  'chuc_danh' => '0');
							else if($i == 5)
								$thanhViens[] = array('ma_giang_vien' => $form->getValue('thanh_vien_' . $i),
													  'chuc_danh' => '2');
							else 
								$thanhViens[] = array('ma_giang_vien' => $form->getValue('thanh_vien_' . $i),
													  'chuc_danh' => '1');
						}
					}	
					$pc_duyet->capNhatTV($id,$thanhViens);
					
					//cat nhat danh sach de tai
					$deTais = array();
					if(isset($_POST['item_selected'])){
						if(isset($_POST['item'])){
							$deTais = array_merge($_POST['item_selected'],$_POST['item']);
						}else{
							$deTais = $_POST['item_selected'];
						}
					}else{
						if(isset($_POST['item']))
							$deTais = $_POST['item'];
					}

					
					$de_tai = new Default_Model_DeTai();
					$de_tai->clearHdd($id);
					if($deTais != null){
						foreach ($deTais as $ma_de_tai){
							$de_tai->capNhatHdd($ma_de_tai,$id);
						}		
					}
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdd?' . $_SESSION['filterHDD']);
				}
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/hoi-dong/danh-sach-hdd?' . $_SESSION['filterHDD']);
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->hd_duyet->getHDD($id);
	            if($data != null){
	            	$data = $this->hd_duyet->HDDToArray($data);
	            	$data['ma_linh_vuc'] = $this->hd_duyet->getLinhVucByHD($data['id']); 
	            	$data['nam'] = substr($data['ma'],3,4);
	            	//lay danh sach giang vien trong hoi dong	
	            	$thanhViens = $this->pc_duyet->getDSGVByHDD($id);
	            	$i = 0;
	            	foreach ($thanhViens as $thanh_vien)
	            	{	       
	            		$dv = 'don_vi_' . $i;
	            		$tv = 'thanh_vien_' . $i;
	            		$data[$dv] = $thanh_vien['ma_don_vi'];
	            		$giang_vien = new Default_Model_GiangVien();
						$gvOptions = $giang_vien->getDSGVByDV($thanh_vien['ma_don_vi']);
						$form->$tv->addMultiOptions($gvOptions)
									   ->setValue($thanh_vien['ma_giang_vien']);
						$i++;
	            	}
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã hội đồng duyệt không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/danh-sach-hdd?' . $_SESSION['filterHDD']);
	            }
        	}else{
            	$this->_redirect('/admin/hoi-dong/danh-sach-hdd?' . $_SESSION['filterHDD']);
            }
        }
    }
    
	public function themHdntAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_HDNT();
        $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'hoi-dong','action' => 'danh-sach-hdnt'),null,true);
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu')
        			 ->setAttribs(array('onclick' => 'window.location.href="' . $link . '"'));
        $this->view->form = $form;  	
    	if($this->getRequest()->isPost()){
			$form->preValidation($_POST);
			$formData = $this->getRequest()->getPost();
			foreach ($formData as $k=>$v){
				if(strpos($k, 'thanh_vien_') !== false && $v == '0')
					$formData[$k] = null;
			}
			if($form->isValid($formData)){
				if(!Default_Model_Functions::kiem_tra_ma($form->getValue('ma'), 'HDNT',true)){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng nghiệm thu không đúng định dạng, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
				}
				if($this->hd_nghiem_thu->kiem_tra_ma($form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng nghiệm thu đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
				}		
				$db = Zend_Registry::get('connectDB');									
				$hd_nghiem_thu = new Default_Model_Hdnt();
				$hd_nghiem_thu->setMa($form->getValue('ma'))
		                 	  ->setNgayThanhLap(date('Y-m-d',strtotime($form->getValue('ngay_thanh_lap'))))
		                 	  ->setGhiChu($form->getValue('ghi_chu'))
		                 	  ->setMaDeTai($_POST['hdnt'][0]);
                
				$kq = $hd_nghiem_thu->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
				}
				
				//them phan cong hoi dong
				$hdnt_id = $db->lastInsertId();
				for($i = 0 ; $i<= 4 ; $i++){		
					//kiem tra co chon giang vien
					if($form->getValue('thanh_vien_' . $i) != 0){
						$pc_nghiem_thu = new Default_Model_Pcnt();
						$pc_nghiem_thu->setMaGiangVien($form->getValue('thanh_vien_' . $i))
								 	  ->setMaHdNghiemThu($hdnt_id)
								 	  ->setChucDanh($i);
						$pc_nghiem_thu->them();
					}
				}	
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/hoi-dong/them-hdnt');					
				}else{
					$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
				}
			}else{
				$form->populate($formData);
			}
		}
    }
    
	public function xoasHdntAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
		}
		
		$db = Zend_Registry::get('connectDB');
    	$str = '';
		foreach($_POST['item'] as $id){			
			$hdnt = $this->hd_duyet->getHDNT($id);			
			if($hdnt != NULL)
			{
				$db->beginTransaction();
				try{			
					//xoa database
					$this->hd_nghiem_thu->xoa($id);
					$this->pc_nghiem_thu->xoa_tv_by_mhd($id);			
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$str .= $hdnt['ma'];
				}
			}			
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các hội đồng nghiệm thu sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');	
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
    }
    
	public function xoaHdntAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$hdnt = $this->hd_nghiem_thu->getHDNT($id);
    		if($hdnt != null){
				$db = Zend_Registry::get('connectDB');	
    			$db->beginTransaction();
				try{			
					//xoa database
					$this->hd_nghiem_thu->xoa($id);
					$this->pc_nghiem_thu->xoa_tv_by_mhd($id);			
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
				}	  
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã hội đồng nghiệm thu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
    		}
    	}else{
    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt');
    	}
    }
    
	public function suaHdntAction()
    {
    	$form = new Admin_Form_HDNT();
    	$form->removeElement('submitCon');
        $form->submitExit->setLabel('Lưu');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;        
        if ($this->getRequest()->isPost()) {
        	$form->preValidation($_POST);
            $formData = $this->getRequest()->getPost();
			foreach ($formData as $k=>$v){
				if(strpos($k, 'thanh_vien_') !== false && $v == '0')
					$formData[$k] = null;
			}
            if ($form->isValid($formData)) {
            	if(!Default_Model_Functions::kiem_tra_ma($form->getValue('ma'), 'HDNT',true)){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng nghiệm thu không đúng định dạng, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt?' . $_SESSION['filterHDNT']);
				}
            	if($this->hd_nghiem_thu->kiem_tra_id_ma($form->getValue('id'),$form->getValue('ma'))){
					$_SESSION['msg'] = 'Lỗi !. Mã hội đồng nghiệm thu đã tồn tại, vui lòng kiểm tra lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt?' . $_SESSION['filterHDNT']);
				}
            	$db = Zend_Registry::get('connectDB');			
				$db->beginTransaction();
				try{											
					$hdnt = new Default_Model_Hdnt();
					$id = $form->getValue('id');
					$hdnt->setId($id)
						 ->setMa($form->getValue('ma'))
			             ->setNgayThanhLap(date('Y-m-d',strtotime($form->getValue('ngay_thanh_lap'))))
			             ->setGhiChu($form->getValue('ghi_chu'))
			             ->setMaDeTai($_POST['hdnt'][0]);
	                
					$hdnt->sua();
					
					//cat nhat thanh vien hoi dong
					$pc_nghiem_thu = new Default_Model_Pcnt();
					$thanhViens = array();
					for($i = 0 ; $i<= 4 ; $i++){		
						//kiem tra co chon giang vien
						if($form->getValue('thanh_vien_' . $i) != 0){
							$thanhViens[] = array('ma_giang_vien' => $form->getValue('thanh_vien_' . $i),
												  'chuc_danh' => $i);
						}
					}	
					$pc_nghiem_thu->capNhatTV($id,$thanhViens);
					$db->commit();
				}catch (Zend_Db_Exception $e){
					$db->rollBack();
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/danh-sach-hdnt?' . $_SESSION['filterHDNT']);
				}
                $_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/hoi-dong/danh-sach-hdnt?' . $_SESSION['filterHDNT']);
            } else {
                $form->populate($formData);
            }
        } else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
	            $data = $this->hd_nghiem_thu->getHDNT($id);
	            if($data != null){
	            	$data = $this->hd_nghiem_thu->HDNTToArray($data);
	            	$data['ma_linh_vuc'] = $this->hd_nghiem_thu->getLinhVucByDT($data['id']); 
	            	$data['nam'] = substr($data['ma'],4,4);
	            	//lay danh sach giang vien trong hoi dong	
	            	$thanhViens = $this->pc_nghiem_thu->getDSGVByHDNT($id);
	            	$i = 0;
	            	foreach ($thanhViens as $thanh_vien)
	            	{	  		
	            		$dv = 'don_vi_' . $i;
	            		$tv = 'thanh_vien_' . $i;
	            		$data[$dv] = $thanh_vien['ma_don_vi'];
	            		$giang_vien = new Default_Model_GiangVien();
						$gvOptions = $giang_vien->getDSGVByDV($thanh_vien['ma_don_vi']);
						$form->$tv->addMultiOptions($gvOptions)
									   ->setValue($thanh_vien['ma_giang_vien']);
						$i++;
	            	}
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã hội đồng nghiệm thu không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/danh-sach-hdnt?' . $_SESSION['filterHDNT']);
	            }
        	}else{
            	$this->_redirect('/admin/hoi-dong/danh-sach-hdnt?' . $_SESSION['filterHDNT']);
            }
        }
    }
    
    public function dsMailTbAction()
    {
    	// TODO Auto-generated {0}::indexAction() default action
    	$mail_tb = new Default_Model_MailTb();
        $mailTBs = $mail_tb->getAll();
        $paginator = Zend_Paginator::factory($mailTBs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function loadAction() {
      	// If we use Ajax to load response of this action
      	// set no render
      	$this->_helper->getHelper('viewRenderer')->setNoRender();
      	// If you use layout, disable it
      	$this->_helper->layout()->disableLayout();
      
      	// Get the id from request
      	$nam = $_POST['nam'];
      	if($nam != null){
	      	// Query from database
	      	$data = $this->hd_duyet->getDSHDByNam($nam);
	      	if($data == null){
	      		echo "NO,<option value='-1'>== Chưa thành lập ==</option>";
	      	}else{
		      	// Response
		      	$result = '';
		      	$result .= '<option value="0">== Tất cả ==</option>';
		      	foreach ($data as $k=>$v)
		      	{
		      		$result .= '<option value=' . $k . '>' . $v .'</option>';
		      	}
		      	echo "YES," . $result;
	      	}
      	}
    }
    
    public function tbDuyetAction()
    {
    	$form = new Admin_Form_TBDuyet();
        $form->submit->setLabel('Gởi');
        $form->cancel->setLabel('Thoát');
        $this->view->form = $form;   	
    	if($this->getRequest()->isPost()){
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData)){	
				if($form->getValue('noi_nhan') == '-1'){
					$_SESSION['msg'] = 'Lỗi !. Chưa chọn hội đồng.';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/tb-duyet');
				}			
				$mail_tb = new Default_Model_MailTb();
				$mail_tb->setTieuDe($form->getValue('tieu_de'))
						->setNoiDung($form->getValue('noi_dung'))
						->setLoai(1)
						->setNgayGoi(new Zend_Db_Expr("NOW()"))
						->setNoiNhan($form->getValue('noi_nhan'));				
				$kq = $mail_tb->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/tb-duyet');
				}
				$arr_hdd = array();
				if($form->getValue('noi_nhan') == '0'){
					$hdds = $this->hd_duyet->getDSHDByNam($form->getValue('nam'));
					foreach ($hdds as $k=>$v){
						$arr_hdd[] = $k;
					}
				}else{
					$arr_hdd[] = $form->getValue('noi_nhan');
				}
				$mail_tb->send_mail_hdd($arr_hdd,$form->getValue('tieu_de'),$form->getValue('noi_dung'));
				$_SESSION['msg'] = 'Thành công !. Gởi mail thông báo thành công .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/hoi-dong/ds-mail-tb');
			}else{
				if($formData['noi_nhan'] == '-1'){
					$form->noi_nhan->setMultiOptions(array('-1' => '== Chưa thành lập =='));
				}
				$form->populate($formData);
			}
		}
    }
    
	public function tbNghiemThuAction()
    {
    	$form = new Admin_Form_TBNT();
        $form->submit->setLabel('Gởi');
        $form->cancel->setLabel('Thoát');
        $this->view->form = $form;   	
    	if($this->getRequest()->isPost()){
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData)){	
				if($form->getValue('noi_nhan') == '-1'){
					$_SESSION['msg'] = 'Lỗi !. Chưa chọn đề tài.';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/tb-nghiem-thu');
				}		
				$db = Khcn_Api::_()->getItemTable('default_de_tai')->getAdapter();
				$db->beginTransaction();
				try{
					$mail_tb = new Default_Model_MailTb();
					$mail_tb->setTieuDe($form->getValue('tieu_de'))
							->setNoiDung($form->getValue('noi_dung'))
							->setLoai(2)
							->setNgayGoi(new Zend_Db_Expr("NOW()"))
							->setNoiNhan($form->getValue('noi_nhan'));				
					$kq = $mail_tb->them();
					if(!$kq){
						$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
						$_SESSION['type_msg'] = 'error';
						$this->_redirect('/admin/hoi-dong/tb-nghiem-thu');
					}
					$de_tai = new Default_Model_DeTai();
					$toEmail = $de_tai->getEmailCNByDT($form->getValue('noi_nhan'));
					Khcn_Api::_()->getApi('mail', 'default')->sendSystemRaw($toEmail, array(
						'subject' => $form->getValue('tieu_de'),
						'body' => $form->getValue('noi_dung')
					));
					$db->commit();
					$_SESSION['msg'] = 'Thành công !. Gởi mail thông báo thành công .';
					$_SESSION['type_msg'] = 'success';
					$this->_redirect('/admin/hoi-dong/ds-mail-tb');
				} catch( Exception $e ){
					$db->rollBack();
					throw $e;
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
				}
			}else{
				if($formData['noi_nhan'] == '-1'){
					$form->noi_nhan->setMultiOptions(array('-1' => 'Không có dữ liệu'));
				}
				$form->populate($formData);
			}
		}
    }
    
	public function xoasMailTbAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoi-dong/ds-mail-tb');
		}		
    	$str = '';
    	$mail_tb = new Default_Model_MailTb();
		foreach($_POST['item'] as $id){			
			$mail = $mail_tb->getMailTB($id);			
			if($mail != NULL)
			{
				$kq = $mail_tb->xoa($id);
				if(!$kq){
					$str .= $mail_tb['tieu_de'] . ', ';
				}	
			}	
		}
		#lỗi
		if($str != ''){
			$_SESSION['msg'] = "Lỗi. Các mail sau đây không xóa được : " . $str;
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/hoi-dong/ds-mail-tb');	
		}
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/hoi-dong/ds-mail-tb');
    }
    
	public function xoaMailTbAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$mail_tb = new Default_Model_MailTb();
    		$mail = $mail_tb->getMailTB($id);
    		if($mail != null){
				$kq = $mail_tb->xoa($id);
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/ds-mail-tb');
				}	  
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/hoi-dong/ds-mail-tb');
    		}else{
	    		$this->_redirect('/admin/hoi-dong/ds-mail-tb');
    		}
    	}else{
    		$this->_redirect('/admin/hoi-dong/ds-mail-tb');
    	}
    }
    
    public function suaTbDuyetAction()
    {
    	$form = new Admin_Form_TBDuyet();
        $form->submit->setLabel('Chuyển tiếp');
        $form->cancel->setLabel('Thoát');
        $this->view->form = $form;   	
    	if($this->getRequest()->isPost()){
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData)){	
				if($form->getValue('noi_nhan') == '-1'){
					$_SESSION['msg'] = 'Lỗi !. Chưa chọn hội đồng.';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/tb-duyet');
				}			
				$mail_tb = new Default_Model_MailTb();
				$mail_tb->setTieuDe($form->getValue('tieu_de'))
						->setNoiDung($form->getValue('noi_dung'))
						->setLoai(1)
						->setNgayGoi(new Zend_Db_Expr("NOW()"))
						->setNoiNhan($form->getValue('noi_nhan'));				
				$kq = $mail_tb->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/tb-duyet');
				}
				$arr_hdd = array();
				if($form->getValue('noi_nhan') == '0'){
					$hdds = $this->hd_duyet->getDSHDByNam($form->getValue('nam'));
					foreach ($hdds as $k=>$v){
						$arr_hdd[] = $k;
					}
				}else{
					$arr_hdd[] = $form->getValue('noi_nhan');
				}
				$mail_tb->send_mail_hdd($arr_hdd,$form->getValue('tieu_de'),$form->getValue('noi_dung'));
				$_SESSION['msg'] = 'Thành công !. Gởi mail thông báo thành công .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/hoi-dong/ds-mail-tb');
			}else{
				if($formData['noi_nhan'] == '-1'){
					$form->noi_nhan->setMultiOptions(array('-1' => '== Chưa thành lập =='));
				}
				$form->populate($formData);
			}
		}else {
        	$id = $this->_getParam('id');
        	if(!empty($id)){
        		$mail_tb = new Default_Model_MailTb();
	            $data = $mail_tb->getMailTB($id);
	            if($data != null){
	            	$data = $mail_tb->MailTBToArray($data);
	            	if($data['noi_nhan'] != '0'){
	            		$hdd = $this->hd_duyet->getHDD($data['noi_nhan']);
	            		$nam = substr($hdd['ma'], 3,4);
	            		$hdds = $this->hd_duyet->getDSHDByNam($nam);
	            		$hdds = array('0' => '== Tất cả ==') + $hdds;
	            		$form->noi_nhan->setMultiOptions($hdds);
	            		$form->nam->setValue($nam);
	            		$form->noi_nhan->setValue($data['noi_nhan']);
	            	}
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã thông báo không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/ds-mail-tb');
	            }
        	}else{
            	$this->_redirect('/admin/hoi-dong/ds-mail-tb');
            }
        }
    }
    
	public function suaTbNtAction()
    {
    	$form = new Admin_Form_TBNT();
        $form->submit->setLabel('Gởi');
        $form->cancel->setLabel('Thoát');
        $this->view->form = $form;   	
    	if($this->getRequest()->isPost()){
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData)){	
				if($form->getValue('noi_nhan') == '-1'){
					$_SESSION['msg'] = 'Lỗi !. Chưa chọn đề tài.';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/tb-nghiem-thu');
				}			
				$mail_tb = new Default_Model_MailTb();
				$mail_tb->setTieuDe($form->getValue('tieu_de'))
						->setNoiDung($form->getValue('noi_dung'))
						->setLoai(2)
						->setNgayGoi(new Zend_Db_Expr("NOW()"))
						->setNoiNhan($form->getValue('noi_nhan'));				
				$kq = $mail_tb->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/hoi-dong/tb-nghiem-thu');
				}
				$de_tai = new Default_Model_DeTai();
				$toEmail = $de_tai->getEmailCNByDT($form->getValue('noi_nhan'));
				Khcn_Api::_()->getApi('mail', 'default')->sendSystemRaw($toEmail, array(
					'subject' => $form->getValue('tieu_de'),
					'body' => $form->getValue('noi_dung')
				));
				$_SESSION['msg'] = 'Thành công !. Gởi mail thông báo thành công .';
				$_SESSION['type_msg'] = 'success';
                $this->_redirect('/admin/hoi-dong/ds-mail-tb');
			}else{
				if($formData['noi_nhan'] == '-1'){
					$form->noi_nhan->setMultiOptions(array('-1' => 'Không có dữ liệu'));
				}
				$form->populate($formData);
			}
		}else{
			$id = $this->_getParam('id');
        	if(!empty($id)){
        		$mail_tb = new Default_Model_MailTb();
	            $data = $mail_tb->getMailTB($id);
	            if($data != null){
	            	$data = $mail_tb->MailTBToArray($data);
	            	$de_tai = new Default_Model_DeTai();
            		$deTai = $de_tai->getDeTai($data['noi_nhan']);
            		$nam = substr($deTai['ma'], 2,4);
            		$deTais = $de_tai->getDSDTSelect(array('nam' => $nam,'ma_don_vi' => $deTai['ma_don_vi']));
            		$form->noi_nhan->setMultiOptions($deTais);
            		$form->nam->setValue($nam);
            		$form->noi_nhan->setValue($data['noi_nhan']);
	            	$form->populate($data);
	            }else{
	            	$_SESSION['msg'] = 'Lỗi !. Mã thông báo không tồn tại .';
					$_SESSION['type_msg'] = 'error';
					$this->_redirect('/admin/hoi-dong/ds-mail-tb');
	            }
        	}else{
            	$this->_redirect('/admin/hoi-dong/ds-mail-tb');
            }
		}
    }
}

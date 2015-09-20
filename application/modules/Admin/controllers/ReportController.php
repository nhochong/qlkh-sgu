<?php

/**
 * {0}
 * 
 * @author
 * @version 
 */
/** PHPExcel */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel.php';

/** PHPExcel_Cell_AdvancedValueBinder */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel/Cell/AdvancedValueBinder.php';

/** PHPExcel_IOFactory */
require_once APPLICATION_PATH . '/../library/Classes/PHPExcel/IOFactory.php';

class Admin_ReportController extends Khcn_Controller_Action_Admin
{	
	protected $de_tai = null;
	protected $giang_vien = null;
	protected $linh_vuc = null;
	protected $dang_ky = null;
	protected $don_vi = null;
	protected $hoc_vi = null;
	protected $cau_hinh = null;
	protected $hdd = null;
	protected $pcd = null;
    
	public function init (){
        $this->de_tai = new Default_Model_DeTai();
		$this->giang_vien = new Default_Model_GiangVien();
		$this->dang_ky = new Default_Model_DangKy();
		$this->linh_vuc = new Default_Model_LinhVuc();
		$this->don_vi = new Default_Model_DonVi();
		$this->hoc_vi = new Default_Model_HocVi();
		$this->cau_hinh = new Default_Model_CauHinh();
		$this->hdd = new Default_Model_Hdd();
		$this->pcd = new Default_Model_Pcd();
    }
    
    public function indexAction() {
        // TODO Auto-generated {0}::indexAction() default action
    	$form = new Admin_Form_Report();
    	$this->view->form = $form;
    	if($this->getRequest()->isPost()){
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData)){
				$values = $form->getValues();
				$session = new Zend_Session_Namespace('report');
				$session->nam = $form->getValue('nam');
				$session->quyet_dinh = $form->getValue('quyet_dinh');
				$session->thong_bao = $form->getValue('thong_bao');
				$session->ma_loai = $form->getValue('ma_loai');
				$session->mau = $form->getValue('mau');
				if($values['file_type'] == 'pdf'){
					$this->_redirect('/admin/report/' . $session->mau);
				}
				if($values['file_type'] == 'excel'){
					$this->_redirect('/admin/report/excel-' . $session->mau);
				}
			}else{
				$form->populate($formData);
			}
		}
    }
    
    public function setHeader(Zend_Pdf_Page $page,$font,$font_b){
    	$page->setFont($font, 10)
             ->drawText('ỦY BAN NHÂN DÂN', 72, 820,'UTF-8')
             ->drawText('THÀNH PHỐ HỒ CHÍ MINH', 60, 808,'UTF-8');
        $page->setFont($font_b, 11)->drawText('TRƯỜNG ĐẠI HỌC SÀI GÒN', 50, 796,'UTF-8');
        $page->setLineWidth(0.1);
        $page->drawLine(80, 792, 158, 792);
        $page->setFont($font_b, 11)
        	 ->drawText('CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM', 320, 820, 'UTF-8');
        $page->setFont($font, 11)
        	 ->drawText('Độc lập - Tự do - Hạnh phúc', 370,808, 'UTF-8');
        $imagePath = Zend_Pdf_Image::imageWithPath(APPLICATION_PATH . '/templates/admin/images/symbol.png');
	    //--------------drawImage(image, left, bottom, right, top)
	    $page->drawImage($imagePath, 408, 793,445,803);
	    return $page;
    }
	
    public function numLine($text,$width,$height){
    	$wrappedText = wordwrap($text, $width, "\n", false);  
	    $token = strtok($wrappedText, "\n");    
	    $count = 0;
	    while ($token !== false) {
	    	$count++;   
	        $token = strtok("\n");   
	    }
	    return $count;
    }
    
    public function setHeaderTableMau01(Zend_Pdf_Page $page,&$yPosition,$font,$font_b){
    	$page->setLineWidth(0.5);
    	$page->setFillColor(new Zend_Pdf_Color_Html('#d1fef5'));
        $page->drawRectangle(20, $yPosition - 40, 575, $yPosition);
        $page->setFillColor(new Zend_Pdf_Color_Rgb(0, 0, 0));
        $page->setFont($font, 9);
        $page->drawText('STT', 25, $yPosition - 20, 'UTF-8');
        $page->setFont($font_b, 9);
        $page = $this->wrapText($page, 'MÃ SỐ ĐỀ TÀI', 55, $yPosition - 15, 13, 12);
        $page->drawText('HỌ TÊN GIẢNG VIÊN', 110, $yPosition - 20, 'UTF-8');
        $page->setFont($font, 7);
        $page = $this->wrapText($page, 'STT GIẢNG VIÊN', 235, $yPosition - 15, 10, 8);
        $page->setFont($font_b, 9)
        	 ->drawText('TÊN ĐỀ TÀI NCKH', 345, $yPosition - 20,'UTF-8');
        $page->setFont($font_b, 8);
        $page = $this->wrapText($page, 'THỜI GIAN KẾT THÚC', 505, $yPosition - 10, 8, 9);
        $page = $this->wrapText($page, 'KINH PHÍ', 545, $yPosition - 13, 8, 9);
        for ($i = 1; $i <= 6; $i ++) {
            switch ($i) {
                case 0:
                    $page->drawLine(20, $yPosition - 40, 20, $yPosition);
                    break;
                case 1:
                    $page->drawLine(45, $yPosition - 40, 45, $yPosition);
                    break;
                case 2:
                    $page->drawLine(100, $yPosition - 40, 100, $yPosition);
                    break;
                case 3:
                    $page->drawLine(230, $yPosition - 40, 230, $yPosition);
                    break;
                case 4:
                    $page->drawLine(262, $yPosition - 40, 262, $yPosition);
                    break;
                case 5:
                    $page->drawLine(497, $yPosition - 40, 497, $yPosition);
                    break;
                case 6:
                    $page->drawLine(538, $yPosition - 40, 538, $yPosition);
                    break;
                case 7:
                    $page->drawLine(575, $yPosition - 40, 575, $yPosition);
                    break;
	    	};
        }	   	
        $yPosition -= 40;
        return $page;
    }
	
	public function setHeaderTableMau02(Zend_Pdf_Page $page,&$yPosition,$font,$font_b){
    	$page->setLineWidth(0.5);
    	$page->setFillColor(new Zend_Pdf_Color_Html('#d1fef5'));
        $page->drawRectangle(20, $yPosition - 40, 575, $yPosition);
        $page->setFillColor(new Zend_Pdf_Color_Rgb(0, 0, 0));
        $page->setFont($font, 9);
        $page->drawText('STT', 25, $yPosition - 20, 'UTF-8');
        $page->setFont($font_b, 9);
        $page->drawText('HỌ TÊN GIẢNG VIÊN', 55, $yPosition - 20, 'UTF-8');
        $page->setFont($font, 7);
        $page = $this->wrapText($page, 'STT GIẢNG VIÊN', 195, $yPosition - 15, 10, 8);
        $page->setFont($font_b, 9)
        	 ->drawText('TÊN ĐỀ TÀI NCKH', 310, $yPosition - 20,'UTF-8');
        $page->setFont($font_b, 8);
        $page = $this->wrapText($page, 'THỜI GIAN KẾT THÚC', 530, $yPosition - 10, 8, 9);
        for ($i = 1; $i <= 4; $i ++) {
            switch ($i) {
                case 1:
                    $page->drawLine(45, $yPosition - 40, 45, $yPosition);
                    break;
                case 2:
                    $page->drawLine(190, $yPosition - 40, 190, $yPosition);
                    break;
                case 3:
                    $page->drawLine(220, $yPosition - 40, 220, $yPosition);
                    break;
                case 4:
                    $page->drawLine(515, $yPosition - 40, 515, $yPosition);
                    break;
	    	};
        }	   	
        $yPosition -= 40;
        return $page;
    }
    
	public function setHeaderTableMau03(Zend_Pdf_Page $page,&$yPosition,$font,$font_b){
    	$page->setLineWidth(0.5);
        $page->drawRectangle(40, $yPosition - 15, 555, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        $page->setFillColor(new Zend_Pdf_Color_Rgb(0, 0, 0));
        $page->setFont($font_b, 10)
        	 ->drawText('STT', 45, $yPosition - 10, 'UTF-8')
	         ->drawText('HỌ VÀ TÊN', 120, $yPosition - 10, 'UTF-8')
	         ->drawText('CHỨC VỤ', 310, $yPosition - 10, 'UTF-8')
	         ->drawText('ĐƠN VỊ CÔNG TÁC', 435, $yPosition - 10,'UTF-8');        
        for ($i = 1; $i <= 3; $i ++) {
            switch ($i) {
                case 1:
                    $page->drawLine(70, $yPosition - 15, 70, $yPosition);
                    break;
                case 2:
                    $page->drawLine(255, $yPosition - 15, 255, $yPosition);
                    break;
                case 3:
                    $page->drawLine(405, $yPosition - 15, 405, $yPosition);
                    break;
	    	};
        }	   	
        $yPosition -= 15;
        return $page;
    }
    
	public function wrapText(Zend_Pdf_Page $page,$text,$x,$y,$width,$height){
	    $wrappedText = wordwrap($text, $width, "\n", false);  
	    $token = strtok($wrappedText, "\n");    
	    while ($token !== false) {      
	        $page->drawText($token,$x,$y,'UTF-8');    
	        $token = strtok("\n");    
	        $y -= $height;    
	    }
	    return $page;
	}
    
    public function mau01Action(){	
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
		 	$session = new Zend_Session_Namespace('report');
            // create PDF
            $pdf = new Zend_Pdf();       
            //set properties
            $pdf->properties['Title'] = 'Phòng Khoa học Công nghệ';
            $pdf->properties['Author'] = 'Hung - Nguyen - K08';
            // create A4 page
      		$page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
            // set font for page           
            $font = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/times.ttf');
            $font_b = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesbd.ttf');
            $font_i = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesi.ttf');
            //set header
            $page = $this->setHeader($page, $font, $font_b);       
            // write text to page	        
	        $page->setFont($font_b,13)
                 ->drawText('DANH SÁCH CÁN BỘ GIẢNG VIÊN', 190, 750,'UTF-8');             
            $page->setFont($font_b,11)
                 ->drawText('ĐƯỢC CHẤP THUẬN ĐĂNG KÝ ĐỀ TÀI NGHIÊN CỨU KHOA HỌC CẤP TRƯỜNG', 90, 735,'UTF-8');   
            $page->setFont($font_b, 11)
                 	 ->drawText('NĂM HỌC ' . $session->nam . '-' . ($session->nam + 1), 230, 720,'UTF-8');                          
            if($session->quyet_dinh != ''){                
            	$page->setFont($font_i,10)
                 	 ->drawText('( ' . $session->quyet_dinh . ' )', 160, 710,'UTF-8');
            }          		 	
            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $yPosition = 685;
			//------------------ HEADER TABLE-----------------
			$page = $this->setHeaderTableMau01($page, $yPosition, $font, $font_b);
            //------------------- DETAIL ----------------
            $donVis = $this->de_tai->getDSDV($session->nam,2,$session->ma_loai);
			$idGVs = array();
            $count_k = 1;
            $count_dt = 1;
            $count_gv = 1;
            foreach ($donVis as $don_vi)
            {	
				$id_don_vi = $don_vi['ma_don_vi'];
				$don_vi = $this->don_vi->getDonVi($id_don_vi);
				if(!$don_vi)
					continue;
				// Get ds de tai
               	$deTais = $this->de_tai->getDSDTChapThuan($id_don_vi,$session->nam,2,$session->ma_loai);
				if(!$deTais)
					continue;
            	//-------- Đơn vị ---------
               	$page->drawRectangle(20, $yPosition - 15, 575, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
            	//viet hoa tieng viet co dau
            	$ten_don_vi = mb_strtoupper($don_vi['ten'],'UTF-8');
            	$page->setFont($font_b, 9)
               	 	 ->drawText($count_k++ . '. ' . $ten_don_vi, 245, $yPosition - 10, 'UTF-8');
               	$yPosition -= 15;
               	//-------- Đề tài ---------
               	foreach ($deTais as $de_tai)
               	{             		
               		$thanhViens = $this->dang_ky->getDSDKByMaDeTai($de_tai['id']);
               		$so_tv = count($thanhViens);
               		$h1 = $so_tv * 15;
               		$h2 = $this->numLine($de_tai['ten'], 70,10) * 10 + 10;
               		$max_height = $h1 > $h2 ? $h1 : $h2;
               		//-------- Tạo page mới nếu cần -----------
               		if(($yPosition - $max_height) < 50){
               			$pdf->pages[] = $page;
               			$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
						$yPosition = $page->getHeight() - 50;
						$page = $this->setHeaderTableMau01($page, $yPosition, $font, $font_b);
               		}
               		//-------------- Thiết kế ô --------------
               		//----- STT Đề Tài -----
	               	$page->drawRectangle(20, $yPosition - $max_height, 45, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Mã Đề Tài -----
	               	$page->drawRectangle(45, $yPosition - $max_height, 100, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Thành viên -----
	               	$page->drawRectangle(100, $yPosition - $max_height, 230, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- STT Thành viên -----
	               	$page->drawRectangle(230, $yPosition - $max_height, 262, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Tên Đề Tài -----
	               	$page->drawRectangle(262, $yPosition - $max_height, 497, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Thoi Gian Hoan Thanh -----
	               	$page->drawRectangle(497, $yPosition - $max_height, 538, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Kinh Phí -----
	               	$page->drawRectangle(538, $yPosition - $max_height, 575, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	
               		$page->setFont($font, 9)
               	 	 	 ->drawText($count_dt++, 30,$yPosition - 10, 'UTF-8');
               	 	$page->setFont($font, 9);
               	 	$page = $this->wrapText($page,$de_tai['ten'], 267,$yPosition - 10,70,10);
               		$h_temp = $yPosition;
               	 	foreach ($thanhViens as $thanh_vien)
               	 	{
               	 		$page->setFont($font, 8)
               	 	 		 ->drawText($thanh_vien['hoc_vi'] . ' ' . $thanh_vien['ten_thanh_vien'], 105, $h_temp - 10,'UTF-8');
               	 	 	if(!in_array($thanh_vien['id'],$idGVs)){
							$idGVs[] = $thanh_vien['id'];
							$page->setFont($font, 8)
								->drawText($count_gv++, 243, $h_temp - 10, 'UTF-8');
						}
               	 	 	$h_temp -= 15;
               	 	}
               	 	$page->setFont($font, 9)
               	 	 	 ->drawText($de_tai['ma'], 50,$yPosition - 10, 'UTF-8');
               	 	$page->setFont($font, 9)
               	 	 	 ->drawText($de_tai['thoi_gian_hoan_thanh'], 503,$yPosition - 10, 'UTF-8');
               	 	$kinh_phi = round((float)$de_tai['kinh_phi']/1000000,1);
               	 	$page->setFont($font, 9)
               	 	 	 ->drawText($kinh_phi . 'tr', 550,$yPosition - 10, 'UTF-8');          	 	
               		$yPosition -= $max_height ;               	 	
               	}
            }
			
            //-------------- KY TEN -------------
			if($yPosition - 100 < 50){
				$pdf->pages[] = $page;
               	$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$yPosition = $page->getHeight() - 50;
			}
			$page->setFont($font, 10)
               	 ->drawText('Danh sách này gồm ' . --$count_dt . ' đề tài với ' . --$count_gv . ' giảng viên tham gia', 70,$yPosition - 20, 'UTF-8');
            /*
			$page->setFont($font_b, 11)
               	 ->drawText('HIỆU TRƯỞNG', 425,$yPosition - 30, 'UTF-8');
            $cau_hinh = $this->cau_hinh->getCauHinh('hieu_truong');
            $page->setFont($font_b, 11)
               	 ->drawText($cau_hinh['noi_dung'], 400,$yPosition - 90, 'UTF-8');
			*/
            // add page to document
            $pdf->pages[] = $page;
            //---------- SAVE FILE PDF ----------------
            //----- SAVE IN DISC -----
            if($session->thong_bao == '1'){
            	$this->tao_thong_bao($pdf,$session->nam,$session->mau);
				$this->_redirect('/admin/report/index');
            }
            //----- DOWNLOAD FILE -----
            header('Content-Type: application/x-pdf');
    		header('Content-Disposition: attachment; filename=Report.pdf');
    		header("Cache-Control: no-cache, must-revalidate");   		
    		echo $pdf->render();
            //echo 'SUCCESS: Document saved!';
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }
    
	public function mau02Action(){
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
		 	$session = new Zend_Session_Namespace('report');
		 	if(!isset($session->nam))
		 		$session->nam = 2012;
            // create PDF
            $pdf = new Zend_Pdf();            
            //set properties
            $pdf->properties['Title'] = 'Phòng Khoa học Công nghệ';
            $pdf->properties['Author'] = 'Hung - Nguyen - K08';
            // create A4 page
      		$page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
            // set font for page           
            $font = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/times.ttf');
            $font_b = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesbd.ttf');
            $font_i = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesi.ttf');
            //set header
            $page = $this->setHeader($page, $font, $font_b);       
            // write text to page	        
	        $page->setFont($font_b,13)
                 ->drawText('DANH SÁCH CÁN BỘ GIẢNG VIÊN', 190, 750,'UTF-8');             
            $page->setFont($font_b,11)
                 ->drawText('ĐƯỢC CHẤP THUẬN ĐĂNG KÝ ĐỀ TÀI NGHIÊN CỨU KHOA HỌC CẤP KHOA', 90, 735,'UTF-8');   
            $page->setFont($font_b, 11)
                 	 ->drawText('NĂM HỌC ' . $session->nam . '-' . ($session->nam + 1), 230, 720,'UTF-8');                          
            if($session->quyet_dinh != ''){                
            	$page->setFont($font_i,10)
                 	 ->drawText('( ' . $session->quyet_dinh . ' )', 160, 710,'UTF-8');
            }          		 	
            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $yPosition = 685;
			//------------------ HEADER TABLE-----------------
			$page = $this->setHeaderTableMau02($page, $yPosition, $font, $font_b);
            //------------------- DETAIL ----------------
            $donVis = $this->de_tai->getDSDV($session->nam,1);
			$idGVs = array();
            $count_k = 1;
            $count_dt = 1;
            $count_gv = 1;
            foreach ($donVis as $don_vi)
            {
				$id_don_vi = $don_vi['ma_don_vi'];
				$don_vi = $this->don_vi->getDonVi($id_don_vi);
				if(!$don_vi)
					continue;
				// Get ds de tai
               	$deTais = $this->de_tai->getDSDTChapThuan($id_don_vi,$session->nam,1);
				if(!$deTais)
					continue;
            	//-------- Đơn vị ---------
               	$page->drawRectangle(20, $yPosition - 15, 575, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
            	//viet hoa tieng viet co dau
            	$ten_don_vi = mb_strtoupper($don_vi['ten'],'UTF-8');
            	$page->setFont($font_b, 9)
               	 	 ->drawText($count_k++ . '. ' . $ten_don_vi, 205, $yPosition - 10, 'UTF-8');
               	$yPosition -= 15;
               	//-------- Đề tài ---------
               	foreach ($deTais as $de_tai)
               	{             		
               		$thanhViens = $this->dang_ky->getDSDKByMaDeTai($de_tai['id']);
               		$so_tv = count($thanhViens);
               		$h1 = $so_tv * 15;
               		$h2 = $this->numLine($de_tai['ten'], 70,10) * 10 + 10;
               		$max_height = $h1 > $h2 ? $h1 : $h2;
               		//-------- Tạo page mới nếu cần -----------
               		if(($yPosition - $max_height) < 50){
               			$pdf->pages[] = $page;
               			$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
						$yPosition = $page->getHeight() - 50;
						$page = $this->setHeaderTableMau01($page, $yPosition, $font, $font_b);
               		}
               		//-------------- Thiết kế ô --------------
               		//----- STT Đề Tài -----
	               	$page->drawRectangle(20, $yPosition - $max_height, 45, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Thành viên -----
	               	$page->drawRectangle(45, $yPosition - $max_height, 190, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- STT Thành viên -----
	               	$page->drawRectangle(190, $yPosition - $max_height, 220, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Tên Đề Tài -----
	               	$page->drawRectangle(220, $yPosition - $max_height, 515, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Thoi Gian Hoan Thanh -----
	               	$page->drawRectangle(515, $yPosition - $max_height, 575, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	
               		$page->setFont($font, 9)
               	 	 	 ->drawText($count_dt++, 30,$yPosition - 10, 'UTF-8');
               	 	$page->setFont($font, 9);
               	 	$page = $this->wrapText($page,$de_tai['ten'], 225,$yPosition - 10,90,10);
               		$h_temp = $yPosition;
               	 	foreach ($thanhViens as $thanh_vien)
               	 	{
               	 		$page->setFont($font, 8)
               	 	 		 ->drawText($thanh_vien['hoc_vi'] . ' ' . $thanh_vien['ten_thanh_vien'], 55, $h_temp - 10,'UTF-8');
               	 	 	if(!in_array($thanh_vien['id'],$idGVs)){
							$idGVs[] = $thanh_vien['id'];
							$page->setFont($font, 8)
								->drawText($count_gv++, 200, $h_temp - 10, 'UTF-8');
						}
               	 	 	$h_temp -= 15;
               	 	}
               	 	$page->setFont($font, 9)
               	 	 	 ->drawText($de_tai['thoi_gian_hoan_thanh'], 525,$yPosition - 10, 'UTF-8');      	 	
               		$yPosition -= $max_height ;               	 	
               	}
            }
            //-------------- KY TEN -------------
			if($yPosition - 100 < 50){
				$pdf->pages[] = $page;
               	$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$yPosition = $page->getHeight() - 50;
			}
			$page->setFont($font, 10)
               	 ->drawText('Danh sách này gồm ' . --$count_dt . ' đề tài với ' . --$count_gv . ' giảng viên tham gia', 70,$yPosition - 20, 'UTF-8');

            // add page to document
            $pdf->pages[] = $page;
            //---------- SAVE FILE PDF ----------------
            //----- SAVE IN DISC -----
            if($session->thong_bao == '1'){
            	$this->tao_thong_bao($pdf,$session->nam,$session->mau);
				$this->_redirect('/admin/report/index');
            } 
            //----- DOWNLOAD FILE -----
            header('Content-Type: application/x-pdf');
    		header('Content-Disposition: attachment; filename=Report.pdf');
    		header("Cache-Control: no-cache, must-revalidate");   		
    		echo $pdf->render();
            //echo 'SUCCESS: Document saved!';
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }
    
	public function mau03Action(){
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
		 	$session = new Zend_Session_Namespace('report');
		 	if(!isset($session->nam))
		 		$session->nam = 2012;
            // create PDF
            $pdf = new Zend_Pdf();            
            //set properties
            $pdf->properties['Title'] = 'Phòng Khoa học Công nghệ';
            $pdf->properties['Author'] = 'Hung - Nguyen - K08';
            // create A4 page
      		$page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
            // set font for page           
            $font = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/times.ttf');
            $font_b = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesbd.ttf');
            $font_i = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesi.ttf');
            //set header
            $page = $this->setHeader($page, $font, $font_b);       
            // write text to page	        
	        $page->setFont($font_b,12)
                 ->drawText('HỘI ĐỒNG DUYỆT ĐỀ TÀI NCKH CẤP TRƯỜNG', 150, 750,'UTF-8');                            
            $page->setFont($font_b, 12)
                 	 ->drawText('NĂM HỌC ' . $session->nam . '-' . ($session->nam + 1), 230, 735,'UTF-8');                          
            if($session->quyet_dinh != ''){                
            	$page->setFont($font_i,10)
                 	 ->drawText('( ' . $session->quyet_dinh . ' )', 160, 725,'UTF-8');
            }          		 	
            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $yPosition = 700;
			//------------------ HEADER TABLE-----------------
            //------------------- DETAIL ----------------
            $hoiDongs = $this->hdd->getDSHDForExport($session->nam);
            $count_hd = 1;
            foreach ($hoiDongs as $hoi_dong)
            {
            	//-------- Hội đồng ---------
            	$count_dt = $this->de_tai->getSLDTByHDD($hoi_dong['id']);
            	if($hoi_dong['ghi_chu'] != '' && $hoi_dong['ghi_chu'] != null)
            		$lv = $hoi_dong['ghi_chu'];
            	else
            		$lv = $hoi_dong['linh_vuc'];
            	$page->setFont($font_b, 11)
               	 	 ->drawText($count_hd . '. HỘI ĐỒNG ' . $count_hd++ . ' : ' . $count_dt . ' đề tài (' .$lv . ')', 60, $yPosition, 'UTF-8');
               	$yPosition -= 5;
               	$page = $this->setHeaderTableMau03($page, $yPosition, $font, $font_b);
               	//-------- Thành viên ---------
               	$thanhViens = $this->pcd->getDSGVForExport($hoi_dong['id']);
               	$count_tv = 1;
               	foreach ($thanhViens as $thanh_vien)
               	{             		
               		//-------- Tạo page mới nếu cần -----------
               		if(($yPosition - 30) < 50){
               			$pdf->pages[] = $page;
               			$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
						$yPosition = $page->getHeight() - 50;
               		}
               		//-------------- Thiết kế ô --------------
               		//----- STT -----
	               	$page->drawRectangle(40, $yPosition - 30, 70, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Họ Tên -----
	               	$page->drawRectangle(70, $yPosition - 30, 255, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Chức vụ -----
	               	$page->drawRectangle(255, $yPosition - 30, 405, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	//----- Đơn vị -----
	               	$page->drawRectangle(405, $yPosition - 30, 555, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	               	
               		$page->setFont($font, 10)
               	 	 	 ->drawText($count_tv++, 53,$yPosition - 15, 'UTF-8');
               	 	if($thanh_vien['chuc_danh'] == '0'){
               	 		$page->setFont($font, 10)
               	 	 	 	 ->drawText('Chủ tịch hội đồng', 75,$yPosition - 10, 'UTF-8');
               	 	}else if($thanh_vien['chuc_danh'] == '2'){
               	 		$page->setFont($font, 10)
               	 	 	 	 ->drawText('Thư ký', 75,$yPosition - 10, 'UTF-8');
               	 	}else{
               	 		$page->setFont($font, 10)
               	 	 	 	 ->drawText('Ủy viên ' . ($count_tv - 2) , 75,$yPosition - 10, 'UTF-8');
               	 	}              	 		
               	 	$page->setFont($font_b, 10)
               	 		 ->drawText($thanh_vien['ma_hoc_vi'] . '. ' . $thanh_vien['ho_ten'], 75,$yPosition - 22, 'UTF-8');           	 	
               	 	$page->setFont($font, 10);
               	 	$page = $this->wrapText($page, $thanh_vien['chuc_vu'], 260, $yPosition - 10, 40, 11);
               	 	$page = $this->wrapText($page, $thanh_vien['don_vi'], 410, $yPosition - 10, 40, 11);        	 	
               		$yPosition -= 30;               	 	
               	}
               	$yPosition -= 30;
            }
            //-------------- KY TEN -------------
			/*
			if($yPosition - 100 < 50){
				$pdf->pages[] = $page;
               	$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
				$yPosition = $page->getHeight() - 50;
			}	
            $page->setFont($font_b, 11)
               	 ->drawText('HIỆU TRƯỞNG', 425,$yPosition, 'UTF-8');
            $cau_hinh = $this->cau_hinh->getCauHinh('hieu_truong');
            $page->setFont($font_b, 11)
               	 ->drawText($cau_hinh['noi_dung'], 400,$yPosition - 60, 'UTF-8');
			*/
            // add page to document
            $pdf->pages[] = $page;
            //---------- SAVE FILE PDF ----------------
            //----- SAVE IN DISC -----
            if($session->thong_bao == '1'){
            	$this->tao_thong_bao($pdf,$session->nam,$session->mau);
				$this->_redirect('/admin/report/index');
            }           
            //----- DOWNLOAD FILE -----
            header('Content-Type: application/x-pdf');
    		header('Content-Disposition: attachment; filename=Report.pdf');
    		header("Cache-Control: no-cache, must-revalidate");   		
    		echo $pdf->render();
            //echo 'SUCCESS: Document saved!';
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }
    
    public function mau04Action(){
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
		 	$session = new Zend_Session_Namespace('report');
		 	if(!isset($session->nam))
		 		$session->nam = 2012;
            // create PDF
            $pdf = new Zend_Pdf();            
            //set properties
            $pdf->properties['Title'] = 'Phòng Khoa học Công nghệ';
            $pdf->properties['Author'] = 'Hung - Nguyen - K08';
            // create A4 page
      		$page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
            // set font for page           
            $font = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/times.ttf');
            $font_b = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesbd.ttf');
            $font_i = Zend_Pdf_Font::fontWithPath(APPLICATION_PATH.'/templates/admin/fonts/timesi.ttf');
            //set header
            $page = $this->setHeader($page, $font, $font_b);       
             		 	
            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $yPosition = 750;
			//------------------ HEADER TABLE-----------------
            //------------------- DETAIL ----------------
            $hoiDongs = $this->hdd->getDSHDForExport($session->nam);
            $count_hd = 1;
            foreach ($hoiDongs as $hoi_dong)
            {
				$count_dt = 1;
				$count_gv = 1;
				$idGVs = array();
            	if($yPosition - 45 < 50){
            		$pdf->pages[] = $page;
	               	$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
					$yPosition = $page->getHeight() - 50;
            	}
            	// Hoi dong        
		        $page->setFont($font_b,12)
	                 ->drawText('DANH SÁCH ĐỀ TÀI NCKH DUYỆT TẠI HỘI ĐỒNG SỐ ' . $count_hd, 150, $yPosition,'UTF-8');                            
	            $page->setFont($font, 12)
	                 	 ->drawText('NĂM HỌC ' . $session->nam . '-' . ($session->nam + 1), 230, $yPosition - 15,'UTF-8');                          
	            if($session->quyet_dinh != ''){                
	            	$page->setFont($font_i,10)
	                 	 ->drawText('( ' . $session->quyet_dinh . ' )', 160, $yPosition - 25,'UTF-8');
	            }   
	            $yPosition -= 35;   
	            // thanh vien hoi dong
	            $thanhViensHDD = $this->pcd->getCTTKByHDD($hoi_dong['id']); 
	            foreach ($thanhViensHDD as $thanh_vien_hdd){
	            	if($thanh_vien_hdd['chuc_danh'] == '0'){
	            		$page->setFont($font, 9)
               	 	 	 	 ->drawText('Chủ tịch : ', 50,$yPosition, 'UTF-8');
               	 	 	$page->setFont($font_b, 9)
               	 	 	 	 ->drawText($thanh_vien_hdd['hoc_vi'] . ' ' . $thanh_vien_hdd['ho_ten'], 90,$yPosition, 'UTF-8');
	            	}else{
	            		$page->setFont($font, 9)
               	 	 	 	 ->drawText('Thư ký : ', 220,$yPosition, 'UTF-8');
               	 	 	$page->setFont($font_b, 9)
               	 	 	 	 ->drawText($thanh_vien_hdd['hoc_vi'] . ' ' . $thanh_vien_hdd['ho_ten'], 260,$yPosition, 'UTF-8');
	            	}
	            }
	            $yPosition -= 10;
	            $page->setFont($font, 9)
               	 	 	 	 ->drawText('Thời gian : ', 50,$yPosition, 'UTF-8');
               	$page->setFont($font, 9)
               	 	 	 	 ->drawText('Địa điểm : ', 220,$yPosition, 'UTF-8');
               	$yPosition -= 10;	 	 	 
               	
            	if($yPosition - 40 < 50){
            		$pdf->pages[] = $page;
	               	$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
					$yPosition = $page->getHeight() - 50;
            	}
				$page = $this->setHeaderTableMau01($page, $yPosition, $font, $font_b);
               	//-------- Hội đồng ---------
            	$tong_so_dt = $this->de_tai->getSLDTByHDD($hoi_dong['id']);
            	if($hoi_dong['ghi_chu'] != '' && $hoi_dong['ghi_chu'] != null)
            		$lv = $hoi_dong['ghi_chu'];
            	else
            		$lv = $hoi_dong['linh_vuc'];
            	$page->setFont($font_b, 9)
               	 	 ->drawText('HỘI ĐỒNG ' . $count_hd . ' : ' . $tong_so_dt . ' đề tài (' .$lv . ')', 25, $yPosition - 10, 'UTF-8');
               	$yPosition -= 15;
               	$page->drawRectangle(20, $yPosition, 575, $yPosition + 15,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
               	
               	$donVis = $this->de_tai->getDSDVByHDD($session->nam,$hoi_dong['id']);
               	foreach ($donVis as $don_vi){
					$id_don_vi = $don_vi['ma_don_vi'];
					$don_vi = $this->don_vi->getDonVi($id_don_vi);
					if(!$don_vi)
						continue;
					// Get ds de tai
					$deTais = $this->de_tai->getDSDTByHDDAndDV($hoi_dong['id'],$id_don_vi);
					if(!$deTais)
						continue;
               		//-------- Đơn vị ---------
	               	$page->drawRectangle(20, $yPosition - 15, 575, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
	            	//viet hoa tieng viet co dau
	            	$ten_don_vi = mb_strtoupper($don_vi['ten'],'UTF-8');
	            	$page->setFont($font_b, 9)
	               	 	 ->drawText($ten_don_vi, 255, $yPosition - 10, 'UTF-8');
	               	$yPosition -= 15;
	               	//-------- Đề tài ---------
	               	foreach ($deTais as $de_tai)
	               	{             		
	               		$thanhViens = $this->dang_ky->getDSDKByMaDeTai($de_tai['id']);
	               		$so_tv = count($thanhViens);
	               		$h1 = $so_tv * 15;
	               		$h2 = $this->numLine($de_tai['ten'], 70,10) * 10 + 10;
	               		$max_height = $h1 > $h2 ? $h1 : $h2;
	               		//-------- Tạo page mới nếu cần -----------
	               		if(($yPosition - $max_height) < 50){
	               			$pdf->pages[] = $page;
	               			$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
							$yPosition = $page->getHeight() - 50;
							$page = $this->setHeaderTableMau01($page, $yPosition, $font, $font_b);
	               		}
	               		//-------------- Thiết kế ô --------------
	               		//----- STT Đề Tài -----
		               	$page->drawRectangle(20, $yPosition - $max_height, 45, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	//----- Mã Đề Tài -----
		               	$page->drawRectangle(45, $yPosition - $max_height, 100, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	//----- Thành viên -----
		               	$page->drawRectangle(100, $yPosition - $max_height, 230, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	//----- STT Thành viên -----
		               	$page->drawRectangle(230, $yPosition - $max_height, 262, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	//----- Tên Đề Tài -----
		               	$page->drawRectangle(262, $yPosition - $max_height, 497, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	//----- Thoi Gian Hoan Thanh -----
		               	$page->drawRectangle(497, $yPosition - $max_height, 538, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	//----- Kinh Phí -----
		               	$page->drawRectangle(538, $yPosition - $max_height, 575, $yPosition,Zend_Pdf_Page::SHAPE_DRAW_STROKE);
		               	
	               		$page->setFont($font, 9)
	               	 	 	 ->drawText($count_dt++, 30,$yPosition - 10, 'UTF-8');
	               	 	$page->setFont($font, 9);
	               	 	$page = $this->wrapText($page,$de_tai['ten'], 267,$yPosition - 10,70,10);
	               		$h_temp = $yPosition;
	               	 	foreach ($thanhViens as $thanh_vien)
	               	 	{
	               	 		$page->setFont($font, 8)
	               	 	 		 ->drawText($thanh_vien['hoc_vi'] . ' ' . $thanh_vien['ten_thanh_vien'], 105, $h_temp - 10,'UTF-8');
	               	 	 	if(!in_array($thanh_vien['id'],$idGVs)){
								$idGVs[] = $thanh_vien['id'];
								$page->setFont($font, 8)
									->drawText($count_gv++, 243, $h_temp - 10, 'UTF-8');
							}
	               	 	 	$h_temp -= 15;
	               	 	}
	               	 	$page->setFont($font, 9)
	               	 	 	 ->drawText($de_tai['ma'], 50,$yPosition - 10, 'UTF-8');
	               	 	$page->setFont($font, 9)
	               	 	 	 ->drawText($de_tai['thoi_gian_hoan_thanh'], 503,$yPosition - 10, 'UTF-8');
	               	 	$kinh_phi = round((float)$de_tai['kinh_phi']/1000000,1);
	               	 	$page->setFont($font, 9)
	               	 	 	 ->drawText($kinh_phi . 'tr', 550,$yPosition - 10, 'UTF-8');          	 	
	               		$yPosition -= $max_height ;               	 	
	               	}
               	}
               	$yPosition -= 50;
               	$count_hd++;
            }

            // add page to document
            $pdf->pages[] = $page;    
            //---------- SAVE FILE PDF ----------------
            //----- SAVE IN DISC -----
            if($session->thong_bao == '1'){
            	$this->tao_thong_bao($pdf,$session->nam,$session->mau);
				$this->_redirect('/admin/report/index');
            }        
            //----- DOWNLOAD FILE -----
            header('Content-Type: application/x-pdf');
    		header('Content-Disposition: attachment; filename=Report.pdf');
    		header("Cache-Control: no-cache, must-revalidate");   		
    		echo $pdf->render();		
            //echo 'SUCCESS: Document saved!';
        } catch (Zend_Pdf_Exception $e) {
            die('PDF error: ' . $e->getMessage());
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }
    
    protected function tao_thong_bao($object,$nam,$mau,$file_type = 'pdf'){
		if($file_type == 'pdf'){
			$filename = 'report_' . time(). '.pdf';
			$file = WEB_ROOT . '/public/upload/files/thong_bao/' . $filename;
			$object->save($file,true);
		}else{
			$filename = 'report_' . time(). '.xls';
			$file = WEB_ROOT . '/public/upload/files/thong_bao/' . $filename;
			$objWriter = new PHPExcel_Writer_Excel5($object);
			$objWriter->save($file);
		}
		
    	$nam = $nam . '-' . ($nam+1);
		switch ($mau){
			case 'mau01':
				$tieu_de = 'Danh sách đăng ký đề tài NCKH cấp trường ' . $nam;
    			$noi_dung = '<p style="text-align: center; text-indent: 0.5in"></p>
					<p>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
								<span style="color: black; ">Download danh sách đăng ký đề tài NCKH cấp trường năm ' . $nam . ' </span>
						</span></span>
						<span style="color: black; font-family: \'Times New Roman\'; font-size: 18px; ">:&nbsp;</span>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
							<a href="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/thong_bao/' . $filename .'" style="font-size: 17px; ">click here</a>
						</span></span>
					</p>';
    			break;
    		case 'mau02':
				$tieu_de = 'Danh sách đăng ký đề tài NCKH cấp khoa năm ' . $nam;
    			$noi_dung = '<p style="text-align: center; text-indent: 0.5in"></p>
					<p>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
								<span style="color: black; ">Download danh sách đăng ký đề tài NCKH cấp khoa năm ' . $nam . ' </span>
						</span></span>
						<span style="color: black; font-family: \'Times New Roman\'; font-size: 18px; ">:&nbsp;</span>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
							<a href="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/thong_bao/' . $filename .'" style="font-size: 17px; ">click here</a>
						</span></span>
					</p>';
    			break;
    		case 'mau03':
				$tieu_de = 'Danh sách hội đồng duyệt đề tài NCKH cấp trường năm ' . $nam;
    			$noi_dung = '<p style="text-align: center; text-indent: 0.5in"></p>
					<p>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
								<span style="color: black; ">Download danh sách hội đồng duyệt đề tài NCKH cấp trường năm ' . $nam . ' </span>
						</span></span>
						<span style="color: black; font-family: \'Times New Roman\'; font-size: 18px; ">:&nbsp;</span>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
							<a href="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/thong_bao/' . $filename .'" style="font-size: 17px; ">click here</a>
						</span></span>
					</p>';
    			break;
			case 'mau04':
				$tieu_de = 'Thông báo lịch duyệt đề cương NCKH năm ' . $nam;
    			$noi_dung = '<p style="text-align: center; text-indent: 0.5in"></p>
					<p>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
								<span style="color: black; ">Download lịch duyệt đề cương năm ' . $nam . ' </span>
						</span></span>
						<span style="color: black; font-family: \'Times New Roman\'; font-size: 18px; ">:&nbsp;</span>
						<span style="font-size: 18px; "><span style="font-family: \'Times New Roman\'; ">
							<a href="' . Khcn_View_Helper_GetBaseUrl::getBaseUrl() . '/upload/files/thong_bao/' . $filename .'" style="font-size: 17px; ">click here</a>
						</span></span>
					</p>';
    			break;
		}
    	
    	$thong_bao = new Default_Model_ThongBao();
		$auth = Zend_Auth::getInstance();
        $thong_bao->setTieuDe($tieu_de);
        $thong_bao->setLoai('0');
        $thong_bao->setTrangThai(1);
        $thong_bao->setNoiDung($noi_dung);
        $thong_bao->setNgayTao(new Zend_Db_Expr('NOW()'));
        $thong_bao->setMaQuanTri($auth->getStorage()->read()->id);
        $thong_bao->them();
        if (!kq) {
            $_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
            $_SESSION['type_msg'] = 'error';
        }
        $_SESSION['msg'] = "Thành công! Thông báo mới đã được tạo.";
		$_SESSION['type_msg'] = "success";
    }
    
    public function downloadPdfAction(){
    	$this->_redirect('/admin/report/index');
    	$file = $this->_getParam('file');
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	header('Content-Type: application/x-pdf');
    	header('Content-Disposition: attachment; filename=Report.pdf');
    	header("Cache-Control: no-cache, must-revalidate");
		readfile($file);
    }
	
	public function excelMau01Action(){
		$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		$session = new Zend_Session_Namespace('report');
		$objPHPExcel = new Admin_Model_PHPExcel();				
		$objPHPExcel->setFileProperties();	
		$objPHPExcel->setHeader();
		$paramsTitle = array(
			'title_1' => 'DANH SÁCH CÁN BỘ GIẢNG VIÊN',
			'title_2' => 'ĐƯỢC CHẤP THUẬN ĐĂNG KÝ ĐỀ TÀI NGHIÊN CỨU KHOA HỌC CẤP TRƯỜNG',
			'year' => $session->nam . '-' . ($session->nam + 1),
			'description' => $session->quyet_dinh,
		);
		$objPHPExcel->setTitle($paramsTitle);
		
		$objPHPExcel->setRowHeight(12, 25);
		$objPHPExcel->setColumnWidth('C', 15);
		$objPHPExcel->setColumnWidth('D', 30);
		$objPHPExcel->setColumnWidth('F', 60);
		$objPHPExcel->setColumnWidth('G', 20);
		$objPHPExcel->setColumnWidth('H', 15);

		$objPHPExcel->setCellValue("B12", "STT", $objPHPExcel->getStyleHeaderColumn());
		$objPHPExcel->setCellValue("C12", "MÃ SỐ ĐỀ TÀI", $objPHPExcel->getStyleHeaderColumn());
		$objPHPExcel->setCellValue("D12", "HỌ TÊN GIẢNG VIÊN", $objPHPExcel->getStyleHeaderColumn());
		$objPHPExcel->setCellValue("E12", "STT GV", $objPHPExcel->getStyleHeaderColumn());
		$objPHPExcel->setCellValue("F12", "TÊN ĐỀ TÀI NCKH", $objPHPExcel->getStyleHeaderColumn());
		$objPHPExcel->setCellValue("G12", "THỜI GIAN KẾT THÚC", $objPHPExcel->getStyleHeaderColumn());
		$objPHPExcel->setCellValue("H12", "KINH PHÍ (VNĐ)", $objPHPExcel->getStyleHeaderColumn());		

		//------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
		//Diem bat dau bang danh sach
		$start_row = $row = 13;
		//------------------- DETAIL ----------------
		$donVis = $this->de_tai->getDSDV($session->nam,2,$session->ma_loai);
		$idGVs = array();
		$count_line = 0;
		$count_k = 1;
		$count_dt = 1;
		$count_gv = 1;
		foreach ($donVis as $don_vi)
		{	
			$id_don_vi = $don_vi['ma_don_vi'];
			$don_vi = $this->don_vi->getDonVi($id_don_vi);
			if(!$don_vi)
				continue;
			// Get ds de tai
			$deTais = $this->de_tai->getDSDTChapThuan($id_don_vi,$session->nam,2,$session->ma_loai);
			if(!$deTais)
				continue;
			//-------- Đơn vị ---------
			$objPHPExcel->setRowHeight($row, 20);
			$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'H'.$row);
			$objPHPExcel->setCellValue('B'.$row, mb_strtoupper($count_k++ . '. ' . $don_vi['ten'],'UTF-8'), $objPHPExcel->getStyleTitleAlign());
			$row++;
			//-------- Subject ---------
			foreach ($deTais as $de_tai)
			{             		
				$thanhViens = $this->dang_ky->getDSDKByMaDeTai($de_tai['id']);
				$so_tv = count($thanhViens);
				//merger cell if have more two teachers
				if($so_tv >= 2){
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'B'.($row + $so_tv - 1));
					$objPHPExcel->getActiveSheet()->mergeCells('C'.$row.':'.'C'.($row + $so_tv - 1));
					$objPHPExcel->getActiveSheet()->mergeCells('F'.$row.':'.'F'.($row + $so_tv - 1));
					$objPHPExcel->getActiveSheet()->mergeCells('G'.$row.':'.'G'.($row + $so_tv - 1));
					$objPHPExcel->getActiveSheet()->mergeCells('H'.$row.':'.'H'.($row + $so_tv - 1));
				}
				//STT
				$objPHPExcel->setCellValue("B".$row, $count_dt++, $objPHPExcel->getStyleAlignText());
				//ID Subject
				$objPHPExcel->setCellValue("C".$row, $de_tai['ma'], $objPHPExcel->getStyleAlignText());
				//Subject
				$objPHPExcel->setCellValue("F".$row, $de_tai['ten'], array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'wrap' => true
					),
				));
				//Member
				$count_mb = 0;
				foreach ($thanhViens as $thanh_vien)
				{
					$objPHPExcel->setCellValue("D".($row + $count_mb), $thanh_vien['hoc_vi'] . ' ' . $thanh_vien['ten_thanh_vien'], $objPHPExcel->getStyleAlignText());					
					if(!in_array($thanh_vien['id'],$idGVs)){
						$idGVs[] = $thanh_vien['id'];
						$objPHPExcel->setCellValue("E".($row + $count_mb), $count_gv++, $objPHPExcel->getStyleAlignText());
					}
					$count_mb++;
				}
				// Expired Date
				$objPHPExcel->setCellValue("G".$row, $de_tai['ngay_hoan_thanh'], $objPHPExcel->getStyleAlignText());
				$objPHPExcel->getActiveSheet()
					->getStyle("G".$row)
					->getNumberFormat()
					->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_MMYYYY);
					
				//Cost
				$objPHPExcel->setCellValue("H".$row, $de_tai['kinh_phi'], $objPHPExcel->getStyleAlignText());
				$objPHPExcel->getActiveSheet()
					->getStyle("H".$row)
					->getNumberFormat()
					->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED);
					
				$row += $count_mb;
			}
		}
		
		$objPHPExcel->getActiveSheet()->getStyle('B'.($start_row - 1).':H'.($row - 1))->applyFromArray($objPHPExcel->getStyleBoderTable());
		
		//Sumary
		$row++;
		$total = 'Danh sách này gồm ' . --$count_dt . ' đề tài với ' . --$count_gv . ' giảng viên tham gia';
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':E'.$row);
		$objPHPExcel->setCellValue("B".$row, $total, $objPHPExcel->getStyleTitleAlign());
		 
		//---------- SAVE FILE EXCEL ----------------
		//----- SAVE IN DISC -----
		if($session->thong_bao == '1'){
			$this->tao_thong_bao($objPHPExcel,$session->nam,$session->mau,'excel');
			$this->_redirect('/admin/report/index');
		}        
		//----- DOWNLOAD FILE -----
		$objPHPExcel->render();
	}
	
	public function excelMau02Action(){
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
			$session = new Zend_Session_Namespace('report');
			$objPHPExcel = new Admin_Model_PHPExcel();				
			$objPHPExcel->setFileProperties();	
			$objPHPExcel->setHeader();
			$paramsTitle = array(
				'title_1' => 'DANH SÁCH CÁN BỘ GIẢNG VIÊN',
				'title_2' => 'ĐƯỢC CHẤP THUẬN ĐĂNG KÝ ĐỀ TÀI NGHIÊN CỨU KHOA HỌC CẤP KHOA',
				'year' => $session->nam . '-' . ($session->nam + 1),
				'description' => $session->quyet_dinh,
			);
			$objPHPExcel->setTitle($paramsTitle);
			
			$objPHPExcel->setRowHeight(12, 25);
			$objPHPExcel->setColumnWidth('C', 25);
			$objPHPExcel->setColumnWidth('F', 70);
			$objPHPExcel->setColumnWidth('G', 15);

			$objPHPExcel->setCellValue("B12", "STT", $objPHPExcel->getStyleHeaderColumn());
			$objPHPExcel->getActiveSheet()->mergeCells('C12:D12');
			$objPHPExcel->setCellValue("C12", "HỌ TÊN GIẢNG VIÊN", $objPHPExcel->getStyleHeaderColumn());
			$objPHPExcel->setCellValue("E12", "STT GV", $objPHPExcel->getStyleHeaderColumn());
			$objPHPExcel->setCellValue("F12", "TÊN ĐỀ TÀI NCKH", $objPHPExcel->getStyleHeaderColumn());			
			$objPHPExcel->getActiveSheet()->mergeCells('G12:H12');
			$objPHPExcel->setCellValue("G12", "THỜI GIAN KẾT THÚC", $objPHPExcel->getStyleHeaderColumn());	

                 		 	
            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $start_row = $row = 13;
            //------------------- DETAIL ----------------
            $donVis = $this->de_tai->getDSDV($session->nam,1);
			$idGVs = array();
			$count_line = 0;
			$count_k = 1;
            $count_dt = 1;
            $count_gv = 1;
            foreach ($donVis as $don_vi)
            {
				$id_don_vi = $don_vi['ma_don_vi'];
				$don_vi = $this->don_vi->getDonVi($id_don_vi);
				if(!$don_vi)
					continue;
				// Get ds de tai
               	$deTais = $this->de_tai->getDSDTChapThuan($id_don_vi,$session->nam,1);
				if(!$deTais)
					continue;
            	//-------- Đơn vị ---------
               	$objPHPExcel->setRowHeight($row, 20);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'H'.$row);
				$objPHPExcel->setCellValue('B'.$row, mb_strtoupper($count_k++ . '. ' .$don_vi['ten'],'UTF-8'), $objPHPExcel->getStyleTitleAlign());
				$row++;
				//-------- Subject ---------
               	foreach ($deTais as $de_tai)
               	{             		
               		$thanhViens = $this->dang_ky->getDSDKByMaDeTai($de_tai['id']);
					$so_tv = count($thanhViens);
					//merger cell if have more two teachers
					if($so_tv >= 2){
						$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'B'.($row + $so_tv - 1));
						$objPHPExcel->getActiveSheet()->mergeCells('F'.$row.':'.'F'.($row + $so_tv - 1));
						$objPHPExcel->getActiveSheet()->mergeCells('H'.$row.':'.'H'.($row + $so_tv - 1));
					}
					//STT
					$objPHPExcel->setCellValue("B".$row, $count_dt++, $objPHPExcel->getStyleAlignText());
					//Subject
					$objPHPExcel->setCellValue("F".$row, $de_tai['ten'], array(
						'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							'wrap' => true
						),
					));
					//Member
					$count_mb = 0;
					foreach ($thanhViens as $thanh_vien)
					{
						$objPHPExcel->getActiveSheet()->mergeCells('C'.($row + $count_mb).':D'.($row + $count_mb));
						$objPHPExcel->setCellValue("C".($row + $count_mb), $thanh_vien['hoc_vi'] . ' ' . $thanh_vien['ten_thanh_vien'], $objPHPExcel->getStyleAlignText());					
						if(!in_array($thanh_vien['id'],$idGVs)){
							$idGVs[] = $thanh_vien['id'];
							$objPHPExcel->setCellValue("E".($row + $count_mb), $count_gv++, $objPHPExcel->getStyleAlignText());
						}
						$count_mb++;
					}
					// Expired Date
					$objPHPExcel->getActiveSheet()->mergeCells("G".$row.":H".$row);
					$objPHPExcel->setCellValue("G".$row, $de_tai['ngay_hoan_thanh'], $objPHPExcel->getStyleAlignText());
					$objPHPExcel->getActiveSheet()
						->getStyle("G".$row)
						->getNumberFormat()
						->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_MMYYYY);
						
					$row += $count_mb;               	 	
               	}
            }
			$objPHPExcel->getActiveSheet()->getStyle('B'.($start_row - 1).':H'.($row - 1))->applyFromArray($objPHPExcel->getStyleBoderTable());		
			//Sumary
			$row++;
			$total = 'Danh sách này gồm ' . --$count_dt . ' đề tài với ' . --$count_gv . ' giảng viên tham gia';
			$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':E'.$row);
			$objPHPExcel->setCellValue("B".$row, $total, $objPHPExcel->getStyleTitleAlign());
			
			//---------- SAVE FILE EXCEL ----------------
			//----- SAVE IN DISC -----
			if($session->thong_bao == '1'){
				$this->tao_thong_bao($objPHPExcel,$session->nam,$session->mau,'excel');
				$this->_redirect('/admin/report/index');
			}        
			//----- DOWNLOAD FILE -----
			$objPHPExcel->render();
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }
	
	
	public function excelMau04Action(){
		$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
			$session = new Zend_Session_Namespace('report');
			$objPHPExcel = new Admin_Model_PHPExcel();				
			$objPHPExcel->setFileProperties();	
			$objPHPExcel->setHeader();
			
			$objPHPExcel->setColumnWidth('C', 15);
			$objPHPExcel->setColumnWidth('D', 30);
			$objPHPExcel->setColumnWidth('F', 60);
			$objPHPExcel->setColumnWidth('G', 20);
			$objPHPExcel->setColumnWidth('H', 15);


            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $row = 7;
			//------------------ HEADER TABLE-----------------
            //------------------- DETAIL ----------------
            $hoiDongs = $this->hdd->getDSHDForExport($session->nam);
            $count_hd = 1;
            foreach ($hoiDongs as $hoi_dong)
            {
				$count_dt = 1;
				$count_gv = 1;
				$idGVs = array();
            	
            	// Hoi dong  
				$paramsTitle = array(
					'title_1' => 'DANH SÁCH ĐỀ TÀI NCKH DUYỆT TẠI HỘI ĐỒNG SỐ ' . $count_hd,
					'year' => $session->nam . '-' . ($session->nam + 1),
					'description' => $session->quyet_dinh,
				);
				$objPHPExcel->setTitle($paramsTitle,$row);
				
	            // thanh vien hoi dong
				$row += 4;
	            $thanhViensHDD = $this->pcd->getCTTKByHDD($hoi_dong['id']); 
	            foreach ($thanhViensHDD as $thanh_vien_hdd){
					
	            	if($thanh_vien_hdd['chuc_danh'] == '0'){
	            		$objPHPExcel->setCellValue("C".$row, "Chủ tịch");
						$objPHPExcel->setCellValue("D".$row, $thanh_vien_hdd['hoc_vi'] . ' ' . $thanh_vien_hdd['ho_ten'], array(
							'font' => array(
								'bold' => true,
							),
						));
	            	}else{
						$objPHPExcel->setCellValue("E".$row, "Thư ký");
						$objPHPExcel->setCellValue("F".$row, $thanh_vien_hdd['hoc_vi'] . ' ' . $thanh_vien_hdd['ho_ten'], array(
							'font' => array(
								'bold' => true,
							),
						));
	            	}
	            }
				$row++;
				$objPHPExcel->setCellValue("C".$row, "Thời gian");
				$objPHPExcel->setCellValue("E".$row, "Địa điểm");
	            
				//Set Title
				$row += 2;
				$objPHPExcel->setRowHeight($row, 25);
				$objPHPExcel->setCellValue("B".$row, "STT", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->setCellValue("C".$row, "MÃ SỐ ĐỀ TÀI", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->setCellValue("D".$row, "HỌ TÊN GIẢNG VIÊN", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->setCellValue("E".$row, "STT GV", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->setCellValue("F".$row, "TÊN ĐỀ TÀI NCKH", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->setCellValue("G".$row, "THỜI GIAN KẾT THÚC", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->setCellValue("H".$row, "KINH PHÍ (VNĐ)", $objPHPExcel->getStyleHeaderColumn());
				
               	//-------- Hội đồng ---------
				$row++;
				$start_row = $row;
            	$tong_so_dt = $this->de_tai->getSLDTByHDD($hoi_dong['id']);
            	if($hoi_dong['ghi_chu'] != '' && $hoi_dong['ghi_chu'] != null)
            		$lv = $hoi_dong['ghi_chu'];
            	else
            		$lv = $hoi_dong['linh_vuc'];
				
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':H'.$row);
				$objPHPExcel->setCellValue("B".$row, 'HỘI ĐỒNG ' . $count_hd . ' : ' . $tong_so_dt . ' đề tài (' .$lv . ')', array(
					'font' => array(
						'bold' => true,
					),
				));
				$row++;
               	$donVis = $this->de_tai->getDSDVByHDD($session->nam,$hoi_dong['id']);
               	foreach ($donVis as $don_vi){
					$id_don_vi = $don_vi['ma_don_vi'];
					$don_vi = $this->don_vi->getDonVi($id_don_vi);
					if(!$don_vi)
						continue;
					// Get ds de tai
					$deTais = $this->de_tai->getDSDTByHDDAndDV($hoi_dong['id'],$id_don_vi);
					if(!$deTais)
						continue;
					//-------- Đơn vị ---------
					$objPHPExcel->setRowHeight($row, 20);
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'H'.$row);
					$objPHPExcel->setCellValue('B'.$row, mb_strtoupper($don_vi['ten'],'UTF-8'), $objPHPExcel->getStyleTitleAlign());
					$row++;
					//-------- Subject ---------
	               	foreach ($deTais as $de_tai)
	               	{         
						$thanhViens = $this->dang_ky->getDSDKByMaDeTai($de_tai['id']);
						$so_tv = count($thanhViens);
						//merger cell if have more two teachers
						if($so_tv >= 2){
							$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':'.'B'.($row + $so_tv - 1));
							$objPHPExcel->getActiveSheet()->mergeCells('C'.$row.':'.'C'.($row + $so_tv - 1));
							$objPHPExcel->getActiveSheet()->mergeCells('F'.$row.':'.'F'.($row + $so_tv - 1));
							$objPHPExcel->getActiveSheet()->mergeCells('G'.$row.':'.'G'.($row + $so_tv - 1));
							$objPHPExcel->getActiveSheet()->mergeCells('H'.$row.':'.'H'.($row + $so_tv - 1));
						}
						//STT
						$objPHPExcel->setCellValue("B".$row, $count_dt++, $objPHPExcel->getStyleAlignText());
						//ID Subject
						$objPHPExcel->setCellValue("C".$row, $de_tai['ma'], $objPHPExcel->getStyleAlignText());
						//Subject
						$objPHPExcel->setCellValue("F".$row, $de_tai['ten'], array(
							'alignment' => array(
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
								'wrap' => true
							),
						));
						//Member
						$count_mb = 0;
						foreach ($thanhViens as $thanh_vien)
						{
							$objPHPExcel->setCellValue("D".($row + $count_mb), $thanh_vien['hoc_vi'] . ' ' . $thanh_vien['ten_thanh_vien'], $objPHPExcel->getStyleAlignText());					
							if(!in_array($thanh_vien['id'],$idGVs)){
								$idGVs[] = $thanh_vien['id'];
								$objPHPExcel->setCellValue("E".($row + $count_mb), $count_gv++, $objPHPExcel->getStyleAlignText());
							}
							$count_mb++;
						}
						// Expired Date
						$objPHPExcel->setCellValue("G".$row, $de_tai['ngay_hoan_thanh'], $objPHPExcel->getStyleAlignText());
						$objPHPExcel->getActiveSheet()
							->getStyle("G".$row)
							->getNumberFormat()
							->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_MMYYYY);
							
						//Cost
						$objPHPExcel->setCellValue("H".$row, $de_tai['kinh_phi'], $objPHPExcel->getStyleAlignText());
						$objPHPExcel->getActiveSheet()
							->getStyle("H".$row)
							->getNumberFormat()
							->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED);
							
						$row += $count_mb;           	 	
	               	}
               	}
				$objPHPExcel->getActiveSheet()->getStyle('B'.($start_row - 1).':H'.($row - 1))->applyFromArray($objPHPExcel->getStyleBoderTable());				
               	$count_hd++;
				$row += 4;
            }

            //---------- SAVE FILE EXCEL ----------------
			//----- SAVE IN DISC -----
			if($session->thong_bao == '1'){
				$this->tao_thong_bao($objPHPExcel,$session->nam,$session->mau,'excel');
				$this->_redirect('/admin/report/index');
			}        
			//----- DOWNLOAD FILE -----
			$objPHPExcel->render();
			
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
	}
	
	public function excelMau03Action(){
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
		try {
		 	$session = new Zend_Session_Namespace('report');
			$objPHPExcel = new Admin_Model_PHPExcel();				
			$objPHPExcel->setFileProperties();	
			$objPHPExcel->setHeader();
			$paramsTitle = array(
				'title_1' => 'HỘI ĐỒNG DUYỆT ĐỀ TÀI NCKH CẤP TRƯỜNG',
				'year' => $session->nam . '-' . ($session->nam + 1),
				'description' => $session->quyet_dinh,
			);
			$objPHPExcel->setTitle($paramsTitle);
			
			$objPHPExcel->setColumnWidth('C', 35);
			$objPHPExcel->setColumnWidth('E', 35);
			$objPHPExcel->setColumnWidth('G', 35);
			  		 	
            //------------------  THÔNG TIN DANH SÁCH ĐỀ TÀI ---------------
            //Diem bat dau bang danh sach
            $row = 12;
			//------------------ HEADER TABLE-----------------
            //------------------- DETAIL ----------------
            $hoiDongs = $this->hdd->getDSHDForExport($session->nam);
            $count_hd = 1;
            foreach ($hoiDongs as $hoi_dong)
            {
            	//-------- Hội đồng ---------
            	$count_dt = $this->de_tai->getSLDTByHDD($hoi_dong['id']);
            	if($hoi_dong['ghi_chu'] != '' && $hoi_dong['ghi_chu'] != null)
            		$lv = $hoi_dong['ghi_chu'];
            	else
            		$lv = $hoi_dong['linh_vuc'];
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':H'.$row);
				$objPHPExcel->setCellValue("B".$row, 'HỘI ĐỒNG ' . $count_hd++ . ' : ' . $count_dt . ' đề tài (' .$lv . ')', array(
					'font' => array(
						'bold' => true,
					),
				));	
               	// Title
            	$row++;
				$objPHPExcel->setRowHeight($row, 25);
				$objPHPExcel->setCellValue("B".$row, "STT", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
				$objPHPExcel->setCellValue("C".$row, "HỌ VÀ TÊN", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->getActiveSheet()->mergeCells('E'.$row.':F'.$row);
				$objPHPExcel->setCellValue("E".$row, "CHỨC VỤ", $objPHPExcel->getStyleHeaderColumn());
				$objPHPExcel->getActiveSheet()->mergeCells('G'.$row.':H'.$row);
				$objPHPExcel->setCellValue("G".$row, "ĐƠN VỊ CÔNG TÁC", $objPHPExcel->getStyleHeaderColumn());		
				
               	//-------- Thành viên ---------
            	$row++;
				$start_row = $row;
               	$thanhViens = $this->pcd->getDSGVForExport($hoi_dong['id']);
               	$count_tv = 1;
               	foreach ($thanhViens as $thanh_vien)
               	{             		
					//STT
               		$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':B'.($row+1));
					$objPHPExcel->setCellValue("B".$row, $count_tv++, $objPHPExcel->getStyleAlignText());		
               	 	//Thanh vien
					$objPHPExcel->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
					if($thanh_vien['chuc_danh'] == '0'){	
						$objPHPExcel->setCellValue("C".$row, 'Chủ tịch hội đồng');			
               	 	}else if($thanh_vien['chuc_danh'] == '2'){	
						$objPHPExcel->setCellValue("C".$row, 'Thư ký');
               	 	}else{
						$objPHPExcel->setCellValue("C".$row, 'Ủy viên' . ($count_tv - 2) );
               	 	}   
					$objPHPExcel->getActiveSheet()->mergeCells('C'.($row+1).':D'.($row+1));
					$objPHPExcel->setCellValue("C".($row+1), $thanh_vien['ma_hoc_vi'] . '. ' . $thanh_vien['ho_ten'], array(
						'font' => array(
							'bold' => true,
						),
					));         
					//Chuc vu
					$objPHPExcel->getActiveSheet()->mergeCells('E'.$row.':F'.($row+1));
					$objPHPExcel->setCellValue("E".$row, $thanh_vien['chuc_vu'], $objPHPExcel->getStyleAlignText());		
					
					//Don vi
               	 	$objPHPExcel->getActiveSheet()->mergeCells('G'.$row.':H'.($row+1));
					$objPHPExcel->setCellValue("G".$row, $thanh_vien['don_vi'], $objPHPExcel->getStyleAlignText());		              	 	
               		$row +=2;          	 	
               	}
				$objPHPExcel->getActiveSheet()->getStyle('B'.($start_row - 1).':H'.($row - 1))->applyFromArray($objPHPExcel->getStyleBoderTable());				
               	$row += 2;
            }
            
			
            //---------- SAVE FILE EXCEL ----------------
			//----- SAVE IN DISC -----
			if($session->thong_bao == '1'){
				$this->tao_thong_bao($objPHPExcel,$session->nam,$session->mau,'excel');
				$this->_redirect('/admin/report/index');
			}        
			//----- DOWNLOAD FILE -----
			$objPHPExcel->render();
			
        } catch (Exception $e) {
            die('Application error: ' . $e->getMessage());
        }
    }
	
	
	public function testAction(){
		// Set value binder
		//4.5.6.	Using value binders to facilitate data entry
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );

		$objPHPExcel = new PHPExcel();
		
		//4.2.1.	Cell Caching
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory;
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod);

		//4.6.1.	Setting a spreadsheet’s metadata
		$objPHPExcel->getProperties()->setCreator("Hung Nguyen K08");
		$objPHPExcel->getProperties()->setLastModifiedBy("Hung Nguyen");
		$objPHPExcel->getProperties()->setTitle("Report");
		$objPHPExcel->getProperties()->setSubject("Report");
		$objPHPExcel->getProperties()->setDescription("Report");
		$objPHPExcel->getProperties()->setKeywords("report");

		//4.5.	Accessing cells
		//4.5.1.	Setting a cell value by coordinate
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Some value 1');
		
		//4.5.3.	Setting a cell value by column and row
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 0, 'Some value 2');
		
		//4.5.6.	Using value binders to facilitate data entry
		// Add some data, resembling some different data types
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Percentage value:');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', '10%');
		// Converts to 0.1 and sets percentage cell style

		
		// MySQL-like timestamp '2008-12-31' or date string
		//Insert new type in class PHPExcel_Style_NumberFormat
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
		$objPHPExcel->getActiveSheet()
					->setCellValue('D1', '2008-12-31');
		$objPHPExcel->getActiveSheet()
					->getStyle('D1')
					->getNumberFormat()
					->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_MMYYYY);
		
		//4.6.4.	Write a formula into a cell
		$objPHPExcel->getActiveSheet()->setCellValue('C4', '400');	
		$objPHPExcel->getActiveSheet()->setCellValue('B8','=IF(C4>500,"profit","loss")');
		
		// If you want to write a string beginning with an "=" to a cell, then you should use the setCellValueExplicit() method
		$objPHPExcel->getActiveSheet()
            ->setCellValueExplicit('B8',
                                   '=IF(C4>500,"profit","loss")',
                                   PHPExcel_Cell_DataType::TYPE_STRING
                                  );
		
		//	Write a newline character "\n" in a cell
		//	AdvancedValuebinder.php automatically turns on "wrap text" for the cell when it sees a newline character in a string that you are inserting in a cell
		$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("hello\nworld");

		//4.6.8.	Change a cell into a clickable URL
		//	Change a cell into a clickable URL
		$objPHPExcel->getActiveSheet()->setCellValue('E26', 'www.phpexcel.net');
		$objPHPExcel->getActiveSheet()->getCell('E26')->getHyperlink()->setUrl('http://www.phpexcel.net');

		
		//	If you want to make a hyperlink to another worksheet/cell, use the following code:
		//$objPHPExcel->getActiveSheet()->setCellValue('E26', 'www.phpexcel.net');
		//$objPHPExcel->getActiveSheet()->getCell('E26')->getHyperlink()->setUrl("sheet://'Sheetname'!A1");

		//4.6.20.	Alignment and wrap text
		$objPHPExcel->getActiveSheet()->getStyle('A1:D4')
					->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

		$objPHPExcel->getActiveSheet()->getStyle('A1:D4')
					->getAlignment()->setWrapText(true);
		
		//$this->getActiveSheet()->getRowDimension(2)->setRowHeight(50);
		
		//4.6.28.	Setting a column’s width
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		
		//If you want PHPExcel to perform an automatic width calculation, use the following code. PHPExcel will approximate the column with to the width of the widest column value.
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				
		//4.6.34.	Merge/unmerge cells
		$objPHPExcel->getActiveSheet()->mergeCells('A18:E22');
				
		//Removing a merge can be done using the unmergeCells method:
		//Just use this function with cell merged
		$objPHPExcel->getActiveSheet()->unmergeCells('A18:E22');
		
		//4.6.35.	Inserting rows/columns
		$objPHPExcel->getActiveSheet()->insertNewRowBefore(7, 2);
		
		
		//4.6.36.	Add a drawing to a worksheet
		// path containe images is public/
		//You can set numerous properties on a drawing, here are some examples:
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath('images/officelogo.jpg');
		$objDrawing->setCoordinates('B15');
		$objDrawing->setOffsetX(110);
		$objDrawing->setRotation(25);
		$objDrawing->getShadow()->setVisible(true);
		$objDrawing->getShadow()->setDirection(45);
		$objDrawing->setHeight(36);
		
		//To add the above drawing to the worksheet, use the following snippet of code. PHPExcel creates the link between the drawing and the worksheet:
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

		//4.6.38.	Add rich text to a cell
		$objRichText = new PHPExcel_RichText();
		$objRichText->createText('This invoice is ');

		$objPayable = $objRichText->createTextRun('payable within thirty days after the end of the month');
		$objPayable->getFont()->setBold(true);
		$objPayable->getFont()->setItalic(true);
		$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );

		$objRichText->createText(', unless specified otherwise on the invoice.');

		$objPHPExcel->getActiveSheet()->getCell('A18')->setValue($objRichText);

		//4.6.41.	Setting the default column width
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
		
		//4.6.42.	Setting the default row height
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
		
		//4.6.46.	Creating worksheets in a workbook
		$objWorksheet1 = $objPHPExcel->createSheet();
		$objWorksheet1->setTitle('Another sheet');

		//4.6.48.	Right-to-left worksheet
		//Worksheets can be set individually whether column ‘A’ should start at left or right side. Default is left. Here is how to set columns from right-to-left.
		// right-to-left worksheet
		//$objPHPExcel->getActiveSheet()->setRightToLeft(true);

		//Here there will be some code where you create $objPHPExcel

		// redirect output to client browser
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="myfile.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output'); 
		
		//write to file in folder public
		//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		//$objWriter->save("05featuredemo.xls");

		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit(0);
	}
}

<?php
class Default_Form_SearchDT extends Khcn_Form {
	
	public function init()
	{
		$this->setAttrib('class', 'global_form form_search_dt')
        	 ->setMethod('get');
				  
		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDVSGU();
		unset($dv['1']);
		$dv = array('' => '') + $dv;
		$dvOptions = array("multiOptions" => $dv);
		$ma_don_vi = new Khcn_Form_Element_Select('ma_don_vi',$dvOptions);
		$ma_don_vi->setLabel('Đơn vị')
				  ->setAttribs(array('onchange' => 'this.form.submit()'));
		$this->addElement($ma_don_vi);
		
		$capQLs = Default_Model_Constraints::detai_capquanly();
        $capQLsOptions = array("multiOptions" => array('' => '') + $capQLs);	
		$cap_quan_ly = new Khcn_Form_Element_Select('cap_quan_ly',$capQLsOptions);
		$cap_quan_ly->setLabel('Cấp quản lý')
				   ->setAttribs(array('id' => 'cap_quan_ly','onchange' => 'this.form.submit()'));
		$this->addElement($cap_quan_ly);
		
		$this->addDisplayGroup(array('ma_don_vi','cap_quan_ly'),'submitbtn'); 
			 
		$status = Default_Model_Constraints::detai_tinhtrang();
        $status = array('' => '') + $status;
        $statusOptions = array("multiOptions" => $status);	
		$tinh_trang = new Khcn_Form_Element_Select('tinh_trang',$statusOptions);
		$tinh_trang->setLabel('Tình trạng')
				   ->setAttribs(array('onchange' => 'this.form.submit()'));
		$this->addElement($tinh_trang);
		
		$linh_vuc = new Default_Model_LinhVuc();
		$lv = $linh_vuc->getDSLV();
		$lv = array('' => '') + $lv;
		$lvOptions = array("multiOptions" => $lv);	
		$ma_linh_vuc = new Khcn_Form_Element_Select('ma_linh_vuc',$lvOptions);
		$ma_linh_vuc->setLabel('Lĩnh vực')
				  ->setAttribs(array('onchange' => 'this.form.submit()'));
		$this->addElement($ma_linh_vuc);
		
		$sorts = array(
			'' => 'Mã & Năm',
			'ma' => 'Mã',
			'nam' => 'Năm'
		);
		$sortsOption = array("multiOptions" => $sorts);
		$order = new Khcn_Form_Element_Select('order',$sortsOption);
		$order->setLabel('Sắp xếp')
			 ->setAttribs(array('onchange' => 'this.form.submit()'));
		//$this->addElement($ma_don_vi);
		
		$directions = array(
			'asc' => 'Tăng dần',
			'desc' => 'Giảm dần'
		);
		$directionsOption = array("multiOptions" => $directions);
		$direction = new Khcn_Form_Element_Select('direction',$directionsOption);
		$direction->setLabel('Sắp xếp')
			->setValue('desc')
			->setAttribs(array('onchange' => 'this.form.submit()'));
		//$this->addElement($ma_don_vi);
		
        $nams = array();
		for($i = 2005 ; $i<2030 ; $i++)
			$nams[$i] = $i;
		$nams = array('0' => '------') + $nams;		
		$namsOption = array("multiOptions" => $nams);
				
		$from = new Khcn_Form_Element_Select('from',$namsOption);
		$from->setLabel('Từ ')
			 ->setValue(date('Y'))
			 ->setAttribs(array('onchange' => 'this.form.submit()'));
		$this->addElement($from);
		
		$to = new Khcn_Form_Element_Select('to',$namsOption);
		$to->setLabel('Đến ')
		   ->setAttribs(array('onchange' => 'this.form.submit()'));
		$this->addElement($to);
		
		//$this->addElements(array($ma_don_vi,$tinh_trang,$ma_linh_vuc,$order,$direction,$from,$to));
		//$this->addElements(array($ma_don_vi, $cap_quan_ly, $ma_linh_vuc, $tinh_trang, $from, $to));

		
	}
}
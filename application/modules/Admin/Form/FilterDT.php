<?php
class Admin_Form_FilterDT extends Zend_Form{
	public function init()
    {  	
        $this->setName('f3')
        	 ->setMethod('get');

        $nams = Default_Model_Constraints::nam();
		$nams = array('' => '== Tất cả ==') + $nams;
		$namOption = array("multiOptions" => $nams);
		$nam = new Zend_Form_Element_Select('nam',$namOption);
		$nam->setLabel('Năm')
			->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'title'))))
			->setAttribs(array('id' => 'nam','onchange' => 'this.form.submit()'));
		
		$expiredOption = array('' => '');
		for($i = 1; $i<=12 ; $i++){
			$expiredOption[$i] = $i;
		}
		$expiredOption = array("multiOptions" => $expiredOption);
		$expired = new Zend_Form_Element_Select('expired',$expiredOption);
		$expired->setLabel('TG Hết hạn (T)')
				->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'title'))))
				->setAttribs(array('id' => 'expired','onchange' => 'this.form.submit()'));
			
		$capQLs = Default_Model_Constraints::detai_capquanly();
        $capQLsOptions = array("multiOptions" => $capQLs);	
		$cap_quan_ly = new Zend_Form_Element_Select('cap_quan_ly',$capQLsOptions);
		$cap_quan_ly->setLabel('Cấp QL')
				   ->setValue(2)
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'title'))))
				   ->setAttribs(array('id' => 'cap_quan_ly','onchange' => 'this.form.submit()'));
				   
        $status = Default_Model_Constraints::detai_tinhtrang();
        $status = array('' => '=== Tất cả ===') + $status;
        $statusOptions = array("multiOptions" => $status);	
		$tinh_trang = new Zend_Form_Element_Select('tinh_trang',$statusOptions);
		$tinh_trang->setLabel('Tình trạng')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','class' => 'status')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td','class' => 'title'))))
				   ->setAttribs(array('id' => 'tinh_trang','onchange' => 'this.form.submit()'));
				   
		$linh_vuc = new Default_Model_LinhVuc();
		$lv = $linh_vuc->getDSLV();
		$lv = array('' => '===== Tất cả =====') + $lv;
		$lvOptions = array("multiOptions" => $lv);	
		$ma_linh_vuc = new Zend_Form_Element_Select('ma_linh_vuc',$lvOptions);
		$ma_linh_vuc->setLabel('Lĩnh vực')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
				  ->setAttribs(array('id' => 'ma_linh_vuc','onchange' => 'this.form.submit()'));
				  
		$llv = Khcn_Api::_()->getDbTable('loai_linh_vuc', 'default')->getMultiOptions();
		$llv = array('' => '===== Tất cả =====') + $llv;
		$llvOptions = array("multiOptions" => $llv);	
		$loai_linh_vuc = new Zend_Form_Element_Select('loai_linh_vuc',$llvOptions);
		$loai_linh_vuc->setLabel('Loại đề tài')
					  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
					->setAttribs(array('id' => 'loai_linh_vuc','onchange' => 'this.form.submit()'));
				  
		$don_vi = new Default_Model_DonVi();
		$dv = $don_vi->getDSDVSGU();
		unset($dv[Default_Model_Constraints::ID_DHSG]);
		$dv = array('' => '============= Tất cả =============') + $dv;
		$dvOptions = array("multiOptions" => $dv);
		$ma_don_vi = new Zend_Form_Element_Select('ma_don_vi',$dvOptions);
		$ma_don_vi->setLabel('Đơn vị')
				  ->setSeparator('')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 3)),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td'))))
				  ->setAttribs(array('id' => 'ma_don_vi', 'onchange' => 'this.form.submit()'));;
		
		$bo_mon_id = new Zend_Form_Element_Select('bo_mon_id');
		$bo_mon_id->setLabel('Bộ môn')
				   ->setDecorators(array(
					 		    'ViewHelper',
				   				'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'span')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'td', 'id' => 'bo_mon_id-wrapper'))))
				   ->setAttribs(array('id' => 'bo_mon_id', 'onchange' => 'this.form.submit()'));
		
		$submit = new Zend_Form_Element_Button('loc',array('type' => 'submit'));
        $submit->setLabel('Lọc')
        	   ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'filter_btn_l')),
							    ))
			   ->setAttribs(array('class' => 'button'));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'de-tai','action' => 'index'),null,true);
		$reset = new Zend_Form_Element_Button('reset');
        $reset->setLabel('Làm mới')
        	  ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'filter_btn_r')),
							    ))
				->setAttribs(array('class' => 'button','id' => 'reset','onclick' => 'window.location.href="' . $link . '"'));
		
		$link = $url->url(array('module' => 'admin','controller' => 'hoi-dong','action' => 'them-hdd'),null,true);
		$them_hdd = new Zend_Form_Element_Button('them_hdd');
        $them_hdd->setLabel('Thành lập Hội đồng duyệt')
        	  	 ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span','class' => 'filter_btn_r')),
							    ))
				 ->setAttribs(array('class' => 'button','id' => 'them_hdd','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($nam, $ma_linh_vuc, $loai_linh_vuc, $cap_quan_ly, $tinh_trang, $ma_don_vi, $bo_mon_id, $expired, $reset, $them_hdd));						
		
		// Element: order
		$this->addElement('Hidden', 'order', array(
			'order' => 10004,
		));

		// Element: direction
		$this->addElement('Hidden', 'direction', array(
			'order' => 10005,
		));
	
        $this->addDisplayGroup(array('nam', 'ma_linh_vuc', 'loai_linh_vuc'),'group2',array(
            'order' => 0,
        	'decorators' => array(
                'FormElements',
				array('HtmlTag', array('tag' => 'tr','class' => 'group2')),
            ),
        ));
        
		$this->addDisplayGroup(array('tinh_trang', 'cap_quan_ly', 'expired'),'group3',array(
            'order' => 1,
        	'decorators' => array(
                'FormElements',
				array('HtmlTag', array('tag' => 'tr','class' => 'group3')),
            ),
        )); 
		
		$this->addDisplayGroup(array('ma_don_vi', 'bo_mon_id'),'group4',array(
            'order' => 2,
        	'decorators' => array(
                'FormElements',
				array('HtmlTag', array('tag' => 'tr','class' => 'group4')),
            ),
        )); 
        
        $this->addDisplayGroup(array('reset','them_hdd'),'group1',array(
            'order' => 3,
			'decorators' => array(
                'FormElements',
				array('HtmlTag', array('tag' => 'td','class' => 'group1','colspan' => 8)),
            ),
        ));
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'filter_dt')),
					'Form',
					));
    }
}
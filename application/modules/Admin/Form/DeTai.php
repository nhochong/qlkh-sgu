<?php
class Admin_Form_DeTai extends Zend_Form{
	
	/**
	 * After post, pre validation hook
	 * 
	 * Finds all fields where name includes 'newName' and uses addNewField to add
	 * them to the form object
	 * 
	 * @param array $data $_GET or $_POST
	 */
	public function preValidation(array $data) {
	 
	    // array_filter callback	  
		function findFields($field) {
		    // return field names that include 'don_vi_'
		    if (strpos($field, 'don_vi_') !== false) {
		      return $field;
		    }
	    }
	 
	    // Search $data for dynamically added fields using findFields callback
	    $newFields = array_filter(array_keys($data), 'findFields');
	    
	    //populate dang ky
	    $don_vi = new Default_Model_DonVi();
		$donVis = $don_vi->getDSDV();
		unset($donVis['1']);
		$dvOptions = array("multiOptions" => $donVis);
	    foreach ($newFields as $fieldName) {
		    // strip the id number off of the field name and use it to set new order
		    if(!$this->__isset($fieldName))
		    {
			    $id = ltrim($fieldName, 'don_vi_');
			    $order = $id + 6;
			    $this->addNewField($fieldName, $data, $order,$dvOptions,$id);
		    }
	    }
	}
	 
	/**
	 * Adds new fields to form
	 *
	 * @param string $name
	 * @param string $value
	 * @param int    $order
	 */
	public function addNewField($name, $data, $order,$option,$id) {

		//tạo 2 selectbox don_vi va thanh_vien
		$don_vi = new Zend_Form_Element_Select($name,$option);
		$don_vi->setValue($data[$name])
			   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
			   ->setAttribs(array('class' => 'text-input','id' => $name,'onchange' => 'change(this,' . $id . ')'));

		//tao selectnox thanh_vien dua vao value cua selectbox don_vi
		$giang_vien = new Default_Model_GiangVien();
		$gvOptions = array("multiOptions" => $giang_vien->getDSGVByDV($data[$name]));
		$thanh_vien = new Zend_Form_Element_Select('thanh_vien_' . $id,$gvOptions);
		$thanh_vien->setRequired(true)
			   	   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
			   	   ->setAttribs(array('class' => 'text-input','id' => 'thanh_vien_' . $id))
			   	   ->setRegisterInArrayValidator(false);

		//tranh truong hop invalidation
		if(isset($data['thanh_vien_' . $id]))	
			$thanh_vien->setValue($data['thanh_vien_' . $id]);   
				   
		//add vao form
		$this->addElements(array($don_vi,$thanh_vien));
		
		$this->addDisplayGroup(array($name,'thanh_vien_' . $id),'dk_tv_' . $id,array(
        	'order' => $order,
			'legend' => 'Thành viên',
        	'decorators' => array(
                 'FormElements',
				 'Fieldset',
        		 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'dk_tv_' . $id)),
            ),
        ));
	}
	
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');
        
		$this->addElement('Hidden', 'search', array(
			'value' => 1
		));
		
        $code = new Zend_Form_Element_Hidden('code');
        $code->setValue(0)
       		 ->setAttrib('id', 'code')
       		 ->removeDecorator('label');
        
        $ma = new Zend_Form_Element_Text('ma');       
        $ma->setLabel('Mã đề tài (*)')
           ->setDescription('vd : CS2000-01')
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addFilter('StringToUpper')
           ->addValidator(new Zend_Validate_StringLength(0, 15))
           ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
           						array('Description', array('tag' => 'small','style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input','id' => 'ma'))
			->setOrder(0);

		$ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên đề tài (*)')
            	->setRequired(true)
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
            	->addValidator('NotEmpty')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input large-input')
				->setOrder(1);
		
		$namOptions = array("multiOptions" => Default_Model_Constraints::nam());	
		$nam = new Zend_Form_Element_Select('nam',$namOptions);
		$nam->setRequired(true)
			->setLabel('Năm (*)')
			->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'nam'))
			->setOrder(2);
			
		$don_vi = new Default_Model_DonVi();
		$donVis = $don_vi->getDSDVSGU();
		unset($donVis['1']);
		$dvOptions = array("multiOptions" => $donVis);	
		$ma_don_vi = new Zend_Form_Element_Select('ma_don_vi',$dvOptions);
		$ma_don_vi->setRequired(true)
				  ->setLabel('Đơn vị (*)')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('class' => 'text-input','id' => 'ma_don_vi'))
				  ->setOrder(3);
				  
		$bmOptions = array("multiOptions" => Khcn_Api::_()->getDbTable('bo_mon', 'default')->getBoMonByDonViAssoc(2));					    
		$bo_mon_id = new Zend_Form_Element_Select('bo_mon_id',$bmOptions);
		$bo_mon_id->setLabel('Bộ môn')
				   ->setDecorators(array(
					 		    'ViewHelper',
				   				'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'id' => 'bo_mon_id-wrapper'))))
				   ->setAttribs(array('class' => 'text-input','id' => 'bo_mon_id'))
				   ->setRegisterInArrayValidator(false)
				   ->setOrder(4);
							    
		$giang_vien = new Default_Model_GiangVien();
		$gvOptions = array("multiOptions" => $giang_vien->getDSGVByDV(2));					    
		$chu_nhiem = new Zend_Form_Element_Select('chu_nhiem',$gvOptions);
		$chu_nhiem->setRequired(true)
				   ->setLabel('Chủ nhiệm (*)')
				   ->setDecorators(array(
					 		    'ViewHelper',
				   				'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				   ->setAttribs(array('class' => 'text-input','id' => 'chu_nhiem'))
				   ->setRegisterInArrayValidator(false)
				   ->setOrder(5);
							    
		$them_tv = new Zend_Form_Element_Button('them_tv');
        $them_tv->setLabel('Thêm thành viên')
        		->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			    ->setAttribs(array('class' => 'button'));
			    
		$xoa_tv = new Zend_Form_Element_Button('xoa_tv');
        $xoa_tv->setLabel('Xóa thành viên')
        		->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			    ->setAttribs(array('class' => 'button'));
			    
		$linh_vuc = new Default_Model_LinhVuc();
		$lvOptions = array("multiOptions" => $linh_vuc->getDSLV());	
		$ma_linh_vuc = new Zend_Form_Element_Select('ma_linh_vuc',$lvOptions);
		$ma_linh_vuc->setRequired(true)
				  ->setLabel('Lĩnh vực (*)')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setOrder(90);
							    
		$statusOptions = array("multiOptions" => Default_Model_Constraints::detai_tinhtrang());	
		$tinh_trang = new Zend_Form_Element_Select('tinh_trang',$statusOptions);
		$tinh_trang->setRequired(true)
				   ->setLabel('Tình trạng (*)')
				   ->setValue('0')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				   ->setOrder(91);
							    
		$thoi_gian_bat_dau = new Zend_Form_Element_Text('thoi_gian_bat_dau');       
        $thoi_gian_bat_dau->setLabel('Ngày bắt đầu (*)')
        				  ->setDescription('(YYYY-mm-dd)')
               	 	 	  ->setRequired(true)
               	 	 	  ->addFilter('StripTags')
                 	 	  ->addValidator('NotEmpty')
        		 	 	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	 	  		array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	 	  ->setAttribs(array('class' => 'text-input','id' => 'thoi_gian_bat_dau'))
				 	 	  ->setOrder(92);
				 
		$thoi_gian_hoan_thanh = new Zend_Form_Element_Text('thoi_gian_hoan_thanh');       
        $thoi_gian_hoan_thanh->setLabel('Ngày hoàn thành(*)')
        					 ->setDescription('(YYYY-mm-dd)')
        					 ->setRequired(true)
               	 	  		 ->addFilter('StripTags')
               	 	  		 ->addValidator('NotEmpty')
        		 	  		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	  		 	array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	  		 ->setAttribs(array('class' => 'text-input','id' => 'thoi_gian_hoan_thanh'))
				 	  		 ->setOrder(93);	  				
		
		$cqlOptions = array("multiOptions" => Default_Model_Constraints::detai_capquanly());	
		$cap_quan_ly = new Zend_Form_Element_Select('cap_quan_ly',$cqlOptions);
		$cap_quan_ly->setRequired(true)
				   	->setLabel('Cấp quản lý (*)')
				   	->setValue('2')
				   	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					->setOrder(94);
		
		$loai_dt = new Default_Model_LoaiDt();
		$ldtOptions = array("multiOptions" => $loai_dt->getDSLDT());	
		$ma_loai = new Zend_Form_Element_Select('ma_loai',$ldtOptions);
		$ma_loai->setLabel('Loại đề tài')
				->setValue('0')
				->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setOrder(95);
							    
		$stghOptions = array("multiOptions" => Default_Model_Constraints::detai_stgh());	
		$so_thang_gia_han = new Zend_Form_Element_Select('so_thang_gia_han',$stghOptions);
		$so_thang_gia_han->setLabel('Số tháng gia hạn')
				   		 ->setValue('0')
				   		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
						 ->setOrder(96);
						 
		$ngay_gia_han = new Zend_Form_Element_Text('ngay_gia_han');       
        $ngay_gia_han->setLabel('Ngày gia hạn')
        				  ->setDescription('(YYYY-mm-dd)')
        		 	 	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	 	  		array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	 	  ->setAttribs(array('class' => 'text-input','id' => 'ngay_gia_han'))
				 	 	  ->setOrder(97);
							    
		$kinh_phi = new Zend_Form_Element_Text('kinh_phi');       
        $kinh_phi->setLabel('Kinh phí')
        		 ->setDescription('(VNĐ)')
            	 ->addFilter('StringTrim')
        		 ->setDecorators(array(
							    'ViewHelper',
        		 				array('Description', array('tag' => 'small')),
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('class' => 'text-input','onkeypress' => 'return inputNumber(event)', 'onkeyup' => 'formatInt(this)'))
				->setOrder(98);
				
		$xlOptions = array("multiOptions" => Default_Model_Constraints::detai_xeploai());	
		$xep_loai = new Zend_Form_Element_Select('xep_loai',$xlOptions);
		$xep_loai->setLabel('Xếp loại')
				 ->setValue('0')
				 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setOrder(99);
				
		$file_tom_tat = new Zend_Form_Element_File('file_tom_tat');
		$file_tom_tat->setLabel('File Tóm Tắt')
				->setDescription('(*.doc, *.docx, *.pdf , < 10MB )')
				->setDestination(BASE_PATH . '/upload/files/de_tai')
				->addValidator(new Zend_Validate_File_Extension(array('doc,docx,pdf')))
				->addValidator(new Zend_Validate_File_FilesSize(array('min' => 1, 
            													   'max' => 10485760,
            													   'bytestring' => true)))
				->setDecorators(array(
							    'File',
							    'Errors',	
			 					array('Description', array('escape' => false, 'tag' => 'div', 'placement' => 'append')),		 					
							    array('HtmlTag', array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setOrder(100);
								
				
		$ghi_chu = new Zend_Form_Element_Textarea('ghi_chu');       
        $ghi_chu->setLabel('Ghi chú')
	            ->addFilter('StripTags')
               	->addFilter('StringTrim')
	        	->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'ghi_chu','class' => 'textarea','rows' => '4'))
				->setOrder(101);
	
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
			   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 
					
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'de-tai','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($code, $ma, $ten, $nam, $ma_don_vi, $bo_mon_id, $chu_nhiem, $them_tv, $xoa_tv, $ma_linh_vuc, $tinh_trang, $thoi_gian_bat_dau, $thoi_gian_hoan_thanh, $cap_quan_ly, $ma_loai, $so_thang_gia_han, $ngay_gia_han, $kinh_phi, $xep_loai, $file_tom_tat, $ghi_chu, $submitCon, $submitExit, $cancel));						

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
            'order' => 102,
			'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn')),
            ),
        ));

        $this->addDisplayGroup(array('them_tv','xoa_tv'),'dang_ky',array(
        	'order' => 89,
        	'decorators' => array(
                 'FormElements',
        		 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn_dk')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
        			'Fieldset',
					array('HtmlTag', array('tag' => 'table','class' => 'de_tai')),
					'Form',
					));
    }
}
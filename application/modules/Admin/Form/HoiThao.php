<?php
class Admin_Form_HoiThao extends Zend_Form{
	public function init()
    {  	
        $this->setName('f2')
        	 ->setAttrib('enctype', 'multipart/form-data');
        
		$this->addElement('Hidden', 'search', array(
			'value' => 1
		));
		
        $chu_de = new Zend_Form_Element_Text('chu_de');       
        $chu_de->setLabel('Chủ đề (*)')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
        	   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			   ->setAttrib('class', 'text-input large-input');
			   
		$managementOptions = array("multiOptions" => Default_Model_Constraints::hoithao_capquanly());
		$cap_quan_ly = new Zend_Form_Element_Radio('cap_quan_ly',$managementOptions);
		$cap_quan_ly->setRequired(true)
				    ->setLabel('Quy mô (*)')
				    ->setValue(1)
				    ->setSeparator('')
				    ->setDecorators(array(
							    'ViewHelper',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','class' => 'cap_ql')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
		
		$so_luong_dai_bieu = new Zend_Form_Element_Text('so_luong_dai_bieu');       
        $so_luong_dai_bieu->setLabel('Số lượng đại biểu')
						   ->setDecorators(array(
											'ViewHelper',
											'Errors',
											array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
											array('Label', array('tag' => 'td')),
											array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
						   ->setAttrib('class', 'text-input');
						   
		$dia_diem = new Zend_Form_Element_Text('dia_diem');       
        $dia_diem->setLabel('Địa điểm')
						   ->setDecorators(array(
											'ViewHelper',
											'Errors',
											array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
											array('Label', array('tag' => 'td')),
											array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
						   ->setAttrib('class', 'text-input medium-input');
			   
		$don_vi = new Default_Model_DonVi();
		$dvptOptions = array("multiOptions" => $don_vi->getDSDVSGU());	
		$don_vi_id = new Zend_Form_Element_Select('don_vi_id',$dvptOptions);
		$don_vi_id->setRequired(true)
				   		 ->setLabel('Đơn vị quản lý (*)')
				   		 ->setValue('1')
				   		 ->setSeparator('')
				   		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
								
		$don_vi_phu_trach = new Zend_Form_Element_Text('don_vi_phu_trach');       
        $don_vi_phu_trach->setLabel('Đơn vị phụ trách')
						->addFilter('StripTags')
						->addFilter('StringTrim')
						->setDecorators(array(
										'ViewHelper',
										'Errors',
										array(array('data' => 'HtmlTag'), array('tag' => 'td')),
										array('Label', array('tag' => 'td')),
										array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
						->setAttrib('class', 'text-input large-input');
							    
		$ngay_to_chuc = new Zend_Form_Element_Text('ngay_to_chuc');       
        $ngay_to_chuc->setRequired(true)
        			 ->setLabel('Ngày tổ chức')
        				  ->setDescription('(dd-mm-YYYY)')
	        		 	  ->setDecorators(array(
								    'ViewHelper',
								    'Errors',
	        		 	  			array('Description', array('tag' => 'span')),
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
					 	  ->setAttribs(array('class' => 'text-input','id' => 'ngay_to_chuc'));	   
							    
		$statusOptions = array("multiOptions" => Default_Model_Constraints::trang_thai());	
		$trang_thai = new Zend_Form_Element_Radio('trang_thai',$statusOptions);
		$trang_thai->setRequired(true)
				   ->setLabel('Trạng thái')
				   ->setValue('1')
				   ->setSeparator('')
				   ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr', 'class' => 'trang_thai'))));
							    
		$anh_trang_bia = new Zend_Form_Element_File('file_anh_trang_bia');
		$anh_trang_bia->setLabel('Upload ảnh trang bìa')
			 		  ->setDescription('(*.jgp, *.gif, *.png , < 10MB )')
			 		  ->setDestination(BASE_PATH . '/upload/images/hoi_thao/')
			 		  ->addValidator(new Zend_Validate_File_Extension(array('jpg,gif,png')))
			 		  ->addValidator(new Zend_Validate_File_FilesSize(array('min' => 1, 
		            													    'max' => 10485760,
		            													    'bytestring' => true)))
			 		  ->setDecorators(array(
									    'File',
									    'Errors',	
					 					array('Description', array('escape' => false, 'tag' => 'div', 'placement' => 'append')),		 					
									    array('HtmlTag', array('tag' => 'td')),
									    array('Label', array('tag' => 'td')),
									    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));	
									    
		$thong_cao_bao_chi = new Zend_Form_Element_File('file_thong_cao_bao_chi');
		$thong_cao_bao_chi->setLabel('Thông cáo báo chí')
			 			  ->setDescription('(*.doc, *.docx, *.pdf , < 10MB )')
						  ->setDestination(BASE_PATH . '/upload/files/hoi_thao/')
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
										    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));
							    					      
	    $image = new Zend_Form_Element_Image('image');
	    $image->setLabel('')
	    	  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))));

		$mo_ta = new Zend_Form_Element_Textarea('mo_ta');       
        $mo_ta->setLabel('Nội dung')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'mo_ta','class' => 'text-input textarea'));
				
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setLabel('Lưu và tiếp tục')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
			   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setLabel('Lưu và thoát')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 

	    $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'hoi-thao','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($chu_de, $don_vi_id, $don_vi_phu_trach, $ngay_to_chuc, $cap_quan_ly, $so_luong_dai_bieu, $dia_diem, $anh_trang_bia, $image, $thong_cao_bao_chi, $mo_ta, $trang_thai, $submitCon, $submitExit, $cancel));						

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'hoi_thao')),
					'Form',
					));
    }
}
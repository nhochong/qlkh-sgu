<?php
class Admin_Form_BaiBao_Create extends Zend_Form{
	
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
		$donVis = Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc(array('thuoc_sgu', true));
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
		$gvOptions = array("multiOptions" => Khcn_Api::_()->getDbTable('giang_vien', 'default')->getGiangViensByDonViAssoc($data[$name]));
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
        	 ->setAttrib('enctype', 'multipart/form-data')
			 ->setAttrib('class', 'form_create_bai_bao');
        
		$this->addElement('Hidden', 'search', array(
			'value' => 1
		));
		
		$code = new Zend_Form_Element_Hidden('code');
        $code->setValue(0)
       		 ->setAttrib('id', 'code')
       		 ->removeDecorator('label');
			 
		$donVis = Khcn_Api::_()->getDbTable('don_vi', 'default')->getDonVisAssoc();
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
				  ->setOrder(1);
		
		// Tac gia
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

		// Ten san pham khoa hoc
		$ten = new Zend_Form_Element_Text('ten');       
        $ten->setLabel('Tên sản phẩm (*)')
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
				->setOrder(90);
		
		$thong_tin = new Zend_Form_Element_Textarea('thong_tin');       
        $thong_tin->setLabel('Thông tin')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'thong_tin','class' => 'text-input textarea'))
				->setOrder(91);
				
		$noi_dang = new Zend_Form_Element_Text('noi_dang');       
        $noi_dang->setLabel('Nơi đăng')
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input')
				->setOrder(92);
		
		$ngay_dang = new Zend_Form_Element_Text('ngay_dang');       
        $ngay_dang->setLabel('Ngày đăng')
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
				 	 	  ->setAttribs(array('class' => 'text-input','id' => 'ngay_dang'))
				 	 	  ->setOrder(93);
						  
		$so = new Zend_Form_Element_Text('so');       
        $so->setLabel('Số')
               	 	  		 ->addFilter('StripTags')
        		 	  		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        		 	  		 	array('Description', array('tag' => 'span')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				 	  		 ->setAttribs(array('class' => 'text-input'))
				 	  		 ->setOrder(94);	  				
		
		$chi_so = new Zend_Form_Element_Text('chi_so');       
        $chi_so->setLabel('Chỉ số')
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input')
				->setOrder(95);
						 
		$diem_cong_trinh = new Zend_Form_Element_Text('diem_cong_trinh');       
        $diem_cong_trinh->setLabel('Điểm công trình')
            	->addFilter('StripTags')
            	->addFilter('StringTrim')
        		->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttrib('class', 'text-input')
				->setOrder(96);
	
		$file = new Zend_Form_Element_File('file');
		$file->setLabel('Upload file')
			 ->setDescription('(*.doc, *.docx, *.pdf , < 10MB )')
			 ->setDestination(BASE_PATH . '/upload/files/bai_bao')
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
			->setOrder(97);
								
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
		$link = $url->url(array('module' => 'admin','controller' => 'bai-bao','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));

		$this->addElements(array($code, $ma_don_vi, $them_tv, $xoa_tv, $ten, $thong_tin, $noi_dang, $ngay_dang, $so, $chi_so, $diem_cong_trinh, $file, $submitCon, $submitExit, $cancel));						

		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
            'order' => 100,
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
					array('HtmlTag', array('tag' => 'table','class' => 'bai_bao')),
					'Form',
					));
    }
}
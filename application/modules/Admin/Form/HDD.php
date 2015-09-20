<?php
class Admin_Form_HDD extends Zend_Form{
	
	public function preValidation(array $data) {
	 
	    // array_filter callback	  
		function findFields($field) {
		    // return field names that include 'don_vi_'
		    if (strpos($field, 'don_vi_') !== false) {
		      return $field;
		    }
	    }
	 
	    // Search $data for dynamically added fields using findFields callback
	    $updateFields = array_filter(array_keys($data), 'findFields');
	    
	    //populate dang ky
	    foreach ($updateFields as $fieldName) {
		    // strip the id number off of the field name and use it to set new order
		    $id = ltrim($fieldName, 'don_vi_');
		    $this->updateField($fieldName, $data,$id);
	    }
	}
	
	public function updateField($name, $data, $id) {

		//tao selectnox thanh_vien dua vao value cua selectbox don_vi
		$tv = 'thanh_vien_' . $id;
		$giang_vien = new Default_Model_GiangVien();
		if($data[$name] != '0')
			$gvOptions = $giang_vien->getDSGVByDV($data[$name]);
		else 
			$gvOptions = array('0' => '===== Chọn giảng viên =====');
		$this->$tv->addMultiOptions($gvOptions);

		//tranh truong hop invalidation
		if(isset($data[$tv]))	
			$this->$tv->setValue($data[$tv]);   
	}
	
	public function init()
    {  	
        $this->setName('f2')
        	 ->setMethod('post');

       	$id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int')
           ->setAttribs(array('id' => 'id'));;
        $this->addElement($id);
        
        $code = new Zend_Form_Element_Hidden('code');
        $code->setValue(6)
       		 ->setAttrib('id', 'code')
       		 ->removeDecorator('label');
       	$this->addElement($code);
       	
        $ma = new Zend_Form_Element_Text('ma');       
        $ma->setLabel('Mã hội đồng (*)')
        	->setDescription('vd : HDD2000-01')
            ->setOrder(1)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addFilter('StringToUpper')
            ->addValidator(new Zend_Validate_StringLength(0, 15))
        	->setDecorators(array(
							    'ViewHelper',
							    'Errors',
        						array('Description', array('tag' => 'small','style' => 'display : block')),
							    array(array('data' => 'HtmlTag'), array('tag' => 'td','style' => 'width: 85%')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('class' => 'text-input'));
		$this->addElement($ma);
			
        $ngay_thanh_lap = new Zend_Form_Element_Text('ngay_thanh_lap');       
        $ngay_thanh_lap->setLabel('Ngày thành lập (*)')
        			   ->setDescription('(dd-mm-YYYY)')
        			   ->setOrder(2)
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
				 	   ->setAttribs(array('class' => 'text-input','id' => 'ngay_thanh_lap'));
		$this->addElement($ngay_thanh_lap);
				 	  
		$ghi_chu = new Zend_Form_Element_Text('ghi_chu');       
        $ghi_chu->setLabel('Ghi chú')
        		->setOrder(3)
	            ->addFilter('StripTags')
	            ->addFilter('StringTrim')
	        	->setDecorators(array(
								    'ViewHelper',
								    'Errors',
								    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
								    array('Label', array('tag' => 'td')),
								    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('class' => 'text-input medium-input'));
		$this->addElement($ghi_chu);	
		//dang ky thanh vien hoi dong
		
		//danh sach don vi
		$don_vi = new Default_Model_DonVi();
		$donVis = $don_vi->getDSDV();
		$donVis = array('' => '============= Chọn đơn vị =============') + $donVis;
		$dvOptions = array("multiOptions" => $donVis);
		
		//danh sach giang vien
		$giangViens = array();
		$giangViens[0] = '===== Chọn giảng viên =====';
		$gvOptions = array("multiOptions" => $giangViens);
		/*
		 *	0 	 : chủ tịch
		 *	1->4 : ủy viên
		 *	5	 : thư ký
		 */
		for($i = 0 ; $i<=5 ; $i++)
		{			
			$dv = new Zend_Form_Element_Select('don_vi_' . $i,$dvOptions);
			$dv->setValue(0)
			   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
			   ->setAttribs(array('id' => 'don_vi_' . $i,'onchange' => 'change(this,' . $i . ')'));
		
			$gv = new Zend_Form_Element_Select('thanh_vien_' . $i,$gvOptions);
			$gv->setRequired(true)
			   ->setDecorators(Khcn_Form_Decorator_Select::getDecorator())
		   	   ->setAttribs(array('id' => 'thanh_vien_' . $i))
		   	   ->setRegisterInArrayValidator(false);
		   	   
		   	$this->addElements(array($dv,$gv));
		   	
		   	$this->addDisplayGroup(array('don_vi_' . $i,'thanh_vien_' . $i),'dk_tvhd_' . $i,array(
	        	'order' => $i + 4,
	        	'decorators' => array(
	                 'FormElements',
					 'Fieldset',
					 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
					 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
					 array('HtmlTag', array('tag' => 'tr', 'id' => 'dk_tvhd_' . $i)),
	            ),
	        ));
	        $decorator = $this->getDisplayGroup('dk_tvhd_' . $i);
	        if($i == 0)
	        	$decorator->setLegend('Chủ tịch (*)');
	        else if($i == 5)
	        	$decorator->setLegend('Thư ký (*)');
	        else 	
	        	$decorator->setLegend('Ủy viên ' . $i . ' (*)');
		}
				        
		$linh_vuc = new Default_Model_LinhVuc();
		$lvOptions = array("multiOptions" => $linh_vuc->getDSLV());	
		$ma_linh_vuc = new Zend_Form_Element_Select('ma_linh_vuc',$lvOptions);
		$ma_linh_vuc->setRequired(true)
				    ->setLabel('Lĩnh vực')
				    ->setOrder(11)
				    ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				    ->setAttribs(array('id' => 'ma_linh_vuc'));
		$this->addElement($ma_linh_vuc);
		
		$namOptions = array("multiOptions" => Default_Model_Constraints::nam());	
		$nam = new Zend_Form_Element_Select('nam',$namOptions);
		$nam->setRequired(true)
			->setLabel('Năm')
			->setOrder(12)
			->setValue(date('Y'))
			->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
			->setAttribs(array('id' => 'nam'));
		$this->addElement($nam);
							    
		$dsdt = new Zend_Form_Element_Button('dsdt');
        $dsdt->setLabel('Danh sách đề tài')
        	 ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			 ->setAttribs(array('class' => 'button','id' => 'dsdt'));
		$this->addElement($dsdt);
			    
		$loc = new Zend_Form_Element_Button('loc');
        $loc->setLabel('Lọc')
            ->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','id' => 'loc'));
		$this->addElement($loc);
			    
		$submitCon = new Zend_Form_Element_Submit('submitCon');
        $submitCon->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	  ->setAttribs(array('class' => 'button'));
		$this->addElement($submitCon);
			   
		$submitExit = new Zend_Form_Element_Submit('submitExit');		
        $submitExit->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button'));
		$this->addElement($submitExit);

		$link = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('module' => 'admin','controller' => 'hoi-dong','action' => 'danh-sach-hdd'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
		$this->addElement($cancel);

		$this->addDisplayGroup(array('dsdt','loc'),'function',array(
			'order' => 13,
        	'decorators' => array(
                 'FormElements',
        		 array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
				 array('HtmlTag', array('tag' => 'tr', 'id' => 'btn_function')),
            ),
        ));
        
		$this->addDisplayGroup(array('submitCon','submitExit','cancel'),'submit',array(
			'order' => 14,
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
            ),
        )); 
        
         
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table','class' => 'hdd')),
					'Form',
					));
					
    }
}
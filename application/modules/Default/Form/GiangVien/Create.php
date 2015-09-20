<?php
class Default_Form_GiangVien_Create extends Khcn_Form
{
	public function init()
    {  	
        $this->setName('form_giang_vien_create')
			 ->setMethod('post')
			 ->setAttrib('class', 'global_form form_giang_vien_create');
        	 
		$this->addElement('Heading', 'account', array(
			'value' => 'Thông tin giảng viên',
		));
		$this->account->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
			
		$this->addElement('Text', 'ma', array(
			'label' => 'Mã giảng viên (*)',
			'allowEmpty' => false,
			'required' => true,
			'filters' => array(
				'StripTags',
			),
			'validators' => array(
				array('StringLength', false, array(5, 10)),
				'Alnum'
			),
		));
		
		$this->addElement('Heading', 'ma_giang_vien', array(
			'label' => 'Mã giảng viên',
		));
		
		$ho = new Khcn_Form_Element_Text('ho');
        $ho->setLabel('Họ (*)')
           ->setOptions(array('size' => '36'))  
           ->setRequired(true)             
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addValidator('NotEmpty')
           ->addValidator(new Zend_Validate_StringLength(0, 128))
		   ->setAttribs(array('id' => 'ho'));             
        $this->addElement($ho);
		
		$ten = new Khcn_Form_Element_Text('ten');
        $ten->setLabel('Tên (*)')
        	->setOptions(array('size' => '36'))  
            ->setRequired(true)              
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->addValidator(new Zend_Validate_StringLength(0, 32))
			->setAttribs(array('id' => 'ten'));               
        $this->addElement($ten);
		
        $email = new Khcn_Form_Element_Text('email');
        $email->setLabel('Email (*)')
              ->setRequired(true)
              ->setOptions(array('size' => '36'))              
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator(new Zend_Validate_EmailAddress())
			  ->setAttribs(array('id' => 'email'));  
		$this->addElement($email);
		
		$don_vi = new Default_Model_DonVi();
		$this->addElement('Select', 'ma_don_vi', array(
			'label' => 'Đơn vị (*)',
			'multiOptions' => $don_vi->getDSDVSGU(),
			'value' => 1
		));
		
		$hoc_vi = new Default_Model_HocVi();
		$this->addElement('Select', 'ma_hoc_vi', array(
			'label' => 'Học vị (*)',
			'multiOptions' => $hoc_vi->getDSHV()
		));
		
		$this->addElement('Text', 'chuc_vu', array(
			'label' => 'Chức vụ',
			'filters' => array(
				'StripTags',
			),
		));
		
		$this->addElement('Text', 'so_dien_thoai', array(
			'label' => 'Số điện thoại',
			'filters' => array(
				'StripTags',
			),
		));		
		
		$this->addElement('Button', 'submit', array(
		  'label' => 'Lưu',
		  'type' => 'submit',
		  'ignore' => true,
		  'decorators' => array('ViewHelper',),
		  'attribs' => array('class' => 'art-button')
		));
		
		$url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'default','controller' => 'index','action' => 'index'));		
		$this->addElement('Cancel', 'cancel', array(
		  'label' => 'Không lưu',
		  'onclick' => 'window.location.href="' . $link . '"',
		  'decorators' => array(
			'ViewHelper',
		  ),
		  'attribs' => array('class' => 'art-button')
		));
		
		$this->addDisplayGroup(array('submit','cancel'),'submitbtn'); 
    }
	
	public function isValid($values){
		$valid = parent::isValid($values);
		if($valid && isset($values['ma']) && !empty($values['ma']) ) {
			if( empty($values['ma']) ) {
				$this->addError("Vui lòng nhập mã giảng viên");
				return false;
			}
			
			$nguoi_dung = Khcn_Api::_()->getDbTable('nguoi_dung', 'default');
			if($nguoi_dung->getNguoiDungByMaGiangVien($values['ma'])){
				$this->addError("Mã giảng viên đã được đăng ký. Vui lòng kiểm tra lại");
				return false;
			}
		}
		return $valid;
	}
}

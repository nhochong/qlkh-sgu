<?php
class Admin_Form_GopY_Filter extends Zend_Form{
	public function init()
    {  	
        $this->setMethod('get');
		$this->setAttrib('class', 'form_filter_gop_y');     
		
		$loaiOptions = array('' => '== Tất cả ==') + Khcn_Api::_()->getDbTable('loai_gy', 'default')->getLoaiGYAssoc();		
		$loaiOptions = array("multiOptions" => $loaiOptions);
		$loai_id = new Zend_Form_Element_Select('loai_id',$loaiOptions);
		$loai_id->setRequired(true)
				  ->setLabel('Loại')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'div')),
								array('Label', array('tag' => 'span', 'class' => 'loai_id')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'id' => 'loai_id-wrapper'))))
				  ->setAttribs(array('id' => 'loai_id','onchange' => 'this.form.submit()'));
		$this->addElement($loai_id);
		
		$tinhTrangOptions = array(
			'' => '== Tất cả ==',
			'initial' => 'Mới',
			'pending' => 'Đang kiểm tra',
			'failure' => 'Hủy bỏ',
			'completed' => 'Hoàn thành'
		);
		$ttOptions = array("multiOptions" => $tinhTrangOptions);	
		$tinh_trang = new Zend_Form_Element_Select('tinh_trang',$ttOptions);
		$tinh_trang->setRequired(true)
				  ->setLabel('Tình Trạng')
				  ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'div')),
							    array('Label', array('tag' => 'span', 'class' => 'tinh_trang')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'id' => 'tinh_trang-wrapper'))))
				  ->setAttribs(array('id' => 'tinh_trang','onchange' => 'this.form.submit()'));
		$this->addElement($tinh_trang);
		
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'div','class' => 'filter_hop_thu')),
					'Form',
					));
    }
}
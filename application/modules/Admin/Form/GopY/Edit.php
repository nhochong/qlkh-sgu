<?php
class Admin_Form_GopY_Edit extends Zend_Form{

	public function init()
    {  	
        $this->setAttrib('class', 'form_gop_y_edit');       
        
		$tinhTrangOptions = array(
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
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				  ->setAttribs(array('class' => 'text-input','id' => 'tinh_trang'));
							    				    
		$ghi_chu = new Zend_Form_Element_Textarea('ghi_chu');       
        $ghi_chu->setLabel('Ghi chú')
        		 ->setDecorators(array(
							    'ViewHelper',
							    'Errors',
							    array(array('data' => 'HtmlTag'), array('tag' => 'td')),
							    array('Label', array('tag' => 'td')),
							    array(array('row' => 'HtmlTag'), array('tag' => 'tr'))))
				->setAttribs(array('id' => 'ghi_chu','class' => 'text-input textarea'));
				
		$submit = new Zend_Form_Element_Submit('submit');		
        $submit->setLabel('Lưu')
					->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			   	   ->setAttribs(array('class' => 'button')); 

	    $url = new Zend_View_Helper_Url();
		$link = $url->url(array('module' => 'admin','controller' => 'gop-y','action' => 'index'),null,true);
		$cancel = new Zend_Form_Element_Button('cancel');
        $cancel->setLabel('Không lưu')
				->setDecorators(array(
							        'ViewHelper',
							        array(array('data' => 'HtmlTag'), array('tag' => 'span')),
							        array(array('row' => 'HtmlTag'), array('tag' => 'span')),
							    ))
			->setAttribs(array('class' => 'button','onclick' => 'window.location.href="' . $link . '"'));
			   
		$this->addElements(array($tinh_trang, $ghi_chu, $submit, $cancel));						

		$this->addDisplayGroup(array('submit', 'cancel'),'submitbtn',array(
            'decorators' => array(
                'FormElements',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => 2)),
				 array(array('row' => 'HtmlTag'), array('tag' => 'td')),
            ),
        )); 
        
        $this->setDecorators(array(
					'FormElements',
					array('HtmlTag', array('tag' => 'table')),
					'Form',
					));
    }
}
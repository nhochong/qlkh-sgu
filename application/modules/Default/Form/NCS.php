<?php
class Default_Form_NCS extends Khcn_Form
{
	public function init()
    {  	
        $this->setName('form_giang_vien_ncs')
			 ->setMethod('post')
			 ->setAttrib('class', 'global_form');
        	 
		$this->addElement('Heading', 'account', array(
			'value' => 'Thông tin cá nhân',
		));
		$this->account->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
			
		$viewer = Khcn_Api::_()->getViewer();
		
		$this->addElement('Text', 'ho_ten', array(
			'label' => 'Họ và tên (*)',
			'allowEmpty' => false,
			'required' => true,
			'filters' => array(
				'StripTags',
			),
			'value' => $viewer->getDisplayname()
		));
		
		$this->addElement('Calendar', 'ngay_sinh', array(
			'label' => 'Ngày tháng năm sinh'
		));		
		
		$don_vi = new Default_Model_DonVi();
		$this->addElement('Select', 'ma_don_vi', array(
			'label' => 'Đơn vị công tác(*)',
			'multiOptions' => $don_vi->getDSDVSGU(),
			'value' => 1
		));
		
		$this->addElement('Text', 'ten_luan_an', array(
			'label' => 'Tên luận án *',
			'allowEmpty' => false,
			'required' => true,
			'filters' => array(
				'StripTags',
			),
		));
		
		$this->addElement('Text', 'chuyen_nganh_dao_tao', array(
			'label' => 'Chuyên ngành đào tạo',
		));
		
		$this->addElement('Text', 'co_so_dao_tao', array(
			'label' => 'Cơ sở đào tạo',
		));
		
		$this->addElement('Heading', 'thoi_gian_dao_tao', array(
			'label' => 'Thời gian đào tạo',
		));
		
		$this->addElement('Calendar', 'tgdt_from', array(
			'label' => 'Từ',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			)
		));
		
		$this->addElement('Calendar', 'tgdt_to', array(
			'label' => 'Đến',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			)
		));
		
		$this->addElement('Heading', 'qd_ncs', array(
			'value' => 'Quyết định công nhận Nghiên cứu sinh',
		));
		$this->qd_ncs->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
		
		$this->addElement('Text', 'ncs_so', array(
			'label' => 'Số',
		));	
		
		$this->addElement('Calendar', 'ngay_ky', array(
			'label' => 'Ký ngày',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			)
		));
		
		$this->addElement('Text', 'nguoi_ky', array(
			'label' => 'Người ký',
		));
		
		$this->addElement('Heading', 'ke_hoach_bao_ve_chuyen_de', array(
			'value' => 'Kế hoạch bảo vệ chuyên đề',
		));
		$this->ke_hoach_bao_ve_chuyen_de->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
		
		$this->addElement('Heading', 'chuyen_de_1', array(
			'label' => 'Chuyên đề 1',
		));
		
		$this->addElement('Calendar', 'thoi_gian_chuyen_de_1', array(
			'label' => 'Thời gian',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			),
			'attribs' => array('name' => 'thoi_gian_chuyen_de[]')
		));
		
		$this->addElement('Text', 'ten_chuyen_de_1', array(
			'label' => 'Tên chuyên đề',
			'attribs' => array('name' => 'ten_chuyen_de[]')
		));
		
		$this->addElement('Hidden', 'tong_chuyen_de', array(
			'value' => 1
		));
		
		$this->addElement('Dummy', 'them_chuyen_de', array(
			'content' => '<a href="javascript:void(0)" onclick="themChuyenDe()" id="them_chuyen_de">Thêm chuyên đề</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="xoaChuyenDe()" id="xoa_chuyen_de" style="display: none;">Xóa chuyên đề</a>',
		));
		
		$this->addElement('Heading', 'ke_hoach_bao_ve_luan_an', array(
			'value' => 'Kế hoạch bảo vệ luận án',
		));
		$this->ke_hoach_bao_ve_luan_an->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
		
		$this->addElement('Dummy', 'bvla_cap_bo_mon', array(
			'content' => 'Dự kiến kế hoạch bảo về luận án cấp bộ môn'
		));
		
		$this->addElement('Calendar', 'thoi_gian_bvla_cap_bo_mon', array(
			'label' => 'Thời gian',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			)
		));
		
		$this->addElement('Text', 'dia_diem_bvla_cap_bo_mon', array(
			'label' => 'Địa điểm',
		));

		$this->addElement('Dummy', 'bvla_cap_truong', array(
			'content' => 'Dự kiến kế hoạch bảo về luận án cấp trường'
		));
		
		$this->addElement('Calendar', 'thoi_gian_bvla_cap_truong', array(
			'label' => 'Thời gian',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			)
		));
		
		$this->addElement('Text', 'dia_diem_bvla_cap_truong', array(
			'label' => 'Địa điểm',
		));		
		
		$this->addElement('Heading', 'bai_bao_ctkh', array(
			'value' => 'Bài báo/công trình khoa học đã công bố',
		));
		$this->bai_bao_ctkh->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
			
		$this->addElement('Text', 'ten_san_pham', array(
			'label' => 'Tên sản phẩm',
		));
		
		$this->addElement('Textarea', 'phuong_thuc_pho_bien', array(
			'label' => 'Phương thức phổ biến',
		));
		
		$this->addElement('Dummy', 'phuong_thuc_pho_bien_luu_y', array(
			'content' => '*Lưu ý: 	</br>- Đối với Tạp chí cần nêu rõ xếp loại tạp chí (SCI, SCIE…); Số kỳ, thời gian phát hành…
									</br>- Đối với Kỷ yếu Hội thảo cần nêu rõ: Quy mô của Hội thảo; Hình thức phát hành kỷ yếu (Bài viết có phản biện…), có báo cáo tại Hội thảo hay không?
',
		));
		
		$this->addElement('Heading', 'ket_qua_bao_ve_luan_an', array(
			'value' => 'Kết quả bảo vệ luận văn/luận án',
		));
		$this->ket_qua_bao_ve_luan_an->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
		
		$this->addElement('Calendar', 'thoi_gian_bao_ve', array(
			'label' => 'Thời gian',
			'calendarOptions' => array(
				'yearRangeCount' => 10
			)
		));
		
		$this->addElement('Text', 'dia_diem_bao_ve', array(
			'label' => 'Địa điểm',
		));

		$this->addElement('Text', 'ket_qua_bao_ve', array(
			'label' => 'Kết quả',
		));			
		
		$this->addElement('Dummy', 'ho_so_nop_cho_phong_qlkhsdh', array(
			'content' => "<strong>Hồ sơ nộp cho Phòng QLKH-SĐH:</strong></br>
			- Văn bản luận án đóng thành tập: 1 cuốn;</br>
			- Đĩa CD chứa nội dung luận án: 1 đĩa;</br>
			- Văn bản liên quan:</br>
			<span style='margin-left: 20px'>+ Quyết định bảo vệ của cơ sở đào tạo;</span></br>
			<span style='margin-left: 20px'>+ Giấy chứng nhận đã bảo về luận án.</span>"
		));
		
		$this->addElement('Heading', 'y_kien_ncs_heading', array(
			'value' => 'Các ý kiến của Nghiên cứu sinh (nếu có)',
		));
		$this->y_kien_ncs_heading->removeDecorator('Label')
			->removeDecorator('HtmlTag')
			->getDecorator('HtmlTag2')->setOption('class', 'form-wrapper-heading');
		
		$this->addElement('Textarea', 'y_kien_ncs', array(
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
	
	/*public function isValid($values){
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
	}*/
}

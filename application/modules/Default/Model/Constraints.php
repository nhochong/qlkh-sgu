<?php
class Default_Model_Constraints {
	
	const ID_DHSG = 1;
	
	public static function detai_tinhtrang(){
		return array(
			'1' => 'Chưa duyệt',
			'2' => 'Không duyệt',
			'3' => 'Đã duyệt đang thực hiện',
			'4' => 'Đã nghiệm thu',
			'5' => 'Không được nghiệm thu',
			'6' => 'Hủy đề tài'
		);
	}
	
	public static function detai_capquanly(){
		return array(
			'1' => 'Cấp khoa',
			'2' => 'Cấp trường',
			'3' => 'Các cấp ngoài trường',
		);
	}
	
	public static function detai_stgh(){
		$data = array();
		for($i = 0 ; $i<=12 ; $i++)
		{
			$data[$i] = $i;
		}		
		return $data;
	}
	
	public static function detai_xeploai(){
		return array(
			'0' => '',
			'1' => 'Trung bình',
			'5' => 'Trung bình Khá',
			'2' => 'Khá',
			'3' => 'Tốt',
			'4' => 'Xuất sắc',
			'6' => 'Không đạt'
		);
	}
	
	public static function hoithao_capquanly(){
		/*return array('0' => 'Toàn quốc',
					 '1' => 'Quốc tế',
					 '2' => 'Cấp trường',
					 '3' => 'Cấp khoa'
					);*/
		return array(
			'1' => 'Quốc tế',
			'2' => 'Quốc gia',
			'3' => 'Thành phố',
			'4' => 'Cấp Trường',
			'5' => 'Cấp khoa'
		);
	}
	
	public static function quidinh_loai(){
		return array(
			'1' => 'Nghiên cứu khoa học',
			/*'2' => 'Đào tạo sau đại học',*/
		);
	}
	
	public static function thongbao_loai(){
		return array(
			'1' => 'Nghiên cứu khoa học',
			'2' => 'Hội nghị - Hội thảo',
			'3' => 'Tuyển sinh',
			'4' => 'Lịch học'
		);
	}
	
	public static function dangky_nhiemvu(){
		return array(
			'1' => 'Chủ nhiệm',
			'0' => 'Thành viên',
		);
	}
	
	public static function lct_thu(){
		return array(
			'1' => '2',
			'2' => '3',
			'3' => '4',
			'4' => '5',
			'5' => '6',
			'6' => '7',
			'7' => 'CN'
		);
	} 
	
	public static function lichct_thang()
	{
		return array(
			'1' => '01',
			'2' => '02',
			'3' => '03',
			'4' => '04',
			'5' => '05',
			'6' => '06',
			'7' => '07',
			'8' => '08',
			'9' => '09',
			'10' => '10',
			'11' => '11',
			'12' => '12',
		);
	}
	
	public static function lichct_tuan()
	{
		return array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5'
		);
	}
	
	public static function trang_thai()
	{
		return array(
			'1' => 'Hiển thị',
			'0' => 'Không hiển thị'
		);
	}
	
	public static function search_cate()
	{
		return array(
			'0' => 'Đề tài khoa học',
			'1' => 'Tin tức - sự kiện',
			'2' => 'Thông báo',
			'3' => 'Hội thảo - Hội nghị'
		);
	}
	
	public static function pcnt_chuc_danh()
	{
		return array(
			'0' => 'Chủ tịch',
			'1' => 'Phản biện 1',
			'2' => 'Phản biện 2',
			'3' => 'Ủy viên',
			'4' => 'Ủy viên - Thư ký',
		);
	}
	
	public static function pcd_chuc_danh()
	{
		return array(
			'0' => 'Chủ tịch hội đồng',
			'1' => 'Ủy viên',
			'2' => 'Thư ký',
		);
	}
	
	public static function nam()
	{
		$result = array();
		$current_year = date('Y');
		for($i = ($current_year - 20) ; $i< ($current_year + 20) ; $i++)
			$result[$i] = $i . '-' . ($i + 1);
		return $result;
	}
	
	public static function years()
	{
		$result = array();
		$current_year = date('Y');
		for($i = ($current_year - 20) ; $i< ($current_year + 20) ; $i++)
			$result[$i] = $i;
		return $result;
	}
	
	public static function report()
	{
		return array(
			'mau01' => 'Danh sách đăng ký đề tài cấp trường - chấp thuận',
			'mau02' => 'Danh sách đăng ký đề tài cấp khoa - chấp thuận',
			'mau03' => 'Danh sách hội đồng duyệt đề tài NCKH cấp trường',
			'mau04' => 'Lịch duyệt đề cương NCKH'
		);
	}

	public static function backup_loai()
	{
		return array(
			'0' => 'Full',
			'1' => 'Schema',
			'2' => 'Data',
		);
	}
	
	public static function mail_tb_loai()
	{
		return array(
			'1' => 'Thông báo duyệt',
			'2' => 'Thông báo nghiệm thu',
		);
	}
	
	public static function lichct_buoi()
	{
		return array(
			'1' => 'Sáng',
			'2' => 'Chiều',
		);
	}
}

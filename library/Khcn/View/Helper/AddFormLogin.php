<?php
class Khcn_View_Helper_AddFormLogin extends Zend_View_Helper_Abstract
{
	public function addFormLogin()
	{
		$viewer = Khcn_Api::_()->getViewer();
		if ($viewer && $viewer->getIdentity()) {
			$link = new Zend_View_Helper_Url();
			$urlLogout = $link->url(array('controller' => 'dang-nhap',  
							              'action'     => 'logout',   
							         	  ),null,true);
			$urlInfoNV = $link->url(array('controller' => 'nguoi-dung',  
							              'action'     => 'sua',   
							         	  ),null,true);
			$urlDkGV = $link->url(array('controller' => 'giang-vien',  
							              'action'     => 'dang-ky',   
							         	  ),null,true);
			$urlInfoGV = $link->url(array('controller' => 'giang-vien',  
							              'action'     => 'cap-nhat',   
							         	  ),null,true);
			$urlNCKH = $link->url(array('controller' => 'giang-vien',  
							              'action'     => 'thong-ke',   
							         	  ),null,true);
			$urlNCS = $link->url(array('controller' => 'giang-vien',  
							              'action'     => 'nghien-cuu-sinh',   
							         	  ),null,true);
			$urlChangePass = $link->url(array('controller' => 'nguoi-dung',  
							              'action'     => 'change-pass',   
							         	  ),null,true);
			$html = '<div class="login-success">';
			$html .= '<p>';
            $html .= 'Xin chào : ' . $viewer->ten_hien_thi;
            $html .= '</p>';	
            $html .= '<ul>';	
			$html .= '<li><a href="' . $urlInfoNV . '"><span>Thông tin cá nhân</span></a></li>';
			if($viewer->isGiangVien()){
				$html .= '<li><a href="' . $urlInfoGV . '"><span>Thông tin giảng viên</span></a></li>';
				$html .= '<li><a href="' . $urlNCKH . '"><span>Hồ sơ nghiên cứu khoa học</span></a></li>';
				$html .= '<li><a href="' . $urlNCS . '"><span>Hồ sơ nghiên cứu sinh</span></a></li>';
			}else{
				$html .= '<li><a href="' . $urlDkGV . '"><span>Đăng ký giảng viên</span></a></li>';
			}
			$html .= '<li><a href="' . $urlChangePass . '"><span>Đổi mật khẩu</span></a></li>';              
            $html .= '<li><a href="' . $urlLogout . '">Đăng xuất</a></li>';                                                                                      
            $html .= '</ul>';                                    
            $html .= '</div>';
            return $html;
        }else{
        	$form = new Default_Form_Login_Login();
			$form->setTitle(null)
				->setDescription(null)
				->setAttrib('class', '');
	        return $form;
        }
	}	
}
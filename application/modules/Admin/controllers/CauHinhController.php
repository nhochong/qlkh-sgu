<?php
ini_set('max_execution_time',1200);
ini_set('request_terminate_timeout',1200);
ini_set('mysql.connect_timeout', 1200);
ini_set('default_socket_timeout', 1200);
/**
 * {0}
 * 
 * @author
 * @version 
 */

class Admin_CauHinhController extends Khcn_Controller_Action_Admin
{
	protected $hinh_anh = null;
	
	public function init ()
    {
        $this->hinh_anh = new Default_Model_HinhAnh();
    }
    
    public function indexAction() 
    {
    	$form = new Admin_Form_CauHinh();
        $this->view->form = $form;
		
		$form->populate(array(
			'ten_phong' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('ten_phong', 'Phòng Khoa học - Công nghệ - Trường Đại học Sài Gòn'),
			'truong_phong' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('truong_phong', 'PGS TS. Võ Văn Lộc'),
			'hieu_truong' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('hieu_truong', 'PGS TS. Nguyễn Viết Ngoạn'),
			'domain' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('domain', $_SERVER['HTTP_HOST']),
			'cesti_info' => Khcn_Api::_()->getApi('settings', 'default')->getSetting('cesti_info', ''),
		));
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$values = $form->getValues();
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('hieu_truong', $values['hieu_truong']);
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('ten_phong', $values['ten_phong']);
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('truong_phong', $values['truong_phong']);
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('domain', $values['domain']);
		Khcn_Api::_()->getApi('settings', 'default')->setSetting('cesti_info', $values['cesti_info']);
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
		$this->_redirect('/admin/cau-hinh/index');					
    }
    
    public function hinhAnhAction()
    {
    	// TODO Auto-generated {0}::indexAction() default action
        $hinhAnhs = $this->hinh_anh->getAll();
        
        $paginator = Zend_Paginator::factory($hinhAnhs);
        $currentPage = 1;
        //Check if the user is not on page 1
        $page = $this->_getParam('page');
        if (! empty($page)) { //Where page is the current page
            $currentPage = $this->_getParam('page');
        }
        //Set the properties for the pagination
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(5);
        $paginator->setCurrentPageNumber($currentPage);
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination.phtml');
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }
    
	public function themHaAction() 
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_HinhAnh();
        $form->submitCon->setLabel('Lưu và tiếp tục');
        $form->submitExit->setLabel('Lưu và thoát');
        $form->cancel->setLabel('Không lưu');
        $this->view->form = $form;
    	if($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if($form->isValid($formData))
			{				
				//determine filename and extension 
                $info = pathinfo($form->ten_file->getFileName(null,false)); 
                $filename = $info['filename']; 
                $ext = $info['extension']?".".$info['extension']:""; 
                //filter for renaming.. prepend with current time 
                $file = time(). '_' . Default_Model_Functions::convert_vi_to_en($filename) .$ext;
                $form->ten_file->addFilter(new Zend_Filter_File_Rename(array( 
                                "target"=>$file, 
                                "overwrite"=>true)))
                		   ->addFilter(new Khcn_Filter_File_Resize(array(
							    'width' => 720,
							    'height' => 720,
							    'keepRatio' => true,
							)));
                $form->getValue('ten_file');
                
				$hinh_anh = new Default_Model_HinhAnh();
				$hinh_anh->setTrangThai($form->getValue('trang_thai'));
                $hinh_anh->setTenFile($file);
				$kq = $hinh_anh->them();
				if(!$kq){
					$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/cau-hinh/index');
				}
				
				$this->flash();
				$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được lưu trữ .';
				$_SESSION['type_msg'] = 'success';
				if($form->submitCon->isChecked()){
					$this->_redirect('/admin/cau-hinh/them-ha');					
				}else{
					$this->_redirect('/admin/cau-hinh/hinh-anh');
				}
			}
			else
			{
				$form->populate($formData);
			}
		}
    }
    
    public function xoasHaAction()
    {
	    if(count($_POST['item']) == 0)
		{
			$_SESSION['msg'] = "Lỗi! Vui lòng chọn dữ liệu trước khi xóa.";
			$_SESSION['type_msg'] = "error";
			$this->_redirect('/admin/cau-hinh/hinh-anh');
		}
		foreach($_POST['item'] as $id){			
			$hinh_anh = $this->hinh_anh->getHinhAnh($id);			
			if($hinh_anh != NULL)
			{			
				if($hinh_anh['ten_file'] != '' && file_exists( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']))
						unlink( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']);
				//xoa database
				$kq = $this->hinh_anh->xoa($id);
			}			
		}
		$this->flash();
		$_SESSION['msg'] = "Thành công! Dữ liệu đã được xóa.";
		$_SESSION['type_msg'] = "success";
		$this->_redirect('/admin/cau-hinh/hinh-anh');
    }
    
	public function xoaHaAction()
    {
    	$id = $this->_getParam('id');
    	if(!empty($id)){
    		$hinh_anh = $this->hinh_anh->getHinhAnh($id);
    		if($hinh_anh != null){
				if($hinh_anh['ten_file'] != '' && file_exists( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']))
						unlink( BASE_PATH . '/flash/image-scroller/images/' . $hinh_anh['ten_file']);
				
    			$kq = $this->hinh_anh->xoa($id);
    			if(!$kq){
    				$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    			}
    			$this->flash();
    			$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được xóa .';
				$_SESSION['type_msg'] = 'success';
	    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    		}else{
    			$_SESSION['msg'] = 'Lỗi !. Mã lĩnh vực không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    		}
    	}else{
    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    	}
    }
    
	public function capNhatTtHaAction()
    {
    	$id = $this->_getParam('id');
    	$status = $this->_getParam('status');
    	if(!empty($id)){
    		$hinh_anh = $this->hinh_anh->getHinhAnh($id);
    		if($hinh_anh != null){
	    		$kq = $this->hinh_anh->CapNhatTT($id,$status);
	    		if(!$kq){
	    			$_SESSION['msg'] = 'Lỗi !. Đã có lỗi trong quá trình xử lý, vui lòng thử lại .';
					$_SESSION['type_msg'] = 'error';
		    		$this->_redirect('/admin/cau-hinh/hinh-anh');
	    		}
	    		$this->flash();
	    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    		}else{
	    		$_SESSION['msg'] = 'Lỗi !. Mã biểu mẫu không tồn tại .';
				$_SESSION['type_msg'] = 'error';
	    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    		}
    	}else{
    		$this->_redirect('/admin/cau-hinh/hinh-anh');
    	}
    }
    
	/*
     * Ghi file xml trong flash index
     */
    private function flash()
    {
    	$hinh_anh = new Default_Model_HinhAnh();
		$hinhAnhs = $hinh_anh->getDSHA();
		$text = '<photos>';
		foreach ($hinhAnhs as $hinhAnh){
			$text .= '<photo image="images/' . $hinhAnh['ten_file'] . '" colorboxImage="images/' . $hinhAnh['ten_file'] . '" colorboxInfo="" colorboxClass="image" url="" target="_blank"><![CDATA[<head></head><body></body>]]></photo>';
		}
		$text .= '</photos>';
		$path = BASE_PATH . '/flash/image-scroller/images.xml';
		$fp = fopen($path, 'w');
		fwrite($fp, $text);
		fclose($fp);
    }
   
	public function createIndexAction ()
    {
        //Create an index.
        $index = Zend_Search_Lucene::create('../application/searchindex');
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());	
        $this->view->msg = 'Create index success<br/>';
	}
	
	public function updateIndexAction(){
        //---------------------- Danh sach de tai ----------------------
        $lists = Khcn_Api::_()->getDbTable('de_tai', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
		
		
        //-------------------------------- Danh sach Tin Tuc Su Kien ---------------------------
        $lists = Khcn_Api::_()->getDbTable('tin_tuc', 'default')->fetchAll();
        foreach ($lists as $item) {
           $item->save();
        }
		
        //-------------------------------- Danh sach Thong Bao --------------------------------
        $lists = Khcn_Api::_()->getDbTable('thong_bao', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
		
        //--------------------------------- Danh sach Hoi Thao --------------------------------
    	$lists = Khcn_Api::_()->getDbTable('hoi_thao', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
        
		//--------------------------------- Danh sach Bai Bao --------------------------------
    	$lists = Khcn_Api::_()->getDbTable('bai_bao', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
		
		//--------------------------------- Danh sach Tai Lieu --------------------------------
    	$lists = Khcn_Api::_()->getDbTable('tai_lieu', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
		
		//--------------------------------- Danh sach Bieu Mau --------------------------------
    	$lists = Khcn_Api::_()->getDbTable('bieu_mau', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
		
		//--------------------------------- Danh sach Qui Dinh --------------------------------
    	$lists = Khcn_Api::_()->getDbTable('qui_dinh', 'default')->fetchAll();
        foreach ($lists as $item) {
            $item->save();
        }
		exit('Done.');
	}
   
	public function mailSettingsAction()
	{
		// Get mail config
		$mailConfigFile = APPLICATION_PATH . '/settings/mail.php';
		$mailConfig = array();
		if( file_exists($mailConfigFile) ) {
		  $mailConfig = include $mailConfigFile;
		}

		// Get form
		$this->view->form = $form = new Admin_Form_Mail_Settings();

		// Populate form
		$form->populate((array) Khcn_Api::_()->getApi('settings', 'default')->core_mail);	
		if( 'Zend_Mail_Transport_Smtp' === @$mailConfig['class'] ) {
		  $form->populate(array_filter(array(
			'mail_smtp' => ( 'Zend_Mail_Transport_Smtp' == @$mailConfig['class'] ),
			'mail_smtp_server' => @$mailConfig['args'][0],
			'mail_smtp_ssl' => @$mailConfig['args'][1]['ssl'],
			'mail_smtp_authentication' => !empty($mailConfig['args'][1]['username']),
			'mail_smtp_port' => @$mailConfig['args'][1]['port'],
			'mail_smtp_username' => @$mailConfig['args'][1]['username'],
			'mail_smtp_password' => @$mailConfig['args'][1]['password'],
		  )));
		}
		
		// Check method/valid
		if( !$this->getRequest()->isPost() ) {
		  return;
		}
		if( !$form->isValid($this->getRequest()->getPost()) ) {
		  return;
		}

		// Process
		$values = $form->getValues();

		// Special case for auth
		if( $values['mail_smtp'] ){
		  // re-assign existing password if form password is left blank
		  if( empty($values['mail_smtp_password']) ) {
			if( !empty($mailConfig['args'][1]['password']) ){
			  $values['mail_smtp_password'] = $mailConfig['args'][1]['password'];
			}
		  }
		}


		// Save smtp settings
		if( $values['mail_smtp'] ) {
		  $args = array();

		  $args['port'] = (int) $values['mail_smtp_port'];

		  if( !empty($values['mail_smtp_ssl']) ) {
			$args['ssl'] = $values['mail_smtp_ssl'];
		  }

		  if( !empty($values['mail_smtp_authentication']) ) {
			$args['auth'] = 'login';
			$args['username'] = $values['mail_smtp_username'];
			$args['password'] = $values['mail_smtp_password'];
		  }

		  $mailConfig = array(
			'class' => 'Zend_Mail_Transport_Smtp',
			'args' => array(
			  $values['mail_smtp_server'],
			  $args,
			)
		  );

		} else {
		  $mailConfig = array(
			'class' => 'Zend_Mail_Transport_Sendmail',
			'args' => array(),
		  );
		}

		// Write contents to file
		if( (is_file($mailConfigFile) && is_writable($mailConfigFile)) ||
			(is_dir(dirname($mailConfigFile)) && is_writable(dirname($mailConfigFile))) ) {
		  $contents = "<?php return ";
		  $contents .= var_export($mailConfig, true);
		  $contents .= "; ?>";

		  file_put_contents($mailConfigFile, $contents);
		} else {
		  return $form->addError('Unable to change mail settings due to the file ' .
			'/application/settings/mail.php not having the correct permissions.' .
			'Please CHMOD (change the permissions of) that file to 666, then try again.');
		}

		// save the name and email address
		Khcn_Api::_()->getApi('settings', 'default')->core_mail = array(
		  'from' => $values['from'],
		  'name' => $values['name'],
		  'contact' => $values['contact'],
		);		
		
		$_SESSION['msg'] = 'Thành công !. Dữ liệu đã được cập nhật .';
		$_SESSION['type_msg'] = 'success';
	}
}

<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Default_IndexController extends Khcn_Controller_Action_Standard
{    
	public function init(){
		
	}
	
    public function indexAction ()
    {     	
		$form = new Default_Form_Search();
		$this->_helper->layout()->assign('isMultiBlock', true);
		
		// Tin tuc
		$tinTucs = Khcn_Api::_()->getDbTable('tin_tuc', 'default')->danhsachhienthi(array('limit' => 7));
		$this->view->tinTucs = $tinTucs;
		
		// Thong bao tuyen sinh SDH
		$nam = date('Y');
		$loaiTbs = Khcn_Api::_()->getDbTable('loai_thong_bao', 'default')->getDanhSachLTB(array('he_cao_hoc' => true));
		$arr_loaiTbs = array();
		foreach($loaiTbs as $loai_tb){
			$arr_loaiTbs[] = $loai_tb->getIdentity();
		}
		$params = array(
			'trang_thai' => true,
			'loais' => $arr_loaiTbs,
			'noi_bat' => true,
			'order' => 'noi_bat',
			'limit' => 7
		);
		$this->view->thongBaoSDH = $thongBaoSDH =  Khcn_Api::_()->getDbTable('thong_bao', 'default')->getDSThongBaos($params);
    }
    
    public function auth($username,$password)
    {
		$userTable = Khcn_Api::_()->getItemTable('default_nguoi_dung');
		$userSelect = $userTable->select()
		  ->where('ten_dang_nhap = ?', $username);          // If post exists
		$user = $userTable->fetchRow($userSelect);
		
		 // Check if user exists
		if( empty($user) ) {
			return false;
		}
	
        //1.Goi ket noi voi Zend Db
        $db = Zend_Registry::get('connectDB');
        //2. Khoi tao Zend Auth
        $auth = Zend_Auth::getInstance();
        //3. Khai bao bang va 2 cot se su dung so sanh trong qua trinh login
        $authAdapter = new Zend_Auth_Adapter_DbTable($db);
        $authAdapter->setTableName('nguoi_dung')
		            ->setIdentityColumn('id')
		            ->setCredentialColumn('mat_khau');
        //4. Lay gia tri duoc gui qua tu FORM
		// Translate email
		$userTable = Khcn_Api::_()->getItemTable('default_nguoi_dung');
		$userIdentity = $userTable->select()
		  ->from($userTable, 'id')
		  ->where('`ten_dang_nhap` = ?', $username)
		  ->limit(1)
		  ->query()
		  ->fetchColumn(0);
		  
        $paswd = md5($password);
        //5. Dua vao so sanh voi du lieu khai bao o muc 3
        $authAdapter->setIdentity($userIdentity);
        $authAdapter->setCredential($paswd);
        //6. Kiem tra trang thai cua user neu trang_thai = 1 moi duoc login
        //$select = $authAdapter->getDbSelect();
        //$select->where('trang_thai = 1');
        //7. Lay ket qua truy van
        $result = $auth->authenticate($authAdapter);
		Khcn_Api::_()->setViewer();
        if ($result->isValid()) {
            //8. Lay nhung du lieu can thiet trong bang users neu login thanh cong									
            //$data = $authAdapter->getResultRowObject(null,array('mat_khau'));
            //9. Luu  nhung du lieu cua member vao session              							
            //$auth->getStorage()->write($data);
			
			//Update lan dang nhap cuoi
			$user = Khcn_Api::_()->getItem('default_nguoi_dung',$auth->getIdentity());
			$user->lan_dang_nhap_cuoi = date('Y-m-d H:i:s');
			$user->save();
					
            return true;
        } else {
            return false;
	    }
    }
    
    public function gioiThieuAction()
    {
    	$this->view->controller = 'gioi-thieu';
    	$this->view->gioi_thieu = Khcn_Api::_()->getApi('settings', 'default')->getSetting('gioi_thieu', '');
    }
    
	
    
	private function sort_cate($data1, $data2) 
    { 
        if ($data1["cate"] > $data2["cate"]) 
        { 
            return 1; 
        } 
        else if ($data1["cate"] == $data2["cate"]) 
        { 
            return 0; 
        } 
        else 
        { 
            return -1; 
        } 
    }
    
    public function searchAction()
    {
    	//get Params
    	$keyword = trim($this->getRequest()->getParam('keyword'));
    	$name = trim($this->getRequest()->getParam('name'));
    	//khởi tạo form AdvSearch
    	$form = new Default_Form_AdvSearch();    	 			
    	$this->view->form = $form;
    	
    	//khởi tạo form SearchGV
    	$formGV = new Default_Form_SearchGV();
    	$this->view->formGV = $formGV;
    	
    	//Mảng kết quả
    	$result = array();
    	
    	//tab đc chọn
    	$this->view->tab = 0;
    	
    	//Nếu search theo chủ đề
    	if($keyword != null){
			if( $form->isValid($this->_getAllParams()) ) {
				$values = $form->getValues();
			}
		    $result = Khcn_Api::_()->getApi('search', 'default')->getSelect($keyword, $values);
			
	    	$this->view->keyword = $keyword;
	    	$this->view->tab = 0;
		}else if($name != null){
			if( $formGV->isValid($this->_getAllParams()) ) {
				$values = $formGV->getValues();
			}
    		$giang_vien = new Default_Model_GiangVien();
    		$result = Khcn_Api::_()->getDbTable('giang_vien', 'default')->searchByGiangVien($name, $values['ma_don_vi']);
	    	$this->view->name = $name;
    		$this->view->tab = 1;
    	}else{
	    	$this->view->keyword = '';
	    	$this->view->tab = 0;
    	}
    	
    	$paginator = Zend_Paginator::factory($result);
		$currentPage = 1;
	    //Check if the user is not on page 1
	    $page = $this->_getParam('page');
	    if (! empty($page)) { //Where page is the current page
	        $currentPage = $this->_getParam('page');
	    }
	    //Set the properties for the pagination
	    $paginator->setItemCountPerPage(20);
	    $paginator->setPageRange(5);
	    $paginator->setCurrentPageNumber($currentPage);
	    Zend_Paginator::setDefaultScrollingStyle('Sliding');
	    Zend_View_Helper_PaginationControl::setDefaultViewPartial('includes/pagination_getmethod.phtml');
	    $paginator->setView($this->view);
	    $this->view->paginator = $paginator;
		$this->view->total = $paginator->getTotalItemCount();	  
		$this->view->searchtypes = $searchtypes = Khcn_Api::_()->getDbTable('searchtypes', 'default')->getSearchTypesEnabledAssoc();  
    }
    
	public function kiemTraUserAction()
    {  	
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();	
    	$user = $_POST['user'];
    	$nguoi_dung = new Default_Model_NguoiDung();
		$datas = array();
		if(empty($user)){
			$datas['status'] = false;
			$datas['message'] = 'Vui lòng nhập tên đăng nhập';
			echo json_encode($datas);
			exit;
		}
		// Check valid username
		$isValid = preg_match('/^[a-z0-9]+$/i', $user);
		if(!$isValid){
			$datas['status'] = false;
			$datas['message'] = 'Vui lòng chỉ nhập các ký tự a-z và 0-9';
			echo json_encode($datas);
			exit;
		}
		
		// Check exist username
		if($nguoi_dung->kiem_tra_user($user)){
			$datas['status'] = false;
			$datas['message'] = 'Tên đăng nhập đã được sử dụng';
			echo json_encode($datas);
			exit;
		}
		$datas['status'] = true;
		$datas['message'] = 'Có thể sử dụng';
		echo json_encode($datas);
		exit;
    } 
    
    public function kiemTraEmailAction()
    {
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
    	$email = $_POST['email'];  
		$datas = array();		
		if(empty($email)){
			$datas['status'] = false;
			$datas['message'] = 'Vui lòng nhập địa chỉ email';
			echo json_encode($datas);
			exit;
		}
		// Check valid email
		$validator = new Zend_Validate_EmailAddress();
		if(!$validator->isValid($email)){
			$datas['status'] = false;
			$datas['message'] = 'Địa chỉ email không hợp lệ';
			echo json_encode($datas);
			exit;
		}
		
		// Check exist email
		$nguoi_dung = new Default_Model_NguoiDung();    	
		if($nguoi_dung->kiem_tra_email($email)){
			$datas['status'] = false;
			$datas['message'] = 'Email đã được sử dụng';
			echo json_encode($datas);
			exit;
		}
		
		$datas['status'] = true;
		$datas['message'] = 'Có thể sử dụng';
		echo json_encode($datas);
		exit;
    }
	
	public function kiemTraMaGvAction()
    {
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
    	$ma_giang_vien = trim($_POST['ma_giang_vien']);  
		$datas = array();		
		if(empty($ma_giang_vien)){
			$datas['status'] = false;
			$datas['message'] = 'Vui lòng nhập mã giảng viên';
			echo json_encode($datas);
			exit;
		}
		
		// Check valid giang vien
		if( (strlen($ma_giang_vien) < 5) || (strlen($ma_giang_vien) > 10)){
			$datas['status'] = false;
			$datas['message'] = 'Mã giảng viên : 5->10 ký tự';
			echo json_encode($datas);
			exit;
		}
		
		$isValid = preg_match('/^[a-z0-9]+$/i', $ma_giang_vien);
		if(!$isValid){
			$datas['status'] = false;
			$datas['message'] = 'Vui lòng chỉ nhập các ký tự a-z và 0-9';
			echo json_encode($datas);
			exit;
		}
		
		// Check exist giang vien
		$datas['is_existed'] = false;
		$giang_vien = Khcn_Api::_()->getDbTable('giang_vien', 'default')->getGiangVienByOptions(array('ma_giang_vien' => $ma_giang_vien));
		if($giang_vien){
			$datas['is_existed'] = true;
			$nguoi_dung = Khcn_Api::_()->getDbTable('nguoi_dung', 'default')->getByGiangVien($giang_vien->id);
			if($nguoi_dung){
				$datas['status'] = false;
				$datas['message'] = 'Mã giảng viên đã được đăng ký. Vui lòng kiểm tra lại.';
				echo json_encode($datas);
				exit;
			}
		}
				
		$datas['status'] = true;
		$datas['message'] = 'Có thể sử dụng';
		echo json_encode($datas);
		exit;
    }
    
	public function dangKyAction()
    {
		$viewer = Khcn_Api::_()->getViewer();
		if($viewer && $viewer->getIdentity()) {
			return $this->_helper->redirector->gotoRoute(array(), 'default', true);
		}
		
    	$form = new Default_Form_Register();
    	$form->submit->setLabel('Đăng ký');
    	$form->removeElement('cancel');
    	$this->view->form = $form; 
		
		if(!$this->getRequest()->isPost()){
			return;
		}
		
		if(!$form->isValid($this->getRequest()->getPost())){
			return;
		}
		
		$session = new Zend_Session_Namespace('message');
		$values = $form->getValues();
		
		$table = Khcn_Api::_()->getItemTable('default_nguoi_dung');	
		
		$db = $table->getAdapter();
		$db->beginTransaction();
		try {
			$values['mat_khau'] = md5($values['mat_khau']);
			if(!empty($values['ngay_sinh']) && $values['ngay_sinh'] != '0000-00-00'){
				$values['ngay_sinh'] = date('Y-m-d',strtotime($values['ngay_sinh']));
			}else{
				$values['ngay_sinh'] = null;
			}
			$values['ngay_tao'] = $values['lan_dang_nhap_cuoi'] = new Zend_Db_Expr('NOW()');
			
			$nguoi_dung = $table->createRow();	
			$nguoi_dung -> setFromArray($values);
			$nguoi_dung -> setTenHienThi(array('ho' => $values['ho'], 'ten' => $values['ten']));
			$nguoi_dung -> save();
				
			$db->commit();
			if($nguoi_dung->enabled == 1){
				Khcn_Api::_()->getAuth()->getStorage()->write($nguoi_dung->getIdentity());
				$message = Zend_Registry::get('Zend_Translate') -> _('Thành công. Tài khoản của bạn đã được tạo. Vui lòng đăng nhập vào hệ thống.');
			}else{
				$message = Zend_Registry::get('Zend_Translate') -> _('Thành công. Xin vui lòng kích hoạt tài khoản thông qua email đã đăng ký.');
			}
			
			return $this->_forward('thong-bao', 'index', 'default', array(
				'messages' => array($message),
			));
		} catch( Exception $e ) {
			$db->rollBack();
			throw $e;
		}
    }
    
    public function resetPassAction()
    {
    	$auth = Zend_Auth::getInstance();		
        if ($auth->hasIdentity())
        	$this->_redirect('/index/index');
    	$form = new Default_Form_ResetPass();
        $form->submit->setLabel('Gởi yêu cầu');
        $this->view->form = $form;    
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
				$db = Khcn_Api::_()->getItemTable('default_de_tai')->getAdapter();
				$db->beginTransaction();
				try{
					$session = new Zend_Session_Namespace('message');
					$nguoi_dung = new Default_Model_NguoiDung();
					if(!$nguoi_dung->kiem_tra_user($form->getValue('ten_dang_nhap'))){
						$session->msg = 'Lỗi. Tài khoản không tồn tại .Vui lòng kiểm tra lại';
						$session->type_msg = 'error';
						$this->_redirect('/index/reset-pass');
					}
					$member = $nguoi_dung->getNDByTDN($form->getValue('ten_dang_nhap'));				
					$account_reset = new Default_Model_AccountReset();
					if($account_reset->kiem_tra_yeu_cau($member['id'])){
						$session->msg = 'Lỗi. Bạn đã gởi yêu cầu reset mật khẩu .Vui lòng kiểm tra lại E-mail';
						$session->type_msg = 'error';
						$this->_redirect('/index/thong-bao');
					}
					$reset_id = md5(time().rand());
					$account_id = $member['id'];
					$new_pass = substr(md5(rand().rand()), 0, 10);
					$expiration = strtotime('+1 days');
					$expiration = date('Y-m-d H:i:s',$expiration);
					$account_reset->setResetId($reset_id)
								  ->setAccountId($account_id)
								  ->setNewPass($new_pass)
								  ->setExpiration($expiration);
					$account_reset->them();
					$db->commit();
					$url = new Zend_View_Helper_Url();
					$domain = Khcn_Api::_()->getApi('settings', 'default')->getSetting('domain', '');
					$contact_email = Khcn_Api::_()->getApi('settings', 'default')->getSetting('core.mail.contact', 'admin@khcnsgu.com');
					$toEmail = $member['email'];
					$subject = "Mail xác nhận việc reset mật khẩu từ Phòng KHCN - SGU";
					$emailMessage = 'Xin chào : <strong>' . $member['ho'] . ' ' . $member['ten'] . '</strong><br/><br/>';
					$emailMessage .= 'Bạn đã gởi yêu cầu cho chúng tôi về việc reset lại mật khẩu cho tài khoản : <strong>' . $member['ten_dang_nhap'] . '</strong><br/>';
					$emailMessage .= 'Để hoàn tất yêu cầu ,bạn hãy click vào link này : <a href="' . $domain . '/public/index/reset/reset_id/' . $reset_id . '">click here</a><br/>';
					$emailMessage .= 'Hoặc copy link dưới đây và dán vào trình duyệt : <br/>';
					$emailMessage .= $domain . '/public/index/reset/reset_id/' . $reset_id;
					$emailMessage .= '<br/><br/>Sau khi bạn chạy đường link trên ,mật khẩu mới của bạn sẽ là : <strong>' . $new_pass . '</strong><br/><br/>';
					$emailMessage .= 'Mail này chỉ có hiệu lực trong vòng <strong>24h</strong> kể từ khi nhận yêu cầu.<br/>';
					$emailMessage .= 'Nếu sau 24h thì việc xác nhận reset mật khẩu sẽ được hủy bỏ.<br/>';
					$emailMessage .= 'Bạn nên <strong>thay đổi lại mật khẩu</strong> ngay sau khi login thành công vào hệ thống.<br/>';
					$emailMessage .= 'Mọi thắc mắc bạn có thể liên lạc với chúng tôi qua địa chỉ sau : 273 An Dương Vương P3 Q5 Tp.HCM<br/>';
					$emailMessage .= 'Hoặc qua E-mail : <strong>' . $contact_email . '</strong>'; 
					Khcn_Api::_()->getApi('mail', 'default')->sendSystemRaw($toEmail, array(
						'subject' => $subject,
						'body' => $emailMessage
					));
					
					$session->msg = 'Thành công. Yêu cầu của bạn đã được thực hiện .Vui lòng kiểm tra e-mail';
					$session->type_msg = 'success';
					$this->_redirect('/index/thong-bao');					
				} catch( Exception $e ){
					$db->rollBack();
					throw $e;
					$session->msg = 'Lỗi. Đã có lỗi xảy ra trong quá trình xử lý .Vui lòng thử lại';
					$session->type_msg = 'error';
					$this->_redirect('/index/reset-pass');
				}
	    	}
    	}	
    }
    
    public function resetAction()
    {
    	$reset_id = $this->_getParam('reset_id');
    	if($reset_id == null)
			$this->_redirect('/index/index');
		$account_reset = new Default_Model_AccountReset();
		$nguoi_dung = new Default_Model_NguoiDung();		
    	$session = new Zend_Session_Namespace('message');
		$account = $account_reset->getAccountReset($reset_id);
    	if($account == null)
    		$this->_redirect('/index/index');
    	if(date('Y-m-d H:i:s') > $account['expiration']){
    		$session->msg = 'Lỗi. Việc xác nhận thay đổi mật khẩu đã quá thời hạn .Vui lòng kiểm tra lại';
			$session->type_msg = 'error';
			$this->_redirect('/index/thong-bao');
    	}
    	$member = $nguoi_dung->getNguoiDung($account['account_id']);
    	$nguoi_dung->change_pass($account['account_id'],md5($account['new_pass']));
    	//xoa account_reset
    	$account_reset->xoa($reset_id);
    	$session->msg = 'Thành công. Mật khẩu của tài khoản ' . $member['ten_dang_nhap'] . ' đã được reset.<br/>Mời bạn login vào hệ thống để kiểm tra';
		$session->type_msg = 'success';
		$this->_redirect('/index/login-default');
    }
    
    public function thongBaoAction()
    {
    	// Get messages
		$messages = array();
		$messages = array_merge($messages, (array) $this->_getParam('messages', null));
		$type_msg = $this->_getParam('type_msg', 'success');
		
		$session = new Zend_Session_Namespace('message');
		if (isset($session->msg)) {
			$messages = array($session->msg);
			$type_msg = $session->type_msg;
			unset($session->msg);	
		}
		
		// Default message "success"
		if( empty($messages) )
		{
			$messages[] = Zend_Registry::get('Zend_Translate')->_('Thành công.');
		}

		// Assign
		$this->view->parentRefresh = $this->_getParam('parentRefresh');
		$this->view->parentRedirect = $this->_getParam('parentRedirect');
		$this->view->parentRedirectTime = $this->_getParam('parentRedirectTime');
		$this->view->redirect = $this->_getParam('redirect');
		$this->view->redirectTime = $this->_getParam('redirectTime');
		$this->view->autoRedirect = $this->_getParam('autoRedirect', true);
		$this->view->messages = $messages;
		$this->view->type_msg = $type_msg;
    } 

    public function rssAction()
    {
    	$this->_helper->viewRenderer->setNoRender();
    	$this->_helper->layout()->disableLayout();
    	$entries = array();
    	$bizThongBao = new Default_Model_ThongBao();
    	$bizTinTuc = new Default_Model_TinTuc();
    	$domain = Khcn_Api::_()->getApi('settings', 'default')->getSetting('domain', '');
    	
    	$thongBaos = $bizThongBao->getDSTBForRSS();
    	$tinTucs = $bizTinTuc->getDSTTForRSS();
    	foreach ($tinTucs as $tin_tuc){
    		$entries[] = array( 'title' => $tin_tuc['tieu_de'] . ' (' . $tin_tuc['ngay_tao'] . ')',
           						'link'        => $domain . '/public/tin-tuc/chi-tiet/id/' . $tin_tuc['id'],
           						'description' => $tin_tuc['mo_ta_tom_tat']
         	);
    	}
    	foreach ($thongBaos as $thong_bao){
    		$entries[] = array( 'title' => $thong_bao['tieu_de'] . ' (' . $thong_bao['ngay_tao'] . ')',
           						'link'        => $domain . '/public/thong-bao/chi-tiet/id/' . $thong_bao['id'],
           						'description' => $thong_bao['tieu_de']
         	);
    	}
    	
    	$feedData = array(
            'title' => 'Phòng Khoa học - Công nghệ - SGU',
            'description' => 'Tin tức - Sự kiện',
            'link' => $domain,
            'charset' => 'utf-8',
            'entries' => $entries
        );
        
        $feed = Zend_Feed::importArray( $feedData, 'rss' );
        // set the Content Type of the document
        header ( 'Content-type: text/xml' );
        // echo the contents of the RSS xml document
        echo $feed->send();
    }
	
	public function congThongTinAction(){
		// Set up require's
		$viewer = Khcn_Api::_()->getViewer();
		$canViewCesti = false;
		$displayForm = false;
		$ma_giang_vien = $this->_getParam('ma_giang_vien', null);
		if(!$viewer->getIdentity() || !$viewer->canViewCesti()){
			$displayForm = true;
		}
		if($viewer->getIdentity() && $viewer->canViewCesti()){
			$canViewCesti = true;
		}else{
			if(!empty($ma_giang_vien)){
				$isExist = Khcn_Api::_()->getDbTable('giang_vien', 'default')->isExist(array('ma_giang_vien' => $ma_giang_vien));
				if($isExist){
					$canViewCesti = true;
				}else{
					$this->view->error = $this->view->translate('Thông tin mã giảng viên không đúng. Vui lòng nhập lại !');
				}
			}
		}
		$this->view->canViewCesti = $canViewCesti;
		$this->view->displayForm = $displayForm;
		$this->view->ma_giang_vien = $ma_giang_vien;

		$this->view->cesti_info = Khcn_Api::_()->getApi('settings', 'default')->getSetting('cesti_info', '');			
	}
}

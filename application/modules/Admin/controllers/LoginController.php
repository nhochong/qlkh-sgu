<?php
/**
 * {0} * 
 * Hung - Nguyen
 * @version 
 */
class Admin_LoginController extends Khcn_Controller_Action_Admin
{
    /**
     * The default action - show the home page
     */
	public function preDispatch ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
        	$this->_redirect('/admin/index/index');
        }
    }
    
    public function indexAction ()
    {
        // TODO Auto-generated {0}::indexAction() default action
        $form = new Admin_Form_Login();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            if ($form->isValid($_POST)) {
            	//1.Goi ket noi voi Zend Db
	            $db = Zend_Registry::get('connectDB');
	            
	            //2. Khoi tao Zend Auth
	            $auth = Zend_Auth::getInstance();
	            
	            //3. Khai bao bang va 2 cot se su dung so sanh trong qua trinh login
	            $authAdapter = new Zend_Auth_Adapter_DbTable($db);
	            $authAdapter->setTableName('nguoi_dung')
                ->setIdentityColumn('ten_dang_nhap')
                ->setCredentialColumn('mat_khau');
                
            	//4. Lay gia tri duoc gui qua tu FORM
				$uname = $form->getValue('Username');
				$paswd = md5($form->getValue('Password'));
				
	            //5. Dua vao so sanh voi du lieu khai bao o muc 3
	            $authAdapter->setIdentity($uname);
	            $authAdapter->setCredential($paswd);
	            
	            //6. Kiem tra trang thai cua user neu trang_thai = 1 moi duoc login
	            $select = $authAdapter->getDbSelect();
	            $select->where('trang_thai = 1');
	            
	            //7. Lay ket qua truy van
	            $result = $auth->authenticate($authAdapter);
	            if ($result->isValid()) {	            	
	           		
	                //8. Lay nhung du lieu can thiet trong bang users neu login thanh cong				
	                $data = $authAdapter->getResultRowObject(null,array('mat_khau'));
	                
	                //9. Luu  nhung du lieu cua member vao session              							
	                $auth->getStorage()->write($data);
	                
	                //Update lan dang nhap cuoi
	           		$user = Khcn_Api::_()->getItem('default_nguoi_dung',$auth->getStorage()->read()->id);
					$user->lan_dang_nhap_cuoi = date('Y-m-d H:i:s');
	           		$user->save();
	           		
	                $this->_redirect('/admin/index/index');
	            }else{	            	
	            	$this->view->message = 'Tên đăng nhập hoặc mật khẩu không đúng';
	            }
            }else {
            	$this->view->form = $form;
            }  
        }else{
        	$this->view->form = $form;
        }    
    }
}

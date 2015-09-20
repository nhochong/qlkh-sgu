<?php
class Default_Controller_Helper_Login extends Khcn_Controller_Action_Standard_Helper_Abstract
{
    public function preDispatch()
    {
        $view = $this->getActionController()->view;
        $form = new Default_Form_Login();
		$redirector = new Khcn_Controller_Action_Standard_Helper_Redirector();
		
        $request = $this->getActionController()->getRequest();
        if($request->isPost() && $request->getPost('submit')) {
            if($form->isValid($request->getPost())) {
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
				$session= new Zend_Session_Namespace('users');
				$session->username = $form->getValue('Username');
				
	            //5. Dua vao so sanh voi du lieu khai bao o muc 3
	            $authAdapter->setIdentity($uname);
	            $authAdapter->setCredential($paswd);
	            
	            //6. Kiem tra trang thai cua user neu status = 1 moi duoc login
	            //$select = $authAdapter->getDbSelect();
	            //$select->where('status = 1');
	            
	            //7. Lay ket qua truy van
	            $result = $auth->authenticate($authAdapter);
	            if ($result->isValid()) {
	            	
	                //8. Lay nhung du lieu can thiet trong bang users neu login thanh cong				
	                $data = $authAdapter->getResultRowObject(null,array('password'));
	                
	                //9. Luu  nhung du lieu cua member vao session
	                $auth->getStorage()->write($data);
	                $urlOptions = array('controller' => 'index', 
                    					'action' => 'index');
	                $redirector->gotoRouteAndExit($urlOptions,null,true);
	            }else{	  
	            	$urlOptions = array('controller' => 'index', 
                    					'action' => 'login-default');    
	            	$redirector->gotoRouteAndExit($urlOptions,null,true);  	            	
	            }
            }
        }        
        $view->loginForm = $form;
    }
}
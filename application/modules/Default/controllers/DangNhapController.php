<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AuthController.php 9339 2011-09-29 23:03:01Z john $
 * @author     John
 */
 
class Default_DangNhapController extends Khcn_Controller_Action_Standard
{
  public function indexAction()
  {
    // Already logged in
	$viewer = Khcn_Api::_()->getViewer();
    if( $viewer && $viewer->getIdentity()) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Bạn đã đăng nhập.');
      $this->_helper->redirector->gotoRoute(array(), 'default', true);
      return;
    }

    // Make form
    $this->view->form = $form = new Default_Form_Login();
    $form->setAction($this->view->url(array('return_url' => null)));
    $form->populate(array(
      'return_url' => $this->_getParam('return_url'),
    ));
    
    // Not a post
    if( !$this->getRequest()->isPost() ) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('No action taken');
      return;
    }

    // Form not valid
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid data');
      return;
    }

    // Check login creds
    extract($form->getValues()); // $Username, $Password, $Remember
    $userTable = Khcn_Api::_()->getItemTable('default_nguoi_dung');
	$userSelect = $userTable->select()
	  ->where('ten_dang_nhap = ?', $Username);          // If post exists
	$user = $userTable->fetchRow($userSelect);
    
    // Get ip address
    $db = Khcn_Db_Table::getDefaultAdapter();
    
    // Check if user exists
    if( empty($user) ) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Tên đăng nhập hoặc mật khẩu không đúng.');
      $form->addError(Zend_Registry::get('Zend_Translate')->_('Tên đăng nhập hoặc mật khẩu không đúng.'));
      return;
    }

    // Check if user is verified and enabled
    if( !$user->enabled ) {
      if( !$user->verified ) {
        $this->view->status = false;
		
		$translate = Zend_Registry::get('Zend_Translate');
        $error = $translate->translate('Vui lòng kích hoạt tài khoản thông qua email.');
        $form->getDecorator('errors')->setOption('escape', false);
        $form->addError($error);
        return;
      } else if( !$user->approved ) {
        $this->view->status = false;
        
        $translate = Zend_Registry::get('Zend_Translate');
        $error = $translate->translate('Tài khoản của bạn cần được kích hoạt bởi admin.');
        $form->getDecorator('errors')->setOption('escape', false);
        $form->addError($error);
        return;
      }
      // Should be handled by hooks or payment
      //return;
    }
    
    // Version 3 Import compatibility
    if( empty($user->mat_khau) ) {
        $form->addError('Mật khẩu không hợp lệ. Vui lòng reset lại mật khẩu.');
        return;
    }

    // Normal authentication
    else {
      $authResult = Khcn_Api::_()->authenticate($Username, $Password);
      $authCode = $authResult->getCode();
      Khcn_Api::_()->setViewer();

      if( $authCode != Zend_Auth_Result::SUCCESS ) {
        $this->view->status = false;
        $this->view->error = Zend_Registry::get('Zend_Translate')->_('Tên đăng nhập hoặc mật khẩu không đúng.');
        $form->addError(Zend_Registry::get('Zend_Translate')->_('Tên đăng nhập hoặc mật khẩu không đúng.'));
        return;
      }
    }

    // -- Success! --
    // Remember
    if(!empty( $Remember )) {
      $lifetime = 1209600; // Two weeks
      Zend_Session::getSaveHandler()->setLifetime($lifetime, true);
      Zend_Session::rememberMe($lifetime);
    }

    // Test activity @todo remove
    $viewer = Khcn_Api::_()->getViewer();
    if($viewer && $viewer->getIdentity() ) {
      $viewer->lan_dang_nhap_cuoi = date("Y-m-d H:i:s");
      $viewer->save();
    }

    // Assign sid to view for json context
    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Đăng nhập thành công');
    $this->view->sid = Zend_Session::getId();
    $this->view->sname = Zend_Session::getOptions('name');

    
    // Do redirection only if normal context
      // Redirect by form
      $uri = $form->getValue('return_url');
      if( $uri ) {
        if( substr($uri, 0, 3) == '64-' ) {
          $uri = base64_decode(substr($uri, 3));
        }
        return $this->_redirect($uri, array('prependBase' => false));
      }

      // Redirect by session
      $session = new Zend_Session_Namespace('Redirect');
      if( isset($session->uri) ) {
        $uri  = $session->uri;
        $opts = $session->options;
        $session->unsetAll();
        return $this->_redirect($uri, $opts);
      } else if( isset($session->route) ) {
        $session->unsetAll();
        return $this->_helper->redirector->gotoRoute($session->params, $session->route, $session->reset);
      }

      // Just redirect to home
      return $this->_helper->redirector->gotoRoute(array(), null, true);
  }

  public function logoutAction()
  {
    // Check if already logged out
    $viewer = Khcn_Api::_()->getViewer();
    if(!$viewer || !$viewer->getIdentity() ) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Bạn đã đăng xuất.');
      $this->_helper->redirector->gotoRoute(array(), 'default', true);
      return;
    }
    
    // Logout
    Khcn_Api::_()->getAuth()->clearIdentity();
    
    // Response
    $this->view->status = true;
    $this->view->message =  Zend_Registry::get('Zend_Translate')->_('Bạn đã đăng xuất.');
    return $this->_helper->redirector->gotoRoute(array(), 'default', true);
  }
}

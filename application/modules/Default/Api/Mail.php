<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Mail.php 9064 2011-07-19 18:22:52Z john $
 * @author     Steve
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Default_Api_Mail extends Default_Api_Abstract
{
  protected $_enabled;

  protected $_queueing;

  protected $_transport;

  protected $_log;

  public function __construct()
  {
    $this->_enabled = (bool) Khcn_Api::_()->getApi('settings', 'default')->getSetting('core.mail.enabled', true);
  }

  // Options

  public function getTransport()
  {
    if( null === $this->_transport ) {

      // Get config
      $mailConfig = array();
      $mailConfigFile = APPLICATION_PATH . '/settings/mail.php';
      if( file_exists($mailConfigFile) ) {
        $mailConfig = include $mailConfigFile;
      } else {
        $mailConfig = array(
          'class' => 'Zend_Mail_Transport_Sendmail',
          'args' => array(),
        );
      }

      // Get transport
      try {
        $args = ( !empty($mailConfig['args']) ? $mailConfig['args'] : array() );
        $r = new ReflectionClass($mailConfig['class']);
        $transport = $r->newInstanceArgs($args);
        if( !($transport instanceof Zend_Mail_Transport_Abstract) ) {
          $this->_transport = false;
        } else {
          $this->_transport = $transport;
        }
      } catch( Exception $e ) {
        $this->_transport = false;
        throw $e;
      }
    }

    if( !($this->_transport instanceof Zend_Mail_Transport_Abstract) )
    {
      return null;
    }

    return $this->_transport;
  }

  public function getCharset()
  {
    return 'utf-8';
  }

  /**
   * @return Zend_Log
   */
  public function getLog()
  {
    if( null === $this->_log ) {
      $log = new Zend_Log();
      $log->addWriter(new Zend_Log_Writer_Stream(WEB_ROOT . '/temporary/log/mail.log', 'a'));
      if( 'development' == APPLICATION_ENV ) {
        $log->addWriter(new Zend_Log_Writer_Firebug());
      }
      $this->_log = $log;
    }
    return $this->_log;
  }


  // Doing things

  public function create()
  {
    return new Zend_Mail($this->getCharset());
  }

  public function send(Zend_Mail $mail)
  {
    if( $this->_enabled ) {
      
    }
    
    return $this;
  }

  public function sendRaw(Zend_Mail $mail)
  {
    if( $this->_enabled ) {
      try {
        $mail->send($this->getTransport());
      } catch( Exception $e ) {
        // Silence? Note: Engine_Exception 's are already logged
        if( !($e instanceof Khcn_Exception) && Zend_Registry::isRegistered('Zend_Log') ) {
          $log = Zend_Registry::get('Zend_Log');
          $log->log($e, Zend_Log::ERR);
        }
      }
    }
    
    return $this;
  }

	public function sendSystemRaw($recipient, array $params = array())
	{    
		// Verify recipient(s)
		if( !is_array($recipient) && !($recipient instanceof Zend_Db_Table_Rowset_Abstract) ) {
			$recipient = array($recipient);
		}
		$recipients = array();
		foreach( $recipient as $oneRecipient ) {
			if( !$this->_validateRecipient($oneRecipient) ) {
				throw new Khcn_Exception(get_class($this).'::sendSystem() requires an item, an array of items with an email, or a string email address.');
			}
			$recipients[] = $oneRecipient;
		}
	
		// Get admin info
		$fromAddress = Khcn_Api::_()->getApi('settings', 'default')->getSetting('core.mail.from', 'admin@' . $_SERVER['HTTP_HOST']);
		$fromName = Khcn_Api::_()->getApi('settings', 'default')->getSetting('core.mail.name', 'Site Admin');
	
		$translate = Zend_Registry::get('Zend_Translate');
		
		foreach( $recipients as $recipient ) {
			// See if they're actually a member
			if($recipient instanceof Default_Model_NguoiDung){
				$params['recipientEmail'] = $recipient->email;
				$params['recipientName'] = $recipient->getDisplayname();
			}else if($recipient instanceof Default_Model_GiangVien){
				$params['recipientEmail'] = $recipient->email;
				$params['recipientName'] = $recipient->getDisplayname();
			}else if( is_string($recipient) ) {
				$params['recipientEmail'] = $recipient;
				$params['recipientName'] = $recipient;
			}
		  
			// Send
			$mail = $this->create()
				->addTo($params['recipientEmail'], $params['recipientName'])
				->setFrom($fromAddress, $fromName)
				->setSubject($params['subject'])
				->setBodyHtml($params['body'])
				->setBodyText($params['body']);
		  
			$this->sendRaw($mail);
		}
		return $this;
	}

  protected function _validateRecipient($recipient)
  {
    if( $recipient instanceof Khcn_Model_Item_Abstract && !empty($recipient->email) ) {
      return true;
    } else if( is_string($recipient) && strpos($recipient, '@') >= 1 ) {
      return true;
    }
    return false;
  }

  protected function _translate($key, $locale, $noDefault = false)
  {
    $translate = Zend_Registry::get('Zend_Translate');
    $value = $translate->translate($key, $locale);
    if( $value == $key || '' == trim($value) ) {
      if( $noDefault ) {
        return false;
      } else {
        $value = $translate->translate($key);
        if( $value == $key || '' == trim($value) ) {
          return false;
        }
      }
    }
    return $value;
  }
}
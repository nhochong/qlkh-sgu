<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 9072 2011-07-21 01:09:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Default_Api_Core extends Khcn_Api_Abstract
{
  /**
   * @var Core_Model_Item_Abstract|mixed The object that represents the subject of the page
   */
  protected $_subject;
  
  /**
   * Set the object that represents the subject of the page
   *
   * @param Core_Model_Item_Abstract|mixed $subject
   * @return Core_Api_Core
   */
  public function setSubject($subject)
  {
    if( null !== $this->_subject ) {
      throw new Khcn_Model_Exception("The subject may not be set twice");
    }

    if( !($subject instanceof Khcn_Model_Item_Abstract) ) {
      throw new Khcn_Model_Exception("The subject must be an instance of Khcn_Model_Item_Abstract");
    }
    
    $this->_subject = $subject;
    return $this;
  }

  /**
   * Get the previously set subject of the page
   *
   * @return Core_Model_Item_Abstract|null
   */
  public function getSubject($type = null)
  {
    if( null === $this->_subject ) {
      throw new Khcn_Model_Exception("getSubject was called without first setting a subject.  Use hasSubject to check");
    } else if( is_string($type) && $type !== $this->_subject->getType() ) {
      throw new Khcn_Model_Exception("getSubject was given a type other than the set subject");
    } else if( is_array($type) && !in_array($this->_subject->getType(), $type) ) {
      throw new Khcn_Model_Exception("getSubject was given a type other than the set subject");
    }
    
    return $this->_subject;
  }

  /**
   * Checks if a subject has been set
   *
   * @return bool
   */
  public function hasSubject($type = null)
  {
    if( null === $this->_subject ) {
      return false;
    } else if( null === $type ) {
      return true;
    } else {
      return ( $type === $this->_subject->getType() );
    }
  }

  public function clearSubject()
  {
    $this->_subject = null;
    return $this;
  }
  
  public function subPhrase($string,$length = 0){
	if(strlen($string)<=$length) return $string;
	$pos = $length;
	for($i=$length-1;$i>=0;$i--){
	  if($string[$i]==" "){
		$pos = $i+1;
          break;
	  }
	}
	return substr($string,0,$pos)."...";
  }
}
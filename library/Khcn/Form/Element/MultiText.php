<?php
/**
 * SocialKhcn
 *
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: MultiText.php 7539 2010-10-04 04:41:38Z john $
 */

/**
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Form_Element_MultiText extends Zend_Form_Element_Xhtml
{
  public $helper = 'formMultiText';

  protected $_isArray = true;
  
  /**
   * Load default decorators
   *
   * @return void
   */
  public function loadDefaultDecorators()
  {
    if( $this->loadDefaultDecoratorsIsDisabled() )
    {
      return;
    }

    $decorators = $this->getDecorators();
    if( empty($decorators) )
    {
      $this->addDecorator('ViewHelper');
      Khcn_Form::addDefaultDecorators($this);
    }
  }
}
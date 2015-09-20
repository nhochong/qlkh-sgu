<?php
/**
 * SocialKhcn
 *
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Cancel.php 7371 2010-09-14 03:33:35Z john $
 */

/**
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Form_Element_Cancel extends Khcn_Form_Element_Button
{
  public $helper = 'formCancel';

  protected $_ignore = true;
}
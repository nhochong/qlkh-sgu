<?php
/**
 * SocialKhcn
 *
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: TinyMce.php 7371 2010-09-14 03:33:35Z john $
 */

/**
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Form_Element_TinyMce extends Khcn_Form_Element_Textarea
{
    /**
     * Use formTextarea view helper by default
     * @var string
     */
    public $helper = 'formTinyMce';

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


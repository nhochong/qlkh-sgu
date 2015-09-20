<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: TinyMce.php 7371 2010-09-14 03:33:35Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Form_Element_Calendar extends Khcn_Form_Element_Text
{
    /**
     * Use formTextarea view helper by default
     * @var string
     */
    public $helper = 'formCalendar';

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


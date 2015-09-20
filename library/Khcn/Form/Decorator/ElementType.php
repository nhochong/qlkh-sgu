<?php
/**
 * SocialKhcn
 *
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: ElementType.php 7371 2010-09-14 03:33:35Z john $
 */

/**
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_Form_Decorator_ElementType extends Zend_Form_Decorator_Abstract
{
  public function render($content)
  {
    $element = $this->getElement();
    $type = array_pop(explode('_', $element->getType()));
    $class = 'element_type_'.strtolower($type);

    if( isset($element->class) )
    {
      $class = $element->class.' '.$class;
    }
    $element->class = $class;
    
    return $content;
  }
}
<?php
/**
 * SocialKhcn
 *
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialKhcn.net/license/
 * @version    $Id: Form.php 7244 2010-09-01 01:49:53Z john $
 */

/**
 * @category   Khcn
 * @package    Khcn_Form
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialKhcn.net/license/
 */
class Khcn_Form extends Zend_Form
{
  /**
   * The title of the form
   * 
   * @var string
   */
  protected $_title;

  /**
   * An array of messages (non-warning)
   * 
   * @var array
   */
  protected $_notices;

  /**
   * Default display group class
   * 
   * @var string
   */
  protected $_defaultDisplayGroupClass = 'Khcn_Form_DisplayGroup';



  // Static

  /**
   * Adds paths to an existing form
   * 
   * @param Zend_Form $form
   */
  public static function enableForm(Zend_Form $form)
  {
    $form
      ->addPrefixPath('Khcn_Form_Decorator', 'Khcn/Form/Decorator', 'decorator')
      ->addPrefixPath('Khcn_Form_Element', 'Khcn/Form/Element', 'element')
      ->addElementPrefixPath('Khcn_Form_Decorator', 'Khcn/Form/Decorator', 'decorator')
      ->addDisplayGroupPrefixPath('Khcn_Form_Decorator', 'Khcn/Form/Decorator')
      ->setDefaultDisplayGroupClass('Khcn_Form_DisplayGroup');
  }

  /**
   * Adds default decorators to an existing element
   * 
   * @param Zend_Form_Element $element
   */
  public static function addDefaultDecorators(Zend_Form_Element $element)
  {
    $fqName = $element->getName();
    if( null !== ($belongsTo = $element->getBelongsTo()) ) {
      $fqName = $belongsTo . '-' . $fqName;
    }
    $element
      ->addDecorator('Description', array('tag' => 'p', 'class' => 'description', 'placement' => 'PREPEND'))
      ->addDecorator('HtmlTag', array('tag' => 'div', 'id'  => $fqName . '-element', 'class' => 'form-element'))
      ->addDecorator('Label', array('tag' => 'div', 'tagOptions' => array('id' => $fqName . '-label', 'class' => 'form-label')))
      ->addDecorator('HtmlTag2', array('tag' => 'div', 'id'  => $fqName . '-wrapper', 'class' => 'form-wrapper'));
  }

  /**
   * Sets each element with a class based on its type
   * 
   * @param Zend_Form $form
   */
  public static function setFormElementTypeClasses(Zend_Form $form)
  {
    foreach( $form->getElements() as $element )
    {
      $type = strtolower(array_pop(explode('_', $element->getType())));
      $class = ( isset($element->class) ? $element->class . ' ' : '' );
      $class .= 'element-type-'.$type;
      $element->class = $class;
    }
  }

  /**
   * Object version of {@link Khcn_Form::setFormElementTypeClasses()}
   */
  public function setElementTypeClasses()
  {
    // Semi-deprecated
    self::setFormElementTypeClasses($this);
  }



  // General

  /**
   * Constructor
   * 
   * @param array|null $options
   */
  public function __construct($options = null)
  {
    $this->setAttrib('class', 'global_form');
    $this->setAction($_SERVER['REQUEST_URI']);
    self::enableForm($this);
    parent::__construct($options);
  }

  /**
   * Loads default decorators
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
      $this
        ->addDecorator('FormElements')
        ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'form-elements'))
        ->addDecorator('FormMessages', array('placement' => 'PREPEND'))
        ->addDecorator('FormErrors', array('placement' => 'PREPEND'))
        ->addDecorator('Description', array('placement' => 'PREPEND', 'class' => 'form-description'))
        ->addDecorator('FormTitle', array('placement' => 'PREPEND', 'tag' => 'h3'))
        ->addDecorator('FormWrapper', array('tag' => 'div'))
        ->addDecorator('FormContainer', array('tag' => 'div'))
        ->addDecorator('Form')
        ; //->addDecorator($decorator);
    }
  }



  // Options

  /**
   * Set form title
   * 
   * @param string $title
   * @return Khcn_Form
   */
  public function setTitle($title)
  {
    $this->_title = $title;
    return $this;
  }

  /**
   * Get current form title
   * 
   * @return string
   */
  public function getTitle()
  {
    return $this->_title;
  }


  // Messaging

  /**
   * Add a notice
   * 
   * @param string $message
   * @return Khcn_Form
   */
  public function addNotice($message)
  {
    $this->_notices[] = $message;
    return $this;
  }

  /**
   * Clear all notices
   * 
   * @return Khcn_Form
   */
  public function clearNotices()
  {
    $this->_notices = array();
    return $this;
  }

  /**
   * Get all notices
   * 
   * @return array
   */
  public function getNotices()
  {
    return (array) $this->_notices;
  }
}
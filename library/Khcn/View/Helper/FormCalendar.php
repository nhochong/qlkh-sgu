<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FormTinyMce.php 7281 2010-09-03 03:46:33Z john $
 * @todo       documentation
 */

/**
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Khcn_View_Helper_FormCalendar extends Zend_View_Helper_FormText
{
    protected $_calendar;
	protected $_configs = array(
		'showOn' => 'button',
		'changeMonth' => true,
		'changeYear' => true,
		'buttonImageOnly' => true,
		'altFormat' => 'dd-mm-yy',
		'dateFormat' => 'dd-mm-yy'
	);
	
    public function formCalendar($name, $value = null, $attribs = null)
    {
        // Disable for mobile browsers
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if( preg_match('/Mobile/i', $ua) || preg_match('/Opera Mini/i', $ua) || preg_match('/NokiaN/i', $ua) ) {
          return $this->formText($name, $value, $attribs);
        }

        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable
        $disabled = '';
        if ($disable) {
            $disabled = ' disabled="disabled"';
        }

        $xhtml = '<input type="text" name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs) . ' />';
		
		// Set Default yearRange
		$this->_configs['yearRange'] = '1900:' . date('Y');
		
		// Set default image
		$baseURL = $this->view->baseUrl();
		$this->_configs['buttonImage'] = $baseURL . '/images/calendar.gif';
		
		// Merger calendarOptions
		if (isset($attribs['calendarOptions'])) {
            $this->_configs = array_merge($this->_configs, $attribs['calendarOptions']);
        }
		
		// Set yearRangeCount
		if (isset($attribs['calendarOptions']['yearRangeCount'])) {
			$yearRangeCount = $attribs['calendarOptions']['yearRangeCount'];
			$this->_configs['yearRange'] = (date('Y') - $yearRangeCount) . ":" . (date('Y') + $yearRangeCount);
			unset($this->_configs['yearRangeCount']);
		}
		
		/*$script = '$(function() {' . PHP_EOL
					. '$("#' . $id . '").datepicker({' . PHP_EOL
					. 'showOn: "button",' . PHP_EOL
					. 'changeMonth: true,' . PHP_EOL
					. 'changeYear: true,' . PHP_EOL
					. 'buttonImage: "' . $baseURL . '/images/calendar.gif' . '",' . PHP_EOL
					. 'buttonImageOnly: true,' . PHP_EOL
					. 'altFormat: "dd-mm-yy",' . PHP_EOL
					. 'dateFormat: "dd-mm-yy",' . PHP_EOL
					. 'yearRange: "1950:' . date('Y') . '",' . PHP_EOL
					. '});' . PHP_EOL
					. '});';*/

		$script = '$(function() {' . PHP_EOL
		. '$("#' . $id . '").datepicker({';
		
		foreach($this->_configs as $key=>$value){
			if(is_string($value))
				$script .= "$key : '$value',"; 
			else
				$script .= "$key : $value,"; 
		}
		
		$script .= "});});";
		
		$this->view->headScript()->prependScript($script);

        return $xhtml;
    }
}

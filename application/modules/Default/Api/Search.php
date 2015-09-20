<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Search.php 8103 2010-12-21 05:25:43Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Default_Api_Search extends Khcn_Api_Abstract
{
  protected $_types;
  
  public function index(Khcn_Model_Item_Abstract $item)
  {
    // Check if not search allowed
    if( isset($item->search) && !$item->search )
    {
      return false;
    }

    // Get info
    $type = $item->getType();
    $id = $item->getIdentity();
    $title = Default_Model_Functions::convert_vi_to_en(substr(trim($item->getTitle()), 0, 255), false);
    $description = Default_Model_Functions::convert_vi_to_en(substr(trim(strip_tags($item->getDescription())), 0, 255), false);
    
    // Ignore if no title and no description
    if( !$title && !$description )
    {
      return false;
    }

	// Check if already indexed
    $table = Khcn_Api::_()->getDbTable('search', 'default');
    $select = $table->select()
      ->where('type = ?', $type)
      ->where('id = ?', $id)
      ->limit(1);

    $row = $table->fetchRow($select);

    if( null === $row )
    {
      $row = $table->createRow();
      $row->type = $type;
      $row->id = $id;
    }

    $row->title = $title;
    $row->description = $description;
    $row->save();
  }

  public function unindex(Khcn_Model_Item_Abstract $item)
  {
	$table = Khcn_Api::_()->getDbtable('search', 'default');

    $table->delete(array(
      'type = ?' => $item->getType(),
      'id = ?' => $item->getIdentity(),
    ));

    return $this;
  }

  public function getPaginator($text, $type = null)
  {
    return Zend_Paginator::factory($this->getSelect($text, $type));
  }

  public function getSelect($text, $params = array())
  {
    // Build base query
    $table = Khcn_Api::_()->getDbtable('search', 'default');
    $db = $table->getAdapter();
    $select = $table->select();
	$text = Default_Model_Functions::convert_vi_to_en($text, false);

	if(strlen($text) < 4 || (isset($params['search_full']) && $params['search_full'] == 1)){
		$select->where("`title` like ? or `description` like ? or `keywords` like ? or `hidden` like ?", '%' . $text . '%');
	}else{
		$select->where(new Zend_Db_Expr($db->quoteInto('MATCH(`title`, `description`, `keywords`, `hidden`) AGAINST (? IN BOOLEAN MODE)', $text)))
				->order(new Zend_Db_Expr($db->quoteInto('MATCH(`title`, `description`, `keywords`, `hidden`) AGAINST (?) DESC', $text)));
	}
	
    // Filter by item types
	$availableTypes = $this->getAvailableTypes();
	if(isset($params['types']) && !empty($params['types'])){
		if(!is_array($params['types'])){
			$params['types'] = (array) $params['types'];
		}
		$availableTypes = $params['types'];
	}
	$select->where('type IN(?)', $availableTypes);
    return $select;
  }

  public function getAvailableTypes()
  {
    if( null === $this->_types ) {
      $this->_types = Khcn_Api::_()->getDbtable('search', 'default')->getAdapter()
        ->query('SELECT DISTINCT `type` FROM `search`')
        ->fetchAll(Zend_Db::FETCH_COLUMN);
    }

    return $this->_types;
  }
  
	public function getHits($keyword, $params = array()){
		 //Open the index to search in.
		Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
		Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');
		$query = Zend_Search_Lucene_Search_QueryParser::parse($keyword,'UTF-8');
		$Index = Zend_Search_Lucene::open('../application/searchindex');
		Zend_Search_Lucene::setResultSetLimit(350);
		//Search.
		if(isset($params['search_full']) == 1)
			$query = '"' . $query . '"';
		$hits = $Index->find($query);
		
		//Filter
		$results = array();
		if(isset($params['types']) && !empty($params['types'])){
			if(!is_array($params['types'])){
				$params['types'] = (array) $params['types'];
			}
			foreach ($hits as $hit){
				if(in_array($hit->type, $params['types'])){
					$results[] = $hit;	
				}
			}
		}else{
			$results = $hits;
		}
		return $results;
	}
	
	private function highlight_search($search_results, $search_criteria, $option){
	    if(empty($search_criteria)){ 
	    	return $search_results; 
	    }else{
		    $start_tag = "<b style='color: black; background-color: rgb(102, 255, 255);'>";
		    $end_tag = '</b>';
		    
		    if($option == 1)
		    {
			    $highlighted_results = $start_tag . $search_criteria . $end_tag;
			    return preg_replace("/". $search_criteria . "/iu",$highlighted_results,$search_results);
			    
		    }else{
		    	$arr = explode(' ', $search_criteria);
			    foreach ($arr as $value)
			    {
			    	$highlighted_results = $start_tag . $value . $end_tag;
			    	$search_results = preg_replace("/". $value . "/iu",$highlighted_results,$search_results);
			    }
			    return $search_results;
		    }
	    }
    }
}
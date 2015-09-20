<?php
class Default_Model_LuceneIndex{
	
	public static function update($data) {
		try {
            //Update an index.
            $index = Zend_Search_Lucene::open('../application/searchindex');
			Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
        } catch (Zend_Search_Exception $e) {
			throw $e;
        }
        // remove an existing entry
		$hits = $index->find('pk:' . $data['pk']);
		foreach ($hits as $hit) {
		    $index->delete($hit->id);
		}
        
        $doc = new Zend_Search_Lucene_Document();
        $doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $data['pk']));
        $doc->addField(Zend_Search_Lucene_Field::Keyword('code', $data['code'], 'UTF-8'));
        $doc->addField(Zend_Search_Lucene_Field::Keyword('u_code', strtolower($data['code']),'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::unIndexed('type', $data['type'], 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::unIndexed('id', $data['id'], 'UTF-8'));
        $doc->addField(Zend_Search_Lucene_Field::Text('title', $data['title'], 'UTF-8'));
        $doc->addField(Zend_Search_Lucene_Field::Text('en_title', Default_Model_Functions::convert_vi_to_en($data['title']), 'UTF-8'));
        $doc->addField(Zend_Search_Lucene_Field::Text('description', $data['description'], 'UTF-8'));
        $doc->addField(Zend_Search_Lucene_Field::Text('en_description', Default_Model_Functions::convert_vi_to_en($data['description']), 'UTF-8'));
        $index->addDocument($doc);
        $index->commit();
	}
		
	public static function delete($pk)
    {
    	try {
            //Update an index.
            $index = Zend_Search_Lucene::open('../application/searchindex');
        } catch (Zend_Search_Exception $e) {
            return;
        }
    	$hits = $index->find('pk:' . $pk);
		foreach ($hits as $hit) {
		    $index->delete($hit->id);
		}
        $index->commit();
    }
}
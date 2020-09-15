<?php

require_once 'Cons_Lucene.php';

/**
 * Description of TextSearcher
 *
 * @author Galina Starchenko
 */
abstract class TextSearcher {            
    
    /**
     *
     * @var TextAnalyzer_Utf8
     */
    protected static $analyzer;
    
    /**
     *
     * @var Cons_Lucene
     */
    protected static $index;
    
    public static function init() {
        $indexPath =  dirname(__FILE__).'/index';
        
        try {
            self::$index = Cons_Lucene::open($indexPath);
        } catch (Zend_Search_Lucene_Exception $exc) {
            self::$index = Cons_Lucene::create($indexPath);
        }
        
        require_once 'TextAnalyzer_Utf8.php';        
        self::$analyzer = new TextAnalyzer_Utf8();
        
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            self::$analyzer
        );                
        
        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');
        Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);
    }       
    
    private static function _companyToLuceneDocument($companyArray){
        $doc = new Zend_Search_Lucene_Document();
        
        $doc->addField(Zend_Search_Lucene_Field::Keyword(Cons_Lucene::docId, $companyArray['id']));          
        $doc->addField(Zend_Search_Lucene_Field::UnStored("name", $companyArray['name']));
        $doc->addField(Zend_Search_Lucene_Field::UnStored("phone", $companyArray['phone']));
        $doc->addField(Zend_Search_Lucene_Field::UnStored("address", $companyArray['address']));
        $doc->addField(Zend_Search_Lucene_Field::UnStored("site", $companyArray['site']));
        $doc->addField(Zend_Search_Lucene_Field::UnStored("email", $companyArray['email']));
        $doc->addField(Zend_Search_Lucene_Field::UnStored("about", $companyArray['about']));
        
        foreach ($companyArray['people'] as $id => $personArray) {                        
            $doc->addField(Zend_Search_Lucene_Field::UnStored("person".$id."fio", $personArray['fio']));
            $doc->addField(Zend_Search_Lucene_Field::UnStored("person".$id."email", $personArray['email']));
            $doc->addField(Zend_Search_Lucene_Field::UnStored("person".$id."phone", $personArray['phone']));
            $doc->addField(Zend_Search_Lucene_Field::UnStored("person".$id."comment", $personArray['comment']));
        }
        
        return $doc;
    }    
    
    public static function companyExistsInIndex($company){
        $hits = self::$index->find(Cons_Lucene::docId . ":" . $company['id']);
        
        if (count($hits)) {
            return TRUE;
        }
        return FALSE;
    }
    
    public static function addCompany($company){
        if (!self::companyExistsInIndex($company))        
            self::$index->addDocument(self::_companyToLuceneDocument($company));
    }
    
    public static function updateCompany($company){
        if (self::companyExistsInIndex($company)){
            $hits = self::$index->find(Cons_Lucene::docId . ":" . $company['id']);
        
            foreach ($hits as $hit) {
                self::$index->delete($hit);
            }

            self::$index->addDocument(self::_companyToLuceneDocument($company));
            
            self::$index->commit();
            return TRUE;
        } 
        return FALSE;
    }
    
    public static function addOrUpdateCompany($company){
        if (!self::updateCompany($company))
            self::addCompany($company);
    }
    
    public static function commit(){
        self::$index->commit();
    }
    
    public static function getInfo(){
        return array(
            "countAll" => self::$index->count(),
            "deleted" => self::$index->count() - self::$index->numDocs()
        );
    }
    
    public static function optimize(){
        self::$index->optimize();
    }
    
    static function find($searchRequest){  
        require_once 'QueryCorrector.php';        
        $hits = self::$index->find(
            QueryCorrector::correctForPhone($searchRequest)
        );
        
        $result = array();
        foreach ($hits as $hit) {
            /* @var $hit Zend_Search_Lucene_Search_QueryHit */
            $result[] = $hit->getDocument()->getFieldValue(Cons_Lucene::docId);
        }
        
        return $result;
    }
}

TextSearcher::init();

?>

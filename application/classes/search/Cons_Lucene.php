<?php

require_once 'Zend/Search/Lucene.php';
/**
 * Description of Cons_Lucene
 *
 * @author Старченко Галина
 */
class Cons_Lucene extends Zend_Search_Lucene {
    
    const docId = "docId";
    
    /**
     * Create index
     *
     * @param mixed $directory
     * @return Zend_Search_Lucene_Interface
     */
    public static function create($directory)
    {
        /** Zend_Search_Lucene_Proxy */
        require_once 'Zend/Search/Lucene/Proxy.php';

        return new Zend_Search_Lucene_Proxy(new Cons_Lucene($directory, true));
    }
    
    /**
     * Open index
     *
     * @param mixed $directory
     * @return Zend_Search_Lucene_Interface
     */
    public static function open($directory)
    {
        /** Zend_Search_Lucene_Proxy */
        require_once 'Zend/Search/Lucene/Proxy.php';

        return new Zend_Search_Lucene_Proxy(new Cons_Lucene($directory, false));
    }
    
    public function getFieldNames($indexed = false) {
        $fields = parent::getFieldNames($indexed);
        unset($fields[Cons_Lucene::docId]);
        return $fields;
    }
}

?>

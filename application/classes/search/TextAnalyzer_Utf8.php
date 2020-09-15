<?php

require_once 'filters/PhoneFilter.php';
require_once 'Zend/Search/Lucene/Analysis/TokenFilter/ShortWords.php';

/**
 * Description of TextAnalyzer_Utf8
 *
 * @author Galina Starchenko
 */
class TextAnalyzer_Utf8 extends Zend_Search_Lucene_Analysis_Analyzer_Common {

    static $tokenizeCache = array();
    protected $tokenizer_regexp = '/[\p{N}(+][\p{N} ()-]+[\p{N})]+|[\p{L}\p{N}]+/u'; // буквы+цифры
    protected $token_stack = array();
    
    /**
     * Current char position in an UTF-8 stream
     *
     * @var integer
     */
    private $_position;

    /**
     * Current binary position in an UTF-8 stream
     *
     * @var integer
     */
    private $_bytePosition;
    
    /**     
     * @var integer
     */
    protected $_minLength = 3;    

    /**
     * Object constructor
     *
     * @throws Zend_Search_Lucene_Exception
     */
    public function __construct()
    {
        if (@preg_match('/\pL/u', 'a') != 1) {
            // PCRE unicode support is turned off
            require_once 'Zend/Search/Lucene/Exception.php';
            throw new Zend_Search_Lucene_Exception('Utf8 analyzer needs PCRE unicode support to be enabled.');
        }
    }    

    /**
     * Reset token stream
     */
    public function reset() {
        $this->_position = 0;
        $this->_bytePosition = 0;
        
        // convert input into UTF-8
        if ($this->_encoding &&
            strcasecmp($this->_encoding, 'utf8' ) != 0  &&
            strcasecmp($this->_encoding, 'utf-8') != 0 ) {
                $this->_input = iconv($this->_encoding, 'UTF-8', $this->_input);
                $this->_encoding = 'UTF-8';
        }
        
        $this->addFilter(new Zend_Search_Lucene_Analysis_TokenFilter_LowerCaseUtf8());
        $this->addFilter(new PhoneFilter());
        $this->addFilter(new Zend_Search_Lucene_Analysis_TokenFilter_ShortWords($this->_minLength));
    }
    
    public function tokenize($data, $encoding = '') {
        if (isset(self::$tokenizeCache[$encoding][$data])){
            return self::$tokenizeCache[$encoding][$data];
        }
        require_once 'QueryCorrector.php';
        
        self::$tokenizeCache[$encoding][$data] = parent::tokenize(QueryCorrector::correctForPhone($data), $encoding);
        
        return self::$tokenizeCache[$encoding][$data];
    }

    /**
     * Tokenization stream API
     * Get next token
     * Returns null at the end of stream
     *
     * @return Zend_Search_Lucene_Analysis_Token|null
     */
    public function nextToken() {       
        if ($this->_input === null) {
            return null;
        }
                
        while (preg_match($this->tokenizer_regexp, $this->_input, $match, PREG_OFFSET_CAPTURE, $this->_bytePosition)) {

            // matched string
            $matched_word = $match[0][0];

            // binary position of the matched word in the input stream
            $bin_start_pos = $match[0][1];

            // character position of the matched word in the input stream
            $start_pos = $this->_position +
                    mb_strlen(substr($this->_input, $this->_bytePosition, $bin_start_pos - $this->_bytePosition));
            // character postion of the end of matched word in the input stream
            $end_pos = $start_pos + mb_strlen($matched_word);

            $this->_bytePosition = $bin_start_pos + strlen($matched_word);
            $this->_position = $end_pos;

            $token = $this->normalize(new Zend_Search_Lucene_Analysis_Token(
                        $matched_word, 
                        $start_pos, 
                        $start_pos + mb_strlen($matched_word)));            
            
            if ($token !== null)
                return $token;
        } 

        return null;
    }
}

?>

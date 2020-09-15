<?php

/**
 * Description of phoneFilter
 *
 * @author Galina Starchenko
 */
class PhoneFilter extends Zend_Search_Lucene_Analysis_TokenFilter {
     
    public function normalize(Zend_Search_Lucene_Analysis_Token $srcToken) {
        $tokenText = $srcToken->getTermText();
        
        if ((preg_match('/[\p{N}(+][\p{N} ()-]+[\p{N})]/u', $tokenText, $match, PREG_OFFSET_CAPTURE)) &&
            ($match[0][0] == $tokenText)) {
            
            $newToken = new Zend_Search_Lucene_Analysis_Token(
                                     preg_replace('/[ ()+-]/u', '', $tokenText),
                                     $srcToken->getStartOffset(),
                                     $srcToken->getEndOffset());

            $newToken->setPositionIncrement($srcToken->getPositionIncrement());

            return $newToken;
        }
        
        return $srcToken;
    }
}

?>

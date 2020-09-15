<?php

/**
 * Description of QueryCorrector
 *
 * @author Galina Starchenko
 */
abstract class QueryCorrector {    
    
    static function correctForPhone($query){       
        $bytePosition = 0;
        while (preg_match('/[\p{N}(+][\p{N} ()-]+[\p{N})]/u', $query, $match, PREG_OFFSET_CAPTURE, $bytePosition)) {
            $phone = $match[0][0];
            $bin_start_pos = $match[0][1];
            $start_pos = mb_strlen(substr($query, 0, $bin_start_pos));
            $bytePosition = $bin_start_pos + mb_strlen($match[0][0]);
            if ($phone){
                $query = mb_substr($query, 0, $start_pos).
                       str_replace(array(' ', '(', ')', '+'), '', $phone).
                       mb_substr($query, $start_pos+mb_strlen($match[0][0]));
                $bytePosition += 2;
            }
        }
        
        return $query;
    }
    
}

?>

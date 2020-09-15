<?php
/*
 * Создан: 25.01.2008 12:29:29
 * Автор: Александр Перов
 */ 
	
    
function smarty_make_timestamp($string)
{
    if(empty($string)) {
        // use "now":
        $time = time();

    } elseif (preg_match('/^\d{14}$/', $string)) {
        // it is mysql timestamp format of YYYYMMDDHHMMSS?            
        $time = mktime(substr($string, 8, 2),substr($string, 10, 2),substr($string, 12, 2),
                       substr($string, 4, 2),substr($string, 6, 2),substr($string, 0, 4));
        
    } elseif (is_numeric($string)) {
        // it is a numeric string, we handle it as timestamp
        $time = (int)$string;
        
    } else {
        // strtotime should handle it
        $time = strtotime($string);
        if ($time == -1 || $time === false) {
            // strtotime() was not able to parse $string, use "now":
            $time = time();
        }
    }
    return $time;

}

function smarty_modifier_date_format($string, $format = '%b %e, %Y', $default_date = '')
{
    if ($string != '') {
        $timestamp = smarty_make_timestamp($string);
    } elseif ($default_date != '') {
        $timestamp = smarty_make_timestamp($default_date);
    } else {
        return;
    }
    if (DIRECTORY_SEPARATOR == '\\') {
        $_win_from = array('%D',       '%h', '%n', '%r',          '%R',    '%t', '%T');
        $_win_to   = array('%m/%d/%y', '%b', "\n", '%I:%M:%S %p', '%H:%M', "\t", '%H:%M:%S');
        if (strpos($format, '%e') !== false) {
            $_win_from[] = '%e';
            $_win_to[]   = sprintf('%\' 2d', date('j', $timestamp));
        }
        if (strpos($format, '%l') !== false) {
            $_win_from[] = '%l';
            $_win_to[]   = sprintf('%\' 2d', date('h', $timestamp));
        }
        $format = str_replace($_win_from, $_win_to, $format);
    }
    return strftime($format, $timestamp);
}


function parseDate($text){
        
        $i = 0;
        $result = array();              
        $text = str_replace("\r","",$text);
        $resultArray = split("\n\n",$text); 
        
        foreach ($resultArray as $k => $v) {
            // текст с датой            
            $pattern = "/([0-9]{1,2})\.([0-9]{1,2}).([0-9]{4}|[0-9]{2})/i";
            
            if (trim($v) == "") continue;
            
            if (preg_match ($pattern, $v, $matches)) {                            
                $result[$i]['date'] = $matches[3]."-". $matches[2]."-".$matches[1]; 
                $result[$i]['text'] = trim(preg_replace ($pattern, "", $v));                
            } else {
                $result[$i]['date'] = '2000-01-01'; 
                $result[$i]['text'] = trim($v);
            }
            
            $i++;
        }       
        
        return $result;  
}

		
?>

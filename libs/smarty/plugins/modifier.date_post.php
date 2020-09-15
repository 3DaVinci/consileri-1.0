<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

include 'incl/multiple.php';

function smarty_modifier_date_post($string)
{
    $posted = strtotime($string);    
    
    //$delta = mktime(0, 0, 0, date("m",$delta), date("d",$delta), date("Y",$delta)) - $posted;
    
    //$delta = mktime(0, 0, 0, date("m"), date("d"), date("Y")) - $posted;
    
    $temp = time();
    $t2 = $temp - mktime(0,0,0,date("m"), date("d"), date("Y"));
    
    $delta = $temp - $posted;
    
    $date_next_d=date ("d", mktime(date("H",$delta) - date("H",$t2), date("i",$delta)- date("i",$t2), date("s",$delta- date("s",$t2)), date("m",$delta), date("d",$delta), date("Y",$delta))) - 1;
    $date_next_m=date ("m", mktime(date("H",$delta)- date("H",$t2), date("i",$delta)- date("i",$t2), date("s",$delta- date("s",$t2)), date("m",$delta), date("d",$delta), date("Y",$delta))) - 1;
    $date_next_y=date ("Y", mktime(date("H",$delta)- date("H",$t2), date("i",$delta)- date("i",$t2), date("s",$delta- date("s",$t2)), date("m",$delta), date("d",$delta), date("Y",$delta))) - 1970;               
    
    if ($date_next_d != 0 && $date_next_m != 0 && $date_next_y < 0) {
    	$text = "сегодня";
    } else if ($date_next_y == 0 && $date_next_m == 0 && $date_next_d == 0) {
    	$text = "вчера";
    } else if ($date_next_y == 0 && $date_next_m == 0 && $date_next_d >= 1) {    	
    	$text = rightWordWithNumber($date_next_d+1,Array(' день назад', ' дня назад', ' дней назад')); 
    } else if ($date_next_y == 0 && $date_next_m > 0) { 
    	if ($date_next_d!=0) {
    	$text = rightWordWithNumber($date_next_m,Array(" месяц"," месяца"," месяцев"))." ".
    			rightWordWithNumber($date_next_d+1,Array(' день назад', ' дня назад', ' дней назад'));
    	} else {
		$text = rightWordWithNumber($date_next_m,Array(" месяц назад"," месяца назад"," месяцев назад"));    		
    	}		
    } else if ($date_next_y > 0) {
    	$text = rightWordWithNumber($date_next_m,Array(" год"," года"," лет"))." ".
    			rightWordWithNumber($date_next_m,Array(" месяц"," месяца"," месяцев"))." ".
    			rightWordWithNumber($date_next_d+1,Array(' день назад', ' дня назад', ' дней назад'));    
    }
    
    return $text." в ".date("H:i",$posted);
}

/* vim: set expandtab: */

?>

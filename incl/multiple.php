<?php
/*
 * Создан: 29.11.2007 18:46:19
 * Автор: Александр Перов
 */ 


function rightWordWithNumber($number, $titles){
$cases = array (2, 0, 1, 1, 1, 2);
return $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
}


function comments_number() {

$number = 1;
$output = om_number($number, Array(_('коментарий'), _('коментария'), _('коментариев'))) . "\n";

}	
		
?>

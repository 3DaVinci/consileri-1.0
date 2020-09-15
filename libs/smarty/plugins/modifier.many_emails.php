<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


function smarty_modifier_many_emails($string)
{

	$emails = preg_split("/,/i",$string);
	$res = "";
	$first = true;
	foreach ($emails as $k => $v) {
		preg_match_all("/[^@]+@([a-z0-9\-]+\.)+[a-z]{2,4}/",trim($v),$match);
		//var_dump($match);
		if ($first) {
			if ($match[0][0]!="") {
				$res .= '<a href="mailto:'.$match[0][0].'" class="cLink">'.trim($v).'</a>';
				$first = false;
			}
		} else {
			if ($match[0][0]!="") {
				$res .= ', <a href="mailto:'.$match[0][0].'" class="cLink">'.trim($v).'</a>';
			}
		}

	}

	return ($res);
}



?>

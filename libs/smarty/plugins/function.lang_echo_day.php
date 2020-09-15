<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {popup} function plugin
 *
 * Type:     function<br>
 * Name:     popup<br>
 * Purpose:  make text pop up in windows via overlib
 * @link http://smarty.php.net/manual/en/language.function.popup.php {popup}
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_lang_echo_day($params, &$smarty)
{
    $retval = lang_echo_day ($params ['day'], $params ['month']);

    return $retval;
}

/* vim: set expandtab: */

?>

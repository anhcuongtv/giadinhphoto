<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty percent modifier plugin
 *
 * Type:     modifier<br>
 * Name:     percent<br>
 * Purpose:  convert number to percent format
 * @author   bloghoctap.com
 * @param string
 * @return string
 */
function smarty_modifier_percent($string)
{
	return ($string * 100) . '%';
}

?>

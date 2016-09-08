<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {counter} function plugin
 *
 * Type:     function<br>
 * Name:     counter<br>
 * Purpose:  print out a counter value
 * @author Monte Ohrt <monte at ohrt dot com>
 * @link http://smarty.php.net/manual/en/language.function.counter.php {counter}
 *       (Smarty online manual)
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_sidebar_news($params, &$smarty)
{
	global $registry;
	
	$latestNews = Core_News::getNews(array(), '', '', $registry->setting['news']['sidebarnews']);
	$output = '';
	for($i = 0; $i < count($latestNews); $i++)
	{
		$isnotfirst = '';
		if($i > 0)
		{
			$isnotfirst = ' sidebarnewsnotfirst';
		}
		
		$output .= '<p class="text sidebarnews '.$isnotfirst.'">
						<a class="sidebarnews_image" href="'.$latestNews[$i]->getFullUrl($registry->conf['rooturl']) .'"><img src="'.$registry->setting['news']['imageDirectory'] . $latestNews[$i]->getSmallImage().'" /></a>
						<a class="sidebarnews_title" href="'.$latestNews[$i]->getFullUrl($registry->conf['rooturl']) .'" title="'.$latestNews[$i]->name[$registry->langCode].'"><strong>'.$latestNews[$i]->name[$registry->langCode].'</strong></a>
						<p class="sidebarnews_summary">'.$latestNews[$i]->summary[$registry->langCode].'</p>
						<p class="sidebarnews_more"><a href="'.$latestNews[$i]->getFullUrl($registry->conf['rooturl']) .'" title="'.$latestNews[$i]->name[$registry->langCode].'">'.$registry->lang['controllergroup']['sidebarMoreNews'].' &raquo;</a></p>';
	}

	return $output;
    
}

/* vim: set expandtab: */

?>

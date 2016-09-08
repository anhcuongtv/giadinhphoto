<?php
require 'includes/config.php';
require 'includes/setting.php';
require 'includes/permission.php';
require 'includes/startup.php';
require 'controllers/core/class.base.php';
if(DEBUG)
{
	//for debug information
	$timer = new timer();
	$timer->start();
}

if($conf['usingGZIP'])
{
	ob_start();
	ob_implicit_flush(false);
} 
   
# Load router
$router = new Router($registry);
$registry->router = $router;
$router->setPath (SITE_PATH . 'controllers');
$router->delegate();

if(DEBUG)
{
	$timer->stop();
	$queryArray = $db->logQuery('', false, true);
	Helper::displayDebugInformation($conf, $timer->get_exec_time(), $queryArray);
}

if($conf['usingGZIP'])
{
	//Output the buffered data
	Helper::print_gzipped_page();
}




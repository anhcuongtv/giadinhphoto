<?php

	///////////////////////////////////////////////////////
	// Embed the viephp session mechanism
	//
	//author: voduytuan<tuanmaster2002@yahoo.com>
	//
	//
	
	$tinymce_imagemanager_path = 'libs'.DIRECTORY_SEPARATOR.'tiny_mce'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'imagemanager';
	$viephpDirName = str_replace($tinymce_imagemanager_path, '', dirname(__FILE__));

	include($viephpDirName.'includes'.DIRECTORY_SEPARATOR.'config.php');
	include($viephpDirName.'classes'.DIRECTORY_SEPARATOR.'class.dbsession.php');
	include($viephpDirName.'classes'.DIRECTORY_SEPARATOR.'class.helper.php');
	include($viephpDirName.'classes'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'class.object.php');
	include($viephpDirName.'classes'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'class.user.php');
	include($viephpDirName.'classes'.DIRECTORY_SEPARATOR.'class.mypdo.php');
	
	


	try 
	{
		$db = new MyPDO('mysql:host='.$conf['db']['host'].';dbname='.$conf['db']['name'].'', ''.$conf['db']['user'].'', ''.$conf['db']['pass'].'');
		$db->query('SET NAMES utf8');

	}
	catch(PDOException $e)
	{
		die('Database connection failed.');
	}

	$session = new dbsession($db);
	
	$registry = new ArrayObject();
	$registry->db = $db;
	$registry->conf = $conf;
	
	//end customize
?>

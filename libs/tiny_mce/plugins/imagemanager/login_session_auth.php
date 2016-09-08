<?php
	// Some settings
	$msg = "";
	$username = "demo";
	$password = ""; // Change the password to something suitable

	/*
	if (!$password)
		$msg = 'You must set a password in the file "login_session_auth.php" inorder to login using this page or reconfigure it the authenticator config options to fit your needs. Consult the <a href="http://wiki.moxiecode.com/index.php/Main_Page" target="_blank">Wiki</a> for more details.';

	if (isset($_POST['submit_button'])) {
		// If password match, then set login
		if ($_POST['login'] == $username && $_POST['password'] == $password && $password) {
			// Set session
			session_start();
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['user'] = $_POST['login'];

			// Override any config option
			//$_SESSION['imagemanager.filesystem.rootpath'] = 'some path';
			//$_SESSION['filemanager.filesystem.rootpath'] = 'some path';

			// Redirect
			header("location: " . $_POST['return_url']);
			die;
		} else
			$msg = "Wrong username/password.";
	}
	*/
	
	
	//viephp authenticate
	//create database connection
	include('viephp_adapter.php');
	
    
    if($_SESSION['userLogin'] >= 1)
    {
    	$me = new Core_User();  
		$me->updateFromSession();
		
		if($me->id > 0 && $me->groupid == GROUPID_ADMIN)
		{
			// Set session
			
			$_SESSION['isLoggedIn'] = true;

			// Override any config option
			//$_SESSION['imagemanager.filesystem.rootpath'] = 'some path';
			//$_SESSION['filemanager.filesystem.rootpath'] = 'some path';

			// Redirect
			$returnUrl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'index.php?type=im&page=index.html';
			header("location: " . $returnUrl);
			die;	
		}
	}
    
	
	
?>

<html>
<head>
<title>Sample login page</title>
<style>
body { font-family: Arial, Verdana; font-size: 11px; }

</style>
</head>
<body>

<div style="text-align:center;margin-top:50px;color:#f00;">
	<h1>Session is expired. Please login again!</h1>
</div>

</body>
</html>

<?php
error_reporting(E_ALL ^ E_NOTICE);

//Development Phase
ini_set("display_errors", 1);

//Production Phase
//ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", 'phperror.txt');
ini_set('register_globals', 'Off');
ini_set('default_charset', 'utf-8');
ini_set('session.name', 'SHASH');
ini_set('session.use_only_cookies', true);
ini_set('session.use_trans_sid', false);

date_default_timezone_set('Asia/Saigon');
set_time_limit(180);

$conf = array();
$conf['db']['host'] = 'localhost';
$conf['db']['name'] = 'gdcontest_swin';
$conf['db']['user'] = 'root';
$conf['db']['pass'] = 'root';
//$conf['db']['pass'] = '123456';

$conf['rootdomain'] = 'photo.local/';
//$conf['rootdomain'] = 'localhost/giadinhphoto/';
$conf['rooturl'] = 'http://' . $conf['rootdomain'];
$conf['rooturl_admin'] = 'http://' . $conf['rootdomain'] . 'admin/';

$conf['defaultLang'] = 'vn';
$conf['homepage'] = $conf['rooturl'];
$conf['cacheDirectory'] = 'uploads/cache/';
$conf['usingGZIP'] = true;



/**
   * Sets the SMTP hosts.  All hosts must be separated by a
   * semicolon.  You can also specify a different port
   * for each host by using this format: [hostname:port]
   * (e.g. "smtp1.example.com:25;smtp2.example.com").
   * Hosts will be tried in order.
   * @var string
   */


$conf['smtp']['enable'] = true;
$conf['smtp']['host'] = array('smtp.gmail.com','smtp.gmail.com','smtp.gmail.com','smtp.gmail.com','smtp.gmail.com','smtp.gmail.com');
$conf['smtp']['username'] = array('support@giadinhphoto.com','gdpc@giadinhphotocontest.com','gdpc2014@giadinhphoto.com','gdpc-2014@giadinhphoto.com','noreply@giadinhphotocontest.com','no-reply@giadinhphotocontest.com');
$conf['smtp']['password'] = array('N23462Waw','%=NnFy3a%=NnFy3a','Organization','Organization','noreplynoreply','OrganizationOrganization');


//	------------------------------
// 		CONSTANT DEFINE 
//	------------------------------
define ('TABLE_PREFIX', 'pex_');
define ('DEBUG', false);

$site_path = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
define ('SITE_PATH', $site_path);

define('GROUPID_GUEST', 0);
define('GROUPID_ADMIN', 1);
define('GROUPID_MODERATOR', 2);
define('GROUPID_JUDGE', 3);
define('GROUPID_MEMBER', 5);


?>
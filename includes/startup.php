<?php
spl_autoload_register('autoload1');


if (get_magic_quotes_gpc()) 
{
    function stripslashes_gpc(&$value)
    {
        $value = stripslashes($value);
    }
    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
}


//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//INIT REGISTRY VARIABLE - MAIN STORAGE OF APPLICATION
$registry = new Registry();

//=========================================================
//---IMPORTANT-------------------
// set base dir to correct the relative link

$route = parseRouterFromHtaccess(Router::initRoute('site'));

$parts = explode('/', $route);



if($parts[0])
{
	$GLOBALS['controller_group'] = $parts[0];
	$conf['servername'] = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $parts[0] . '/';    
}



if(!empty($parts[1]))
{
	$GLOBALS['controller'] = $parts[1];	
	if(!empty($parts[2]))
	{
		$GLOBALS['action'] = $parts[2];
	}
	else
	{
		$GLOBALS['action'] = 'index';
		$route = $GLOBALS['controller_group'] . '/' . $GLOBALS['controller'] . '/' . 'index';
	}
}
else
{
	$GLOBALS['controller'] = 'index';
	$GLOBALS['action'] = 'index';
	$route = $GLOBALS['controller_group'] . '/' . 'index' . '/' . 'index';
}



$GLOBALS['route'] = $route;
for ($i = 0; $i < count($parts) - 1; $i++)
{
	Registry::$base_dir .= '../';
}




//=========================================================
//connect to database using PDO
try 
{
	$db = new MyPDO('mysql:host=' . $conf['db']['host'] . ';dbname=' . $conf['db']['name'] . '', '' . $conf['db']['user'] . '', '' . $conf['db']['pass'] . '');
	$db->query('SET NAMES utf8');

}
catch(PDOException $e)
{
	die('Database connection failed.');
}
//unset the database config information for not leak security
unset($conf['db']);



$session = new dbsession($db);


//===================================================
//get language
if(isset($_GET['language']))
{
	$_SESSION['language'] = $_GET['language'];
	setcookie('language', $_GET['language'], time() + 24 * 3600, '/');
}

if(isset($_POST['language']))
{
	$_SESSION['language'] = $_POST['language'];
	setcookie('language', $_POST['language'], time() + 24 * 3600, '/');
}


//=============================
// CURRENCY INITIALIZATION
$currencyCode = $_SESSION['fcurrency'];

//set currency
if(isset($_GET['fcurrency']))
	$currencyCode = substr($_GET['fcurrency'], 0, 3);

if(isset($_POST['fcurrency']))
	$currencyCode = substr($_POST['fcurrency'], 0, 3);          
	
$_SESSION['fcurrency'] = $currencyCode;
setcookie('fcurrency', $currencyCode, time() + 24*3600);

//create currency object
$currency = new Currency($setting['payment']['vnd_to_usd_exchange']);



if(isset($_SESSION['language']))
	$langCode = $_SESSION['language'];
elseif(isset($_COOKIE['language']))
	$langCode = $_COOKIE['language'];
else
	$langCode = $conf['defaultLang']; 

$langCode = substr($langCode, 0, 2);	
			
//declare language variable
$lang = array();

if(file_exists('language' . DIRECTORY_SEPARATOR . $langCode . DIRECTORY_SEPARATOR . $GLOBALS['controller_group']))
{
	$lang['global'] = Helper::GetLangContent('language' . DIRECTORY_SEPARATOR  . $langCode . DIRECTORY_SEPARATOR, 'global'); 
	$lang['controllergroup'] = Helper::GetLangContent('language' . DIRECTORY_SEPARATOR . $langCode . DIRECTORY_SEPARATOR . $GLOBALS['controller_group'] . DIRECTORY_SEPARATOR, 'default');
	$lang['controller'] = Helper::GetLangContent('language' . DIRECTORY_SEPARATOR . $langCode . DIRECTORY_SEPARATOR . $GLOBALS['controller_group'] . DIRECTORY_SEPARATOR, $GLOBALS['controller']);
}
else
{
	$lang['global'] = Helper::GetLangContent('language' . DIRECTORY_SEPARATOR  . $conf['defaultLang'] . DIRECTORY_SEPARATOR, 'global'); 
	$lang['controllergroup'] = Helper::GetLangContent('language' . DIRECTORY_SEPARATOR . $conf['defaultLang'] . DIRECTORY_SEPARATOR . $GLOBALS['controller_group'] . DIRECTORY_SEPARATOR, 'default');
	$lang['controller'] = Helper::GetLangContent('language' . DIRECTORY_SEPARATOR . $conf['defaultLang'] . DIRECTORY_SEPARATOR . $GLOBALS['controller_group'] . DIRECTORY_SEPARATOR, $GLOBALS['controller']);
}


//register an object to hold all global objects
$registry->conf = $conf;
$registry->db = $db;
$registry->setting = $setting;
$registry->lang = $lang;
$registry->langCode = $langCode;
$registry->currency = $currency; 
$registry->controller = $GLOBALS['controller'];  
$registry->controllerGroup = $GLOBALS['controller_group']; 


$me = new Core_User();  
$me->updateFromSession();
$me->checkPerm();
$registry->me = $me; 





//Include Smarty class
include(SITE_PATH. 'libs' . DIRECTORY_SEPARATOR . 'smarty' . DIRECTORY_SEPARATOR . 'Smarty.class.php');
$smarty = new Smarty();

//set current template
$currentTemplate = (isset($setting['general_defaultTemplate']) && $setting['general_defaultTemplate'] != '') ? $setting['general_defaultTemplate'] : 'default';
$registry->currentTemplate = $currentTemplate;

$registry->staticserver = getStaticServer();	//detect server for en/vn base on language

$smarty->template_dir = 'templates/' . $currentTemplate;
$smarty->compile_dir = 'templates/_core/templates_c/';
$smarty->config_dir = 'templates/_core/configs/';
$smarty->cache_dir = 'templates/_core/cache/';
$smarty->compile_id = $currentTemplate;	//seperate compiled template file 
$smarty->error_reporting = E_ALL ^ E_NOTICE ^ E_DEPRECATED;

$smarty->assign(array('base_dir' => Registry::$base_dir,
					  'langCode' => $langCode,
					  'lang' => $lang,
					  'currency'	=> $currency,                
					  'setting'	=> $setting,
					  'controller' => $GLOBALS['controller'],
					  'controllerGroup' => $GLOBALS['controller_group'],
					  'action' => $GLOBALS['action'], 
					  'redirect' => base64_encode($GLOBALS['route']),
					  'currentTemplate'	=> $currentTemplate,
					  'staticserver'	=> $registry->staticserver,
					  'paginateLang' 	=> array('first' 			=> $lang['global']['navpageFirst'],
												'last' 				=> $lang['global']['navpageLast'],
												'firstTooltip' 		=> $lang['global']['navpageFirstTooltip'],
												'lastTooltip' 		=> $lang['global']['navpageLastTooltip'],
												'previous'			=> $lang['global']['navpagePrevious'],
												'next' 				=> $lang['global']['navpageNext'],
												'previousTooltip' 	=> $lang['global']['navpagePreviousTooltip'],
												'nextTooltip' 		=> $lang['global']['navpageNextTooltip'],
												'pageTooltip' 		=> $lang['global']['navpagePageTooltip']),
					  'me' => $me,
					  'conf' => $conf));
$registry->smarty = $smarty;





					  


//PREVENT FLOOD---------------------------
/*
$floodExpire = 0; //unit:second : nen dung <= 3; boi vi fu thuoc vao trang redirect.

if(!isset($_SESSION['floodLastAccess']) || (time() - $_SESSION['floodLastAccess']) > $floodExpire)
{
	$_SESSION['floodLastAccess'] = time();	
}
else 
{
	$route = empty($_GET['route']) ? 'index' : $_GET['route'];
	$noCheckFloodController = array('captcha','redirect'', 'cart');
	$parts = explode('/', $route, 2);
	
	//kiem tra xem co nen chong flood cho cac controller trong array nocheckfloodcontroller
	if(!in_array($parts[0],$noCheckFloodController))
	{
		//redirect flood notify page
		$registry->smarty->assign(array('redirectMsg' 	=> 'floodWaitNotify',
											'redirect' 		=> $_GET['route'],
											'base_dir' => Registry::$base_dir));
		$registry->smarty->display('redirect.tpl');
		die();
	}
	
	
}
*/

Helper::fixBackButtonOnIE();

/**
* Ham dung de tang performance, giam request toi main domain
* trong truong hop request toi cac static resource nhu js,css,image layout
* 
*/
function getStaticServer()
{
	global $setting, $langCode;
	
	if(isset($setting['extra']['staticserver'][$langCode]))
	{
		$staticserver = $setting['extra']['staticserver'][$langCode];
	}
	else
	{
		$staticserver = $setting['extra']['staticserver']['vn'];
	}
	
	return $staticserver;
}


function autoload1($classname)
{
	$namepart = explode('_', $classname);
	$namepartCount = count($namepart);
	
	if($namepartCount > 1)
	{
		if($namepart[0] == 'Controller')
		{
			$filepath = '';
			for($i = 1; $i < $namepartCount - 1; $i++)
			{
				$filepath .= strtolower($namepart[$i]) . DIRECTORY_SEPARATOR;
			}
			$filename = SITE_PATH . 'controllers' . DIRECTORY_SEPARATOR . $filepath . 'class.' . strtolower($namepart[$namepartCount - 1]) . '.php';
		}
		else
		{
			$filepath = '';
			for($i = 0; $i < $namepartCount - 1; $i++)
			{
				$filepath .= strtolower($namepart[$i]) . DIRECTORY_SEPARATOR;
			}
			$filename = SITE_PATH . 'classes' . DIRECTORY_SEPARATOR . $filepath . 'class.' . strtolower($namepart[$namepartCount - 1]) . '.php';
		}
		
	}
	else
		$filename = SITE_PATH . 'classes' . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
		
	
	if (file_exists($filename) == false) 
	{
		return false;
	}
	

	include ($filename);
}



function myGlobalException($exception)
{
	$message = 'Unknown Error';
	$redirectUrl = '/';
	header('location: ' . $conf['rooturl'] . 'redirect/go/url/' . base64_encode($redirectUrl) . '/msg/' . base64_encode($message) . '');
	//echo "<b>Exception:</b> " , $exception->getMessage();
}

//set_exception_handler('myGlobalException');

/////////////////////////////////////////////////
/////////////////////////////////////////////////
//REWRITE RULE FOR WEBSITE HERE
function parseRouterFromHtaccess($route)
{
	global $conf,$catMap;

	$parts = explode('/', $route);

	//not check URL Rewrite if admin controller group
	if($parts[0] == 'admin' || $parts[0] == 'site')
		return $route;
	//echo $route;
	
	
	$controllergroup = '';
	$controller = '';
	$action = '';
	$routerArgString = '';
	$isEntryController = false;	//bien de kiem tra xem dang xem cac trang entry, dung cho fix category seo slash
	$isSorting = false;	//neu dang xem trang entry ma co su dung sorting thi bien nay se gan thanh true, dung cho fix category seo slash
	
	for($i = 0; $i < count($parts); $i++)
	{
		$partValue = $parts[$i];   
		
		if(preg_match('/article-([a-z0-9]+)\.html/', $partValue, $match))  //normal controller, such as(login,logout,register,tos,...)
		{
			$controllergroup = 'site';
			$controller = 'page';
			$action = 'index';
			$routerArgString .= 'seourl/'.$match[1].'/';
		}
		elseif(preg_match('/trang-(\d+)/', $partValue, $match)) //this is a page group: trang-1, trang-2...
		{
			$routerArgString .= 'page/' . $match[1] . '/';
		}
		else if(preg_match('/[a-z0-9\._-]+-(\d+)\.html/', $partValue, $match)) //get detail action
		{
			if($action != 'edit' && $action != 'delete' && $action != 'rate')
				$action = 'detail';
				
			$routerArgString .= 'id/' . $match[1] . '/';
		}
		else if($partValue == 'rss')
		{
			$controllergroup = 'site';
			$controller = 'rss';
			$action = 'index';
		}
		else if($partValue == 'sitemap.xml')
		{
			$controllergroup = 'site';
			$controller = 'sitemapxml';
			$action = 'index';
		}
		else if($partValue == 'add' || $partValue == 'edit' || $partValue == 'delete' || $partValue == 'rate') //check action
		{
			$action = $partValue;
		}
		else if(preg_match('/([a-z]+)\.html/', $partValue, $match))  //normal controller, such as(login,logout,register,tos,...)
		{
			$controllergroup = 'site';
			$controller = $match[1];
			$action = 'index';
		}
		else if($partValue == 'oldest')
		{
			$routerArgString .= 'sortby/id/sorttype/ASC/';
			$isSorting = true;
		}
		else if($partValue == 'toprate')
		{
			$routerArgString .= 'sortby/rating/sorttype/DESC/';
			$isSorting = true;
		}
		else if($partValue == 'topview')
		{
			$routerArgString .= 'sortby/view/sorttype/DESC/';
			$isSorting = true;
		}
		else if($partValue == 'topplay')
		{
			$routerArgString .= 'sortby/play/sorttype/DESC/';
			$isSorting = true;
		}
		else if(preg_match('/^[a-z0-9_]+$/', $partValue, $match))  //user controller
		{                            
			$controllergroup = 'site';
			$controller = 'user';
			$action = 'index';
			$routerArgString .= 'username/' . $match[0] . '/';
		}
		else if(strlen($partValue) > 0)
		{
			$routerArgString .= $partValue . '/';
		}
	}
	
	//fix category seo url (not end with slash /)
	if($isEntryController && $action == 'index' && !$isSorting)
	{
		//kiem tra neu ky tu cuoi khong phai la slash thi them slash va redirect
		if($_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI'])-1] != '/')
		{
			$fixedUrl = $conf['rooturl'] . substr($_SERVER['REQUEST_URI'],1) . '/';	//substr request_uri de bo dau / dau tien
			Header( "HTTP/1.1 301 Moved Permanently" );
 			Header( "Location: " . $fixedUrl );

		}
	}
	
	$route = '';
	if($controllergroup != '')
		$route .= $controllergroup . '/';
	if($controller != '')
		$route .=  $controller . '/' ;
	if($action != '')
		$route .= $action . '/';
	if($routerArgString != '')
		$route .= $routerArgString;
	//echo $route;
	//exit();
	return $route;
}
    
function echodebug($data, $die=false)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	
	if($die) die();
}
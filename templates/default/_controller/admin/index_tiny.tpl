<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>{$lang.controllergroup.adminPanel} &raquo; {$pageTitle|default:$lang.controllergroup.menuDashboard}</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="{$currentTemplate}/styles/admin/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="{$currentTemplate}/styles/admin/style.css" type="text/css" media="screen" />
        
        
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="{$currentTemplate}/styles/admin/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
        <link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
		-->
		<link rel="stylesheet" href="{$currentTemplate}/styles/admin/blue.css" type="text/css" media="screen" />
		
		
	 
		
		

		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="{$currentTemplate}/styles/admin/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		
		<link rel="stylesheet" href="{$currentTemplate}/styles/admin/mystyle.css" type="text/css" media="screen" />
		
		
		<!--                       Javascripts                       -->
	  
		<!-- jQuery -->
		<script type="text/javascript" src="{$currentTemplate}/jscripts/jquery.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="{$currentTemplate}/jscripts/simpla.jquery.configuration.js"></script>
		
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="{$currentTemplate}/jscripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
        
		<!-- admin -->
		<script type="text/javascript" src="{$currentTemplate}/jscripts/admin.js"></script>
		
		
        <script type="text/javascript">
		var rooturl = "{$conf.rooturl}";
		var rooturl_admin = "{$conf.rooturl_admin}";
		var controllerGroup = "{$controllerGroup}";
		var currentTemplate = "{$currentTemplate}";
		var delConfirm = "Are You Sure?";
		var delPromptYes = "Type YES to continue";
		</script>
		
	</head>
    
    <body style="background-image: none;"><div id="body-wrapper" style="background-position:0 0;"> <!-- Wrapper for the radial gradient background -->
		
		
        <div id="main-content" style="margin: 0 30px;"> <!-- Main Content Section with everything -->
		
		{include file="admin_maincontent.tpl"}
		
		{include file="admin_footer.tpl"}
		
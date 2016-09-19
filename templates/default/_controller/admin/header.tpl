<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>{$lang.controllergroup.adminPanel} &raquo; {$pageTitle|default:$lang.controllergroup.menuDashboard}</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="{$currentTemplate}/css/admin/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="{$currentTemplate}/css/admin/style.css" type="text/css" media="screen" />
        
        
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="{$currentTemplate}/css/admin/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
        <link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
		-->
		<link rel="stylesheet" href="{$currentTemplate}/css/admin/blue.css" type="text/css" media="screen" />
		
		
	 
		
		

		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="{$currentTemplate}/css/admin/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		
		<link rel="stylesheet" href="{$currentTemplate}/css/admin/mystyle.css" type="text/css" media="screen" />
		
		
		<!--                       Javascripts                       -->
	  
		<!-- jQuery -->
		<script type="text/javascript" src="{$currentTemplate}/js/jquery.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="{$currentTemplate}/js/admin/simpla.jquery.configuration.js"></script>
		
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="{$currentTemplate}/js/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
        
		<!-- admin -->
		<script type="text/javascript" src="{$currentTemplate}/js/admin/admin.js"></script>
		
		
        <script type="text/javascript">
		var rooturl = "{$conf.rooturl}";
		var rooturl_admin = "{$conf.rooturl_admin}";
		var controllerGroup = "{$controllerGroup}";
		var currentTemplate = "{$currentTemplate}";
		var delConfirm = "Are You Sure?";
		var delPromptYes = "Type YES to continue";
		</script>
		
	</head>
    
    <body>
	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="{$conf.rooturl_admin}">{$lang.controllergroup.adminPanel}</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="{$conf.rooturl_admin}"><img id="logo" src="{$currentTemplate}/images/admin/logo.png" alt="Admin logo" /></a>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				{$lang.controllergroup.hi} <a href="{$conf.rooturl_admin}user/edit/id/{$me->id}" title="{$lang.controllergroup.editProfileTooltip}">{$me->username}</a> | <a href="{$conf.rooturl}site/logout" title="{$lang.controllergroup.logoutTooltip}">{$lang.controllergroup.logout}</a><br />
				<br />
				 <form name="currencyForm" method="post" action="">
				<a href="{$conf.rooturl}" target="_blank" title="{$lang.controllergroup.gotoHomepageTooltip}">{$lang.controllergroup.gotoHomepage}</a> | <a href="?language=vn" title="Vietnamese"><img src="{$currentTemplate}/images/admin/flag_vn.png" alt="vn" {if $langCode == 'vn'}class="language_flag_current"{/if} /></a> <a href="?language=en" title="English"><img src="{$currentTemplate}/images/admin/flag_en.png" alt="en" {if $langCode == 'en'}class="language_flag_current"{/if} /></a> |<select style="border: 1px solid rgb(221, 221, 221); font-size: 10px; padding:0;" onchange="javascript:document.currencyForm.submit();" name="fcurrency"><option value="usd" {if $currency->currencyCode == 'usd'}selected="selected"{/if}>USD</option><option value="vnd" {if $currency->currencyCode == 'vnd'}selected="selected"{/if}>VND</option></select>
				</form>
			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
                
                <li>
                	<a href="#" class="nav-top-item" id="menu_user">{$lang.controllergroup.menuUser}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}user" id="menu_userlist">{$lang.controllergroup.menuUserList}</a></li>
						<li><a href="{$conf.rooturl_admin}user/export" id="menu_userexport">Export</a></li>
                        <li><a href="{$conf.rooturl_admin}log" id="menu_log">{$lang.controllergroup.menuAdminLog}</a></li>
                    </ul>
                </li> 
                
                <li>
                	<a href="#" class="nav-top-item" id="menu_contestphoto">{$lang.controllergroup.menuPhoto}</a>
                    <ul>
						<li><a href="{$conf.rooturl_admin}contestphotogroup" id="menu_contestphotogroup">{$lang.controllergroup.menuPhotoGroup}</a></li>
                    	<li><a href="{$conf.rooturl_admin}contestphoto" id="menu_contestphotolist">{$lang.controllergroup.menuPhotoList}</a></li>
						<li><a href="{$conf.rooturl_admin}contestphotoready" id="menu_contestphotoreadylist">{$lang.controllergroup.menuPhotoContestReadyList}</a></li>
                    </ul>
                </li> 
                
               <li>
                	<a href="#" class="nav-top-item" id="menu_product">{$lang.controllergroup.menuProduct}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}product" id="menu_productlist">{$lang.controllergroup.menuProductList}</a></li>
						<li><a href="{$conf.rooturl_admin}order" id="menu_order">{$lang.controllergroup.menuOrder}</a></li>
                    </ul>
                </li> 
				
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_news">{$lang.controllergroup.menuNews}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}news" id="menu_newslist">{$lang.controllergroup.menuNewsList}</a></li>
						<li><a href="{$conf.rooturl_admin}news/add" id="menu_newsadd">{$lang.controllergroup.menuNewsAdd}</a></li>
						<li><a href="{$conf.rooturl_admin}newscategory" id="menu_newscategorylist">{$lang.controllergroup.menuNewsCategoryList}</a></li>
						<li><a href="{$conf.rooturl_admin}newscategory/add" id="menu_newscategoryadd">{$lang.controllergroup.menuNewsCategoryAdd}</a></li>
                    </ul>
                </li> 
                
               
								
				<li style="display:none;">
                	<a href="#" class="nav-top-item" id="menu_news">{$lang.controllergroup.menuNews}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}news" id="menu_newslist">{$lang.controllergroup.menuNewsList}</a></li>
						<li><a href="{$conf.rooturl_admin}news/add" id="menu_newsadd">{$lang.controllergroup.menuNewsAdd}</a></li>
						<li><a href="{$conf.rooturl_admin}newscategory" id="menu_newscategorylist">{$lang.controllergroup.menuNewsCategoryList}</a></li>
						<li><a href="{$conf.rooturl_admin}newscategory/add" id="menu_newscategoryadd">{$lang.controllergroup.menuNewsCategoryAdd}</a></li>
                    </ul>
                </li> 
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_page">{$lang.controllergroup.menuPage}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}page" id="menu_pagelist">{$lang.controllergroup.menuPageList}</a></li>
						<li><a href="{$conf.rooturl_admin}page/add" id="menu_pageadd">{$lang.controllergroup.menuPageAdd}</a></li>
                    </ul>
                </li> 
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_round">{$lang.controllergroup.menuRound}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}round" id="menu_roundlist">{$lang.controllergroup.menuRoundList}</a></li>
						<li><a href="{$conf.rooturl_admin}round/add" id="menu_roundadd">{$lang.controllergroup.menuRoundAdd}</a></li>
                    </ul>
                </li> 
                
                <li>
                	<a href="#" class="nav-top-item" id="menu_award">{$lang.controllergroup.menuAward}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}contestaward" id="menu_awardlist">{$lang.controllergroup.menuAwardList}</a></li>
						<li><a href="{$conf.rooturl_admin}contestaward/add" id="menu_awardadd">{$lang.controllergroup.menuAwardAdd}</a></li>
                    </ul>
                </li> 
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_judger">{$lang.controllergroup.menuJudger}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}judger" id="menu_judgerlist">{$lang.controllergroup.menuJudgerList}</a></li>
						<li><a href="{$conf.rooturl_admin}judger/add" id="menu_judgeradd">{$lang.controllergroup.menuJudgerAdd}</a></li>
                    </ul>
                </li> 
				
				<li style="display:none;">
                	<a href="#" class="nav-top-item" id="menu_page">{$lang.controllergroup.menuBanner}</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}banner" id="menu_bannerlist">{$lang.controllergroup.menuBannerList}</a></li>
						<li><a href="{$conf.rooturl_admin}banner/add" id="menu_banneradd">{$lang.controllergroup.menuBannerAdd}</a></li>
						<li><a href="{$conf.rooturl_admin}bannerposition" id="menu_bannerpositionlist">{$lang.controllergroup.menuBannerPositionList}</a></li>
						<li><a href="{$conf.rooturl_admin}bannerposition/add" id="menu_bannerpositionadd">{$lang.controllergroup.menuBannerPositionAdd}</a></li>
                    </ul>
                </li>   
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_tool">Tools</a>
                    <ul>
                    	<li><a href="{$conf.rooturl_admin}contact" id="menu_contact">{$lang.controllergroup.menuContact}</a></li>
						<li><a href="{$conf.rooturl_admin}language" id="menu_language">Language</a></li>
                    </ul>
                </li>                		
				  
				
			</ul> <!-- End #main-nav -->
            
            <script type="text/javascript">
				var curMenu = "{$menu}";
				{literal}
					if(curMenu.length > 0)
					{
						$("#menu_" + curMenu).addClass('current');
						
						//curMenu is submenu, select parent menu
						if($("#menu_" + curMenu).hasClass('nav-top-item') == false)
						{
							$("#menu_" + curMenu).parent().parent().prev().addClass('current');	
						}
					}
					
				{/literal}
			</script>
			
			
		</div></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->
		
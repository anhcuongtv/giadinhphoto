<?php /* Smarty version 2.6.26, created on 2016-09-09 13:39:11
         compiled from _controller/admin/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '_controller/admin/header.tpl', 8, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title><?php echo $this->_tpl_vars['lang']['controllergroup']['adminPanel']; ?>
 &raquo; <?php echo ((is_array($_tmp=@$this->_tpl_vars['pageTitle'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['lang']['controllergroup']['menuDashboard']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['lang']['controllergroup']['menuDashboard'])); ?>
</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/admin/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/admin/style.css" type="text/css" media="screen" />
        
        
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/admin/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
        <link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
		-->
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/admin/blue.css" type="text/css" media="screen" />
		
		
	 
		
		

		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/admin/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/css/admin/mystyle.css" type="text/css" media="screen" />
		
		
		<!--                       Javascripts                       -->
	  
		<!-- jQuery -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/js/jquery.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/js/admin/simpla.jquery.configuration.js"></script>
		
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/js/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
        
		<!-- admin -->
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/js/admin/admin.js"></script>
		
		
        <script type="text/javascript">
		var rooturl = "<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
";
		var rooturl_admin = "<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
";
		var controllerGroup = "<?php echo $this->_tpl_vars['controllerGroup']; ?>
";
		var currentTemplate = "<?php echo $this->_tpl_vars['currentTemplate']; ?>
";
		var delConfirm = "Are You Sure?";
		var delPromptYes = "Type YES to continue";
		</script>
		
	</head>
    
    <body>
	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['adminPanel']; ?>
</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
"><img id="logo" src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/logo.png" alt="Admin logo" /></a>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				<?php echo $this->_tpl_vars['lang']['controllergroup']['hi']; ?>
 <a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user/edit/id/<?php echo $this->_tpl_vars['me']->id; ?>
" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['editProfileTooltip']; ?>
"><?php echo $this->_tpl_vars['me']->username; ?>
</a> | <a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/logout" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['logoutTooltip']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['logout']; ?>
</a><br />
				<br />
				 <form name="currencyForm" method="post" action="">
				<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['lang']['controllergroup']['gotoHomepageTooltip']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['gotoHomepage']; ?>
</a> | <a href="?language=vn" title="Vietnamese"><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/flag_vn.png" alt="vn" <?php if ($this->_tpl_vars['langCode'] == 'vn'): ?>class="language_flag_current"<?php endif; ?> /></a> <a href="?language=en" title="English"><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/flag_en.png" alt="en" <?php if ($this->_tpl_vars['langCode'] == 'en'): ?>class="language_flag_current"<?php endif; ?> /></a> |<select style="border: 1px solid rgb(221, 221, 221); font-size: 10px; padding:0;" onchange="javascript:document.currencyForm.submit();" name="fcurrency"><option value="usd" <?php if ($this->_tpl_vars['currency']->currencyCode == 'usd'): ?>selected="selected"<?php endif; ?>>USD</option><option value="vnd" <?php if ($this->_tpl_vars['currency']->currencyCode == 'vnd'): ?>selected="selected"<?php endif; ?>>VND</option></select>
				</form>
			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
                
                <li>
                	<a href="#" class="nav-top-item" id="menu_user"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuUser']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user" id="menu_userlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuUserList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user/export" id="menu_userexport">Export</a></li>
                        <li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
log" id="menu_log"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuAdminLog']; ?>
</a></li>
                    </ul>
                </li> 
                
                <li>
                	<a href="#" class="nav-top-item" id="menu_contestphoto"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPhoto']; ?>
</a>
                    <ul>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphotogroup" id="menu_contestphotogroup"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPhotoGroup']; ?>
</a></li>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphoto" id="menu_contestphotolist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPhotoList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestphotoready" id="menu_contestphotoreadylist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPhotoContestReadyList']; ?>
</a></li>
                    </ul>
                </li> 
                
               <li>
                	<a href="#" class="nav-top-item" id="menu_product"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuProduct']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
product" id="menu_productlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuProductList']; ?>
</a></li>
						
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order" id="menu_order"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuOrder']; ?>
</a></li>
                    </ul>
                </li> 
				
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_news"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNews']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news" id="menu_newslist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/add" id="menu_newsadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsAdd']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory" id="menu_newscategorylist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsCategoryList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/add" id="menu_newscategoryadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsCategoryAdd']; ?>
</a></li>
                    </ul>
                </li> 
                
               
								
				<li style="display:none;">
                	<a href="#" class="nav-top-item" id="menu_news"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNews']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news" id="menu_newslist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
news/add" id="menu_newsadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsAdd']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory" id="menu_newscategorylist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsCategoryList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
newscategory/add" id="menu_newscategoryadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuNewsCategoryAdd']; ?>
</a></li>
                    </ul>
                </li> 
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_page"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPage']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
page" id="menu_pagelist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPageList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
page/add" id="menu_pageadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuPageAdd']; ?>
</a></li>
                    </ul>
                </li> 
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_round"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuRound']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
round" id="menu_roundlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuRoundList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
round/add" id="menu_roundadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuRoundAdd']; ?>
</a></li>
                    </ul>
                </li> 
                
                <li>
                	<a href="#" class="nav-top-item" id="menu_award"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuAward']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestaward" id="menu_awardlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuAwardList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contestaward/add" id="menu_awardadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuAwardAdd']; ?>
</a></li>
                    </ul>
                </li> 
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_judger"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuJudger']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
judger" id="menu_judgerlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuJudgerList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
judger/add" id="menu_judgeradd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuJudgerAdd']; ?>
</a></li>
                    </ul>
                </li> 
				
				<li style="display:none;">
                	<a href="#" class="nav-top-item" id="menu_page"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuBanner']; ?>
</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
banner" id="menu_bannerlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuBannerList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
banner/add" id="menu_banneradd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuBannerAdd']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
bannerposition" id="menu_bannerpositionlist"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuBannerPositionList']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
bannerposition/add" id="menu_bannerpositionadd"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuBannerPositionAdd']; ?>
</a></li>
                    </ul>
                </li>   
				
				<li>
                	<a href="#" class="nav-top-item" id="menu_tool">Tools</a>
                    <ul>
                    	<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
contact" id="menu_contact"><?php echo $this->_tpl_vars['lang']['controllergroup']['menuContact']; ?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
language" id="menu_language">Language</a></li>
                    </ul>
                </li>                		
				  
				
			</ul> <!-- End #main-nav -->
            
            <script type="text/javascript">
				var curMenu = "<?php echo $this->_tpl_vars['menu']; ?>
";
				<?php echo '
					if(curMenu.length > 0)
					{
						$("#menu_" + curMenu).addClass(\'current\');
						
						//curMenu is submenu, select parent menu
						if($("#menu_" + curMenu).hasClass(\'nav-top-item\') == false)
						{
							$("#menu_" + curMenu).parent().parent().prev().addClass(\'current\');	
						}
					}
					
				'; ?>

			</script>
			
			
		</div></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->
		
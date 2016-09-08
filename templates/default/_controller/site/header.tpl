<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>{if $pageTitle != ''}{$pageTitle}{else}{$setting.site.defaultPageTitle}{/if}</title>
<meta name="author" content="iMS Vietnam, support@imsvietnam.com" />
<meta name="keywords" content="{$pageKeyword|default:$setting.site.defaultPageKeyword}" />
<meta name="description" content="{$pageDescription|default:$setting.site.defaultPageDescription}" />
<meta name="robots" content="index,follow" />
<link href="{$staticserver}{$currentTemplate}/css/style.css" rel="stylesheet" type="text/css" media="screen,print" />
<link rel="shortcut icon" href="favicon.ico" />
<link href="{$staticserver}{$currentTemplate}/css/shadowbox.css" rel="stylesheet" type="text/css" media="screen,print" />
<script type="text/javascript">
	var rooturl = "{$conf.rooturl}";
	var currentTemplate = "{$currentTemplate}";
	var delConfirm = "{$lang.controllergroup.jsDelConfirm}";
</script>
</head>
<body>

	<div id="wrapper" class="{if $controller != 'memberarea'}wrapperborder{/if}">
	{if $controller == 'index'}
		<div id="home">
            <div id="positionlogo">
                <div id="homelogo">
                    <img src="{$setting.extra.staticserver.vn}default/images/gdpc-contest-2012.png" />
                </div>
                
                {*<div id="exhibition">
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                </div> *}
            </div>
            <div id="header">
            <div class="topbar">
                <div class="left">
                    <div>
                        <ul>
                <li><a {if $controller == 'index'}class="active"{/if} href="{$conf.rooturl}" title="{$lang.controllergroup.mHome}">{$lang.controllergroup.mHome}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'rules'}class="active"{/if} href="{$conf.rooturl}article-rules.html" title="{$lang.controllergroup.mRule}">{$lang.controllergroup.mRule}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'awards'}class="active"{/if} href="{$conf.rooturl}article-awards.html" title="{$lang.controllergroup.mAward}">{$lang.controllergroup.mAward}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'judge'}class="active"{/if} href="{$conf.rooturl}article-judge.html" title="{$lang.controllergroup.mJudge}">{$lang.controllergroup.mJudge}</a></li>
                <li><a {if $controller == 'statuslist'}class="active"{/if} href="{$conf.rooturl}site/statuslist/index" title="{$lang.controllergroup.mStatuslist}">{$lang.controllergroup.mStatuslist}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'instruction'}class="active"{/if} href="{$conf.rooturl}article-instruction.html" title="{$lang.controllergroup.mInstruction}">{$lang.controllergroup.mInstruction}</a></li>
                <li><a {if $controller == 'memberarea' || $controller == 'login' || $controller == 'register'}class="active"{/if} href="{$conf.rooturl}memberarea.html" title="{$lang.controllergroup.mMemberarea}">{$lang.controllergroup.mMemberarea}</a></li>
                                                <li><a {if $controller == 'page' && $pagename == 'photo'}class="active"{/if} href="{$conf.rooturl}site/photo/index" title="{$lang.controllergroup.mPhotos}">{$lang.controllergroup.mPhotos}</a></li>

            </ul>
                    </div>
                </div>
                <div class="right">
                    <a href="?language=vn"><img src="{$staticserver}{$currentTemplate}/images/img_vietnam.gif" alt="VN" /></a>
                    <a href="?language=en"><img src="{$staticserver}{$currentTemplate}/images/img_english.gif" alt="EN" /></a>
                </div>
            </div>
        </div>
		</div><!-- end #home -->
	{else}
        <div id="positionlogo">
                <div id="homelogo">
                    <img src="{$setting.extra.staticserver.vn}default/images/gdpc-contest-2012.png" />
                </div>
                {*
                <div id="exhibition">
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                    <div class="logo"><a href="#" title="exhibition"><img src="{$setting.extra.staticserver.vn}default/images/exhibition/fiap.gif" alt="" /></a></div>
                </div>
                *}
            </div>
		<div id="header">
			<div class="topbar">
				<div class="left">
                    <div>
                        <ul>
                <li><a {if $controller == 'page' && $pagename == 'home'}class="active"{/if} href="{$conf.rooturl}" title="{$lang.controllergroup.mHome}">{$lang.controllergroup.mHome}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'rules'}class="active"{/if} href="{$conf.rooturl}article-rules.html" title="{$lang.controllergroup.mRule}">{$lang.controllergroup.mRule}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'awards'}class="active"{/if} href="{$conf.rooturl}article-awards.html" title="{$lang.controllergroup.mAward}">{$lang.controllergroup.mAward}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'judge'}class="active"{/if} href="{$conf.rooturl}article-judge.html" title="{$lang.controllergroup.mJudge}">{$lang.controllergroup.mJudge}</a></li>

                <li><a {if $controller == 'statuslist'}class="active"{/if} href="{$conf.rooturl}site/statuslist/index" title="{$lang.controllergroup.mStatuslist}">{$lang.controllergroup.mStatuslist}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'instruction'}class="active"{/if} href="{$conf.rooturl}article-instruction.html" title="{$lang.controllergroup.mInstruction}">{$lang.controllergroup.mInstruction}</a></li>
                <li><a {if $controller == 'memberarea' || $controller == 'login' || $controller == 'register'}class="active"{/if} href="{$conf.rooturl}memberarea.html" title="{$lang.controllergroup.mMemberarea}">{$lang.controllergroup.mMemberarea}</a></li>
                                                <li><a {if $controller == 'page' && $pagename == 'photo'}class="active"{/if} href="{$conf.rooturl}site/photo/index" title="{$lang.controllergroup.mPhotos}">{$lang.controllergroup.mPhotos}</a></li>

            </ul>
                    </div>
                </div>
				<div class="right">
					<a href="?language=vn"><img src="{$staticserver}{$currentTemplate}/images/img_vietnam.gif" alt="VN" /></a>
					<a href="?language=en"><img src="{$staticserver}{$currentTemplate}/images/img_english.gif" alt="EN" /></a>
				</div>
			</div>
			
			{*
			<ul>
                <li><a {if $controller == 'page' && $pagename == 'home'}class="active"{/if} href="{$conf.rooturl}" title="{$lang.controllergroup.mHome}">{$lang.controllergroup.mHome}</a></li>
				<li><a {if $controller == 'page' && $pagename == 'rules'}class="active"{/if} href="{$conf.rooturl}article-rules.html" title="{$lang.controllergroup.mRule}">{$lang.controllergroup.mRule}</a></li>
				<li><a {if $controller == 'page' && $pagename == 'awards'}class="active"{/if} href="{$conf.rooturl}article-awards.html" title="{$lang.controllergroup.mAward}">{$lang.controllergroup.mAward}</a></li>
				<li><a {if $controller == 'page' && $pagename == 'judge'}class="active"{/if} href="{$conf.rooturl}article-judge.html" title="{$lang.controllergroup.mJudge}">{$lang.controllergroup.mJudge}</a></li>
				<li><a {if $controller == 'statuslist'}class="active"{/if} href="{$conf.rooturl}site/statuslist/index" title="{$lang.controllergroup.mStatuslist}">{$lang.controllergroup.mStatuslist}</a></li>
                <li><a {if $controller == 'page' && $pagename == 'instruction'}class="active"{/if} href="{$conf.rooturl}article-instruction.html" title="{$lang.controllergroup.mInstruction}">{$lang.controllergroup.mInstruction}</a></li>
				<li><a {if $controller == 'memberarea' || $controller == 'login' || $controller == 'register'}class="active"{/if} href="{$conf.rooturl}memberarea.html" title="{$lang.controllergroup.mMemberarea}">{$lang.controllergroup.mMemberarea}</a></li>
                                <li><a {if $controller == 'page' && $pagename == 'photo'}class="active"{/if} href="{$conf.rooturl}site/photo/index" title="{$lang.controllergroup.mPhotos}">{$lang.controllergroup.mPhotos}</a></li>

			</ul>
            *}
		</div><!-- end #header -->
	{/if}






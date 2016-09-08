<div id="panelleft">
	{if $controller != 'index'}
	<div id="sidebar-userstatus">
		{if $me->id > 0}
			{$lang.controllergroup.hi}, <a href="{$conf.rooturl}memberarea.html" title="Memberarea">{$me->username}</a> | <a href="{$conf.rooturl}logout.html" title="{$lang.global.mLogout}" style="color:#999;">{$lang.global.mLogout}</a>
			
			
		{else}
			{$lang.controllergroup.hi}, {$lang.controllergroup.guest}{if $setting.extra.enableRegister} | <a href="{$conf.rooturl}register.html" title="{$lang.global.mRegister}" style="color:#999;">{$lang.global.mRegister}</a>{/if}
			
			
		{/if}
	</div>
	{/if}
	

	<div class="logo">
		<a href="{$staticserver}{$currentTemplate}/images/fiapbanner.jpg" title="FIAP" rel="shadowbox"><img src="{$staticserver}{$currentTemplate}/images/logofiap.png" alt="fiap" /></a>
		<a href="{$conf.rooturl}article-paymentmethod.html" title="Paypal support" class="banner"><img src="{$staticserver}{$currentTemplate}/images/paypallogo.png" alt="Secure Payments by Paypal" /></a>
		<a href="#" title="Logo 1" class="banner"><img src="{$staticserver}{$currentTemplate}/images/bannerimage1.jpg" alt="logo1" /></a>
		<a href="#" title="Logo 2" class="banner"><img src="{$staticserver}{$currentTemplate}/images/bannerimage2.jpg" alt="logo2" /></a>
	</div><!-- end .logo -->
	
	{if $setting.extra.enablePhotogallery || ($controller != 'index' && $controller != 'news')|| $me->canViewPhoto()}
	<div id="sidebar-news">
		<div class="head"><img src="{$staticserver}{$currentTemplate}/images/greybox-logo.png" alt="" /> {$lang.controllergroup.aboutThisContest}</div>
		<div class="body">			
			<div class="detail">{sidebar_news}</div>
		</div>
	</div>
	{/if}
</div><!-- end #panelleft -->
		
		
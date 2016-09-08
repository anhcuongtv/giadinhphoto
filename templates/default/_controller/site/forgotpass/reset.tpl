{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.title}</h1>
		{include file="notify.tpl" notifyError=$error}
	
		<form action="" method="post">
			
			<div class="form-entry" >
				<div class="form-entry-label"><label>{$lang.controller.password} :</label></div>
				<div class="form-entry-big-textbox"><input type="password" name="fpassword" value="" /></div>
			</div>
			<div class="form-entry" >
				<div class="form-entry-label"><label>{$lang.controller.password2} :</label></div>
				<div class="form-entry-big-textbox"><input type="password" name="fpassword2" value="" /></div>
			</div>
			
				
				
			<div class="form-entry">
				<div class="form-entry-label">&nbsp;</div>
				<div class="form-entry-submit"><input class="btnSubmit" type="submit" name="fsubmit" value="{$lang.controller.submitLabel}" />
				<span class="form-entry-login-register"><a href="{$conf.rooturl}login.html{if $redirectUrl != ''}?redirect={$redirectUrl}{/if}" title="{$lang.global.mLogin}">{$lang.global.mLogin}</a></span>
				</div>
				
		
			</div>
			<div class="clearboth"></div>
			
		</form>
	</div>
</div>


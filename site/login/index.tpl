{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.title}</h1>
		{include file="notify.tpl" notifyError=$error}
		<form action="{$conf.rooturl}login.html?redirect={$redirectUrl}" method="post">
			<div id="form-entry-formtip">
				{$lang.controller.help}
			</div>
			
			<div class="form-entry" >
				<div class="form-entry-label"><label>{$lang.controller.username} :</label></div>
				<div class="form-entry-big-textbox"><input type="text" name="fusername" value="" /></div>
			</div>
			
			<div class="form-entry">
				<div class="form-entry-label"><label>{$lang.controller.password} :</label></div>
				<div class="form-entry-big-textbox"><input type="password" id="fpassword" name="fpassword" value="" /></div>
			</div>
			
			<div class="form-entry">
				<div class="form-entry-label"></div>
				<div>
					<label class=" myTip" title="{$lang.controller.remembermeTip}"><input type="checkbox" id="frememberme" name="frememberme" value="1" /> {$lang.controller.rememberme}</label>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; 
						<a href="{$conf.rooturl}forgotpass.html{if $redirectUrl != ''}?redirect={$redirectUrl}{/if}" title="{$lang.controller.forgotpass}">{$lang.controller.forgotpass}</a>
				</div>
			</div>
			
			
			
			<div class="form-entry">
				<div class="form-entry-label">&nbsp;</div>
				<div class="form-entry-submit"><input class="btnSubmit" type="submit" name="fsubmit" value="{$lang.controller.submitLabel}" />&nbsp;&nbsp;&nbsp;
				{if $setting.extra.enableRegister}<span class="form-entry-login-register"><a href="{$conf.rooturl}register.html{if $redirectUrl != ''}?redirect={$redirectUrl}{/if}" title="{$lang.global.mRegister}">{$lang.global.mRegister}</a></span>{/if}&nbsp;&nbsp;&nbsp;
				
				</div>
				
		
			</div>
			<div class="clearboth"></div>
			
		</form>
	</div>
</div>

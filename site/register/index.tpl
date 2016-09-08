{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.heading}</h1>
		<p class="info">{$lang.controller.help}</p>
		
		{include file="notify.tpl" notifyError=$error notifySuccess=$success}
		
		<div class="contents">
		
		
			<form action="{$conf.rooturl}register.html" method="post">
	
	
			<input type="hidden" name="ftoken" value="{$smarty.session.userRegisterToken}" />
			<div class="form">
			<table cellspacing="0" cellpadding="4" id="registerform">
			<tbody><tr>
			<th align="right"></th>
			<td><span class="required">*</span> {$lang.controller.required}</td>
			</tr>
			<tr>
			<th><label for="flastname">{$lang.controller.lastname}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.flastname}" id="flastname" name="flastname"></td>
			</tr>
			<tr>
			<th><label for="ffirstname">{$lang.controller.firstname}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.ffirstname}" id="ffirstname" name="ffirstname"></td>
			</tr>
			
			<tr>
			<th><label for="faddress">{$lang.controller.address}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.faddress}" id="faddress" name="faddress"></td>
			</tr>
			
			<tr>
			<th><label for="fzipcode">{$lang.controller.zipcode}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.fzipcode}" id="fzipcode" name="fzipcode"></td>
			</tr>
			<tr>
			<th><label for="fcity">{$lang.controller.city}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.fcity}" id="fcity" name="fcity"></td>
			</tr>
			<tr>
			<th><label for="fregion">{$lang.controller.region}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.fregion}" id="fregion" name="fregion"></td>
			</tr>
			<tr>
			<th><label for="fcountry">{$lang.controller.country}<span class="required">*</span> :</label></th>
			<td><select id="fcountry" name="fcountry">
			<option value="">- - - -</option>
			{foreach item=country key=key from=$setting.country}
				<option value="{$key}" {if $formData.fcountry == $key}selected="selected"{/if}>{$country}</option>
			{/foreach}
			</select></td>
			</tr>
			<tr>
			<th><label for="fphone1">{$lang.controller.phone1}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.fphone1}" id="fphone1" name="fphone1"></td>
			</tr>
			<tr>
			<th>&nbsp;</th>
			<td class="code">{$lang.controller.phone1help}</td>
			</tr>
			
			<tr>
			<th><label for="fusername">{$lang.controller.username}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.fusername}" id="fusername" name="fusername"></td>
			</tr>
			<tr>
			<th><label for="fpassword1">{$lang.controller.password}<span class="required">*</span> :</label></th>
			<td><input type="password" class="textbox" size="40" value="{$formData.fpassword1}" id="fpassword1" name="fpassword1"></td>
			</tr>
			<tr>
			<th><label for="fpassword2">{$lang.controller.passwordconfirm}<span class="required">*</span> :</label></th>
			<td><input type="password" class="textbox" size="40" value="{$formData.fpassword2}" id="fpassword2" name="fpassword2"></td>
			</tr>
			<tr>
			<th><label for="femail">{$lang.controller.email}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.femail}" id="femail" name="femail"></td>
			</tr>
			<tr>
			<th><label for="femail2">{$lang.controller.email2}<span class="required">*</span> :</label></th>
			<td><input type="text" class="textbox" size="40" value="{$formData.femail2}" id="femail2" name="femail2"></td>
			</tr>
			
			<tr>
			<th><label for="fcaptcha">{$lang.controller.securityCode}<span class="required">*</span> :</label></th>
			<td><img alt="captcha" id="captchaImage" width="200" height="50" src='{$conf.rooturl}site/captcha' /><a class="form-entry-register-captcharefresh" href="javascript:void(0);" onclick="javascript:reloadCaptchaImage();" title="{$lang.controller.refreshImage}">{$lang.controller.refreshImage}</a><br />
			<input type="text" class="textbox" size="40" value="" id="fcaptcha" name="fcaptcha" title="{$lang.controller.securityCodeTip}" /></td>
			</tr>
			</tbody></table>
			
			<!-- / class form --></div>
			{$lang.controller.foottext1}
			<p class="btnSubmit"><input type="submit" class="btnSubmit" value="Submit" id="fsubmit" name="fsubmit"></p>
			{$lang.controller.foottext2}
			</form>
		</div>
	</div>
</div>


	
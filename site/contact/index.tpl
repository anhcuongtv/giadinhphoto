{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.title}</h1>
		<div class="contents">
			<h2 style="font-size:16px;"><strong>{$lang.controller.titleInformation}</strong></h2>
			{$page->contents.$langCode}
			
			<hr size="1" />
			<br />
			
			
			{include file="notify.tpl" notifyError=$error notifySuccess=$success}
			
			
			
			<form action="" method="post">
				<div id="form-entry-formtip">
					<span class="required">*</span> : {$lang.controller.required}
				</div>
				
				<div class="form-entry">
					<div class="form-entry-label"><label>{$lang.controller.fullname} <span class="required">*</span>:</label></div>
					<div class="form-entry-big-textbox"><input type="text" id="ffullname" name="ffullname" value="{$formData.ffullname}" /></div>
				</div>
				<div class="form-entry">
					<div class="form-entry-label"><label>{$lang.controller.email} <span class="required">*</span>:</label></div>
					<div class="form-entry-big-textbox"><input type="text" id="femail" name="femail" value="{$formData.femail}" /></div>
				</div>
				<div class="form-entry">
					<div class="form-entry-label form-entry-label-normalfont"><label>{$lang.controller.phone}:</label></div>
					<div class="form-entry-textbox"><input type="text" id="fphone" name="fphone" size="5" value="{$formData.fphone}" style="width:100px;" /></div>
				</div>
				
				
				<div class="form-entry">
					<div class="form-entry-label form-entry-label-normalfont"><label>{$lang.controller.reason}:</label></div>
					<div class="form-entry-big-textbox">
						<select class="entry-selectbox" name="freason" id="freason">
							<option {if $formData.freason == 'general'}selected="selected" {/if} value="general">{$lang.controller.reasonGeneral}</option>
							<option {if $formData.freason == 'support'}selected="selected" {/if} value="support">{$lang.controller.reasonSupport}</option>
						</select>
					</div>
				</div>
				<div class="form-entry">
					<div class="form-entry-label form-entry-label-normalfont"><label>{$lang.controller.message} <span class="required">*</span>:</label></div>
					<div class="form-entry-textbox">
						<textarea name="fmessage" class="entry-textarea" rows="5" style="width:400px;">{$formData.fmessage}</textarea>
					</div>
				</div>
				
				<div class="form-entry">
						<div class="form-entry-label"><label>{$lang.controller.securityCode} <span class="required">*</span>:</label></div>
						<div class="form-entry-textbox">
							<div class=""><img alt="captcha" id="captchaImage" width="200" height="50" src='{$conf.rooturl}site/captcha' /><a class="" href="javascript:void(0);" onclick="javascript:reloadCaptchaImage();" title="{$lang.controller.refreshImage}">{$lang.controller.refreshImage}</a></div>
							<div class="">
								<input type="text" name="fcaptcha" onclick="this.value=''" class="myTip" title="{$lang.controller.securityCodeTip}"/>
							</div>
							
						</div>
					</div>
				
				
						
				
				<div class="form-entry">
					<div class="form-entry-label">&nbsp;</div>
					<div class="form-entry-submit"><input class="btnSubmit" type="submit" name="fsubmit" value="{$lang.controller.submitLabel}" /></div>
				</div>
				<div class="clearboth"></div>
				
			</form>
		</div>
	</div>
</div>


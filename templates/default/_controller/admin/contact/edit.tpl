<h2>{$lang.controller.head_edit}</h2>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_edit}</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" id="tab1_link" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="{$backUrl}">{$lang.controllergroup.formBackLabel}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
		<div class="tab-content default-tab" id="tab1">
			<form action="{$conf.rooturl_admin}contact/edit/id/{$myContact->id}/redirect/{$redirectUrl}" method="post" name="myform">
			<input type="hidden" name="ftoken" value="{$smarty.session.contactEditToken}" />
			<table class="form" cellpadding="5" cellspacing="5">
				<tr>
					<td width="150" class="label" valign="middle">{$lang.controller.formUsernameLabel} : </td>
					<td>{$formData.fusername} (USER ID: {$formData.fuserid})</td>
				</tr>
				
				
				<tr>
					<td class="label" valign="middle">{$lang.controller.formFullnameLabel} : </td>
					<td><input type="text" name="ffullname" id="ffullname" size="60" value="{$formData.ffullname|@htmlspecialchars}" class="text-input"></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formEmailLabel} : </td>
					<td><input type="text" name="femail" id="femail" size="60" value="{$formData.femail|@htmlspecialchars}" class="text-input"></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formPhoneLabel} : </td>
					<td><input type="text" name="fphone" id="fphone" size="60" value="{$formData.fphone|@htmlspecialchars}" class="text-input"></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formReasonLabel} : </td>
					<td><select name="freason" id="freason">
						<option value="general" {if $formData.freason eq 'general'}selected="selected"{/if}>{$lang.controller.reasonGeneral}</option>
						<option value="ads" {if $formData.freason eq 'ads'}selected="selected"{/if}>{$lang.controller.reasonAds}</option>
						<option value="idea" {if $formData.freason eq 'idea'}selected="selected"{/if}>{$lang.controller.reasonIdea}</option>
						<option value="support" {if $formData.freason eq 'support'}selected="selected"{/if}>{$lang.controller.reasonSupport}</option>
					</select></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formMessageLabel} :</td>
					<td><textarea class="text-input"  rows="6" name="fmessage" id="fmessage">{$formData.fmessage}</textarea></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formStatusLabel} : </td>
					<td><select name="fstatus" id="fstatus">
						<option value="new" {if $formData.fstatus eq 'new'}selected="selected"{/if}>New</option>
						<option value="pending" {if $formData.fstatus eq 'pending'}selected="selected"{/if}>Pending</option>
						<option value="completed" {if $formData.fstatus eq 'completed'}selected="selected"{/if}>Completed</option>
					</select></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formNoteLabel} :</td>
					<td><textarea class="text-input"  rows="4" name="fnote" id="fnote">{$formData.fnote}</textarea></td>
				</tr>
				<tr>
					<td class="label" valign="middle">{$lang.controller.formDateCreatedLabel} :</td>
					<td>{$formData.fdatecreated|date_format:$lang.controllergroup.dateFormatTimeSmarty} ({$lang.controller.formIpAddressLabel} : {$formData.fipaddress})</td>
				</tr>
				
			</table>
			<fieldset>
			<p>
				<input type="submit" name="fsubmit" value="{$lang.controllergroup.formUpdateSubmit}" class="button buttonbig">
				<br /><small><span class="star_require">*</span> : {$lang.controllergroup.formRequiredLabel}</small>
			</p>
			</fieldset>
			
			</form>
		</div>
		
		
	</div>
	
	
</div>


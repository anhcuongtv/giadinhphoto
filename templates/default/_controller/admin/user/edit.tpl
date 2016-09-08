<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.userEditToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_edit}</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="{$redirectUrl}">{$lang.controllergroup.formBackLabel}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			
			<fieldset>
			
			<p>
				<label>{$lang.controller.formGroupLabel} <span class="star_require">*</span> : </label>
				
				{if $me->id == $myUser->id}
					<input type="text" name="fgroupid" id="fgroupid" size="40" disabled="disabled" style="color:#aaa;" value="{$myUser->groupname($myUser->groupid, $lang)}" class="text-input">
				{else}	
					<select id="fgroupid" name="fgroupid">
					<option value="">- - - -</option>
					{foreach item=groupname key=key from=$userGroups}
						{if $groupPriorityList.$key > $me->groupPriority}
							<option value="{$key}" {if $formData.fgroupid == $key}selected="selected"{/if}>{$groupname}</option>
						{/if}
					{/foreach}
					</select>
				{/if}
					
				
			</p>
			<p>
				<label>{$lang.controller.formEmailLabel} <span class="star_require">*</span> : </label>
				<input type="text" name="femail" id="femail" size="40" disabled="disabled" style="color:#aaa;" value="{$formData.femail|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.formUserNameLabel} : </label>
				<input type="text" name="fusername" id="fusername" size="40" disabled="disabled" style="color:#aaa;" value="{$formData.fusername|@htmlspecialchars}" class="text-input">
			</p>
			
			
			<p>
				<label>{$lang.controller.formPasswordLabel} <span class="star_require">*</span> : </label>
				<a href="javascript:delm('{$conf.rooturl_admin}user/resetpass/id/{$myUser->id}')">{$lang.controller.resetpass}</a>
			</p>
			
			
			<hr />
			<p>
				<label>{$lang.controller.firstname}  : </label>
				<input type="text" name="ffirstname" id="ffirstname" size="40" value="{$formData.ffirstname|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.lastname}  : </label>
				<input type="text" name="flastname" id="flastname" size="40" value="{$formData.flastname|@htmlspecialchars}" class="text-input">
			</p>
			
			<p>
				<label>{$lang.controller.honor}  : </label>
				<input type="text" name="fhonor" id="fhonor" size="40" value="{$formData.fhonor|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.address}  : </label>
				<input type="text" name="faddress" id="faddress" size="40" value="{$formData.faddress|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.address2}  : </label>
				<input type="text" name="faddress2" id="faddress2" size="40" value="{$formData.faddress2|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.zipcode}  : </label>
				<input type="text" name="fzipcode" id="fzipcode" size="10" value="{$formData.fzipcode|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.city}  : </label>
				<input type="text" name="fcity" id="fcity" size="40" value="{$formData.fcity|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.region}  : </label>
				<input type="text" name="fregion" id="fregion" size="40" value="{$formData.fregion|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.country}  : </label>
				<select id="fcountry" name="fcountry">
					<option value="">- - - -</option>
					{foreach item=country key=key from=$setting.country}
						<option value="{$key}" {if $formData.fcountry == $key}selected="selected"{/if}>{$country}</option>
					{/foreach}
				</select>
			</p>
			<p>
				<label>{$lang.controller.phone1}  : </label>
				<input type="text" name="fphone1" id="fphone1" size="20" value="{$formData.fphone1|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.phone2}  : </label>
				<input type="text" name="fphone2" id="fphone2" size="20" value="{$formData.fphone2|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.psamembership}  : </label>
				<input type="text" name="fpsamembership" id="fpsamembership" size="40" value="{$formData.fpsamembership|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>{$lang.controller.photoclub}  : </label>
				<input type="text" name="fphotoclub" id="fphotoclub" size="40" value="{$formData.fphotoclub|@htmlspecialchars}" class="text-input">
			</p>
            
            <p><input type="checkbox" name="fpaidcolor" value="1" {if $formData.fpaidcolor == 1}checked="checked"{/if} /> Paid Color Section</p>
            <p><input type="checkbox" name="fpaidmono" value="1" {if $formData.fpaidmono == 1}checked="checked"{/if} /> Paid Monochrome Section</p>
            <p><input type="checkbox" name="fpaidnature" value="1" {if $formData.fpaidnature == 1}checked="checked"{/if} /> Paid Nature Section</p>
		<p><input type="checkbox" name="fpaidtravel" value="1" {if $formData.fpaidtravel == 1}checked="checked"{/if} /> Paid Travel Section</p>		
			</fieldset>
		
			
		</div>
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="{$lang.controllergroup.formUpdateSubmit}" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : {$lang.controllergroup.formRequiredLabel}</small>
		</p>
		</fieldset>
	</div>

    	
</div>
</form>


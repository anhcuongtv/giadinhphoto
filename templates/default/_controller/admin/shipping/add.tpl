<form name="addform" action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" class="tablegrid tableform" cellspacing="0" cellpadding="2" style="border-collapse:collapse;">
	<tr>
		<td align="right">{$lang.controller.formIncategoryLabel}<span class="star_require">*</span> :</td>
		<td>
			<select name="fcategory" id="fcategory">
				<option value="0">{$lang.controller.formTopCategoryOptionLabel}</option>
			{foreach item=category from=$categoryOptions}
				<option title="{$category.title}" value="{$category.id}" {if $formData.fcategory eq $category.id}selected="selected"{/if} class="selectbox_level{$category.level}">{section name=levelloop loop=$category.level}&nbsp; &nbsp; {/section} &raquo; {$category.name}</option>
			{/foreach}
			</select>
		</td>
	</tr>
{foreach item=language from=$availableLangs}
	<tr style="background:#{$language.l_stylecolor};">
		<td width="30%" align="left" style="font-weight:bold;font-size:14px;">{$language.l_country} {if $language.l_required_input_field eq '1'}<span class="star_require">[{$lang.default.formRequiredLabel}]</span>{/if}</td>
		<td></td>
	</tr>
	<tr style="background:#{$language.l_stylecolor};">
		<td align="right">{$lang.default.formNameLabel}{if $language.l_required_input_field eq '1'}<span class="star_require">*</span>{/if}:</td>
		<td><input type='text' name="fcatname[{$language.l_code}]" value="{$formData.fcatname[$language.l_code]}" size="40"/></td>
	</tr>	
{/foreach}
	<tr style="display:none;">
		<td align="right">{$lang.controller.formIdentifierLabel}:</td>
		<td><input type='text' name="fidentifier" value="{$formData.fidentifier}" size="40"/></td>
	</tr>
	<tr style="display:none;">
		<td align="right">{$lang.default.formImageLabel}: </td>
		<td><input type="file" name="imageupload[]" size="40"/><span style="color:#FF0000">(JPG,GIF,PNG)</span></td>
	</tr>
	<tr>
		<td></td>
		<td><span class="star_require">*</span>: {$lang.default.formRequiredLabel}</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="fsubmitexit" value="{$lang.default.formAddExitSubmit}" class="submit_double_border" /> <input type="submit" name="fsubmit" value="{$lang.default.formAddSubmit}" class="submit_double_border" /></td>
	</tr>
</table>
</form>
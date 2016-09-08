<form action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-collapse:collapse;" class="tablegrid tableform">
	<tr>
		<td align="right">{$lang.controller.formIncategoryLabel}<span class="star_require">*</span>:</td>
		{if $formData.fsubmit neq ""}
			{assign var="selectedcategory" value=$formData.fcategory}
		{else}
			{assign var="selectedcategory" value=$formData.pc_parentid}
		{/if}
		<td>
			<select name="fcategory" id="fcategory">
				<option value="0">{$lang.controller.formTopCategoryOptionLabel}</option>
			{foreach item=category from=$categoryOptions}
				<option value="{$category.id}" title="{$category.title}" {if $selectedcategory eq $category.id}selected="selected"{/if} class="selectbox_level{$category.level}">{section name=levelloop loop=$category.level}&nbsp; &nbsp; {/section} &raquo; {$category.name}</option>
			{/foreach}
			</select>
		</td>
	</tr>
{foreach item=language from=$availableLangs}
	<tr style="background:#{$language.l_stylecolor};">
		<td align="left" style="font-weight:bold;font-size:14px;">{$language.l_country} {if $language.l_required_input_field eq '1'}<span class="star_require">[{$lang.default.formRequiredLabel}]</span>{/if}</td>
		<td></td>
	</tr>
	<tr style="background:#{$language.l_stylecolor};">
		<td width="30%" align="right">{$lang.default.formNameLabel}{if $language.l_required_input_field eq '1'}<span class="star_require">*</span>{/if}:</td>
		<td><input type='text' name="fcatname[{$language.l_code}]" value="{$formData.fcatname[$language.l_code]}" size="40"/></td>
	</tr>
{/foreach}
	<tr style="display:none;">
		<td align="right">{$lang.controller.formIdentifierLabel}:</td>
		<td><input type='text' name="fidentifier" value="{if $formData.fidentifier neq ""}{$formData.fidentifier}{else}{$formData.pc_identifier}{/if}" size="40"/></td>
	</tr>
	<tr style="display:none;">
		<td align="right" valign="top">{$lang.default.formImageLabel}: </td>
		{assign var="image1" value=$formData.pc_image1}
		<td>
			{if $image1 neq ""}
				<a href="javascript: void(0)" onclick="window.open('{$base_dir}../uploads/prodcategory/{$image1}', 'windowname1', 'scrollbars=1, resizeable=yes, width=800, height=700'); return false;"  style="float:left;text-decoration:none;"  target="_blank">
					<img alt="" src="{$base_dir}../uploads/prodcategory/{$image1}" hspace="5" border="0" width="100"><br /><div align="center">[{$image1}]</div>
				</a>
				<input type="checkbox" name="delimage[1]" value="1" /><label>{$lang.default.formImageDeleteCurrentLabel}</label><br />
				{$lang.default.formImageDeleteCurrentHelp}<br />
			{/if}
			<input type="file" name="imageupload[]" size="40"/><span style="color:#FF0000">(JPG,GIF,PNG)</span>
		</td>
	</tr> 
	<tr>
		<td align="right">{$lang.default.formEnableLabel} </td>
		<td><select name="fenable"><option value="1">{$lang.default.formYesLabel}</option><option value="0" {if $formData.fsubmit neq ""}{if $formData.fenable eq "0"}selected="selected"{/if}{else}{if $formData.pc_enable eq "0"}selected="selected"{/if}{/if}>{$lang.default.formNoLabel}</option></select></td>
	</tr>
	<tr>
		<td></td>
		<td><span class="star_require">*</span>: {$lang.default.formRequiredLabel}</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="fsubmitexit" value="{$lang.default.formUpdateExitSubmit}" class="submit_double_border" /> <input type="submit" name="fsubmit" value="{$lang.default.formUpdateSubmit}" class="submit_double_border" /></td>
	</tr>
</table>
</form>
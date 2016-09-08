<h2>{$lang.controller.head_edit}</h2>

{if $locType == 'country'}
<form name="addform" id="addformcountry" action="" method="post">
	<input type="hidden" name="ftoken" value="{$smarty.session.locationEditoken}" />
	<input type="hidden" name="fcountrycode" value="{$formData.fid}" />
	<div class="content-box"><!-- Start Content Box -->
		<div class="content-box-header">		
			<h3>{$lang.controller.editCountry}</h3>
			<ul class="content-box-link">
				<li><a href="{$conf.rooturl_admin}shipping">{$lang.controllergroup.formBackLabel}</a></li>
			</ul>
			<div class="clear"></div>  
		</div> <!-- End .content-box-header -->
		
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				{include file="notify.tpl" notifyError=$error.country notifySuccess=$success.country}
				<table style="background:#ddd;" cellpadding="20">
					<tr>
						<td>{$lang.controller.formCountryCodeLabel}: </td>
						<td> <strong>{$formData.fcountrycode}</strong></td>
						<td> | {$lang.controller.formCountryNameLabel}: </td>
						<td><input class="text-input" type="text" name="fcountryname" value="{$formData.fcountryname}" /></td>
						<td><input type="submit" name="fsubmit" value="{$lang.controllergroup.formUpdateSubmit}" class="button buttonbig"><input type="submit" name="fsubmitexit" value="{$lang.controllergroup.formUpdateExitSubmit}" class="button buttonbig"></td>
					</tr>
				</table>
			</div>
		</div>
</div>
</form>
{/if}



{if $locType == 'region'}
<form name="addform" id="addformregion" action="" method="post">
	<input type="hidden" name="ftoken" value="{$smarty.session.locationEditoken}" />
	<input type="hidden" name="fid" value="{$formData.fid}" />
	<div class="content-box"><!-- Start Content Box -->
		<div class="content-box-header">		
			<h3>{$lang.controller.editRegion}</h3>
			<ul class="content-box-link">
				<li><a href="{$conf.rooturl_admin}shipping">{$lang.controllergroup.formBackLabel}</a></li>
			</ul>
			<div class="clear"></div>  
		</div> <!-- End .content-box-header -->
		
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				{include file="notify.tpl" notifyError=$error.region notifySuccess=$success.region}
				<table style="background:#ddd;" cellpadding="20">
					<tr>
						<td>{$lang.controller.formCountryLabel} : </td>
						<td><select disabled="disabled" name="fcountry" id="fcountry">
								<option  value="0">- - - - - - - - - - - -</option>
							{foreach item=country from=$countries}
								<option title="{$country->name}" value="{$country->code}" {if $formData.fcountry eq $country->code}selected="selected"{/if}>{$country->name}</option>
							{/foreach}
							</select></td>
						<td> | {$lang.controller.formRegionNameLabel}: </td>
						<td><input class="text-input" type="text" name="fregion" value="{$formData.fregion}" /></td>
						<td><input type="submit" name="fsubmit" value="{$lang.controllergroup.formUpdateSubmit}" class="button buttonbig"><input type="submit" name="fsubmitexit" value="{$lang.controllergroup.formUpdateExitSubmit}" class="button buttonbig"></td>
					</tr>
				</table>
			</div>
		</div>
</div>
</form>
{/if}

{if $conf.enableLocCity > 0 && $locType == 'city'}
<form name="addform" id="addformcity" action="" method="post">
	<input type="hidden" name="ftoken" value="{$smarty.session.locationEditoken}" />
	<input type="hidden" name="fid" value="{$formData.fid}" />
	<div class="content-box"><!-- Start Content Box -->
		<div class="content-box-header">		
			<h3>{$lang.controller.editCity}</h3>
			<ul class="content-box-link">
				<li><a href="{$conf.rooturl_admin}shipping">{$lang.controllergroup.formBackLabel}</a></li>
			</ul>
			<div class="clear"></div>  
		</div> <!-- End .content-box-header -->
		
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				{include file="notify.tpl" notifyError=$error.city notifySuccess=$success.city}
				<table style="background:#ddd;" cellpadding="20">
					<tr>
						<td>{$lang.controller.formCountryLabel} : </td>
						<td><select disabled="disabled" name="fcountry" id="fcountry" onchange="fetchRegion('billing')">
								<option value="0">- - - - - - - - - - - -</option>
							{foreach item=country from=$countries}
								<option title="{$country->name}" value="{$country->code}" {if $formData.fcountry eq $country->code}selected="selected"{/if}>{$country->name}</option>
							{/foreach}
							</select>
						</td>
						<td>| {$lang.controller.formRegionLabel} : </td>
						<td><input type="hidden" id="fregionhidden" value="{$formData.fregion}" /><div id="fregion_indicator"></div>		
							<select disabled="disabled" name="fregion" id="fregion">
								<option value="0">- - - - - - - - - - - -</option>
							</select></td>	
						<td> | {$lang.controller.formCityNameLabel}: </td>
						<td><input class="text-input" type="text" name="fcity" value="{$formData.fcity}" /></td>
						<td><input type="submit" name="fsubmit" value="{$lang.controllergroup.formUpdateSubmit}" class="button buttonbig"><input type="submit" name="fsubmitexit" value="{$lang.controllergroup.formUpdateExitSubmit}" class="button buttonbig"></td>
					</tr>
				</table>
			</div>
		</div>
</div>
</form>
{/if}



<script type="text/javascript">
	var loadingIndicator = "<img src='{$currentTemplate}/images/admin/progress_bar.gif' />";
	var requestRegionUrl = "{$conf.rooturl_admin}shipping/ajaxgetregion";

	fetchRegion();
</script>

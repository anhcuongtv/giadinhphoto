<h2>{$lang.controller.head_add}</h2>

<form name="addform" id="addformcountry" action="" method="post">
	<input type="hidden" name="ftoken" value="{$smarty.session.locationAddToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.addCountry}</h3>
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
					<td>{$lang.controller.formCountryCodeLabel} {$lang.controller.formCountryCodeNote}: </td>
					<td><input class="text-input" type="text" name="fcountrycode" size="3" value="{$formData.fcountrycode}" /></td>
					<td> | {$lang.controller.formCountryNameLabel}: </td>
					<td><input class="text-input" type="text" name="fcountryname" value="{$formData.fcountryname}" /></td>
					<td><input type="submit" name="fsubmitcountry" value="{$lang.controller.addCountry}" class="button buttonbig"></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</form>


<form name="addform" id="addformregion" action="" method="post">
	<input type="hidden" name="ftoken" value="{$smarty.session.locationAddToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.addRegion}</h3>
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
					<td><select class="text-input" name="fcountry" id="fcountry">
							<option value="0">- - - - - - - - - - - -</option>
						{foreach item=country from=$countries}
							<option title="{$country->name}" value="{$country->code}" {if $formData.fcountry == $country->code}selected="selected"{/if}>{$country->name}</option>
						{/foreach}
						</select></td>
					<td> | {$lang.controller.formRegionNameLabel}: </td>
					<td><input class="text-input" type="text" name="fregion" value="{if $formData.fsubmitregion != ''}{$formData.fregion}{/if}" /></td>
					<td><input type="submit" name="fsubmitregion" value="{$lang.controller.addRegion}" class="button buttonbig"></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</form>

{if $conf.enableLocCity > 0}
<form name="addform" id="addformcity" action="" method="post">
	<input type="hidden" name="ftoken" value="{$smarty.session.locationAddToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.addCity}</h3>
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
					<td><select name="fcountry" id="fcountry" onchange="fetchRegion('billing')">
							<option value="0">- - - - - - - - - - - -</option>
						{foreach item=country from=$countries}
							<option title="{$country->name}" value="{$country->code}" {if $formData.fcountry == $country->code}selected="selected"{/if}>{$country->name}</option>
						{/foreach}
						</select>
					</td>
					<td>| {$lang.controller.formRegionLabel} : </td>
					<td><input type="hidden" id="fregionhidden" value="{$formData.fregion}" /><div id="fregion_indicator"></div>		
						<select name="fregion" id="fregion">
							<option value="0">- - - - - - - - - - - -</option>
						
						</select></td>	
					<td> | {$lang.controller.formCityNameLabel}: </td>
					<td><input class="text-input" type="text" name="fcity" value="{$formData.fcity}" /></td>
					<td><input type="submit" name="fsubmitcity" value="{$lang.controller.addCity}" class="button buttonbig"></td>
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
{if $conf.enableLocCity > 0}
	fetchRegion();
{/if}
</script>

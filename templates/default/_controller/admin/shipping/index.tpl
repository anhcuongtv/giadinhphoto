<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list}</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}shipping/locadd">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			
			<form action="" method="post" name="manage" onsubmit="return confirm('Are you sure?');">
			<input type="hidden" name="ftoken" value="{$smarty.session.locationDeleteToken}" />
			<table border="0" width="100%" cellpadding="2" cellspacing="0" style="border-collapse:collapse;" class="grid">
				<thead>
					<tr class="tablegrid_rowtitle1">
						<th width="40"><input class="check-all" type="checkbox" /></th>
						<th align="center" width="70">{$lang.controllergroup.formOrderLabel}</th>
						<th align="left" width="150">{$lang.controller.formCountryLabel}</th>
						<th align="left" width="200">{$lang.controller.formRegionLabel}</th>
						<th align="left" width="100">{$lang.controller.formCityLabel}</th>
						
						{foreach item=group from=$shippingGroups}
							<th align="right" title="{$group->description}">
								<div>{$group->code}</div>
								<div style="display:none;"><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}shipping/locedit/group/{$group->id}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formActionEditTooltip}" width="16"/></a> &nbsp;<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}shipping/delete/group/{$group->id}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formActionEditLabel}" width="16" height="16" /></a>	
								</div>
							</th>
						{/foreach}
						<th width="50" align="center">{$lang.default.formActionLabel}</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="8">
							<div class="bulk-actions align-left">
								<select name="fbulkaction">
									<option value="">{$lang.controllergroup.bulkActionSelectLabel}</option>
									<option value="delete">{$lang.controllergroup.bulkActionDeletetLabel}</option>
								</select>
								<input type="submit" name="fsubmitbulk" class="button" value="{$lang.controllergroup.bulkActionSubmit}" /><br />
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" name="fchangeordercountry" class="button" value="{$lang.controllergroup.formChangeOrderSubmit} {$lang.controller.formCountryLabel}" />
								<input type="submit" name="fchangeorderregion" class="button" value="{$lang.controllergroup.formChangeOrderSubmit} {$lang.controller.formRegionLabel}" />
								<input type="submit" name="fchangeordercity" class="button" value="{$lang.controllergroup.formChangeOrderSubmit} {$lang.controller.formCityLabel}" />
							</div>
							
							<div class="pagination">
							   
							</div> <!-- End .pagination -->
	
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				{foreach item=country from=$countries}
					<tr class="shipping_price_country">
						<td align="center"><input type="checkbox" name="fbuilkidcountry[]" value="{$country->code}"/></td>
						<td><input type='hidden' name='countryhiddenId[]' value='{$country->code}'/>
							<input class="text-input" title="{$lang.controller.orderTooltip}" type='text' name='countryorderId[]' value='{$country->order}' size='2'/></td>
						<td>{$country->name}</td>
						<td></td>
						<td></td>
						{foreach item=priceitem from=$country->pricelist}
							<td class="shipping_price_cell" align="right" id="shipping_price_{$country->code}_0_0_{$priceitem.groupid}">
								<div class="shipping_price_indicator"></div>
								<div class="shipping_price_display">{$priceitem.display_price}</div>
								<div class="shipping_price_input">{$priceitem.edit_price}</div>
								<div class="shipping_price_editor">
									{if $priceitem.display_price != ''}
										<a title="{$lang.controller.priceChangeTooltip}" href="javascript:void(0);" onclick="priceChange('{$country->code}', 0, 0, {$priceitem.groupid}, 0)"><img border="0" src="{$currentTemplate}/images/admin/edit.png" alt="Edit" width="16"/></a>
										&nbsp;
										<a title="{$lang.controller.priceRemoveTooltip}" href="javascript:void(0);" onclick="priceRemove('{$country->code}', 0, 0, {$priceitem.groupid})"><img border="0" src="{$currentTemplate}/images/admin/delete.png" alt="Remove}" width="16" height="16" /></a>
									{else}
										<a title="{$lang.controller.priceSetTooltip}" href="javascript:void(0);" onclick="priceChange('{$country->code}', 0, 0, {$priceitem.groupid}, 1)"><img border="0" src="{$currentTemplate}/images/admin/add.png" alt="Insert" width="16"/></a>
									{/if}
								</div>
							</td>
						{/foreach}
						<td align="center"><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}shipping/locedit/country/{$country->code}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formActionEditLabel}" width="16"/></a> &nbsp;<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}shipping/delete/country/{$country->code}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16" height="16" /></a></td>		
					</tr>
					
					<!-- REGIONS LISTING -->
					{foreach item=region from=$country->regions}
						<tr class="shipping_price_region">
							<td align="center"><input type="checkbox" name="fbuilkidregion[]" value="{$region->id}"/></td>
							<td><input type='hidden' name='regionhiddenId[]' value='{$region->id}'/>
								</td>
							<td class="shipping_price_small">{$country->name} - &nbsp;</td>
							<td><input class="text-input" title="{$lang.controller.orderTooltip}" type='text' name='regionorderId[]' value='{$region->order}' size='2'/>{$region->name}</td>
							<td></td>
							{foreach item=priceitem from=$region->pricelist}
								<td class="shipping_price_cell" align="right" id="shipping_price_{$country->code}_{$region->id}_0_{$priceitem.groupid}">
									<div class="shipping_price_indicator"></div>
									<div class="shipping_price_display">{$priceitem.display_price}</div>
									<div class="shipping_price_input">{$priceitem.edit_price}</div>
									<div class="shipping_price_editor">
										{if $priceitem.display_price != ''}
											<a title="{$lang.controller.priceChangeTooltip}" href="javascript:void(0);" onclick="priceChange('{$country->code}', {$region->id}, 0, {$priceitem.groupid}, 0)"><img border="0" src="{$currentTemplate}/images/admin/edit.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a>
											&nbsp;
											<a title="{$lang.controller.priceRemoveTooltip}" href="javascript:void(0);" onclick="priceRemove('{$country->code}', {$region->id}, 0, {$priceitem.groupid})"><img border="0" src="{$currentTemplate}/images/admin/delete.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16" height="16" /></a>
										{else}
											<a title="{$lang.controller.priceSetTooltip}" href="javascript:void(0);" onclick="priceChange('{$country->code}', {$region->id}, 0, {$priceitem.groupid}, 1)"><img border="0" src="{$currentTemplate}/images/admin/add.png" alt="{$lang.controllergroup.formAddLabel}" width="16"/></a>
										{/if}
									</div>
								</td>
							{/foreach}
							<td align="center"><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}shipping/locedit/region/{$region->id}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}shipping/delete/region/{$region->id}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16" height="16" /></a></td>		
						</tr>	
						<!-- CITY LISTING -->
						{if $conf.enableLocCity > 0}
						{foreach item=city from=$region->cities}
							<tr class="shipping_price_city">
								<td align="center"><input type="checkbox" name="fbuilkidcity[]" value="{$city->id}"/></td>
								<td><input type='hidden' name='cityhiddenId[]' value='{$city->id}'/>
									</td>
								<td class="shipping_price_small"></td>
								<td class="shipping_price_small">{$region->name} - &nbsp;</td>
								<td><input class="text-input" title="{$lang.controller.orderTooltip}" type='text' name='cityorderId[]' value='{$city->order}' size='2'/>{$city->name}</td>
								{foreach item=priceitem from=$city->pricelist}
									<td class="shipping_price_cell" align="right" id="shipping_price_{$country->code}_{$region->id}_{$city->id}_{$priceitem.groupid}">
										<div class="shipping_price_indicator"></div>
										<div class="shipping_price_display">{$priceitem.display_price}</div>
										<div class="shipping_price_input">{$priceitem.edit_price}</div>
										<div class="shipping_price_editor">
											{if $priceitem.display_price != ''}
												<a title="{$lang.controller.priceChangeTooltip}" href="javascript:void(0);" onclick="priceChange('{$country->code}', {$region->id}, {$city->id}, {$priceitem.groupid}, 0)"><img border="0" src="{$currentTemplate}/images/admin/edit.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a>
												&nbsp;
												<a title="{$lang.controller.priceRemoveTooltip}" href="javascript:void(0);" onclick="priceRemove('{$country->code}', {$region->id}, {$city->id}, {$priceitem.groupid})"><img border="0" src="{$currentTemplate}/images/admin/delete.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16" height="16" /></a>
											{else}
												<a title="{$lang.controller.priceSetTooltip}" href="javascript:void(0);" onclick="priceChange('{$country->code}', {$region->id}, {$city->id}, {$priceitem.groupid}, 1)"><img border="0" src="{$currentTemplate}/images/admin/add.png" alt="{$lang.controllergroup.formAddLabel}" width="16"/></a>
											{/if}
										</div>
									</td>
								{/foreach}
								<td align="center"><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}shipping/locedit/city/{$city->id}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}shipping/delete/city/{$city->id}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16" height="16" /></a></td>		
							</tr>	
						{/foreach} <!-- end CITY LISTING-->
						{/if}
					{/foreach}<!-- end REGION LISTING-->
				{/foreach} <!-- end COUNTRY LISTING -->
				
			</table>
			</form>
			
		</div>
		
		
	
	</div>

    	
</div>








<script type="text/javascript">
var formPleaseFill = "{$lang.controller.jsFormPleaseFillMoney} ({$currency->currencyCode})";
var errMoneyFormat = "{$lang.controller.jsErrMoneyFormat}";

{literal}
//jquery fx begin
$(document).ready(function()
{
	$('.shipping_price_cell').bind('mouseover', function(){	
			$(this).find('.shipping_price_display').hide();
			$(this).find('.shipping_price_editor').show();
		}).bind('mouseout', function(){
			$(this).find('.shipping_price_editor').hide();
			$(this).find('.shipping_price_display').show();
		})
});

function priceChange(country, region, city, group, isadd)
{
	var usermoney = prompt(formPleaseFill, $("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_input").html());
	
	
	if(usermoney != null)
	{
		if(parseFloat(usermoney) >= 0)
		{
			{/literal}
			var loadingIndicator = "<img src='{$currentTemplate}/images/admin/ajax-loader-small-indicator-blue.gif' />Saving...";
			var requestUrl = "{$conf.rooturl_admin}shipping/priceupdateajax/";
			{literal}
			
			//Begin using AJAX to create selected manufacturer
			$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_indicator").html(loadingIndicator);
		
			
			$.ajax({
					url: requestUrl,
					type: 'POST',
					dataType: 'xml',
					data: 'country=' + country + '&region=' + region + '&city=' + city + '&group=' + group + '&money=' + usermoney,
					error: function(){
						alert('Error loading XML document');
						$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_indicator").html('');
					},
					success: function(xml){
						var success = $(xml).find('success').text();
						var message = $(xml).find('message').text();
						var displaymoney = $(xml).find('displaymoney').text();
						var editmoney = $(xml).find('editmoney').text();
						
												
						if(success == "1")
						{
							//finish all task with ajax success
							$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_indicator").html('');
							$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_display").html(displaymoney);
							$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_input").html(editmoney);
							
							if(isadd == 1)
							{
								var htmldata = '{/literal}<a title="{$lang.controller.priceChangeTooltip}" href="javascript:void(0);" onclick="priceChange(\\''+country+'\\', '+ region +', '+ city +', '+ group +', 0)"><img border="0" src="{$currentTemplate}/images/admin/edit.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a>&nbsp;<a title="{$lang.controller.priceRemoveTooltip}" href="javascript:void(0);" onclick="priceRemove(\\''+ country +'\\', '+ region +', '+ city +', '+ group +')"><img border="0" src="{$currentTemplate}/images/admin/delete.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16" height="16" /></a>{literal}';
								$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_editor").html(htmldata);
							}
							
							
						}
						else
							alert(message);
						
					}
				});
		}
		else
			alert(errMoneyFormat);
	}
}



function priceRemove(country, region, city, group)
{
	if (confirm(delConfirm))
	{
		{/literal}
		var loadingIndicator = "<img src='{$currentTemplate}/images/admin/ajax-loader-small-indicator-blue.gif' />Saving...";
		var requestUrl = "{$conf.rooturl_admin}shipping/priceupdateajax/";
		{literal}
		
		//Begin using AJAX to create selected manufacturer
		$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_indicator").html(loadingIndicator);
	
		
		$.ajax({
				url: requestUrl,
				type: 'POST',
				dataType: 'xml',
				data: 'isremove=1&country=' + country + '&region=' + region + '&city=' + city + '&group=' + group,
				error: function(){
					alert('Error loading XML document');
					$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group + " .shipping_price_indicator").html('');
				},
				success: function(xml){
					var success = $(xml).find('success').text();
					var message = $(xml).find('message').text();
																
					if(success == "1")
					{
						//finish all task with ajax success
						
						var htmldata = '<div class="shipping_price_indicator"></div>';
						htmldata += '<div class="shipping_price_display"></div>';
						htmldata += '<div class="shipping_price_input"></div>';
						htmldata += '<div class="shipping_price_editor">';
						htmldata += '<a title="{/literal}{$lang.controller.priceSetTooltip}{literal}" href="javascript:void(0);" onclick="priceChange(\\''+country+'\\', '+region+', '+city+', '+group+')"><img border="0" src="{/literal}{$currentTemplate}{literal}/images/admin/add.png" alt="{/literal}{$lang.controllergroup.formAddLabel}{literal}" width="16"/></a></div>';
						$("#shipping_price_" + country + "_" + region + "_" + city + "_" + group).html(htmldata);

					
					}
					else
						alert(message);
					
				}
			});
	}
	
	
	
}



{/literal}
</script>
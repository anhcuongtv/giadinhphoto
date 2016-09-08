<h2>{$lang.controller.head_list}</h2>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} {if $formData.search != ''}| {$lang.controller.title_listSearch} {/if}({$total})</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controllergroup.filterLabel}</a></li>
		</ul>
		{if $formData.search != ''}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}order">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}order/add/redirect/{$redirectUrl}">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.orderBulkToken}" />
				<table class="grid" cellpadding="5" width="100%">
					
				{if $orders|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th align="left" width="30"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">ID</a></th>
							<th align="left"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Invoice ID</a></th>		
							<th align="left">{$lang.controller.printCustomerInfo}</th>				
							<th align="right"><a href="{$filterUrl}sortby/subtotal/sorttype/{if $formData.sortby eq 'subtotal'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formOrderTotalLabel}</a></th>	
                            <th align="center"><a href="{$filterUrl}sortby/datepaid/sorttype/{if $formData.sortby eq 'datepaid'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formPaidLabel}</a></th>	
                            <th align="left">{$lang.controller.formOrderPaidMethod}</th>			
										
							
							<th width="100" align="left"><a href="{$filterUrl}sortby/status/sorttype/{if $formData.sortby eq 'status'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formOrderStatusLabel}</a></th>
							<th><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formOrderOnLabel}</a></th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="10">
								<div class="bulk-actions align-left">
									<select name="fbulkaction">
										<option value="">{$lang.controllergroup.bulkActionSelectLabel}</option>
										<option value="delete">{$lang.controllergroup.bulkActionDeletetLabel}</option>
									</select>
									<input type="submit" name="fsubmitbulk" class="button" value="{$lang.controllergroup.bulkActionSubmit}" />
								</div>
								
								<div class="pagination">
								   {assign var="pageurl" value="page/::PAGE::"}
									{paginate count=$totalPage curr=$curPage lang=$paginateLang max=10 url=$paginateurl$pageurl}
								</div> <!-- End .pagination -->
		
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>
					<tbody>
				{foreach item=order from=$orders}
					
						<tr {if $order->status == 'completed'}style="background:#A5F791;" title="Completed"{/if}>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="{$order->id}" {if in_array($order->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$order->id}</td>
							<td style="font-weight:bold;"><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}order/edit/id/{$order->id}/redirect/{$redirectUrl}">{$order->invoiceid}</a></td>
							<td>{$order->billingFirstname} {$order->billingLastname}</td>
							<td align="right">{assign var=priceAfterAll value=$order->subtotal+$order->shipprice+$order->taxprice}{$currency->formatPrice($priceAfterAll)}</td>
                            <td align="center">{if $order->datepaid > 0 || $order->status == 'completed'}<img src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="Yes" border="0" width="16" title="{$lang.controller.formOrderPaidAtTooltip}: {$order->datepaid|date_format:$lang.controllergroup.dateFormatTimeSmarty}. {$lang.controller.formOrderPaidMethod}: {$order->paymentmethod}" />{/if}</td>
                            <td align="left">{$order->paymentmethod|upper}</td>
							
							<td align="left">{$order->status}</td>
							<td align="center">{$order->datecreated|date_format:$lang.controllergroup.dateFormatTimeSmarty}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}order/edit/id/{$order->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}order/delete/id/{$order->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
						</tr>
						
					
				{/foreach}
				</tbody>
					
				  
				{else}
					<tr>
						<td colspan="9"> {$lang.controllergroup.notfound}</td>
					</tr>
				{/if}
				
				</table>
			</form>
	
		</div>
		
		<div class="tab-content" id="tab2">
			<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
				{$lang.controllergroup.formIdLabel}: 
				<input type="text" name="fid" id="fid" size="8" value="{$formData.fid|@htmlspecialchars}" class="text-input" /> - 
				
				{$lang.controller.formInvoiceIdLabel}: 
				<input type="text" name="finvoiceid" id="finvoiceid" size="8" value="{$formData.finvoiceid|@htmlspecialchars}" class="text-input" /> - 
				
				
				{$lang.controller.formKeywordLabel}:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="{$formData.fkeyword|@htmlspecialchars}" class="text-input" /><select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="email" {if $formData.fsearchin eq 'email'}selected="selected"{/if}>{$lang.controller.formKeywordInEmailLabel}</option>
						<option value="status" {if $formData.fsearchin eq 'status'}selected="selected"{/if}>{$lang.controller.formKeywordInStatusLabel}</option>
						<option value="paymentmethod" {if $formData.fsearchin eq 'paymentmethod'}selected="selected"{/if}>{$lang.controller.formKeywordInPaymentmethodLabel}</option>
						<option value="firstname" {if $formData.fsearchin eq 'firstname'}selected="selected"{/if}>{$lang.controller.formKeywordInFirstNameLabel}</option>
						<option value="lastname" {if $formData.fsearchin eq 'lastname'}selected="selected"{/if}>{$lang.controller.formKeywordInLastNameLabel}</option>
						<option value="phone" {if $formData.fsearchin eq 'phone'}selected="selected"{/if}>{$lang.controller.formKeywordInPhoneLabel}</option>
						<option value="comment" {if $formData.fsearchin eq 'comment'}selected="selected"{/if}>{$lang.controller.formKeywordInCommentLabel}</option>
						<option value="address" {if $formData.fsearchin eq 'address'}selected="selected"{/if}>{$lang.controller.formKeywordInAddressLabel}</option>
						<option value="city" {if $formData.fsearchin eq 'city'}selected="selected"{/if}>{$lang.controller.formKeywordInCityLabel}</option>
						<option value="region" {if $formData.fsearchin eq 'region'}selected="selected"{/if}>{$lang.controller.formKeywordInRegionLabel}</option>
						<option value="country" {if $formData.fsearchin eq 'country'}selected="selected"{/if}>{$lang.controller.formKeywordInCountryLabel}</option>
						<option value="zipcode" {if $formData.fsearchin eq 'zipcode'}selected="selected"{/if}>{$lang.controller.formKeywordInZipcodeLabel}</option>
						
					</select>
					
				
				
				
				<input type="button" name="fsubmit" value="{$lang.controllergroup.filterSubmit}" class="button" onclick="gosearch();"  />
		
			</form>
		</div>
		
		
	
	</div>
	

    	
</div>

{literal}
<script type="text/javascript">
	function gosearch()
	{
		var path = rooturl_admin + "order/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		var invoiceid = $("#finvoiceid").val();
		if(parseInt(invoiceid) > 0)
		{
			path += "/invoiceid/" + invoiceid;
		}
		
		var keyword = $("#fkeyword").val();
		if(keyword.length > 0)
		{
			path += "/keyword/" + keyword;
		}
		
		var keywordin = $("#fsearchin").val();
		if(keywordin.length > 0)
		{
			path += "/searchin/" + keywordin;
		}
		
				
		document.location.href= path;
	}
</script>
{/literal}







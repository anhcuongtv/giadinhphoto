{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.reviewTitle}</h1>
		<div>


			{if $cancel_return eq '1'}
				<div align="left" style="font-weight:bold;font-size:20px;margin-left:10px;color:#0066CC;">{$lang.controller.reviewCancelText}</div>
				<br />
				<div align="left" style="margin-left:10px;color:#0066FF;font-weight:bold;font-size:14px;">
					<a href="{if $smarty.session.continueshoppingurl eq ''}{$conf.rooturl}site/product{else}{$smarty.session.continueshoppingurl}{/if}" title="{$lang.controller.continueShoppingTooltip}"><img alt="{$lang.controller.continueShoppingTooltip}" src="{$conf.rooturl}{$currentTemplate}/images/site/{$langCode}/continueshopbtn.png" width="146" height="20" border="0" /></a>
				</div>
			{else}
				<div align="left" style="font-weight:bold;font-size:24px;margin-bottom:10px;margin-left:10px;">
					{$lang.controller.reviewHeading} ({$lang.controller.printInvoiceLabel} #{$myOrder->invoiceid})
				</div>
				{include file="notify.tpl" notifyError=$error notifySuccess=$success}
				<form name="manage" action="" method="post">
				<table border="0"  cellpadding="2" cellspacing="1" style="" width="98%"  class="adminaccount_table">
					<tr class="tablegrid_rowtitle1">
						
						<td align="left">{$lang.controller.itemproduct}</td>
						<td align="right" width="100">{$lang.controller.itemprice}</td>
						<td align="center" width="70">{$lang.controller.itemquantity}</td>
						<td align="right" width="120">{$lang.controller.itemsubtotal}</td>    
					</tr>
				{foreach item=item from=$myOrder->productList}
					<tr bgcolor="#{cycle values="ffffff,f7f7f7"}">
						
						<td align="left" style="font-weight:bold;">{$item->productName}</td>
						<td align="right" >{$currency->formatPrice($item->unitCost)}</td>
						<td align="center">{$item->quantity}</td>
						<td align="right" style="font-weight:bold;">{$currency->formatPrice($item->subtotal)}</td>	
					</tr>
				{/foreach}
					
					<tr>
						<td valign="top" colspan="4" align="right" class="totalpricearea" style="border-top:1px solid #cccccc;">
							<table>
								<tr>
									<td align="right">{$lang.controller.cartSubTotal}:</td><td align="right">{$currency->formatPrice($totalprice)}</td>
								</tr>
								
								<tr class="cart_totalamount_row">
									<td align="right"><span style="font-weight:bold;color:#000;">{$lang.controller.cartTotal}:</span></td><td align="right" style="font-weight:bold;color:#000;">{$currency->formatPrice($totalpriceAfterTax)}</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</form>
				<div align="left" style="font-weight:bold;font-size:20px;margin-left:10px;color:#0066CC;">{$lang.controller.reviewBuySuccessText}</div>
				<br />
				<div align="left" style="margin-left:10px;color:#0066FF;font-weight:bold;font-size:14px;">
					<a href="{$conf.rooturl}memberarea.html?tab=upload"><img alt="Continue" src="{$conf.rooturl}{$currentTemplate}/images/site/{$langCode}/continue.png" width="146" height="20" border="0" /></a>
				</div>
				{/if}
		
		</div>
	</div>
</div>






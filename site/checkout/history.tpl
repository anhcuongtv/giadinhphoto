	<div class="cmscontent">
			<div class="cmscontent_title">
				{$lang.controller.orderHistoryTitle} ({$total})
			</div>
			<div class="cmscontent_contents">
				<table border="1" cellpadding="2" cellspacing="0" style="border:1px solid #dddddd;border-collapse:collapse;" width="100%"  class="adminaccount_table">
				<tr>
					<td>
						<div>
							<table border="1" cellpadding="2" cellspacing="0" style="border-color:#dddddd;border-collapse:collapse;" width="100%"  class="adminaccount_table">
								<tr class="tablegrid_rowtitle1">
									<td width="70" align="center">{$lang.controller.orderInvoiceId}</td>
									<td align="center">{$lang.controller.needUpdateShipPrice}</td>
									<td align="right">{$lang.controller.orderTotal}</td>
									<td align="center" width="30">{$lang.controller.orderPaid}</td>
									<td  align="center" width="80" >{$lang.controller.orderStatus}</td>
									<td align="center" width="60" >{$lang.controller.orderOn}</td>
									<td align="center" width="60" >{$lang.controller.orderDetail}</td>
								</tr>
							{foreach item=order from=$orders}
									<tr {if $order->status == 'completed'}style="background:#eeeeee;font-weight:bold;color:#ee5500;"{/if}>
											<td align="center"><a href="javascript:void(0)" onclick="window.open('{$conf.rooturl}site/checkout/history/print/1/invoiceid/{$order->invoiceid}', 'windowname1', 'scrollbars=1, resizeable=yes, width=750, height=700'); return false;" style="font-weight:bold;text-decoration:none;font-family:'Courier New', Courier, monospace;font-size:14px;{if $order->status == 'completed'}color:#ee5500;{/if}">{$order->invoiceid}</a></td>
											<td align="center" style="font-size:10px;">
											
											{if $order->shipIssetManual == '1'}
												<img alt="yes" src="{$conf.rooturl}{$currentTemplate}/images/site/tick.gif" border="0" width="16" title="{if $order->shipIsset == '1'}Shipping price have been updated. You can proceed to payment now!{else}Shipping price have not been updated yet{/if}" />
												
											{/if}
											</td>
											<td align="right">{assign var=priceAfterAll value=$order->subtotal+$order->shipprice+$order->taxprice}{$currency->formatPrice($priceAfterAll)}</td>
											<td  align="center">{if $order->datepaid > 0}<img alt="yes" src="{$conf.rooturl}{$currentTemplate}/images/site/tick.gif" border="0" width="16" />{else}{if $order->status != 'completed'}
														{if $order->shipIsset == '1'}
															<a href="{$conf.rooturl}site/checkout/paymentformmanual/invoice/{$order->invoiceid}" title="Click here to pay for this order"><img alt="Pay now" src="{$conf.rooturl}{$currentTemplate}/images/site/{$langCode}/icon_pay_now.gif" border="0"/></a>
														{/if}
												  {/if}{/if}</td>
											<td align="center">{assign var=statusstring value=status`$order->status`}{$lang.controller[$statusstring]}</td>
											<td align="center">{$order->datecreated|date_format}</td>
											<td align="center"><a href="javascript:void(0)" onclick="window.open('{$conf.rooturl}site/checkout/history/print/1/invoiceid/{$order->invoiceid}', 'windowname1', 'scrollbars=1, resizeable=yes, width=750, height=700'); return false;"><img src="{$conf.rooturl}{$currentTemplate}/images/site/{$langCode}/view_button.png" width="54" height="20" border="0"/></a> </td>
									</tr>
							{/foreach}
							</table>
						<br />
						{assign var="pageurl" value="page/::PAGE::"}
						{paginate count=$totalPage curr=$curPage lang=$paginateLangIndex max=10 url=$paginateUrl$pageurl}
						<br />
						</div>
					</td>
				
				</tr>
				
		</table>
	</div>
</div>

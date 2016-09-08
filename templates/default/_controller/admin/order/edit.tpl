<h2>{$lang.controller.head_edit}</h2>



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
			
			<table  border="0" cellpadding="2" cellspacing="0" style="border-collapse:collapse;border-top:1px solid #CC6600;border-left:1px solid #CC6600;border-right:1px solid #CC6600;border-bottom:1px solid #CC6600;" width="100%"  class="adminaccount_table">
			<tr>
				<td style="font-weight:bold;font-size:18px;color:#FFFFFF;" align="center" bgcolor="#D76702">{$lang.controller.formInvoiceIdLabel} #{$myOrder->invoiceid}</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td width="50%" valign="top" style="vertical-align:top">
								
								<table width="100%" border="0" cellpadding="5" cellspacing="5" style="border:1px solid #eeeeee;" class="highlightTable">
									<tr>
										<th height="30" colspan="2" bgcolor="#cccccc" style="font-weight:bold;" align="left">{$lang.controller.formShipServiceLabel}:</th>
									</tr>
									<tr>
										<td align="left" style="font-weight:bold;" colspan="2">
										<div style="font-style:italic;font-weight:normal;margin-top:20px;"><strong>{$lang.controller.formOrderCommentLabel}</strong> {$myOrder->comment|strip_tags|nl2br} [<a href="javascript:void(0)" onclick="$('#ordercommentform').toggle();">{$lang.controllergroup.formEditLabel}</a>]</div>										
										<form style="display:none;" id="ordercommentform" method="post" action="{$conf.rooturl_admin}order/edit/id/{$myOrder->id}/redirect/{$encodedRedirectUrl}">
										<input type="hidden" name="ftoken" value="{$smarty.session.productfieldEditToken}" />
											<table width="100%" style="font-weight:normal;border:1px solid #ccc;margin:10px 0;" cellpadding="5">
												<tr style="height:30px;font-weight:bold;background:#F60;color:#fff;"><td colspan="2">{$lang.controllergroup.formEditLabel}</td></tr>
												<tr>
													<td>{$lang.controller.formOrderCommentLabel}: </td>
													<td><textarea rows="7" name="fcomment">{$formData->fcomment|default:$myOrder->comment}</textarea></td>
												</tr>
												
												<tr>
													<td>&nbsp;</td>
													<td><input type="submit" name="fsubmitcomment" value="{$lang.controllergroup.formUpdateSubmit}" /></td>
												</tr>
											</table>
										</form>
										
										
										
										
										</td>
									</tr>
								</table>
							</td>
                            
							<td width="50%" valign="top" style="vertical-align:top;">
								<table width="100%" border="1" cellpadding="5" cellspacing="5" style="border:1px solid #eeeeee;" class="highlightTable">
									<tr height="30">
										<th colspan="2" bgcolor="#cccccc" style="font-weight:bold;" align="left">Buyer:</th>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formFirstnameLabel}: </td>
										<td>{$myOrder->shippingFirstname}</td>
									</tr>
									{if $myOrder->shippingMid != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formMidLabel}: </td>
										<td>{$myOrder->shippingMid}</td>
									</tr>{/if}
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formLastnameLabel}: </td>
										<td>{$myOrder->shippingLastname}</td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formContactEmailLabel}: </td>
										<td><a href="mailto:{$myOrder->contactemail}">{$myOrder->contactemail}</a><input type="hidden" name="femail" value="{$myOrder->contactemail}" /></td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formAddressLabel}: </td>
										<td>{$myOrder->shippingAddress}</td>
									</tr>
									{if $myOrder->shippingAddress2 != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formAddress2Label}: </td>
										<td>{$myOrder->shippingAddress2}</td>
									</tr>{/if}
									{if $myOrder->shippingCityText != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formCityLabel}: </td>
										<td>{$myOrder->shippingCityText}</td>
									</tr>{/if}
									{if $myOrder->shippingRegionText != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formRegionLabel}: </td>
										<td style="color:#0066FF;font-weight:bold;">{$myOrder->shippingRegionText}</td>
									</tr>{/if}
									{if $myOrder->shippingCountryText != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formCountryLabel}: </td>
										<td style="color:#0066FF;font-weight:bold;">{$myOrder->shippingCountryText}</td>
									</tr>{/if}
									
									{if $myOrder->shippingZipcode != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formZipcodeLabel}: </td>
										<td>{$myOrder->shippingZipcode}</td>
									</tr>{/if}
									
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formPhoneLabel}: </td>
										<td>{$myOrder->shippingPhone}</td>
									</tr>
									{if $myOrder->shippingPhone2 != ''}<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formPhone2Label}: </td>
										<td>{$myOrder->shippingPhone2}</td>
									</tr>{/if}
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formOrderOnLabel}: </td>
										<td>{$myOrder->datecreated|date_format:$lang.controllergroup.dateFormatTimeSmarty}</td>
									</tr>
                                    <tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formOrderPaidMethod}: </td>
										<td><strong>{$myOrder->paymentmethod|upper}</strong></td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formOrderStatusLabel}: </td>{if $formData.fstatus != ""}{assign var="status" value=$formData.fstatus}{else}
										{assign var="status" value=$myOrder->status}{/if}
										<td><form name="shippingInformation" method="post" action="{$conf.rooturl_admin}order/edit/id/{$myOrder->id}/redirect/{$encodedRedirectUrl}">
										<select name="fstatus" style="font-weight:bold;color:#FF0000;" onchange="javascript:document.shippingInformation.submit();">
											<option value="pending" {if $status == 'pending'}selected="selected"{/if}>{$lang.controller.statuspending}</option>
											<option value="completed" {if $status == 'completed'}selected="selected"{/if}>{$lang.controller.statuscompleted}</option>
											<option value="cancel" {if $status == 'cancel'}selected="selected"{/if}>{$lang.controller.statuscancel}</option>
											<option value="error" {if $status == 'error'}selected="selected"{/if}>{$lang.controller.statuserror}</option>
									</select></form></td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;">{$lang.controller.formClientOrderLabel}: </td>
										<td><a title="{$lang.controller.formClientOrderTooltip}" href="{$conf.rooturl_admin}user/edit/id/{$myOrder->memberid}">{$myOrder->contactemail}</a></td>
									</tr>
								</table>
								
								<br />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table border="0"  cellpadding="2" cellspacing="0" style="border-collapse:collapse;" width="100%"  class="tablegrid highlightTable">
						<tr class="tablegrid_rowtitle1">
							<th colspan="6" align="center">{$lang.controller.formOrderDetailLabel}</th>
						</tr>
						<tr class="tablegrid_rowtitle2">
							<th width="20"></th>
							<th align="left">{$lang.controller.formOrderProductLabel}</th>
							<th  align="center" width="100">{$lang.controller.formOrderPriceLabel}</th>
							<th align="center" width="50">{$lang.controller.formOrderQuantityLabel}</th>
							<th align="center" width="150">{$lang.controller.formOrderSubtotalLabel}</th>
						</tr>
					{foreach name=orderproductlist item=item from=$myOrder->productList}
						<tr class="{cycle values="tablegrid_rowview, tablegrid_rowview_alt"}">
							<td align="center"><div class="shoppingcart_productorder">{$smarty.foreach.orderproductlist.iteration}</div></td>
							<td style="padding:5px;"><a title="{$item->productName}" href="{$conf.rooturl_admin}product/edit/id/{$item->productId}" style="color:#333333;text-decoration:none;">{$item->productName}</a></td>
							<td align="right">{$currency->formatPrice($item->unitCost)}</td>
							<td align="center">{$item->quantity}</td>
							<td align="right">{$currency->formatPrice($item->subtotal)}</td>
						</tr>
					{/foreach}
					</table>
				</td>
			</tr>
			<tr>
				<td align="right" style="">
					<table>
						<tr>
							<td align="right">{$lang.controller.formOrderSubtotalLabel}:</td>
							<td align="right">{$currency->formatPrice($myOrder->subtotal)}</td>
						</tr>
						
						<tr>
							<td align="right"><span style="font-weight:bold;color:#000;">{$lang.controller.formOrderTotalLabel}:</span></td>
							<td align="right" style="font-weight:bold;color:#000;">{assign var=priceAfterAll value=$myOrder->subtotal+$myOrder->shipprice+$myOrder->taxprice}{$currency->formatPrice($priceAfterAll)}</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr bgcolor="#CC6600">
				<td height="5"></td>
			</tr>
		</table>
		
		
		<br /><br />
		<div align="center">
			<a href="javascript:void(0)" onclick="window.open('{$conf.rooturl_admin}order/edit/id/{$myOrder->id}/print/1', 'windowname1', 'scrollbars=1, resizeable=yes, width=750, height=700'); return false;"><img src="{$currentTemplate}/images/admin/print.png" alt="Print Version" width="66" height="38" border="0" /></a>
		</div>			
		</div>
		
	
		
	</div>
	
	
    	
</div>



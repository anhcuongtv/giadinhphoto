{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.title}</h1>
		
		{include file="notify.tpl" notifyError=$error}

		<div id="tabpayment">
				<div class="infoSelectPayment">{$lang.controller.paymentYourSelect}</div>
				<div class="paymentOptionList">
					{if $packDetail}
						{if $country|strtolower === 'vn'}
							{assign var=price value=$packDetail->price_vn}
							{$packDetail->description_vn}
						{else}
							{assign var=price value=$packDetail->price_en}
							{$packDetail->description_en}
						{/if}
					{/if}
				</div>

				<div><a href="{$conf.rooturl}memberarea.html?tab=payment" title="Back">{$lang.controller.paymentSectionChange}</a></div>
				
				<div class="paymentOptionTotal">
					{$lang.controller.paymentTotal} : <span id="paymentOptionPrice">{$currency->formatPrice($price)}</span>
				</div>
				
				<div class="paymentMethodSelect">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectPaypal">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectPaypal');"><a name="selectpayment"></a>{$lang.controller.paymentSelectHeading}</div>
						<div class="paymentMethodBody">
						
							{if $errorCheckout != ''}
							{include file="notify.tpl" notifyError=$errorCheckout}
							
							
							{/if}
							
							<table border="0" width="100%" style="background:url({$staticserver}{$currentTemplate}/images/site/paypal_verified.jpg) no-repeat top right;">
							 <tbody><tr>
								<td colspan="2">
								 <form method="post" action="{$conf.rooturl}site/checkout/payment" name="manage">
									<table width="100%">
									<tr>
										<td colspan="2" style="font-weight:bold;">{$lang.controller.paymentFormHelp}</td>
									</tr>
									<tr>
										<td width="150" align="left">{$lang.controller.paymentFormCardType}:</td>
										<td>
											<label><input type="radio" name="fcardtype" value="MasterCard" {if $formData.fcardtype eq 'MasterCard'}checked{/if} /><img align="top" alt="MasterCard" title="MasterCard" src="{$staticserver}{$currentTemplate}/images/site/cardtype_mastercard.gif" border="1"/></label>
											&nbsp;&nbsp;&nbsp;<label><input type="radio" name="fcardtype" value="Visa" {if $formData.fcardtype eq 'Visa'}checked{/if} /><img align="top" alt="Visa" title="Visa" src="{$staticserver}{$currentTemplate}/images/site/cardtype_visa.gif" border="1"/></label>
											&nbsp;&nbsp;&nbsp;<label><input type="radio" name="fcardtype" value="Discover" {if $formData.fcardtype eq 'Discover'}checked{/if} /><img align="top" alt="Discover" title="Discover" src="{$staticserver}{$currentTemplate}/images/site/cardtype_discover.gif" border="1"/></label>
											&nbsp;&nbsp;&nbsp;<label><input type="radio" name="fcardtype" value="Amex" {if $formData.fcardtype eq 'Amex'}checked{/if} /><img align="top" alt="Amex" title="Amex" src="{$staticserver}{$currentTemplate}/images/site/cardtype_amex.gif" border="1"/></label>
										</td>
									</tr>
									
									<tr class="directpayment_data">
										<td align="left">{$lang.controller.paymentFormFirstname}:</td>
										<td align="left"><input type="text" name="ffirstname" value="{if $formData.ffirstname neq ''}{$formData.ffirstname}{else}{$orderInformation.billing_firstname}{/if}"/></td>
									</tr>
									<tr class="directpayment_data">
										<td align="left">{$lang.controller.paymentFormLastname}:</td>
										<td align="left"><input type="text" name="flastname" value="{if $formData.flastname neq ''}{$formData.flastname}{else}{$orderInformation.billing_lastname}{/if}"/></td>
									</tr>
									
									<tr class="directpayment_data">
										<td align="left">{$lang.controller.paymentFormZipcode}:</td>
										<td align="left"><input type="text" name="fzipcode" value="{$formData.fzipcode}" size="5"/></td>
									</tr>
									<tr class="directpayment_data">
										<td align="left">{$lang.controller.paymentFormCardNumber}:</td>
										<td align="left"><input type="text" name="fcardnumber" value="{$formData.fcardnumber}" size="30"/></td>
									</tr>
									<tr class="directpayment_data">
										<td align="left">{$lang.controller.paymentFormCvv}:</td>
										<td align="left"><input type="text" name="fcvvnumber" value="{$formData.cvvnumber}" size="5"/></td>
									</tr>
								 <tr class="directpayment_data">
										<td align="left">{$lang.controller.paymentFormExpiredDate}:</td>
										<td align="left"><select name="fexpiredmonth"><option value="0">- {$lang.controller.paymentFormExpiredDateMonth} -</option>{html_options options=$monthOptions selected=$formData.fexpiredmonth}</select>
												<select name="fexpiredyear"><option value="0">- {$lang.controller.paymentFormExpiredDateYear} -</option>{html_options options=$yearOptions selected=$formData.fexpiredyear}</select>
										
										</td>
									</tr>
									
									<tr>
										<td></td>
										<td align="left"><input type="image" src="{$staticserver}{$currentTemplate}/images/site/{$langCode}/paynow_btn.gif" style="border:0;" name="submitimage" />
												<input type="hidden" name="fsubmit" value="1" />
										</td>
									</tr>
								</table>
								</form>
								</td>
								</tr>
								
							
								<tr>
									<td width="150"></td>
									<td align="right"><br /><div style="padding-right:70px;font-style:italic;">{$lang.controller.paymentOrLabel}</div>
									<form method="post" action="{$conf.rooturl}site/checkout/payment{if $orderInformation.invoiceid != ''}/invoice/{$orderInformation.invoiceid}{/if}#selectpayment"> 
										 <input type="hidden" name="method" value="SetExpressCheckout" />
										 <input type="hidden" name="fsubmit" value="1" />
											<input type="image" src="{$staticserver}{$currentTemplate}/images/site/cardtype_paypal.gif" style="border:0;"/>
									</form>
									</td>
								</tr>
								
													
							</tbody></table>		
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					<form method="post" action="{$conf.rooturl}site/checkout/placeorder">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectCash">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectCash');">{$lang.controller.paymentFormCashTitle}</div>
						<div class="paymentMethodBody">
							<div class="button"><input type="image" src="{$staticserver}{$currentTemplate}/images/site/{$langCode}/paynow_btn.gif" alt="Place Order" /></div>
							<div class="paymentMethodText">{$lang.controller.paymentFormCashText}<br /><br /></div>
							
							<div class="comment">
								<span style="font-size:11px; color:#555"><i>{$lang.controller.paymentFormCashCommentLabel}:</i></span><br />
								<textarea name="fcomment" rows="4" cols="50"></textarea>
								<input type="hidden" name="ftype" value="cash" />
							</div>
							<div class="clear"></div>
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					</form>
					
					 <form method="post" action="{$conf.rooturl}site/checkout/placeorder">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectBank">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectBank');">{$lang.controller.paymentFormBankTitle}</div>
						<div class="paymentMethodBody">
							<div class="button"><input type="image" src="{$staticserver}{$currentTemplate}/images/site/{$langCode}/paynow_btn.gif" alt="Place Order" /></div>
							<div class="paymentMethodText">{$lang.controller.paymentFormBankText}<br /><br /></div>
							
							<div class="comment">
								<span style="font-size:11px; color:#555"><i>{$lang.controller.paymentFormBankCommentLabel}:</i></span><br />
								<textarea name="fcomment" rows="4" cols="50"></textarea>
								<input type="hidden" name="ftype" value="bank" />
							</div>
							<div class="clear"></div>
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					</form>
					
					 <form method="post" action="{$conf.rooturl}site/checkout/placeorder">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectPostoffice">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectPostoffice');">{$lang.controller.paymentFormPostofficeTitle}</div>
						<div class="paymentMethodBody">
							<div class="button"><input type="image" src="{$staticserver}{$currentTemplate}/images/site/{$langCode}/paynow_btn.gif" alt="Place Order" /></div>
							<div class="paymentMethodText">{$lang.controller.paymentFormPostofficeText}<br /><br /></div>
							
							<div class="comment">
								<span style="font-size:11px; color:#555"><i>{$lang.controller.paymentFormPostofficeCommentLabel}:</i></span><br />
								<textarea name="fcomment" rows="4" cols="50"></textarea>
								<input type="hidden" name="ftype" value="postoffice" />
							</div>
							<div class="clear"></div>
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					</form>
					
				</div>
				
				
				{literal}
				<script type="text/javascript">
					function togglePaymentMethodGroup(groupid)
					{
						$('#' + groupid + ' .paymentMethodBody').slideToggle();		
					}
				</script>
				{/literal}
				
				<div class="paymentMethod">
					<h2>{$myPaymentPage->title.$langCode}</h2>
					<div>{$myPaymentPage->contents.$langCode}</div>
				</div>
			
		
		</div>
	</div>
</div>




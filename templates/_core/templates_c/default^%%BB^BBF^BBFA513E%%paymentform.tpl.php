<?php /* Smarty version 2.6.26, created on 2016-09-18 16:59:44
         compiled from _controller/site/checkout/paymentform.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtolower', '_controller/site/checkout/paymentform.tpl', 12, false),array('function', 'html_options', '_controller/site/checkout/paymentform.tpl', 80, false),)), $this); ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['title']; ?>
</h1>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<div id="tabpayment">
				<div class="infoSelectPayment"><?php echo $this->_tpl_vars['lang']['controller']['paymentYourSelect']; ?>
</div>
				<div class="paymentOptionList">
					<?php if ($this->_tpl_vars['packDetail']): ?>
						<?php if (((is_array($_tmp=$this->_tpl_vars['country'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)) === 'vn'): ?>
							<?php $this->assign('price', $this->_tpl_vars['packDetail']->price_vn); ?>
							<?php echo $this->_tpl_vars['packDetail']->description_vn; ?>

						<?php else: ?>
							<?php $this->assign('price', $this->_tpl_vars['packDetail']->price_en); ?>
							<?php echo $this->_tpl_vars['packDetail']->description_en; ?>

						<?php endif; ?>
					<?php endif; ?>
				</div>

				<div><a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html?tab=payment" title="Back"><?php echo $this->_tpl_vars['lang']['controller']['paymentSectionChange']; ?>
</a></div>
				
				<div class="paymentOptionTotal">
					<?php echo $this->_tpl_vars['lang']['controller']['paymentTotal']; ?>
 : <span id="paymentOptionPrice"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['price']); ?>
</span>
				</div>
				
				<div class="paymentMethodSelect">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectPaypal">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectPaypal');"><a name="selectpayment"></a><?php echo $this->_tpl_vars['lang']['controller']['paymentSelectHeading']; ?>
</div>
						<div class="paymentMethodBody">
						
							<?php if ($this->_tpl_vars['errorCheckout'] != ''): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['errorCheckout'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							
							
							<?php endif; ?>
							
							<table border="0" width="100%" style="background:url(<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/paypal_verified.jpg) no-repeat top right;">
							 <tbody><tr>
								<td colspan="2">
								 <form method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/payment" name="manage">
									<table width="100%">
									<tr>
										<td colspan="2" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormHelp']; ?>
</td>
									</tr>
									<tr>
										<td width="150" align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormCardType']; ?>
:</td>
										<td>
											<label><input type="radio" name="fcardtype" value="MasterCard" <?php if ($this->_tpl_vars['formData']['fcardtype'] == 'MasterCard'): ?>checked<?php endif; ?> /><img align="top" alt="MasterCard" title="MasterCard" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/cardtype_mastercard.gif" border="1"/></label>
											&nbsp;&nbsp;&nbsp;<label><input type="radio" name="fcardtype" value="Visa" <?php if ($this->_tpl_vars['formData']['fcardtype'] == 'Visa'): ?>checked<?php endif; ?> /><img align="top" alt="Visa" title="Visa" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/cardtype_visa.gif" border="1"/></label>
											&nbsp;&nbsp;&nbsp;<label><input type="radio" name="fcardtype" value="Discover" <?php if ($this->_tpl_vars['formData']['fcardtype'] == 'Discover'): ?>checked<?php endif; ?> /><img align="top" alt="Discover" title="Discover" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/cardtype_discover.gif" border="1"/></label>
											&nbsp;&nbsp;&nbsp;<label><input type="radio" name="fcardtype" value="Amex" <?php if ($this->_tpl_vars['formData']['fcardtype'] == 'Amex'): ?>checked<?php endif; ?> /><img align="top" alt="Amex" title="Amex" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/cardtype_amex.gif" border="1"/></label>
										</td>
									</tr>
									
									<tr class="directpayment_data">
										<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormFirstname']; ?>
:</td>
										<td align="left"><input type="text" name="ffirstname" value="<?php if ($this->_tpl_vars['formData']['ffirstname'] != ''): ?><?php echo $this->_tpl_vars['formData']['ffirstname']; ?>
<?php else: ?><?php echo $this->_tpl_vars['orderInformation']['billing_firstname']; ?>
<?php endif; ?>"/></td>
									</tr>
									<tr class="directpayment_data">
										<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormLastname']; ?>
:</td>
										<td align="left"><input type="text" name="flastname" value="<?php if ($this->_tpl_vars['formData']['flastname'] != ''): ?><?php echo $this->_tpl_vars['formData']['flastname']; ?>
<?php else: ?><?php echo $this->_tpl_vars['orderInformation']['billing_lastname']; ?>
<?php endif; ?>"/></td>
									</tr>
									
									<tr class="directpayment_data">
										<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormZipcode']; ?>
:</td>
										<td align="left"><input type="text" name="fzipcode" value="<?php echo $this->_tpl_vars['formData']['fzipcode']; ?>
" size="5"/></td>
									</tr>
									<tr class="directpayment_data">
										<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormCardNumber']; ?>
:</td>
										<td align="left"><input type="text" name="fcardnumber" value="<?php echo $this->_tpl_vars['formData']['fcardnumber']; ?>
" size="30"/></td>
									</tr>
									<tr class="directpayment_data">
										<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormCvv']; ?>
:</td>
										<td align="left"><input type="text" name="fcvvnumber" value="<?php echo $this->_tpl_vars['formData']['cvvnumber']; ?>
" size="5"/></td>
									</tr>
								 <tr class="directpayment_data">
										<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormExpiredDate']; ?>
:</td>
										<td align="left"><select name="fexpiredmonth"><option value="0">- <?php echo $this->_tpl_vars['lang']['controller']['paymentFormExpiredDateMonth']; ?>
 -</option><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['monthOptions'],'selected' => $this->_tpl_vars['formData']['fexpiredmonth']), $this);?>
</select>
												<select name="fexpiredyear"><option value="0">- <?php echo $this->_tpl_vars['lang']['controller']['paymentFormExpiredDateYear']; ?>
 -</option><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yearOptions'],'selected' => $this->_tpl_vars['formData']['fexpiredyear']), $this);?>
</select>
										
										</td>
									</tr>
									
									<tr>
										<td></td>
										<td align="left"><input type="image" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/paynow_btn.gif" style="border:0;" name="submitimage" />
												<input type="hidden" name="fsubmit" value="1" />
										</td>
									</tr>
								</table>
								</form>
								</td>
								</tr>
								
							
								<tr>
									<td width="150"></td>
									<td align="right"><br /><div style="padding-right:70px;font-style:italic;"><?php echo $this->_tpl_vars['lang']['controller']['paymentOrLabel']; ?>
</div>
									<form method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/payment<?php if ($this->_tpl_vars['orderInformation']['invoiceid'] != ''): ?>/invoice/<?php echo $this->_tpl_vars['orderInformation']['invoiceid']; ?>
<?php endif; ?>#selectpayment"> 
										 <input type="hidden" name="method" value="SetExpressCheckout" />
										 <input type="hidden" name="fsubmit" value="1" />
											<input type="image" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/cardtype_paypal.gif" style="border:0;"/>
									</form>
									</td>
								</tr>
								
													
							</tbody></table>		
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					<form method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/placeorder">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectCash">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectCash');"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormCashTitle']; ?>
</div>
						<div class="paymentMethodBody">
							<div class="button"><input type="image" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/paynow_btn.gif" alt="Place Order" /></div>
							<div class="paymentMethodText"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormCashText']; ?>
<br /><br /></div>
							
							<div class="comment">
								<span style="font-size:11px; color:#555"><i><?php echo $this->_tpl_vars['lang']['controller']['paymentFormCashCommentLabel']; ?>
:</i></span><br />
								<textarea name="fcomment" rows="4" cols="50"></textarea>
								<input type="hidden" name="ftype" value="cash" />
							</div>
							<div class="clear"></div>
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					</form>
					
					 <form method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/placeorder">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectBank">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectBank');"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormBankTitle']; ?>
</div>
						<div class="paymentMethodBody">
							<div class="button"><input type="image" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/paynow_btn.gif" alt="Place Order" /></div>
							<div class="paymentMethodText"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormBankText']; ?>
<br /><br /></div>
							
							<div class="comment">
								<span style="font-size:11px; color:#555"><i><?php echo $this->_tpl_vars['lang']['controller']['paymentFormBankCommentLabel']; ?>
:</i></span><br />
								<textarea name="fcomment" rows="4" cols="50"></textarea>
								<input type="hidden" name="ftype" value="bank" />
							</div>
							<div class="clear"></div>
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					</form>
					
					 <form method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/placeorder">
					<div class="paymentMethodSelectGroup" id="paymentMethodSelectPostoffice">
						<div class="paymentMethodHead" onclick="togglePaymentMethodGroup('paymentMethodSelectPostoffice');"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormPostofficeTitle']; ?>
</div>
						<div class="paymentMethodBody">
							<div class="button"><input type="image" src="<?php echo $this->_tpl_vars['staticserver']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/paynow_btn.gif" alt="Place Order" /></div>
							<div class="paymentMethodText"><?php echo $this->_tpl_vars['lang']['controller']['paymentFormPostofficeText']; ?>
<br /><br /></div>
							
							<div class="comment">
								<span style="font-size:11px; color:#555"><i><?php echo $this->_tpl_vars['lang']['controller']['paymentFormPostofficeCommentLabel']; ?>
:</i></span><br />
								<textarea name="fcomment" rows="4" cols="50"></textarea>
								<input type="hidden" name="ftype" value="postoffice" />
							</div>
							<div class="clear"></div>
						</div>
					</div><!-- end .paymentMethodSelectGroup -->
					</form>
					
				</div>
				
				
				<?php echo '
				<script type="text/javascript">
					function togglePaymentMethodGroup(groupid)
					{
						$(\'#\' + groupid + \' .paymentMethodBody\').slideToggle();		
					}
				</script>
				'; ?>

				
				<div class="paymentMethod">
					<h2><?php echo $this->_tpl_vars['myPaymentPage']->title[$this->_tpl_vars['langCode']]; ?>
</h2>
					<div><?php echo $this->_tpl_vars['myPaymentPage']->contents[$this->_tpl_vars['langCode']]; ?>
</div>
				</div>
			
		
		</div>
	</div>
</div>



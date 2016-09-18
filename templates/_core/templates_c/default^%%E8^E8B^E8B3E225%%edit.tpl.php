<?php /* Smarty version 2.6.26, created on 2016-09-18 17:19:35
         compiled from _controller/admin/order/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '_controller/admin/order/edit.tpl', 37, false),array('modifier', 'nl2br', '_controller/admin/order/edit.tpl', 37, false),array('modifier', 'default', '_controller/admin/order/edit.tpl', 44, false),array('modifier', 'date_format', '_controller/admin/order/edit.tpl', 119, false),array('modifier', 'upper', '_controller/admin/order/edit.tpl', 123, false),array('function', 'cycle', '_controller/admin/order/edit.tpl', 162, false),)), $this); ?>
<h2><?php echo $this->_tpl_vars['lang']['controller']['head_edit']; ?>
</h2>



<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3><?php echo $this->_tpl_vars['lang']['controller']['title_edit']; ?>
</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab"><?php echo $this->_tpl_vars['lang']['controllergroup']['formFormLabel']; ?>
</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<ul class="content-box-link">
			<li><a href="<?php echo $this->_tpl_vars['redirectUrl']; ?>
"><?php echo $this->_tpl_vars['lang']['controllergroup']['formBackLabel']; ?>
</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'],'notifyWarning' => $this->_tpl_vars['warning'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			<table  border="0" cellpadding="2" cellspacing="0" style="border-collapse:collapse;border-top:1px solid #CC6600;border-left:1px solid #CC6600;border-right:1px solid #CC6600;border-bottom:1px solid #CC6600;" width="100%"  class="adminaccount_table">
			<tr>
				<td style="font-weight:bold;font-size:18px;color:#FFFFFF;" align="center" bgcolor="#D76702"><?php echo $this->_tpl_vars['lang']['controller']['formInvoiceIdLabel']; ?>
 #<?php echo $this->_tpl_vars['myOrder']->invoiceid; ?>
</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td width="50%" valign="top" style="vertical-align:top">
								
								<table width="100%" border="0" cellpadding="5" cellspacing="5" style="border:1px solid #eeeeee;" class="highlightTable">
									<tr>
										<th height="30" colspan="2" bgcolor="#cccccc" style="font-weight:bold;" align="left"><?php echo $this->_tpl_vars['lang']['controller']['formShipServiceLabel']; ?>
:</th>
									</tr>
									<tr>
										<td align="left" style="font-weight:bold;" colspan="2">
										<div style="font-style:italic;font-weight:normal;margin-top:20px;"><strong><?php echo $this->_tpl_vars['lang']['controller']['formOrderCommentLabel']; ?>
</strong> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['myOrder']->comment)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
 [<a href="javascript:void(0)" onclick="$('#ordercommentform').toggle();"><?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
</a>]</div>										
										<form style="display:none;" id="ordercommentform" method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/edit/id/<?php echo $this->_tpl_vars['myOrder']->id; ?>
/redirect/<?php echo $this->_tpl_vars['encodedRedirectUrl']; ?>
">
										<input type="hidden" name="ftoken" value="<?php echo $_SESSION['productfieldEditToken']; ?>
" />
											<table width="100%" style="font-weight:normal;border:1px solid #ccc;margin:10px 0;" cellpadding="5">
												<tr style="height:30px;font-weight:bold;background:#F60;color:#fff;"><td colspan="2"><?php echo $this->_tpl_vars['lang']['controllergroup']['formEditLabel']; ?>
</td></tr>
												<tr>
													<td><?php echo $this->_tpl_vars['lang']['controller']['formOrderCommentLabel']; ?>
: </td>
													<td><textarea rows="7" name="fcomment"><?php echo ((is_array($_tmp=@$this->_tpl_vars['formData']->fcomment)) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['myOrder']->comment) : smarty_modifier_default($_tmp, @$this->_tpl_vars['myOrder']->comment)); ?>
</textarea></td>
												</tr>
												
												<tr>
													<td>&nbsp;</td>
													<td><input type="submit" name="fsubmitcomment" value="<?php echo $this->_tpl_vars['lang']['controllergroup']['formUpdateSubmit']; ?>
" /></td>
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
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formFirstnameLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingFirstname; ?>
</td>
									</tr>
									<?php if ($this->_tpl_vars['myOrder']->shippingMid != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formMidLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingMid; ?>
</td>
									</tr><?php endif; ?>
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formLastnameLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingLastname; ?>
</td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formContactEmailLabel']; ?>
: </td>
										<td><a href="mailto:<?php echo $this->_tpl_vars['myOrder']->contactemail; ?>
"><?php echo $this->_tpl_vars['myOrder']->contactemail; ?>
</a><input type="hidden" name="femail" value="<?php echo $this->_tpl_vars['myOrder']->contactemail; ?>
" /></td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formAddressLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingAddress; ?>
</td>
									</tr>
									<?php if ($this->_tpl_vars['myOrder']->shippingAddress2 != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formAddress2Label']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingAddress2; ?>
</td>
									</tr><?php endif; ?>
									<?php if ($this->_tpl_vars['myOrder']->shippingCityText != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formCityLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingCityText; ?>
</td>
									</tr><?php endif; ?>
									<?php if ($this->_tpl_vars['myOrder']->shippingRegionText != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formRegionLabel']; ?>
: </td>
										<td style="color:#0066FF;font-weight:bold;"><?php echo $this->_tpl_vars['myOrder']->shippingRegionText; ?>
</td>
									</tr><?php endif; ?>
									<?php if ($this->_tpl_vars['myOrder']->shippingCountryText != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formCountryLabel']; ?>
: </td>
										<td style="color:#0066FF;font-weight:bold;"><?php echo $this->_tpl_vars['myOrder']->shippingCountryText; ?>
</td>
									</tr><?php endif; ?>
									
									<?php if ($this->_tpl_vars['myOrder']->shippingZipcode != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formZipcodeLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingZipcode; ?>
</td>
									</tr><?php endif; ?>
									
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formPhoneLabel']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingPhone; ?>
</td>
									</tr>
									<?php if ($this->_tpl_vars['myOrder']->shippingPhone2 != ''): ?><tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formPhone2Label']; ?>
: </td>
										<td><?php echo $this->_tpl_vars['myOrder']->shippingPhone2; ?>
</td>
									</tr><?php endif; ?>
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formOrderOnLabel']; ?>
: </td>
										<td><?php echo ((is_array($_tmp=$this->_tpl_vars['myOrder']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['lang']['controllergroup']['dateFormatTimeSmarty'])); ?>
</td>
									</tr>
                                    <tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formOrderPaidMethod']; ?>
: </td>
										<td><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['myOrder']->paymentmethod)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</strong></td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formOrderStatusLabel']; ?>
: </td><?php if ($this->_tpl_vars['formData']['fstatus'] != ""): ?><?php $this->assign('status', $this->_tpl_vars['formData']['fstatus']); ?><?php else: ?>
										<?php $this->assign('status', $this->_tpl_vars['myOrder']->status); ?><?php endif; ?>
										<td><form name="shippingInformation" method="post" action="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/edit/id/<?php echo $this->_tpl_vars['myOrder']->id; ?>
/redirect/<?php echo $this->_tpl_vars['encodedRedirectUrl']; ?>
">
										<select name="fstatus" style="font-weight:bold;color:#FF0000;" onchange="javascript:document.shippingInformation.submit();">
											<option value="pending" <?php if ($this->_tpl_vars['status'] == 'pending'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['statuspending']; ?>
</option>
											<option value="completed" <?php if ($this->_tpl_vars['status'] == 'completed'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['statuscompleted']; ?>
</option>
											<option value="cancel" <?php if ($this->_tpl_vars['status'] == 'cancel'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['statuscancel']; ?>
</option>
											<option value="error" <?php if ($this->_tpl_vars['status'] == 'error'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['controller']['statuserror']; ?>
</option>
									</select></form></td>
									</tr>
									<tr>
										<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formClientOrderLabel']; ?>
: </td>
										<td><a title="<?php echo $this->_tpl_vars['lang']['controller']['formClientOrderTooltip']; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
user/edit/id/<?php echo $this->_tpl_vars['myOrder']->memberid; ?>
"><?php echo $this->_tpl_vars['myOrder']->contactemail; ?>
</a></td>
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
							<th colspan="6" align="center"><?php echo $this->_tpl_vars['lang']['controller']['formOrderDetailLabel']; ?>
</th>
						</tr>
						<tr class="tablegrid_rowtitle2">
							<th width="20"></th>
							<th align="left"><?php echo $this->_tpl_vars['lang']['controller']['formOrderProductLabel']; ?>
</th>
							<th  align="center" width="100"><?php echo $this->_tpl_vars['lang']['controller']['formOrderPriceLabel']; ?>
</th>
							<th align="center" width="50"><?php echo $this->_tpl_vars['lang']['controller']['formOrderQuantityLabel']; ?>
</th>
							<th align="center" width="150"><?php echo $this->_tpl_vars['lang']['controller']['formOrderSubtotalLabel']; ?>
</th>
						</tr>
					<?php $_from = $this->_tpl_vars['myOrder']->productList; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['orderproductlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['orderproductlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['orderproductlist']['iteration']++;
?>
						<tr class="<?php echo smarty_function_cycle(array('values' => "tablegrid_rowview, tablegrid_rowview_alt"), $this);?>
">
							<td align="center"><div class="shoppingcart_productorder"><?php echo $this->_foreach['orderproductlist']['iteration']; ?>
</div></td>
							<td style="padding:5px;"><a title="<?php echo $this->_tpl_vars['item']->productName; ?>
" href="<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
product/edit/id/<?php echo $this->_tpl_vars['item']->productId; ?>
" style="color:#333333;text-decoration:none;"><?php echo $this->_tpl_vars['item']->productName; ?>
</a></td>
							<td align="right"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['item']->unitCost); ?>
</td>
							<td align="center"><?php echo $this->_tpl_vars['item']->quantity; ?>
</td>
							<td align="right"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['item']->subtotal); ?>
</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					</table>
				</td>
			</tr>
			<tr>
				<td align="right" style="">
					<table>
						<tr>
							<td align="right"><?php echo $this->_tpl_vars['lang']['controller']['formOrderSubtotalLabel']; ?>
:</td>
							<td align="right"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['myOrder']->subtotal); ?>
</td>
						</tr>
						
						<tr>
							<td align="right"><span style="font-weight:bold;color:#000;"><?php echo $this->_tpl_vars['lang']['controller']['formOrderTotalLabel']; ?>
:</span></td>
							<td align="right" style="font-weight:bold;color:#000;"><?php $this->assign('priceAfterAll', $this->_tpl_vars['myOrder']->subtotal+$this->_tpl_vars['myOrder']->shipprice+$this->_tpl_vars['myOrder']->taxprice); ?><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['priceAfterAll']); ?>
</td>
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
			<a href="javascript:void(0)" onclick="window.open('<?php echo $this->_tpl_vars['conf']['rooturl_admin']; ?>
order/edit/id/<?php echo $this->_tpl_vars['myOrder']->id; ?>
/print/1', 'windowname1', 'scrollbars=1, resizeable=yes, width=750, height=700'); return false;"><img src="<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/admin/print.png" alt="Print Version" width="66" height="38" border="0" /></a>
		</div>			
		</div>
		
	
		
	</div>
	
	
    	
</div>


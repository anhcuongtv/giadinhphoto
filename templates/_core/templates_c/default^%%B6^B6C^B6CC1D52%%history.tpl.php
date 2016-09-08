<?php /* Smarty version 2.6.26, created on 2012-08-14 00:25:34
         compiled from _controller/site/checkout/history.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_controller/site/checkout/history.tpl', 37, false),array('function', 'paginate', '_controller/site/checkout/history.tpl', 44, false),)), $this); ?>
	<div class="cmscontent">
			<div class="cmscontent_title">
				<?php echo $this->_tpl_vars['lang']['controller']['orderHistoryTitle']; ?>
 (<?php echo $this->_tpl_vars['total']; ?>
)
			</div>
			<div class="cmscontent_contents">
				<table border="1" cellpadding="2" cellspacing="0" style="border:1px solid #dddddd;border-collapse:collapse;" width="100%"  class="adminaccount_table">
				<tr>
					<td>
						<div>
							<table border="1" cellpadding="2" cellspacing="0" style="border-color:#dddddd;border-collapse:collapse;" width="100%"  class="adminaccount_table">
								<tr class="tablegrid_rowtitle1">
									<td width="70" align="center"><?php echo $this->_tpl_vars['lang']['controller']['orderInvoiceId']; ?>
</td>
									<td align="center"><?php echo $this->_tpl_vars['lang']['controller']['needUpdateShipPrice']; ?>
</td>
									<td align="right"><?php echo $this->_tpl_vars['lang']['controller']['orderTotal']; ?>
</td>
									<td align="center" width="30"><?php echo $this->_tpl_vars['lang']['controller']['orderPaid']; ?>
</td>
									<td  align="center" width="80" ><?php echo $this->_tpl_vars['lang']['controller']['orderStatus']; ?>
</td>
									<td align="center" width="60" ><?php echo $this->_tpl_vars['lang']['controller']['orderOn']; ?>
</td>
									<td align="center" width="60" ><?php echo $this->_tpl_vars['lang']['controller']['orderDetail']; ?>
</td>
								</tr>
							<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
									<tr <?php if ($this->_tpl_vars['order']->status == 'completed'): ?>style="background:#eeeeee;font-weight:bold;color:#ee5500;"<?php endif; ?>>
											<td align="center"><a href="javascript:void(0)" onclick="window.open('<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/history/print/1/invoiceid/<?php echo $this->_tpl_vars['order']->invoiceid; ?>
', 'windowname1', 'scrollbars=1, resizeable=yes, width=750, height=700'); return false;" style="font-weight:bold;text-decoration:none;font-family:'Courier New', Courier, monospace;font-size:14px;<?php if ($this->_tpl_vars['order']->status == 'completed'): ?>color:#ee5500;<?php endif; ?>"><?php echo $this->_tpl_vars['order']->invoiceid; ?>
</a></td>
											<td align="center" style="font-size:10px;">
											
											<?php if ($this->_tpl_vars['order']->shipIssetManual == '1'): ?>
												<img alt="yes" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/tick.gif" border="0" width="16" title="<?php if ($this->_tpl_vars['order']->shipIsset == '1'): ?>Shipping price have been updated. You can proceed to payment now!<?php else: ?>Shipping price have not been updated yet<?php endif; ?>" />
												
											<?php endif; ?>
											</td>
											<td align="right"><?php $this->assign('priceAfterAll', $this->_tpl_vars['order']->subtotal+$this->_tpl_vars['order']->shipprice+$this->_tpl_vars['order']->taxprice); ?><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['priceAfterAll']); ?>
</td>
											<td  align="center"><?php if ($this->_tpl_vars['order']->datepaid > 0): ?><img alt="yes" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/tick.gif" border="0" width="16" /><?php else: ?><?php if ($this->_tpl_vars['order']->status != 'completed'): ?>
														<?php if ($this->_tpl_vars['order']->shipIsset == '1'): ?>
															<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/paymentformmanual/invoice/<?php echo $this->_tpl_vars['order']->invoiceid; ?>
" title="Click here to pay for this order"><img alt="Pay now" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/icon_pay_now.gif" border="0"/></a>
														<?php endif; ?>
												  <?php endif; ?><?php endif; ?></td>
											<td align="center"><?php $this->assign('statusstring', "status".($this->_tpl_vars['order']->status)); ?><?php echo $this->_tpl_vars['lang']['controller'][$this->_tpl_vars['statusstring']]; ?>
</td>
											<td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
											<td align="center"><a href="javascript:void(0)" onclick="window.open('<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/checkout/history/print/1/invoiceid/<?php echo $this->_tpl_vars['order']->invoiceid; ?>
', 'windowname1', 'scrollbars=1, resizeable=yes, width=750, height=700'); return false;"><img src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/view_button.png" width="54" height="20" border="0"/></a> </td>
									</tr>
							<?php endforeach; endif; unset($_from); ?>
							</table>
						<br />
						<?php $this->assign('pageurl', "page/::PAGE::"); ?>
						<?php echo smarty_function_paginate(array('count' => $this->_tpl_vars['totalPage'],'curr' => $this->_tpl_vars['curPage'],'lang' => $this->_tpl_vars['paginateLangIndex'],'max' => 10,'url' => ($this->_tpl_vars['paginateUrl']).($this->_tpl_vars['pageurl'])), $this);?>

						<br />
						</div>
					</td>
				
				</tr>
				
		</table>
	</div>
</div>
<?php /* Smarty version 2.6.26, created on 2014-09-04 21:30:21
         compiled from _controller/site/checkout/review.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '_controller/site/checkout/review.tpl', 29, false),)), $this); ?>
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1><?php echo $this->_tpl_vars['lang']['controller']['reviewTitle']; ?>
</h1>
		<div>


			<?php if ($this->_tpl_vars['cancel_return'] == '1'): ?>
				<div align="left" style="font-weight:bold;font-size:20px;margin-left:10px;color:#0066CC;"><?php echo $this->_tpl_vars['lang']['controller']['reviewCancelText']; ?>
</div>
				<br />
				<div align="left" style="margin-left:10px;color:#0066FF;font-weight:bold;font-size:14px;">
					<a href="<?php if ($_SESSION['continueshoppingurl'] == ''): ?><?php echo $this->_tpl_vars['conf']['rooturl']; ?>
site/product<?php else: ?><?php echo $_SESSION['continueshoppingurl']; ?>
<?php endif; ?>" title="<?php echo $this->_tpl_vars['lang']['controller']['continueShoppingTooltip']; ?>
"><img alt="<?php echo $this->_tpl_vars['lang']['controller']['continueShoppingTooltip']; ?>
" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/continueshopbtn.png" width="146" height="20" border="0" /></a>
				</div>
			<?php else: ?>
				<div align="left" style="font-weight:bold;font-size:24px;margin-bottom:10px;margin-left:10px;">
					<?php echo $this->_tpl_vars['lang']['controller']['reviewHeading']; ?>
 (<?php echo $this->_tpl_vars['lang']['controller']['printInvoiceLabel']; ?>
 #<?php echo $this->_tpl_vars['myOrder']->invoiceid; ?>
)
				</div>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "notify.tpl", 'smarty_include_vars' => array('notifyError' => $this->_tpl_vars['error'],'notifySuccess' => $this->_tpl_vars['success'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<form name="manage" action="" method="post">
				<table border="0"  cellpadding="2" cellspacing="1" style="" width="98%"  class="adminaccount_table">
					<tr class="tablegrid_rowtitle1">
						
						<td align="left"><?php echo $this->_tpl_vars['lang']['controller']['itemproduct']; ?>
</td>
						<td align="right" width="100"><?php echo $this->_tpl_vars['lang']['controller']['itemprice']; ?>
</td>
						<td align="center" width="70"><?php echo $this->_tpl_vars['lang']['controller']['itemquantity']; ?>
</td>
						<td align="right" width="120"><?php echo $this->_tpl_vars['lang']['controller']['itemsubtotal']; ?>
</td>    
					</tr>
				<?php $_from = $this->_tpl_vars['myOrder']->productList; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<tr bgcolor="#<?php echo smarty_function_cycle(array('values' => "ffffff,f7f7f7"), $this);?>
">
						
						<td align="left" style="font-weight:bold;"><?php echo $this->_tpl_vars['item']->productName; ?>
</td>
						<td align="right" ><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['item']->unitCost); ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['item']->quantity; ?>
</td>
						<td align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['item']->subtotal); ?>
</td>	
					</tr>
				<?php endforeach; endif; unset($_from); ?>
					
					<tr>
						<td valign="top" colspan="4" align="right" class="totalpricearea" style="border-top:1px solid #cccccc;">
							<table>
								<tr>
									<td align="right"><?php echo $this->_tpl_vars['lang']['controller']['cartSubTotal']; ?>
:</td><td align="right"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['totalprice']); ?>
</td>
								</tr>
								
								<tr class="cart_totalamount_row">
									<td align="right"><span style="font-weight:bold;color:#000;"><?php echo $this->_tpl_vars['lang']['controller']['cartTotal']; ?>
:</span></td><td align="right" style="font-weight:bold;color:#000;"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['totalpriceAfterTax']); ?>
</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</form>
				<div align="left" style="font-weight:bold;font-size:20px;margin-left:10px;color:#0066CC;"><?php echo $this->_tpl_vars['lang']['controller']['reviewBuySuccessText']; ?>
</div>
				<br />
				<div align="left" style="margin-left:10px;color:#0066FF;font-weight:bold;font-size:14px;">
					<a href="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
memberarea.html?tab=upload"><img alt="Continue" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/<?php echo $this->_tpl_vars['langCode']; ?>
/continue.png" width="146" height="20" border="0" /></a>
				</div>
				<?php endif; ?>
		
		</div>
	</div>
</div>





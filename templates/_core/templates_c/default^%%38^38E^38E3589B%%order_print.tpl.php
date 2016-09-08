<?php /* Smarty version 2.6.26, created on 2012-07-31 07:01:16
         compiled from _controller/site/order_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_controller/site/order_print.tpl', 16, false),array('modifier', 'upper', '_controller/site/order_print.tpl', 20, false),)), $this); ?>
<div align="left" style="padding:20px;">
<div align="left" style="background:#ffffff;">
<table width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td align="left" valign="bottom">
    	<div style="font-weight:bold;font-size:32px;"><?php echo $this->_tpl_vars['lang']['controller']['printHeading']; ?>
</div>
      <div style="font-weight:bold;font-size:18px;color:#333333;"><?php echo $this->_tpl_vars['lang']['controller']['printInvoiceLabel']; ?>
 #<?php echo $this->_tpl_vars['myOrder']->invoiceid; ?>
</div>
      
      </td>
    <td align="right" valign="bottom"><?php echo $this->_tpl_vars['lang']['controller']['printDateLabel']; ?>
: <?php  echo date("H:i, M-j-Y");  ?></td>
  </tr>
</table>
<table cellspacing="8" style="font-family:Arial, Helvetica, sans-serif">
	<tr>
  	<td width="150" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['printOrderOnLabel']; ?>
:</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['myOrder']->datecreated)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
  </tr>
  <tr>
  	<td width="150" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['formOrderPaidMethod']; ?>
:</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['myOrder']->paymentmethod)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</td>
  </tr>
  <tr>
  	<td width="150" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['orderStatus']; ?>
:</td>
    <td><span style="<?php if ($this->_tpl_vars['myOrder']->status == 'completed'): ?>font-weight:bold;border-bottom:dashed 1px #000000;<?php endif; ?>"><?php $this->assign('statusstring', "status".($this->_tpl_vars['myOrder']->status)); ?><?php echo $this->_tpl_vars['lang']['controller'][$this->_tpl_vars['statusstring']]; ?>
<?php if ($this->_tpl_vars['myOrder']->status == 'completed'): ?><img alt="" src="<?php echo $this->_tpl_vars['conf']['rooturl']; ?>
<?php echo $this->_tpl_vars['currentTemplate']; ?>
/images/site/tick.gif"><?php endif; ?></span></td>
  </tr>
  <tr>
  	<td style="font-weight:bold;" valign="top"><?php echo $this->_tpl_vars['lang']['controller']['printSeller']; ?>
:</td>
    <td>
    	<div style="font-weight:bold;"><?php echo $this->_tpl_vars['setting']['seller']['name']; ?>
</div>
      	<div><?php echo $this->_tpl_vars['setting']['seller']['address']; ?>
</div>
    	<div>(<?php echo $this->_tpl_vars['lang']['controller']['billingPhone']; ?>
 : <?php echo $this->_tpl_vars['setting']['seller']['phone']; ?>
)</div>
    </td>
  </tr>
  <tr>
  	<td style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['printBuyer']; ?>
:</td>
    <td><strong><?php echo $this->_tpl_vars['myOrder']->billingFirstname; ?>
 <?php echo $this->_tpl_vars['myOrder']->billingMid; ?>
 <?php echo $this->_tpl_vars['myOrder']->billingLastname; ?>
 (<?php echo $this->_tpl_vars['myOrder']->contactemail; ?>
)</strong></td>
  </tr>
  
</table>
<br/><br/>
<table cellspacing="8" width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td align="left" valign="bottom">
    	<div style="font-weight:bold;font-size:28px;"><?php echo $this->_tpl_vars['lang']['controller']['billingShipInfo']; ?>
</div>
      </td>
    <td align="right" valign="bottom"></td>
  </tr>
</table>

<table cellspacing="8" width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
 		<td width="150" style="font-weight:bold;" valign="top"><?php echo $this->_tpl_vars['lang']['controller']['BillingInfo']; ?>
: </td>
    <td valign="top" align="left">
    	<div style="font-weight:bold;"><?php echo $this->_tpl_vars['myOrder']->shippingFirstname; ?>
 <?php echo $this->_tpl_vars['myOrder']->shippingMid; ?>
 <?php echo $this->_tpl_vars['myOrder']->shippingLastname; ?>
</div>
      <div><?php echo $this->_tpl_vars['myOrder']->shippingAddress; ?>
 <?php if ($this->_tpl_vars['myOrder']->shippingAddress2 != ''): ?>(<?php echo $this->_tpl_vars['lang']['controller']['printOtherAddress']; ?>
: <?php echo $this->_tpl_vars['myOrder']->shippingAddress2; ?>
)<?php endif; ?></div>
      <?php if ($this->_tpl_vars['myOrder']->shippingCityText != ''): ?><div><?php echo $this->_tpl_vars['myOrder']->shippingCityText; ?>
</div><?php endif; ?>
	  <?php if ($this->_tpl_vars['myOrder']->shippingRegionText != ''): ?><div><?php echo $this->_tpl_vars['myOrder']->shippingRegionText; ?>
, <?php echo $this->_tpl_vars['myOrder']->shippingZipcode; ?>
</div><?php endif; ?> 
      <div><?php echo $this->_tpl_vars['myOrder']->shippingCountryText; ?>
</div>
      <div>(<?php echo $this->_tpl_vars['lang']['controller']['billingPhone']; ?>
 : <?php echo $this->_tpl_vars['myOrder']->shippingPhone; ?>
 <?php if ($this->_tpl_vars['myOrder']->shippingPhone2 != ''): ?> - <?php echo $this->_tpl_vars['lang']['controller']['billingPhone2']; ?>
 : <?php echo $this->_tpl_vars['myOrder']->shippingPhone2; ?>
<?php endif; ?>)</div>     
    </td>
	</tr>

  
	
   
</table>


<br/><br/>
<table cellspacing="8" width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td align="left" valign="bottom">
    	<div style="font-weight:bold;font-size:28px;"><?php echo $this->_tpl_vars['lang']['controller']['printPaymentDetail']; ?>
</div>
      </td>
    <td align="right" valign="bottom"></td>
  </tr>
</table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td width="20" align="right"></td>
  	<td align="left" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['itemproduct']; ?>
</td>
    <td width="70" align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['itemprice']; ?>
</td>
    <td width="50" align="center" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['itemquantity']; ?>
</td>
    <td width="150" align="right" style="font-weight:bold;"><?php echo $this->_tpl_vars['lang']['controller']['itemsubtotal']; ?>
</td>
  </tr>
  <?php $_from = $this->_tpl_vars['productList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['productlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['productlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['productlist']['iteration']++;
?>
      <tr>
          <td align="center" style="border-bottom:1px dashed #e0e0e0;"><div class="shoppingcart_productorder"><?php echo $this->_foreach['productlist']['iteration']; ?>
</div></td>
          <td style="border-bottom:1px dashed #e0e0e0;"><?php echo $this->_tpl_vars['item']->productName; ?>
</td>
          <td align="right" style="border-bottom:1px dashed #e0e0e0;"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['item']->unitCost); ?>
</td>
          <td align="center" style="border-bottom:1px dashed #e0e0e0;"><?php echo $this->_tpl_vars['item']->quantity; ?>
</td>
          <td align="right" style="border-bottom:1px dashed #e0e0e0;"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['item']->subtotal); ?>
</td>
      </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>

<table width="100%">
<tr>
   <td align="right">
   	<br/><br/>
   		<table width="100%" style="border-bottom:1px solid #ccc;font-family:Arial, Helvetica, sans-serif;color:#666666;" cellpadding="4" cellspacing="0">
      	<tr>
        	<td align="right"><?php echo $this->_tpl_vars['lang']['controller']['cartSubTotal']; ?>
:</td><td align="right" width="100"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['totalprice']); ?>
</td>
        </tr>
		        
        <tr style="background:#eeeeee;" class="cart_totalamount_row">
        	<td align="right"><span style="font-weight:bold;color:#000;"><?php echo $this->_tpl_vars['lang']['controller']['cartTotal']; ?>
:</span></td><td align="right" style="font-weight:bold;color:#000;"><?php echo $this->_tpl_vars['currency']->formatPrice($this->_tpl_vars['totalpriceAfterTax']); ?>
</td>
        </tr>
      </table>
   </td>
 </tr>
</table>

</div>
</div>



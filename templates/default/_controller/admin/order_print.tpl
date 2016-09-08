<div align="left" style="padding:20px;">
<div align="left" style="background:#ffffff;">
<table width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td align="left" valign="bottom">
    	<div style="font-weight:bold;font-size:32px;">{$lang.controller.printHeading}</div>
      <div style="font-weight:bold;font-size:18px;color:#333333;">{$lang.controller.printInvoiceLabel} #{$myOrder->invoiceid}</div>
      
      </td>
    <td align="right" valign="bottom">{$lang.controller.printDateLabel}: {php} echo date("H:i, M-j-Y"); {/php}</td>
  </tr>
</table>
<table cellspacing="8" style="font-family:Arial, Helvetica, sans-serif">
  <tr>
  	<td width="150" style="font-weight:bold;">{$lang.controller.printOrderOnLabel}:</td>
    <td>{$myOrder->datecreated|date_format}</td>
  </tr>
  <tr>
  	<td width="150" style="font-weight:bold;">{$lang.controller.formOrderPaidMethod}:</td>
    <td>{$myOrder->paymentmethod|upper}</td>
  </tr>
  <tr>
  	<td width="150" style="font-weight:bold;">{$lang.controller.formOrderStatusLabel}:</td>
    <td><span style="{if $myOrder->status == 'completed'}font-weight:bold;border-bottom:dashed 1px #000000;{/if}">{assign var=statusstring value=status`$myOrder->status`}{$lang.controller[$statusstring]}{if $myOrder->status == 'completed'}<img alt="" src="{$conf.rooturl}{$currentTemplate}/images/site/tick.gif">{/if}</span></td>
  </tr>
  <tr>
  	<td style="font-weight:bold;" valign="top">{$lang.controller.printSeller}:</td>
    <td>
    	<div style="font-weight:bold;">{$setting.seller.name}</div>
      	<div>{$setting.seller.address}</div>
    	<div>({$lang.controller.formPhoneLabel} : {$setting.seller.phone})</div>
    </td>
  </tr>
  <tr>
  	<td style="font-weight:bold;">{$lang.controller.printBuyer}:</td>
    <td><strong>{$myOrder->billingFirstname} {$myOrder->billingMid} {$myOrder->billingLastname} ({$myOrder->contactemail})</strong></td>
  </tr>
  
</table>
<br/><br/>
<table cellspacing="8" width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td align="left" valign="bottom">
    	<div style="font-weight:bold;font-size:28px;">{$lang.controller.printCustomerInfo}</div>
      </td>
    <td align="right" valign="bottom"></td>
  </tr>
</table>

<table cellspacing="8" width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
 		<td width="150" style="font-weight:bold;" valign="top"> </td>
    <td valign="top" align="left">
    	<div style="font-weight:bold;">{$myOrder->shippingFirstname} {$myOrder->shippingMid} {$myOrder->shippingLastname}</div>
      <div>{$myOrder->shippingAddress} {if $myOrder->shippingAddress2 != ''}({$lang.controller.formAddress2Label}: {$myOrder->shippingAddress2}){/if}</div>
      {if $myOrder->shippingCityText != ''}<div>{$myOrder->shippingCityText}</div>{/if}
	  {if $myOrder->shippingRegionText != ''}<div>{$myOrder->shippingRegionText}, {$myOrder->shippingZipcode}</div>{/if} 
      <div>{$myOrder->shippingCountryText}</div>
      <div>({$lang.controller.formPhoneLabel} : {$myOrder->shippingPhone} {if $myOrder->shippingPhone2 != ''} - {$lang.controller.formPhone2Label} : {$myOrder->shippingPhone2}{/if})</div>     
    </td>
	</tr>

  
	
  
</table>


<br/><br/>
<table cellspacing="8" width="100%" style="border-bottom:2px solid #444444;font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td align="left" valign="bottom">
    	<div style="font-weight:bold;font-size:28px;">{$lang.controller.printPaymentDetail}</div>
      </td>
    <td align="right" valign="bottom"></td>
  </tr>
</table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif;">
	<tr>
  	<td width="20" align="right"></td>
  	<td align="left" style="font-weight:bold;">{$lang.controller.formOrderProductLabel}</td>
    <td width="70" align="right" style="font-weight:bold;">{$lang.controller.formOrderPriceLabel}</td>
    <td width="50" align="center" style="font-weight:bold;">{$lang.controller.formOrderQuantityLabel}</td>
    <td width="150" align="right" style="font-weight:bold;">{$lang.controller.formOrderSubtotalLabel}</td>
  </tr>
  {foreach name="productlist" item=item from=$myOrder->productList}
      <tr>
          <td align="center" style="border-bottom:1px dashed #e0e0e0;"><div class="shoppingcart_productorder">{$smarty.foreach.productlist.iteration}</div></td>
          <td style="border-bottom:1px dashed #e0e0e0;">{$item->productName}</td>
          <td align="right" style="border-bottom:1px dashed #e0e0e0;">{$currency->formatPrice($item->unitCost)}</td>
          <td align="center" style="border-bottom:1px dashed #e0e0e0;">{$item->quantity}</td>
          <td align="right" style="border-bottom:1px dashed #e0e0e0;">{$currency->formatPrice($item->subtotal)}</td>
      </tr>
  {/foreach}
</table>

<table width="100%">
<tr>
   <td align="right">
   	<br/><br/>
   		<table width="100%" style="border-bottom:1px solid #ccc;font-family:Arial, Helvetica, sans-serif;color:#666666;" cellpadding="4" cellspacing="0">
      	<tr>
        	<td align="right">{$lang.controller.cartSubTotal}:</td><td align="right" width="100">{$currency->formatPrice($myOrder->subtotal)}</td>
        </tr>
		
        
        <tr style="background:#eeeeee;" class="cart_totalamount_row">
        	<td align="right"><span style="font-weight:bold;color:#000;">{$lang.controller.formOrderTotalLabel}:</span></td><td align="right" style="font-weight:bold;color:#000;">{assign var=priceAfterAll value=$myOrder->subtotal+$myOrder->shipprice+$myOrder->taxprice}{$currency->formatPrice($priceAfterAll)}</td>
        </tr>
      </table>
   </td>
 </tr>
</table>

</div>
</div>




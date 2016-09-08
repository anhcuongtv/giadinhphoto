{include file="`$smartyMailGroupContainer`header.tpl"}
<h2>Ordering products at {$datecreated}</h2>
<p><b>Order information: </b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Contact Email: <b>{$account}</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Invoice ID: <b>#{$invoiceId}</b></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Total: <b>{$currency->formatPrice($totalpriceAfterTax)}</b></p>
<div style="border: 1px solid #cccccc;background:#f0f0f0;">
{$orderDetailContents}
</div>
{include file="`$smartyMailGroupContainer`footer.tpl"}
{include file="`$smartyMailGroupContainer`header.tpl"}
<p>Dear {$name},</p><br />

<p>Thank you for placed order on {$setting.seller.name}. The following <span style="color:#FF0000;font-weight:bold;">order #{$invoiceid}</span> , date created: <span style="font-weight:bold;color:#FF0000">{$datecreated}</span> , total <span style="color:#FF0000;font-weight:bold;">{$currency->formatPrice($total)}</span> has been updated the  shipping cost.</p><br /> 

<p>Please go to our website {$conf.rooturl} and log in to the member section to finish payment for your order. Or you can login by click on the link below:</p>
<p>
<a href="{$conf.rooturl}site/login?redirect={$redirectUrl}">{$conf.rooturl}site/login?redirect={$redirectUrl}</a></p>
<p><br />
If you have any troubles or questions about your order, please call us at <span style="color:#FF0000;font-weight:bold;">{$setting.seller.phone}</span> or email us at <a href="mailto:{$setting.mail.toEmail}">{$setting.mail.toEmail}</a>. </p>

<p><br />Thank you for choosing our products.</p>


{include file="`$smartyMailGroupContainer`footer.tpl"}
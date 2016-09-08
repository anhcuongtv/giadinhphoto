{include file="`$smartyMailGroupContainer`header.tpl"}
{if $myUser->fullname != ''}<p>Hi {$myUser->fullname},</p>{/if}
<p>Your request to recovery password at {$datecreated}</p>
<p>Account:</p>
<p>&nbsp;&nbsp;Username: <b>{$myUser->username} &lt;{$myUser->email}&gt;</b></p>

{if $activatedCode neq ''}
	<p>Click this link <a href="{$conf.rooturl}forgotpass.html?sub=reset&amp;username={$myUser->username}&amp;code={$activatedCode}">{$conf.rooturl}forgotpass.html?sub=reset&amp;username={$myUser->username}&amp;code={$activatedCode}</a> and type your new password to reset your password.</p>
    
{/if}
{include file="`$smartyMailGroupContainer`footer.tpl"}
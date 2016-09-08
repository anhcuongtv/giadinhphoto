{include file="`$smartyMailContainerRoot`site/header.tpl"}
RESET PASSWORD FOR ACCOUNT <b>{$myUser->username}</b>:

This email was sent from out website to notify you that administrator had been reset your password for your account. Your new account information:<br />
<br />
Username: {$myUser->username}<br />
Password: {$newpass}<br />
<br />
{include file="`$smartyMailContainerRoot`site/footer.tpl"}
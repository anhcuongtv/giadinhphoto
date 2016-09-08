{include file="`$smartyMailGroupContainer`header.tpl"}
{if $sec eq 'activate'}
	<p>Account <strong>{$account}</strong> had been activated at {$datecreated}</p>
{else}
  <h2>Website has new registered member at {$datecreated}</h2>
  <p>Username: <b>{$myUser->username}</b></p>
  <p>Email: <b>{$myUser->email}</b></p>
  <p>Full name: <b>{$myUser->fullname}</b></p>
  
{/if}
{include file="`$smartyMailGroupContainer`footer.tpl"}
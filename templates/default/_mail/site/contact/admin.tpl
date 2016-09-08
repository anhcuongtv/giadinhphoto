{include file="`$smartyMailGroupContainer`header.tpl"}

  <h2>Website has new contact at {$datecreated}</h2>
  <p>Username: <b>{$myContact->username}</b></p>
  <p>User ID: <b>{$myContact->userId}</b></p>
  <p>Full name: <b>{$myContact->fullname}</b></p>
  <p>Email: <b>{$myContact->email}</b></p>
  <p>Phone: <b>{$myContact->phone}</b></p>
  <p>Message: <b>{$myContact->message}</b></p>
  <p>Reason: <b>{$myContact->reason}</b></p>
 
  
 
  

{include file="`$smartyMailGroupContainer`footer.tpl"}
{include file="`$smartyMailGroupContainer`header.tpl"}
{if $myUser->fullname != ''}<p>Chao ban {$myUser->fullname},</p>{/if}
<p>Ban da dang ky thanh vien thanh cong tai website www.GiaDinhPhotoContest.com vao luc {$datecreated}</p>
<p>Thong tin tai khoan:</p>
<p>&nbsp;&nbsp;Username: <b>{$myUser->username} &lt;{$myUser->email}&gt;</b></p>
<p>&nbsp;&nbsp;Password: <b>{$formData.fpassword}</b></p>

{if $activatedCode neq ''}
	<p>Nhan vao day de kich hoat tai khoan: <a href="{$conf.rooturl}activate.html?username/{$myUser->username}/code/{$activatedCode}">		{$conf.rooturl}activate.html?username={$myUser->username}&amp;code={$activatedCode}</a></p>
    <p>Neu lien ket o tren khong chay duoc, hay truy cap dia chi <a href="{$conf.rooturl}activate.html">{$conf.rooturl}activate.html</a> va nhap cac thong tin sau: <br />
    	&nbsp;&nbsp;&nbsp;Username: <b>{$myUser->username}</b><br />
        &nbsp;&nbsp;&nbsp;Activated Code: <b>{$activatedCode}</b></p>
{/if}
<p>Cam on da tham gia website. Chuc ban mot ngay tot lanh!</p>

--------------------------------------------------------------------------------------

{if $myUser->fullname != ''}<p>Hi {$myUser->fullname},</p>{/if}
<p>You have already registered members at the site www.GiaDinhPhotoContest.com at time {$datecreated}</p>
<p>Account information:</p>
<p>&nbsp;&nbsp;Username: <b>{$myUser->username} &lt;{$myUser->email}&gt;</b></p>
<p>&nbsp;&nbsp;Password: <b>{$formData.fpassword}</b></p>

{if $activatedCode neq ''}
	<p>Nhan vao day de kich hoat tai khoan: <a href="{$conf.rooturl}activate.html?username/{$myUser->username}/code/{$activatedCode}">		{$conf.rooturl}activate.html?username={$myUser->username}&amp;code={$activatedCode}</a></p>
    <p>Neu lien ket o tren khong chay duoc, hay truy cap dia chi <a href="{$conf.rooturl}activate.html">{$conf.rooturl}activate.html</a> va nhap cac thong tin sau: <br />
    	&nbsp;&nbsp;&nbsp;Username: <b>{$myUser->username}</b><br />
        &nbsp;&nbsp;&nbsp;Activated Code: <b>{$activatedCode}</b></p>
{/if}
<p>Thanks for participating website. Have a nice day!</p>
{include file="`$smartyMailGroupContainer`footer.tpl"}
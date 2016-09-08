{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">

	<div id="page">
		<h1>{$lang.controller.title} ({$total} {$lang.controller.userLabel})</h1>
		<div style="text-align:right;font-size:14px;margin-top:-50px; margin-left:780px; position:absolute">
			<img src="{$currentTemplate}/images/tick_circle.png" alt="Yes" />{$lang.controller.isPaid} &nbsp; 	
			<img src="{$currentTemplate}/images/cross_circle.png" alt="No" /> {$lang.controller.isNotPaid}
		</div>
		<table border="1" id="statuslisttable" bordercolor="#CCCCCC" style="border-collapse:collapse;">
        	<tr>
            	<th>#</th>
                <th>{$lang.controller.fullname}</th>
                <th>{$lang.controller.region}</th>
                <th>{$lang.controller.country}</th>
                <th>{$lang.controller.datecreated}</th>
                <th>{$lang.controller.paidColor}</th>
                <th>{$lang.controller.paidMono}</th>
                <th>{$lang.controller.paidNature}</th>
                <th>{$lang.controller.paidTravel}</th>
            </tr>
			{foreach item=user from=$userList name=userlist}
				<tr>
                    <td>{math equation="a+b" a=$orderStartCount b=$smarty.foreach.userlist.iteration}</td>
                    <td>{$user->fullname}</td>
                    <td>{$user->region}</td>
                    <td>{$user->country}</td>
                    <td>{$user->datecreated|date_format}</td>
                    <td class="center">{if $user->paidColor == 1}<img src="{$currentTemplate}/images/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/cross_circle.png" alt="No" />{/if}</td>
                    <td class="center">{if $user->paidMono == 1}<img src="{$currentTemplate}/images/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/cross_circle.png" alt="No" />{/if}</td>
                    <td class="center">{if $user->paidNature == 1}<img src="{$currentTemplate}/images/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/cross_circle.png" alt="No" />{/if}</td>
                    <td class="center">{if $user->paidTravel == 1}<img src="{$currentTemplate}/images/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/cross_circle.png" alt="No" />{/if}</td>
                </tr>
			{/foreach}

        </table>
        
        {assign var="pageurl" value="page/::PAGE::"}
			{paginate count=$totalPage curr=$curPage lang=$paginateLang max=10 url=$paginateurl$pageurl}
		
		
	
	</div>

</div><!-- end #panelright -->

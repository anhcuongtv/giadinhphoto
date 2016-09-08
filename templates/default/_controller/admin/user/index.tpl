<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} {if $formData.search != ''}| {$lang.controller.title_listSearch} {/if}({$total})</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controllergroup.filterLabel}</a></li>
		</ul>
		{if $formData.search != ''}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}user">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}user/add/redirect/{$redirectUrl}">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<table class="grid" cellpadding="5" width="100%">
					
				{if $users|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th align="left" width="30"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">ID</a></th>
							<th align="left"><a href="{$filterUrl}sortby/username/sorttype/{if $formData.sortby eq 'username'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Username</a></th>		
							<th align="left"><a href="{$filterUrl}sortby/email/sorttype/{if $formData.sortby eq 'email'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Email</a></th>				
							<th align="left"><a href="{$filterUrl}sortby/group/sorttype/{if $formData.sortby eq 'group'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Group</a></th>
							<th align="left"><a href="{$filterUrl}sortby/fullname/sorttype/{if $formData.sortby eq 'fullname'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Full Name</a></th>
                            <th align="center">Color</th>		
                            <th align="center">Mono</th>		
                            <th align="center">Nature</th>                
                            <th align="center">Travel</th>				
							<th align="left"><a href="{$filterUrl}sortby/region/sorttype/{if $formData.sortby eq 'region'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">City</a></th>				
							
							<th align="left"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Registered</a></th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="9">
								<div class="bulk-actions align-left">
									<select name="fbulkaction">
										<option value="">{$lang.controllergroup.bulkActionSelectLabel}</option>
										<option value="delete">{$lang.controllergroup.bulkActionDeletetLabel}</option>
									</select>
									<input type="submit" name="fsubmitbulk" class="button" value="{$lang.controllergroup.bulkActionSubmit}" />
								</div>
								
								<div class="pagination">
								   {assign var="pageurl" value="page/::PAGE::"}
									{paginate count=$totalPage curr=$curPage lang=$paginateLang max=10 url=$paginateurl$pageurl}
								</div> <!-- End .pagination -->
		
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>
					<tbody>
				{foreach item=user from=$users}
					
						<tr>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="{$user->id}" {if in_array($user->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$user->id}</td>
							<td><a href="{$conf.rooturl_admin}user/edit/id/{$user->id}/redirect/{$redirectUrl}">{$user->username}</a></td>
							<td>{$user->email}</td>
							<td>{$user->groupname($user->groupid, $lang)}</td>
							<td>{$user->fullname}</td>
                            <td align="center">{if $user->paidColor == 1}<img src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="No" />{/if}</td>
                            <td align="center">{if $user->paidMono == 1}<img src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="No" />{/if}</td>
                            <td align="center">{if $user->paidNature == 1}<img src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="No" />{/if}</td>
                            <td align="center">{if $user->paidTravel == 1}<img src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="Yes" />{else}<img src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="No" />{/if}</td>
                            
							<td>{$user->city}</td>
							<td>{$user->datecreated|date_format}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}user/edit/id/{$user->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								{if $user->groupid != $smarty.const.GROUPID_ADMIN}<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}user/delete/id/{$user->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>{/if}
						</tr>
						
					
				{/foreach}
				</tbody>
					
				  
				{else}
					<tr>
						<td colspan="9"> {$lang.controllergroup.notfound}</td>
					</tr>
				{/if}
				
				</table>
			</form>
	
		</div>
		
		<div class="tab-content" id="tab2">
			<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
				{$lang.controllergroup.formIdLabel}: 
				<input type="text" name="fid" id="fid" size="8" value="{$formData.fid|@htmlspecialchars}" class="text-input" /> - 
				{$lang.controller.formKeywordLabel}:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="{$formData.fkeyword|@htmlspecialchars}" class="text-input" /><select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="username" {if $formData.fsearchin eq 'username'}selected="selected"{/if}>{$lang.controller.formKeywordInUsernameLabel}</option>
						<option value="email" {if $formData.fsearchin eq 'email'}selected="selected"{/if}>{$lang.controller.formKeywordInEmailLabel}</option>
						<option value="fullname" {if $formData.fsearchin eq 'fullname'}selected="selected"{/if}>{$lang.controller.formKeywordInFullnameLabel}</option>
					</select>
					
				
				
				
				<input type="button" name="fsubmit" value="{$lang.controllergroup.filterSubmit}" class="button" onclick="gosearchuser();"  />
		
			</form>
		</div>
		
		
	
	</div>
	

    	
</div>

{literal}
<script type="text/javascript">
	function gosearchuser()
	{
		var path = rooturl_admin + "user/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		var keyword = $("#fkeyword").val();
		if(keyword.length > 0)
		{
			path += "/keyword/" + keyword;
		}
		
		var keywordin = $("#fsearchin").val();
		if(keywordin.length > 0)
		{
			path += "/searchin/" + keywordin;
		}
		
				
		document.location.href= path;
	}
</script>
{/literal}







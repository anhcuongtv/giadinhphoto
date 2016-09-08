<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>




<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} {if $formData.search != ''}| {$lang.controller.title_listSearch} {/if}({$total})</h3>
		<ul class="content-box-link">
			<li><a href="javascript:delm('{$conf.rooturl_admin}log/clear/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');">{$lang.controller.clearLabel}</a></li>
		</ul>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controllergroup.filterLabel}</a></li>
		</ul>
		{if $formData.search != ''}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}log">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<table class="grid">
					
				{if $logs|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30">{$lang.controllergroup.formIdLabel}</th>
							<th>{$lang.controller.formDatecreatedLabel}</th>
							<th align="left">{$lang.controller.formUsernameLabel}</th>
							<th align="left">{$lang.controller.formGroupLabel}</th>
							<th align="left">{$lang.controller.formTypeLabel}</th>
							<th align="left">{$lang.controller.formIpLabel}</th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="8">
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
				{foreach item=log from=$logs}
					
						<tr>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="{$log->id}" {if in_array($log->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td align="center">{$log->id}</td>
							<td align="center">{$log->datecreated|date_format:$lang.controllergroup.dateFormatTimeSmarty}</td>
							<td align="left"><a href="{$conf.rooturl_admin}log/index/uid/{$log->uid}/redirect/{$redirectUrl}">{$log->username}</a></td>
							<td><a href="{$conf.rooturl_admin}log/index/group/{$log->groupid}">{$log->groupname}</a></td>
							<td><a href="{$conf.rooturl_admin}log/index/type/{$log->type}">{$log->type}</a></td>
							<td><a href="{$conf.rooturl_admin}log/index/ip/{$log->ip}">{$log->ip}</a></td>
						
							<td align="center"><a title="{$lang.controllergroup.formActionDetailTooltip}" href="{$conf.rooturl_admin}log/detail/id/{$log->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/detail.png" alt="{$lang.controllergroup.formDetailLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}log/delete/id/{$log->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
							</td>
						</tr>
					
				{/foreach}
					</tbody>
				
					
				  
				{else}
					<tr>
						<td colspan="10">{$lang.controllergroup.notfound}</td>
					</tr>
				{/if}
				
				</table>
			</form>
	 </div>
	 
	<div class="tab-content" id="tab2">

		<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
			{$lang.controller.formUsernameLabel}:
			<input type="text" name="fusername" id="fusername" size="20" value="{$formData.fusername|@htmlspecialchars}" class="text-input" /> -
			
			{$lang.controller.formTypeLabel}:
			<input type="text" name="ftype" id="ftype" size="20" value="{$formData.ftype|@htmlspecialchars}" class="text-input" /> -
			
			{$lang.controller.formGroupLabel}:
				<select name="fgroup" id="fgroup" size="1">
					<option value="">- - - - - - - - - - - - - - - - </option>
					{html_options options=$usergroups selected=$formData.fgroup}
				</select> -
			{$lang.controller.formIpLabel}:
			<input type="text" name="fip" id="fip" size="20" value="{$formData.fip|@htmlspecialchars}" class="text-input" /> -
			
			<input type="button" name="fsubmit" value="{$lang.controllergroup.filterSubmit}" class="button" onclick="gosearch();"  />
	
		</form>
	</div>
	
	</div>

    	
</div>



{literal}
<script type="text/javascript">
	function gosearch()
	{
		var path = rooturl_admin + "log/index";
		
		
		var keyword = $("#fusername").val();
		if(keyword.length > 0)
		{
			path += "/username/" + keyword;
		}
		
		var type = $("#ftype").val();
		if(type.length > 0)
		{
			path += "/type/" + type;
		}
		
		
		
		var group = $("#fgroup").val();
		if(group > 0)
		{
			path += "/group/" + group;
		}
		
		var ip = $("#fip").val();
		if(ip.length > 0)
		{
			path += "/ip/" + ip;
		}
		
		
		
		
		document.location.href= path;
	}
</script>
{/literal}
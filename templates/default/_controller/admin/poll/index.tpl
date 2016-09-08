<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} ({$total})</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controllergroup.filterLabel}</a></li>
		</ul>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}poll/add">{$lang.controller.head_add}</a></li>
		</ul>
		{if $formData.search != ''}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}poll">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.pollBulkToken}" />
				<table class="grid">
					
				{if $polls|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30">{$lang.controllergroup.formIdLabel}</th>
							<th>{$lang.controller.formTitleLabel} ({$langCode|upper})</th>				
							<th width="120">{$lang.controller.formDatecreatedLabel}</th>			
							<th width="150" class="td_center">{$lang.controller.formFinishedLabel}</th>
							<th width="100" class="td_center">{$lang.controller.formShowLabel}</th>
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
					{foreach item=poll from=$polls}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$poll->id}" {if in_array($poll->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$poll->id}</td>
							<td><a href="{$conf.rooturl_admin}poll/edit/id/{$poll->id}/redirect/{$redirectUrl}">{$poll->title.$langCode}</a></td>
							<td>{$poll->datecreated|date_format:$lang.controllergroup.dateFormatSmarty}</td>
							<td class="td_center">{if $poll->finished == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td class="td_center">{if $poll->enable == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}poll/edit/id/{$poll->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}poll/delete/id/{$poll->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
							</td>
						</tr>
						
					
					{/foreach}
					</tbody>
					
				  
				{else}
					<tr>
						<td colspan="10"> {$lang.controllergroup.notfound}</td>
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
						<option value="title" {if $formData.fsearchin eq 'title'}selected="selected"{/if}>{$lang.controller.formKeywordInTitleLabel}</option>
						
						
					</select>
									
				<input type="button" name="fsubmit" value="{$lang.controllergroup.filterSubmit}" class="button" onclick="gosearch();"  />
		
			</form>
		</div>
	
	</div>

    	
</div>

{literal}
<script type="text/javascript">
	function gosearch()
	{
		var path = rooturl_admin + "poll/index";
		
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



<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} ({$total})</h3>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}bannerposition/add/redirect/{$redirectUrl}">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.bannerpositionDeleteToken}" />
				
				<table class="grid">
					
				{if $positions|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30">{$lang.controllergroup.formIdLabel}</th>
							<th>{$lang.controller.formNameLabel}</th>
							<th>{$lang.controller.formDescriptionLabel}</th>							
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
					{foreach item=position from=$positions}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$position->id}" {if in_array($position->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$position->id}</td>
							<td><a href="{$conf.rooturl_admin}bannerposition/edit/id/{$position->id}/redirect/{$redirectUrl}">{$position->name}</a></td>
							<td>{$position->description}</td>
							
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}bannerposition/edit/id/{$position->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}bannerposition/delete/id/{$position->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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

    	
</div>




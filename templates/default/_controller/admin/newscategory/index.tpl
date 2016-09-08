<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} ({$total})</h3>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}newscategory/add">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.newscategoryBulkToken}" />
				<table class="grid">
					
				{if $categories|@count > 0}
					<thead>
						<tr>
						   <th width="40" align="left"><input class="check-all" type="checkbox" /></th>
							<th width="30" align="left">{$lang.controllergroup.formIdLabel}</th>
							<th width="50">{$lang.controllergroup.formOrderLabel}</th>
							<th align="left">{$lang.controller.formNameLabel}</th>							
							<th width="100" class="td_center">{$lang.controller.formShowLabel}</th>
							<th width="120" align="left">{$lang.controller.formDateModifiedLabel}</th>
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
									<input type="submit" name="fchangeorder" class="button" value="{$lang.controllergroup.formChangeOrderSubmit}" />
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
					{foreach item=category from=$categories}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$category->id}" {if in_array($category->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$category->id}</td>
							<td><input type="text" size="3" value="{$category->order}" name="forder[{$category->id}]" class="text-input" /></td>
							<td><a title="URL: {$conf.rooturl}{$conf.seoDirNewsCategory}/{$category->seoUrl}-{$category->id}.html" href="{$conf.rooturl_admin}newscategory/edit/id/{$category->id}/redirect/{$redirectUrl}">{$category->name.$langCode}</a>
								{if $category->sub|@count > 0}
									<ul>
										{foreach item=subcat from=$category->sub}
											<li><a href="{$conf.rooturl_admin}newscategory/edit/id/{$subcat->id}/redirect/{$redirectUrl}">{$subcat->name.$langCode}</a></li>
										{/foreach}
									</ul>
								{/if}
							</td>
							<td class="td_center">{if $category->enable == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td>{$category->datemodified|date_format:$lang.controllergroup.dateFormatSmarty}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}newscategory/edit/id/{$category->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}newscategory/delete/id/{$category->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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




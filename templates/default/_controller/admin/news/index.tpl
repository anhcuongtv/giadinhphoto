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
			<li><a href="{$conf.rooturl_admin}news">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}news/add/redirect/{$redirectUrl}">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.newsBulkToken}" />
				<table class="grid">
					
				{if $newsList|@count > 0}
					<thead>
						<tr>
						   <th width="40" align="left"><input class="check-all" type="checkbox" /></th>
							<th width="30" align="left">{$lang.controllergroup.formIdLabel}</th>
							
							<th align="left">{$lang.controller.formNameLabel}</th>		
							<th align="left">{$lang.controller.formCategoryLabel}</th>
							<th align="left">{$lang.controller.formImageLabel}</th>		
							<th class="td_center" width="50">{$lang.controller.formViewLabel}</th>					
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
					{foreach item=news from=$newsList}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$news->id}" {if in_array($news->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$news->id}</td>
							
							<td><a title="URL: {$conf.rooturl}{$conf.seoDirNewsCat}/{$news->seoUrl}-{$news->id}.html" href="{$conf.rooturl_admin}news/edit/id/{$news->id}/redirect/{$redirectUrl}">{$news->name.$langCode}</a>
								
							</td>
							<td>
								{if $news->categoryList|@count > 0}
								<ul>
									{foreach item=category from=$categories}
										
										{if in_array($category->id, $news->categoryList)}
											<li><a href="{$conf.rooturl_admin}news/index/category/{$category->id}">{$category->title}</a></li>
										{/if}
										
									{/foreach}
									</ul>
								{/if}
							</td>
							<td>
							{if $news->image!=''}<a href="" title="">
								<img style="border:1px solid #999999;" alt="{$news->name.$langCode}" src="{$conf.rooturl}{$setting.news.imageDirectory}{$news->smallImage}" width="100" height="100"/>
							{/if}
							</td>
							<td class="td_center">{$news->view}</td>
							<td class="td_center">{if $news->enable == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td>{$news->datemodified|date_format:$lang.controllergroup.dateFormatSmarty}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}news/edit/id/{$news->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}news/delete/id/{$news->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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
		
		<div class="tab-content" id="tab2"><!--Tim kiem-->
			<form action="" method="post" style="padding:0px;margin:0px;" onsubmit="return false;">
	
				{$lang.controllergroup.formIdLabel}: 
				<input type="text" name="fid" id="fid" size="4" value="{$formData.fid|@htmlspecialchars}" class="text-input" /> - 
				
				{$lang.controller.formCategoryLabel}:	
					<select name="fcategory" id="fcategory">
						<option value="0">- - - - - - - - - - - - - - - - - - -</option>
						{foreach item=category from=$categories}
							<option value="{$category->id}" title="{$category->name}" {if $category->id == $formData.fcategory}selected="selected"{/if}>{$category->title}</option>
						{/foreach}
					</select> -
					
					{$lang.controller.formShowLabel}:	
					<select name="fenable" id="fenable">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="NO" {if $formData.fenable eq 'NO'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
						<option value="YES" {if $formData.fenable eq 'YES'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>
					</select> -
					
					{$lang.controller.formKeywordLabel}:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="{$formData.fkeyword|@htmlspecialchars}" class="text-input" />&nbsp;<select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="idtext" {if $formData.fsearchin eq 'idtext'}selected="selected"{/if}>{$lang.controller.formKeywordInIdtextLabel}</option>
						<option value="contents" {if $formData.fsearchin eq 'contents'}selected="selected"{/if}>{$lang.controller.formKeywordInContentLabel}</option>
						
					</select>
			<p align="right">
				<input type="button" name="fsubmit" value="{$lang.controllergroup.filterSubmit}" class="button" onclick="gosearch();"  />
			</p>
			</form>
		</div>
		
		
	
	</div>
	

    	
</div>

{literal}
<script type="text/javascript">
	function gosearch()
	{
		var path = rooturl_admin + "news/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		
		var enable = $("#fenable").val();
		if(enable.length > 0)
		{
			path += "/enable/" + enable;
		}
		var category = $("#fcategory").val();
		if(category.length > 0)
		{
			path += "/category/" + category;
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




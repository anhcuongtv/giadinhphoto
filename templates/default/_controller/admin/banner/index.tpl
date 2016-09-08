<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>




<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} {if $formData.search != ''}| {$lang.controller.title_listSearch} {/if}({$total})</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controllergroup.filterLabel}</a></li>
		</ul>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}banner/add/redirect/{$redirectUrl}">{$lang.controller.title_add}</a></li>
		</ul>
		{if $formData.search != ''}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}banner">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.bannerDeleteToken}" />
				<table class="grid">
					
				{if $banners|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30">{$lang.controllergroup.formIdLabel}</th>
							<th width="50">{$lang.controllergroup.formOrderLabel}</th>
							<th>{$lang.controller.formNameLabel}</th>
							<th>{$lang.controller.formPositionLabel}</th>
							<th width="100" class="td_center">{$lang.controller.formEnableLabel}</th>
							<th width="50">{$lang.controller.formSizeLabel}</th>
							<th>{$lang.controller.formSourceLabel}</th>							
							<th width="120">{$lang.controller.formDatecreatedLabel}</th>
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
					{foreach item=banner from=$banners}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$banner->id}" {if in_array($banner->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$banner->id}</td>
							<td><input type="text" size="3" value="{$banner->order}" name="forder[{$banner->id}]" class="text-input" /></td>
							<td><a href="{$conf.rooturl_admin}banner/edit/id/{$banner->id}/redirect/{$redirectUrl}" title="{$banner->link}">{$banner->name}</a></td>
							<td>{$banner->position->name}</td>
							<td class="td_center">{if $banner->enable == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td>{$banner->width}x{if $banner->height > 0}{$banner->height}{else}...{/if}</td>
							<td>
								{if $banner->extension == "SWF"}
									<object data="{$conf.rooturl}{$setting.banner.imageDirectory}{$banner->source}"  type="application/x-shockwave-flash" width="{$banner->width}" height="{if $banner->height > 0}{$banner->height}{else}100{/if}">
										<param name="movie" value="{$conf.rooturl}{$setting.banner.imageDirectory}{$banner->source}"/>
									</object>
								{else}
									<a href="{$banner->link}" title="{$banner->link}">
										<img style="border:1px solid #999999;" alt="{$banner->title}" src="{$conf.rooturl}{$setting.banner.imageDirectory}{$banner->source}" width="{$banner->width}" {if $banner->height > 0} height="{$banner->height}" {/if}/>
									</a>
								{/if}	
							</td>
							<td>{$banner->datecreated|date_format:$lang.controllergroup.dateFormatSmarty}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}banner/edit/id/{$banner->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}banner/delete/id/{$banner->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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
						<option value="name" {if $formData.fsearchin eq 'name'}selected="selected"{/if}>{$lang.controller.formKeywordInNameLabel}</option>
						
					</select>
					-
				
				{$lang.controller.formPositionLabel}:
				
					<select name="fposition" id="fposition">
						<option value="0">- - - - - - - - - - - - - - - - - - -</option>
						{foreach item=position from=$positions}
							<option value="{$position->id}" title="{$position->description}" {if $position->id == $formData.fposition}selected="selected"{/if}>{$position->name}</option>
						{/foreach}
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
		var path = rooturl_admin + "banner/index";
		
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
		
		var positionid = $("#fposition").val();
		if(positionid > 0)
		{
			path += "/positionid/" + positionid;
		}
		
		
		
		document.location.href= path;
	}
</script>
{/literal}




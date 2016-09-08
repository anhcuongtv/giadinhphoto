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
			<li><a href="{$conf.rooturl_admin}contestphotoready">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}contestphotoready/generate">{$lang.controller.head_generate}</a></li>
            <li><a href="{$conf.rooturl_admin}contestphotoready/exportcsv">{$lang.controller.head_exportcsv}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<table class="grid" cellpadding="5" width="100%">
					
				{if $photos|@count > 0}
					<thead>
						<tr>
						   <th align="center"><input class="check-all" type="checkbox" /></th>
							<th width="30" align="left"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">ID</a></th>
							<th width="60">Photo</th>
							<th class="td_left">Section</th>	
							<th class="td_left"><a href="{$filterUrl}sortby/name/sorttype/{if $formData.sortby eq 'name'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Name</a></th>		
										
							<th class="td_center"><a href="{$filterUrl}sortby/resolution/sorttype/{if $formData.sortby eq 'resolution'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Resolution</a></th>
									
							<th align="left"><a href="{$filterUrl}sortby/username/sorttype/{if $formData.sortby eq 'username'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Poster</a></th>	
							<th class="td_center"><a href="{$filterUrl}sortby/country/sorttype/{if $formData.sortby eq 'username'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Country</a></th>			
							
							<th align="left"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">Date Posted</a></th>
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
				{foreach item=photo from=$photos}
					
						<tr>
							<td align="center"><input type="checkbox" name="fbulkid[]" value="{$photo->id}" {if in_array($photo->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							
							<td style="font-weight:bold;">{$photo->id}</td>
							{if $photo->fileserver == ""}
                            <td><a href="{$conf.rooturl}{$setting.contestphoto.imageDirectory}{$photo->filethumb1}" title="{$photo->name}"><img src="{$conf.rooturl}{$setting.contestphoto.imageDirectory}{$photo->filethumb2}" width="60" /></a></td>                  {else}
                            <td><a href="{$setting.extra.imageDirectoryRemoteServer.vn}{$photo->filethumb1}" title="{$photo->name}"><img src="{$setting.extra.imageDirectoryRemoteServer.vn}{$photo->filethumb2}" width="60" /></a></td>
                            {/if}
							<td>{$photo->section}</td>
							<td><a href="{$conf.rooturl_admin}contestphoto/edit/id/{$photo->id}/redirect/{$redirectUrl}"><b>{$photo->name}</b></a></td>
							
							<td class="td_center">{$photo->resolution}</td>
							
							<td align="left">{$photo->poster->username}</td>
							<td class="td_center">{$photo->userCountry}</td>
							<td align="left">{$photo->datecreated|date_format}</td>
							<td><a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}photocontestready/delete/id/{$photo->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="{$formData.fkeyword|@htmlspecialchars}" class="text-input" />
					<select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="name" {if $formData.fsearchin eq 'name'}selected="selected"{/if}>Photo Name</option>
						<option value="section" {if $formData.fsearchin eq 'section'}selected="selected"{/if}>Section</option>
						<option value="country" {if $formData.fsearchin eq 'country'}selected="selected"{/if}>Country</option>
						
						
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
		var path = rooturl_admin + "contestphotoready/index";
		
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







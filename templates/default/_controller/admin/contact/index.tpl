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
			<li><a href="{$conf.rooturl_admin}contact">{$lang.controllergroup.formViewAll}</a></li>
		</ul>
		{/if}
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<table class="grid">
					
				{if $contacts|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controllergroup.formIdLabel}</a></th>
							<th width="150">{$lang.controller.formFullnameLabel}</th>	
							<th width="100"><a href="{$filterUrl}sortby/reason/sorttype/{if $formData.sortby eq 'reason'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formReasonLabel}</a></th>	
							<th>{$lang.controller.formMessageLabel}</th>
							<th width="80"><a href="{$filterUrl}sortby/status/sorttype/{if $formData.sortby eq 'status'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formStatusLabel}</a></th>	
							<th width="100">{$lang.controller.formIpAddressLabel}</th>
							<th width="100"><a href="{$filterUrl}sortby/id/sorttype/{if $formData.sortby eq 'id'}{if $formData.sorttype|upper neq 'DESC'}DESC{else}ASC{/if}{/if}">{$lang.controller.formDateCreatedLabel}</a></th>
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
				{foreach item=contact from=$contacts}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$contact->id}" {if in_array($contact->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$contact->id}</td>
							<td><strong>{$contact->fullname}</strong><br />
								<div style="color:#888;">
									<small>
										{$lang.controller.formEmailLabel}:{$contact->email}<br />
										{$lang.controller.formPhoneLabel}:{$contact->phone}<br />
										{if $contact->username != ''}{$lang.controller.formUsernameLabel}: <a target="_blank" href="{$conf.rooturl}{$contact->username}">{$contact->username}</a>{/if}
									</small></div>
								</td>
							<td>{$contact->reason}</td>
							<td>{$contact->message}</td>
							<td>{if $contact->status == 'completed'}<img src="{$currentTemplate}/images/admin/icons/completed.png" title="Completed" alt="completed" />{elseif $contact->status == 'pending'}<img src="{$currentTemplate}/images/admin/icons/pending.png" title="Pending" alt="pending" />{else}<img src="{$currentTemplate}/images/admin/icons/new.png" title="New" alt="new" />{/if}
								{if $contact->note != ''}<div style="font-style:italic; font-size:11px;" title="{$contact->note}"><small>{$lang.controller.formNoteLabel}: {$contact->note}</small></div>{/if}
							</td>
							<td>{$contact->ipaddress}</td>
							<td title="{$contact->datecreated|date_format:"%H:%M, %B %e, %Y"}">{$contact->datecreated|date_format:"%H:%M, %B %e, %Y"}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}contact/edit/id/{$contact->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
							<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}contact/delete/id/{$contact->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
							</td>
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
				
				{$lang.controller.formReasonLabel}:	
				<select name="freason" id="freason">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="general" {if $formData.freason eq 'general'}selected="selected"{/if}>{$lang.controller.reasonGeneral}</option>
						<option value="ads" {if $formData.freason eq 'ads'}selected="selected"{/if}>{$lang.controller.reasonAds}</option>
						<option value="idea" {if $formData.freason eq 'idea'}selected="selected"{/if}>{$lang.controller.reasonIdea}</option>
						<option value="support" {if $formData.freason eq 'support'}selected="selected"{/if}>{$lang.controller.reasonSupport}</option>
					</select> -
					
					{$lang.controller.formStatusLabel}:	
					<select name="fstatus" id="fstatus">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="new" {if $formData.fstatus eq 'new'}selected="selected"{/if}>New</option>
						<option value="pending" {if $formData.fstatus eq 'pending'}selected="selected"{/if}>Pending</option>
						<option value="completed" {if $formData.fstatus eq 'completed'}selected="selected"{/if}>Completed</option>
					</select> -
					
					{$lang.controller.formKeywordLabel}:
				
					<input type="text" name="fkeyword" id="fkeyword" size="20" value="{$formData.fkeyword|@htmlspecialchars}" class="text-input" /><select name="fsearchin" id="fsearchin">
						<option value="">- - - - - - - - - - - - -</option>
						<option value="username" {if $formData.fsearchin eq 'username'}selected="selected"{/if}>{$lang.controller.formKeywordInUsernameLabel}</option>
						<option value="fullname" {if $formData.fsearchin eq 'fullname'}selected="selected"{/if}>{$lang.controller.formKeywordInFullnameLabel}</option>
						<option value="email" {if $formData.fsearchin eq 'email'}selected="selected"{/if}>{$lang.controller.formKeywordInEmailLabel}</option>
						<option value="phone" {if $formData.fsearchin eq 'phone'}selected="selected"{/if}>{$lang.controller.formKeywordInPhoneLabel}</option>
						<option value="message" {if $formData.fsearchin eq 'message'}selected="selected"{/if}>{$lang.controller.formKeywordInMessageLabel}</option>
						<option value="ipaddress" {if $formData.fsearchin eq 'ipaddress'}selected="selected"{/if}>{$lang.controller.formKeywordInIpAddressLabel}</option>
						<option value="note" {if $formData.fsearchin eq 'note'}selected="selected"{/if}>{$lang.controller.formKeywordInNoteLabel}</option>
						
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
		var path = rooturl_admin + "contact/index";
		
		var id = $("#fid").val();
		if(parseInt(id) > 0)
		{
			path += "/id/" + id;
		}
		
		var reason = $("#freason").val();
		if(reason.length > 0)
		{
			path += "/reason/" + reason;
		}
		
		var status = $("#fstatus").val();
		if(status.length > 0)
		{
			path += "/status/" + status;
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




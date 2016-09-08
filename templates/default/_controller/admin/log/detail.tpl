<h2>{$lang.controller.head_detail} : #{$log->id}</h2>
<div id="page-intro">{$lang.controller.intro_detail}</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_detail}</h3>
		<ul class="content-box-link">
			<li><a href="{$redirectUrl}">{$lang.controllergroup.formBackLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		{include file="`$smartyControllerGroupContainer`notification.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
		
			<table class="grid">
				<tr>
					<td width="150" class="td_right"><strong>Entry ID :</strong></td>
					<td>{$log->id}</td>
				</tr>
				<tr>
					<td class="td_right"><strong>{$lang.controller.formUsernameLabel} :</strong></td>
					<td>{$log->username} (UID: {$log->uid})</td>
				</tr>
				<tr>
					<td class="td_right"><strong>{$lang.controller.formGroupLabel} :</strong></td>
					<td>{$log->groupname} (GROUPID: {$log->groupid})</td>
				</tr>
				<tr>
					<td class="td_right"><strong>{$lang.controller.formTypeLabel} :</strong></td>
					<td> {$log->type}</td>
				</tr>
				
				
				<tr>
					<td class="td_right"><strong>{$lang.controller.formIpLabel} :</strong></td>
					<td>{$log->ip}</td>
				</tr>
				
				<tr>
					<td class="td_right"><strong>{$lang.controller.formDatecreatedLabel} :</strong></td>
					<td>{$log->datecreated|date_format:$lang.controllergroup.dateFormatTimeSmarty}</td>
				</tr>
				
				<tr>
					<td class="td_right"><strong>{$lang.controller.formMoreDataLabel} :</strong></td>
					<td>
						<ul>
							<li><em>{$lang.controller.formMainIdLabel}</em>: {$log->mainid}</li>
						{foreach from=$log->moredata key=k item=v}
							<li><em>{$k}</em>: {$v}</li>
						{/foreach}
						</ul>
					</td>
				</tr>
				
			</table>
			
			<p>
				<a class="button button-delete buttonbig" title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}log/delete/id/{$log->id}/redirect/{$encodedRedirectUrl}?token={$smarty.session.securityToken}');">{$lang.controllergroup.formDeleteLabel}</a>
				&nbsp;
				
			</p>
	
	</div>

    	
</div>


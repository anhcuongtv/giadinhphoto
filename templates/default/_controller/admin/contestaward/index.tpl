<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} ({$awards|@count})</h3>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}contestaward/add">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.awardDeleteToken}" />
				<table class="grid">
					
				{if $awards|@count > 0}
					<thead>
						<tr>
						   <th width="30" class="td_left">{$lang.controllergroup.formIdLabel}</th>
							<th class="td_left" width="200">{$lang.controller.name}</th>
                            <th class="td_left" width="200">{$lang.controller.section}</th>	
							<th width="100" class="td_center">{$lang.controller.isactive}</th>
							<th width="70"></th>
						</tr>
					</thead>
					
					
					<tbody>
					{foreach item=award from=$awards name=awardlist}
					
						<tr>
							<td style="font-weight:bold;">{$award->id}</td>
							<td><a href="{$conf.rooturl_admin}contestaward/edit/id/{$award->id}/redirect/{$redirectUrl}">{$award->name}</a></td>
							<td>
                            	{if $award->section == 'color'}{$lang.global.photoSectionColor}{elseif $award->section == 'mono'}{$lang.global.photoSectionMono}{elseif $award->section == 'nature'}{$lang.global.photoSectionNature}{elseif $award->section == 'travel'}{$lang.global.photoSectionTravel}{else}<small style="color:#bbb;"><i>{$lang.controller.applytoallsection}</i></small>{/if}
                            </td>
                            
							<td class="td_center">{if $award->isactive == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}contestaward/edit/id/{$award->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}contestaward/delete/id/{$award->id}/redirect/{$redirectUrl}?token={$smarty.session.awardDeleteToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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




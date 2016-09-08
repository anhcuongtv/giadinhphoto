<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list} ({$rounds|@count})</h3>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}round/add">{$lang.controller.head_add}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.roundDeleteToken}" />
				<table class="grid">
					
				{if $rounds|@count > 0}
					<thead>
						<tr>
						   <th width="30" class="td_left">{$lang.controllergroup.formIdLabel}</th>
							<th class="td_left" width="200">{$lang.controller.name}</th>		
							<th class="td_left">{$lang.controller.photo}</th>
                            <th class="td_left">Score Stats</th>	
							
                            <th class="td_left">Generate Photo</th>	
                            <th width="100">{$lang.controller.passpoint}</th>							
							<th width="100" class="td_center">{$lang.controller.isactive}</th>
							<th width="100" class="td_center">{$lang.controller.isEnableView}</th>
                            <th width="100" class="td_center">{$lang.controller.isgiveaward}</th>
                            <th></th>
							<th width="70"></th>
						</tr>
					</thead>
					
					
					<tbody>
					{foreach item=round from=$rounds name=roundlist}
					
						<tr>
							<td style="font-weight:bold;">{$round->id}</td>
							<td><a href="{$conf.rooturl_admin}round/edit/id/{$round->id}/redirect/{$redirectUrl}">{$round->name}</a></td>
							<td>
                            	{$round->numberphoto}
                                
                            </td>
                            <td><small>
                            	{if $round->numberphoto > 0}
                                	Finished: {$round->numberphotofinished}, <br />
                                    Un-scored: {$round->numberphotounscored}<br />
                                    <a href="{$conf.rooturl_admin}round/updatestats/id/{$round->id}/redirect/{$redirectUrl}" title="Update Info about Finished Photos &amp; Un-scored Photos">[Update Stat]</a>
                                {else}
                                	<em>Photo empty</em>
                                {/if}
                            	</small>
                            </td>

                            <td>{if $smarty.foreach.roundlist.first}
                                	<a href="javascript:delm('{$conf.rooturl_admin}round/insertphoto/id/{$round->id}/inserttype/all/redirect/{$redirectUrl}')" title="">{$lang.controller.insertFromReadyList}</a> (<a href="{$conf.rooturl_admin}contestphotoready">{$countReadyPhoto} photo</a>)
                                {else}
                                	<a href="{$conf.rooturl_admin}round/insertphoto/id/{$round->id}/previd/{$prevRound->id}/redirect/{$redirectUrl}" title="">{$lang.controller.insertFromPrevRound}</a> (<a href="{$conf.rooturl_admin}contestphotoready">{$prevRound->name} : {$prevRound->numberphoto} photo</a>)
                                {/if}
                            </td>
							<td style="width:140px">{$round->passPoint}</td>
							<td class="td_center">{if $round->isactive == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td class="td_center">{if $round->isEnableView == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td class="td_center">{if $round->isgiveaward == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td><a title="Export CSV" href="{$conf.rooturl_admin}round/exportcsv/id/{$round->id}/redirect/{$redirectUrl}">Export CSV</a></td>
                            <td>
                            	<a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}round/edit/id/{$round->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}round/delete/id/{$round->id}/redirect/{$redirectUrl}?token={$smarty.session.roundDeleteToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
							</td>
							                            <td><a href="{$conf.rooturl_admin}round/listphoto/id/{$round->id}">Xem ảnh</a></td>

						</tr>
						
						{assign var=prevRound value=$round}
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




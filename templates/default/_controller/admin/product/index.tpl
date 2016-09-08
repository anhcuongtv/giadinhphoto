<h2>{$lang.controller.head_list}</h2>
<div id="page-intro">{$lang.controller.intro_list}</div>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_list}({$total})</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.tableTabLabel}</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			<form action="" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<input type="hidden" name="ftoken" value="{$smarty.session.productBulkToken}" />
				<table class="grid">
					
				{if $products|@count > 0}
					<thead>
						<tr>
							<th width="30" align="right">{$lang.controllergroup.formIdLabel}</th>
							<th align="left">{$lang.controller.formNameLabel}</th>		
							<th width="80" class="td_right">{$lang.controller.formPriceLabel}</th>				
							<th width="70"></th>
						</tr>
					</thead>
					
					
					<tbody>
					{foreach item=myProduct from=$products}
					
						<tr>
							<td style="font-weight:bold;" align="right">{$myProduct->id}</td>
							<td align="left"><a href="{$conf.rooturl_admin}product/edit/id/{$myProduct->id}/redirect/{$redirectUrl}">{$myProduct->name}</a>
							</td>
							<td class="td_right">{$currency->formatPrice($myProduct->price)}</td>
							
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}product/edit/id/{$myProduct->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a style="display:none" title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}product/delete/id/{$myProduct->id}/redirect/{$redirectUrl}?token={$smarty.session.securityToken}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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
	

    	
</div>




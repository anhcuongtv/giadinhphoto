<table width="100%" border="0"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
	<tr>
		<td>
			<div class="nav_tabs">	
				<ul>
					<li class="{if $action eq 'index' OR $action eq 'view'}active{/if}"><a href="{if $decodedRedirectUrl neq ''}{$base_dir}{$decodedRedirectUrl}{else}{$base_dir}shipping{/if}">{$lang.controller.sm_view}</a></li>
					<li class="{if $action eq 'locadd'}active{/if}"><a href="{$base_dir}shipping/locadd">{$lang.controller.sm_locadd}</a></li>
					{if $action eq 'locedit'}<li class="active"><a href="javascript:void(0);">{$lang.controller.sm_locedit}</a></li>{/if}
				</ul>
				<div class="tab_description">
					{switch expr=$action}
						{case}{$lang.controller.sm_view_descr}{/case}
						{case expr='locadd'}{$lang.controller.sm_locadd_descr}{/case}
						{case expr='locedit'}{$lang.controller.sm_locedit_descr}{/case}
					{/switch}
				</div>
			</div>
		</td>
	</tr>
</table>
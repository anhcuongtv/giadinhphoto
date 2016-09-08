<h2>{$lang.controller.head}</h2>
<div id="page-intro">{$lang.controller.intro}</div>

<div class="content-box column-left"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_system}</h3>
		
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<table class="grid" cellpadding="10">
			<tr>
				<td width="200" class="td_right">Server IP :</td>
				<td>{$formData.fserverip}</td>
			</tr>
			<tr>
				<td class="td_right">Server Name :</td>
				<td>{$formData.fserver}</td>
			</tr>
			<tr>
				<td class="td_right">PHP Version :</td>
				<td>{$formData.fphp}</td>
			</tr>
			<tr>
				<td class="td_right">MySQL Version :</td>
				<td></td>
			</tr>
			<tr>
				<td class="td_right">Server Time :</td>
				<td>{$smarty.now|date_format:$lang.controllergroup.dateFormatTimeSmarty}</td>
			</tr>
		</table>
	</div>	
</div>


<div class="content-box column-right"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_website}</h3>
		
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<table cellpadding="10" cellspacing="20">
			<tbody>
			<tr>
				<td width="50">&nbsp;</td>
				<td><a title="{$lang.controller.viewAllTooltip}" href="{$conf.rooturl_admin}user"><img src="{$currentTemplate}/images/admin/icons/detail.png" alt="list" /></a>  <span class="statnumber">{$stat.user}</span> <strong>{$lang.controller.statUser}{if $stat.user > 1}{$lang.controller.statPluralSuffix}{/if}</strong> </td>
			</tr>
			<tr>
				<td width="50">&nbsp;</td>
				<td><a title="{$lang.controller.viewAllTooltip}" href="{$conf.rooturl_admin}contact"><img src="{$currentTemplate}/images/admin/icons/detail.png" alt="list" /></a>  <span class="statnumber">{$stat.contact}</span> <strong>{$lang.controller.statContact}{if $stat.contact > 1}{$lang.controller.statPluralSuffix}{/if}</strong> </td>
			</tr>
			
			
			<tr>
				<td colspan="2"><hr size="1" /><br /><a href="http://www.google.com/analytics/" target="_blank">&raquo; Go to Google Analytics</a></td>
			</tr>
		</tbody
		></table>
	</div>	
</div>

<div class="clear"></div>
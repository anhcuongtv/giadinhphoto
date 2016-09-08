<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.judgerEditToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_edit}</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
			
		</ul>
		<ul class="content-box-link">
			<li><a href="{$redirectUrl}">{$lang.controllergroup.formBackLabel}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1">
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			
				<fieldset>
				<p>
					<label>{$lang.controller.judger} <span class="star_require">*</span> : </label>
					User ID: <input type="text" disabled="disabled" size="5" value="{$myJudger->uid}" class="text-input">
					 <em>- OR -</em>
					Username: <input type="text" disabled="disabled" size="30" value="{$myJudger->user->username}" class="text-input">
					<em>- OR -</em>
					Email<input type="text" disabled="disabled" size="30" value="{$myJudger->user->email}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controller.iscolor}: </label>
					<select name="fiscolor" id="fiscolor">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
						<option value="1" {if $formData.fiscolor == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>						
					</select>
				</p>
                
                <p>
                    <label>{$lang.controller.isColorBestPortrait} Best: </label>
                    <select name="isColorBestPortrait" id="fiscolorbest">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isColorBestPortrait == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isColorBestIdea} Best: </label>
                    <select name="isColorBestIdea" id="fiscolorbest">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isColorBestIdea == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isColorBestAction} Best: </label>
                    <select name="isColorBestAction" id="fiscolorbest">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isColorBestAction == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.ismono} </label>
                    <select name="fismono" id="fiscolorbest">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.fismono == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isMonoBestPortrait} Best: </label>
                    <select name="isMonoBestPortrait" id="fiscolorbest">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isMonoBestPortrait == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isMonoBestAction} Best: </label>
                    <select name="isMonoBestAction" id="isMonoBestAction">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isMonoBestAction == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isMonoCreative} Best: </label>
                    <select name="isMonoCreative" id="fiscolorbest">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isMonoCreative == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isnature}  </label>
                    <select name="fisnature" id="fisnature">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.fisnature == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isNatureBestBird} Best: </label>
                    <select name="isNatureBestBird" id="isNatureBestBird">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isNatureBestBird == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isNatureBestSnow} Best: </label>
                    <select name="isNatureBestSnow" id="isNatureBestSnow">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isNatureBestSnow == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isNatureBestFlower} Best: </label>
                    <select name="isNatureBestFlower" id="isNatureBestFlower">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isNatureBestFlower == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.istravel} </label>
                    <select name="fistravel" id="fistravel">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.fistravel == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
                <p>
                    <label>{$lang.controller.isTravelTransportation} Best: </label>
                    <select name="isTravelTransportation" id="isTravelTransportation">
                        <option value="0">{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isTravelTransportation == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>                        
                    </select>
                </p>
				
				<p>
					<label>{$lang.controller.isTravelTraditional} Best :</label>
					<select name="isTravelTraditional" id="isTravelTraditional">
                        <option value="0" >{$lang.controllergroup.formNoLabel}</option>
						<option value="1" {if $formData.isTravelTraditional == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>
					</select>
				</p>
                
                <p>
                    <label>{$lang.controller.isTravelCountry} Best </label>
                    <select name="isTravelCountry" id="isTravelCountry">
                        <option value="0" >{$lang.controllergroup.formNoLabel}</option>
                        <option value="1" {if $formData.isTravelCountry == '1'}selected="selected"{/if}>{$lang.controllergroup.formYesLabel}</option>
                    </select>
                </p>
				
				
				
				</fieldset>
			
		</div>
		
	
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="{$lang.controllergroup.formUpdateSubmit}" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : {$lang.controllergroup.formRequiredLabel}</small>
		</p>
		</fieldset>
	</div>

    	
</div>
</form>


<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>Round Score Statistic ({$rounds|@count})</h3>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}round">{$lang.controllergroup.menuRoundList}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			
				<table class="grid">
					
				{if $rounds|@count > 0}
					<thead>
						<tr>
						   <th width="30" class="td_left">ID</th>
							<th class="td_left" width="200">Name</th>		
							<th class="td_left">Photo</th>
                            <th class="td_left">Score Stats</th>	
									
							<th width="100" class="td_center">Is Active</th>
							
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
                                    
                                {else}
                                	<em>Photo empty</em>
                                {/if}
                            	</small>
                            </td>
                            
							<td class="td_center">{if $round->isactive == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							
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


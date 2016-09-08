<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.pollEditToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_edit}</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controller.formOptionLabel}</a></li> <!-- href must be unique and match the id of target div -->
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
				<label>{$lang.controller.formFinishedLabel}: </label>
				<select name="ffinished" id="ffinished">
					<option value="1">{$lang.controllergroup.formYesLabel}</option>
					<option value="0" {if $formData.ffinished == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
				</select>
			</p>
			
			<p>
				<label>{$lang.controller.formShowLabel}: </label>
				<select name="fenable" id="fenable">
					<option value="1">{$lang.controllergroup.formYesLabel}</option>
					<option value="0" {if $formData.fenable == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
				</select>
			</p>
			
			<hr class="language_seperator_line" />
			{foreach item=langedit from=$langEditList}
				{assign var=langeditcode value=$langedit->code}
				<h3 class="language_heading"><img src="{$conf.rooturl}{$currentTemplate}/images/admin/flag_{$langeditcode}.png" alt="{$langeditcode}" /> {$langedit->name}</h3>
				<p>
					<label>{$lang.controller.formTitleLabel} : </label>
					<input type="text" name="ftitle[{$langeditcode}]" id="ftitle[{$langeditcode}]" size="80" value="{$formData.ftitle.$langeditcode|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controllergroup.formSeoTitleLabel} : </label>
					<input type="text" name="fseotitle[{$langeditcode}]" id="fseotitle[{$langeditcode}]" size="80" value="{$formData.fseotitle.$langeditcode|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controllergroup.formSeoKeywordLabel} : </label>
					<textarea class="text-input mceNoEditor"  rows="2" name="fseokeyword[{$langeditcode}]" id="fseokeyword[{$langeditcode}]">{$formData.fseokeyword.$langeditcode}</textarea>
				</p>
				
				<p>
					<label>{$lang.controllergroup.formSeoDescriptionLabel} : </label>
					<textarea class="text-input mceNoEditor"  rows="2" name="fseodescription[{$langeditcode}]" id="fseodescription[{$langeditcode}]">{$formData.fseodescription.$langeditcode}</textarea>
				</p>

				<hr class="language_seperator_line" />	
			{/foreach}
						
			</fieldset>
			
		</div>
		
		<div class="tab-content" id="tab2">
			<table cellspacing="5">
				<thead>
					<tr>
						<th></th>
						{foreach item=langedit from=$langEditList}
							{assign var=langeditcode value=$langedit->code}
							<th><h3 class="language_heading"><img src="{$conf.rooturl}{$currentTemplate}/images/admin/flag_{$langeditcode}.png" alt="{$langeditcode}" /> {$langedit->name}</h3></th>
						{/foreach}
						<th>{$lang.controllergroup.formOrderLabel}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
					{foreach name="polloption" item=option from=$formData.foldoption}
						{counter assign=polloptionCounter}	
						<tr>
							<td>Option #{$polloptionCounter} :</td>
							{foreach item=langedit from=$langEditList}
							{assign var=curiteration value=$smarty.section.polloption.iteration}
							{assign var=langeditcode value=$langedit->code}
								<td><input type="text" name="foldoption[{$option->id}][title][{$langeditcode}]" value="{$option->title.$langeditcode}" size="40" class="text-input" /></td>	
						{/foreach}
						
							
							<td><input type="text" name="foldoption[{$option->id}][order]" value="{$option->order}" size="4" class="text-input" /></td>
							<td><input type="checkbox" name="fdeleteoption[]" value="{$option->id}" />{$lang.controllergroup.formDeleteLabel}</td>
						</tr>

					{/foreach}
					{section loop=6 name="polloption" start=$polloptionCounter}
					{counter assign=polloptionCounter}
					<tr>
						<td>Option #{$polloptionCounter} :</td>
						{foreach item=langedit from=$langEditList}
							{assign var=curiteration value=$smarty.section.polloption.iteration}
							{assign var=langeditcode value=$langedit->code}
								<td><input type="text" name="foption[{$polloptionCounter}][{$langeditcode}]" value="{$formData.foption.$polloptionCounter.$langeditcode}" size="40" class="text-input" /></td>
						{/foreach}
					</tr>
					
					{/section}
				</tbody>
			</table>
		
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

{include file=tinymce.tpl}


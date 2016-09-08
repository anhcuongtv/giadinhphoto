<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.newscategoryEditToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_edit}</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">{$lang.controllergroup.formFormLabel}</a></li> <!-- href must be unique and match the id of target div -->
			<li><a href="#tab2">{$lang.controllergroup.formSeoLabel}</a></li>
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
					<label>{$lang.controller.formParentLabel}: </label>
					<select name="fparentid" id="fparentid">
						<option value="0">- - - - - - - - - - - - - - - - - - -</option>
						{foreach item=parentCat from=$parentCategories}
							<option value="{$parentCat->id}" title="{$parentCat->title}" {if $parentCat->id == $formData.fparentid}selected="selected"{/if}>{$parentCat->title}</option>
						{/foreach}
					</select>
				</p>
				
				<p>
					<label>{$lang.controller.formShowLabel}: </label>
					<select name="fenable" id="fenable">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.fenable == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
					</select>
				</p>
				<!--Phan thong tin lien quan ngon ngu:-->
				<hr class="language_seperator_line" />
				{foreach item=langedit from=$langEditList}
					{assign var=langeditcode value=$langedit->code}
					<h3 class="language_heading"><img src="{$conf.rooturl}{$currentTemplate}/images/admin/flag_{$langeditcode}.png" alt="{$langeditcode}" /> {$langedit->name}</h3>
					<p>
						<label>{$lang.controller.formNameLabel} <span class="star_require">*</span> : </label>
						<input type="text" name="fname[{$langeditcode}]" id="fname[{$langeditcode}]" size="80" value="{$formData.fname.$langeditcode|@htmlspecialchars}" class="text-input">
					</p>
	
					<hr class="language_seperator_line" />	
				{/foreach}
				
				</fieldset>
			
		</div>
		
		<div class="tab-content" id="tab2">
			<p>
				<label>{$lang.controllergroup.formSeoUrlLabel} : </label>
				<input type="text" name="fseourl" id="fseourl" size="80" value="{$formData.fseourl|@htmlspecialchars}" class="text-input">
			</p>
			
			<hr class="language_seperator_line" />
			{foreach item=langedit from=$langEditList}
				{assign var=langeditcode value=$langedit->code}
				<h3 class="language_heading"><img src="{$conf.rooturl}{$currentTemplate}/images/admin/flag_{$langeditcode}.png" alt="{$langeditcode}" /> {$langedit->name}</h3>
				<p>
					<label>{$lang.controllergroup.formSeoTitleLabel} : </label>
					<input type="text" name="fseotitle[{$langeditcode}]" id="fseotitle[{$langeditcode}]" size="80" value="{$formData.fseotitle.$langeditcode|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controllergroup.formSeoKeywordLabel} : </label>
					<textarea class="text-input"  rows="2" name="fseokeyword[{$langeditcode}]" id="fseokeyword[{$langeditcode}]">{$formData.fseokeyword.$langeditcode}</textarea>
				</p>
				
				<p>
					<label>{$lang.controllergroup.formSeoDescriptionLabel} : </label>
					<textarea class="text-input"  rows="2" name="fseodescription[{$langeditcode}]" id="fseodescription[{$langeditcode}]">{$formData.fseodescription.$langeditcode}</textarea>
				</p>

				<hr class="language_seperator_line" />	
			{/foreach}
						
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
		<h3>{$lang.controller.title_subcat} ({$subcategories|@count})</h3>
		<ul class="content-box-link">
			<li><a href="{$conf.rooturl_admin}newscategory/add/parentid/{$formData.fid}">{$lang.controller.head_addsub}</a></li>
		</ul>
		<div class="clear"></div>  
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			<form action="{$conf.rooturl_admin}newscategory" method="post" name="manage" onsubmit="return confirm('Are You Sure ?');">
				<table class="grid">
					
				{if $subcategories|@count > 0}
					<thead>
						<tr>
						   <th width="40"><input class="check-all" type="checkbox" /></th>
							<th width="30">{$lang.controllergroup.formIdLabel}</th>
							<th width="50">{$lang.controllergroup.formOrderLabel}</th>
							<th>{$lang.controller.formNameLabel}</th>							
							<th width="100" class="td_center">{$lang.controller.formShowLabel}</th>
							<th width="120">{$lang.controller.formDateModifiedLabel}</th>
							<th width="70"></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="8">
								<div class="bulk-actions align-left">
									<select name="fbulkaction">
										<option value="">{$lang.controllergroup.bulkActionSelectLabel}</option>
										<option value="delete">{$lang.controllergroup.bulkActionDeletetLabel}</option>
									</select>
									<input type="submit" name="fsubmitbulk" class="button" value="{$lang.controllergroup.bulkActionSubmit}" />
									<input type="submit" name="fchangeorder" class="button" value="{$lang.controllergroup.formChangeOrderSubmit}" />
								</div>
						
								<div class="clear"></div>
							</td>
						</tr>
					</tfoot>
					<tbody>
					{foreach item=category from=$subcategories}
					
						<tr>
							<td><input type="checkbox" name="fbulkid[]" value="{$category->id}" {if in_array($category->id, $formData.fbulkid)}checked="checked"{/if}/></td>
							<td style="font-weight:bold;">{$category->id}</td>
							<td><input type="text" size="3" value="{$category->order}" name="forder[{$category->id}]" class="text-input" /></td>
							<td><a title="URL: {$conf.rooturl}{$conf.seoDirNewsCategory}/{$category->seoUrl}-{$category->id}.html" href="{$conf.rooturl_admin}newscategory/edit/id/{$category->id}/redirect/{$redirectUrl}">{$category->name}</a>
								{if $category->sub|@count > 0}
									<ul>
										{foreach item=subcat from=$category->sub}
											<li><a title="URL: {$conf.rooturl}{$conf.seoDirNewsCategory}/{$subcat->seoUrl}-{$subcat->id}.html" href="{$conf.rooturl_admin}newscategory/edit/id/{$subcat->id}/redirect/{$redirectUrl}">{$subcat->name}</a></li>
										{/foreach}
									</ul>
								{/if}
							</td>
							<td class="td_center">{if $category->enable == 1}<img border="0" src="{$currentTemplate}/images/admin/icons/tick_circle.png" alt="{$lang.controllergroup.formYesLabel}" title="{$lang.controllergroup.formYesLabel}" width="16"/>{else}<img border="0" src="{$currentTemplate}/images/admin/icons/cross_circle.png" alt="{$lang.controllergroup.formNoLabel}" title="{$lang.controllergroup.formNoLabel}" width="16"/>{/if}</td>
							<td>{$category->datemodified|date_format:$lang.controllergroup.dateFormatSmarty}</td>
							<td><a title="{$lang.controllergroup.formActionEditTooltip}" href="{$conf.rooturl_admin}newscategory/edit/id/{$category->id}/redirect/{$redirectUrl}"><img border="0" src="{$currentTemplate}/images/admin/icons/pencil.png" alt="{$lang.controllergroup.formEditLabel}" width="16"/></a> &nbsp;
								<a title="{$lang.controllergroup.formActionDeleteTooltip}" href="javascript:delm('{$conf.rooturl_admin}newscategory/delete/id/{$category->id}/redirect/{$redirectUrl}');"><img border="0" src="{$currentTemplate}/images/admin/icons/cross.png" alt="{$lang.controllergroup.formDeleteLabel}" width="16"/></a>
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


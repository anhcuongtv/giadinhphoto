<h2>{$lang.controller.head_add}</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
<input type="hidden" name="ftoken" value="{$smarty.session.judgerAddToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_add}</h3>
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
					User ID: <input type="text" name="fuserid" id="fuserid" size="5" value="{$formData.fuserid|@htmlspecialchars}" class="text-input">
					 <em>- OR -</em>
					Username: <input type="text" name="fusername" id="fusername" size="30" value="{$formData.fusername|@htmlspecialchars}" class="text-input">
					<em>- OR -</em>
					Email<input type="text" name="femail" id="femail" size="30" value="{$formData.femail|@htmlspecialchars}" class="text-input">
				</p>

				{foreach item=sectionItem from=$group}
					{if $sectionItem->isSection}
						<div class="sectionGroup">
							<span>{$sectionItem->name}</span>

					{if $sectionItem->child}
						{foreach item=sectionItemDetail from=$sectionItem->child}
						<p>
							<label>{$sectionItemDetail->name}: </label>
							<select name="group[]" id="group">
								<option value="0">{$lang.controllergroup.formNoLabel}</option>
								<option value="{$sectionItemDetail->id}">{$lang.controllergroup.formYesLabel}</option>
							</select>
						</p>
						{/foreach}
					{/if}
							</div>
					{/if}
				{/foreach}

				
				
				</fieldset>
			
		</div>

	
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="{$lang.controllergroup.formAddSubmit}" class="button buttonbig">
			<br /><small><span class="star_require">*</span> : {$lang.controllergroup.formRequiredLabel}</small>
		</p>
		</fieldset>
	</div>

    	
</div>
</form>




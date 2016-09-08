<h2>{$lang.controller.head_add}</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
<input type="hidden" name="ftoken" value="{$smarty.session.bannerAddToken}" />
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
					<label>{$lang.controller.formNameLabel} <span class="star_require">*</span> : </label>
					<input type="text" name="fname" id="fname" size="80" value="{$formData.fname|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controller.formLinkLabel} <span class="star_require">*</span> : </label>
					<input type="text" name="flink" id="flink" size="80" value="{$formData.flink|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controller.formSourceLabel} <span class="star_require">*</span> : </label>
					<input type="file" name="fimage" id="fimage" class="text-input"><small>{$lang.controller.formSourceHelp}</small>
				</p>
				
				<p>
					<label>{$lang.controller.formWidthLabel} <span class="star_require">*</span> : </label>
					<input type="text" name="fwidth" id="fwidth" size="10" value="{$formData.fwidth|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controller.formHeightLabel} : </label>
					<input type="text" name="fheight" id="fheight" size="10" value="{$formData.fheight|@htmlspecialchars}" class="text-input"><small>{$lang.controller.formHeightHelp}</small>
				</p>
				
				<p>
					<label>{$lang.controller.formPositionLabel}: </label>
					<select name="fposition" id="fposition">
						<option value="0">- - - - - - - - - - - - - - - - - - -</option>
						{foreach item=position from=$positions}
							<option value="{$position->id}" title="{$position->description}" {if $position->id == $formData.fposition}selected="selected"{/if}>{$position->name}</option>
						{/foreach}
					</select>
				</p>
				
				<p>
					<label>{$lang.controller.formEnableLabel}: </label>
					<select name="fenable" id="fenable">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.fenable == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
					</select>
				</p>
				
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


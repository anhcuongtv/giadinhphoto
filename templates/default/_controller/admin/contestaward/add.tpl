<h2>{$lang.controller.head_add}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.awardAddToken}" />
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
					<label>{$lang.controller.name} <span class="star_require">*</span> : </label>
					<input type="text" name="fname" id="fname" size="80" value="{$formData.fname|@htmlspecialchars}" class="text-input">
				</p>
				
                <p>
                    <label>{$lang.controller.section}  : </label>
                    <select name="fsection">
                        <option value="">{$lang.global.photoSectionSelectOne}</option>
                        <option value="color" {if $formData.fsection == 'color'}selected="selected"{/if}>{$lang.global.photoSectionColor}</option>
                        <option value="mono" {if $formData.fsection == 'mono'}selected="selected"{/if}>{$lang.global.photoSectionMono}</option>
                        <option value="nature" {if $formData.fsection == 'nature'}selected="selected"{/if}>{$lang.global.photoSectionNature}</option>
                        <option value="travel" {if $formData.fsection == 'travel'}selected="selected"{/if}>{$lang.global.photoSectionTravel}</option>
                    </select>
                </p>
                
				<p>
					<label>{$lang.controller.isactive}: </label>
					<select name="fisactive" id="fisactive">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.fisactive == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
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




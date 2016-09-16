<h2>{$lang.controller.head_add}</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
<input type="hidden" name="ftoken" value="{$smarty.session.roundAddToken}" />
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
					<label>{$lang.controller.isactive}: </label>
					<select name="fisactive" id="fisactive">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.fisactive == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
					</select>
				</p>
                
                <p>
					<label>{$lang.controller.isgiveaward}: </label>
					<select name="fisgiveaward" id="fisgiveaward">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.fisgiveaward == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
					</select>
				</p>

					{foreach item=sectionItem from=$group}
						{if $sectionItem->isSection}
							<div class="sectionGroup">
								<span>{$sectionItem->name}</span>
								{if $sectionItem->child}
									{foreach item=sectionItemDetail from=$sectionItem->child}
										{assign var="id" value=$sectionItemDetail->id}
										<p>
											<label>{$sectionItemDetail->name} <span class="star_require">*</span> : </label>
											<input type="text" name="section[{$sectionItemDetail->id}]" id="section" size="5" value="{$formData.section.$id|@htmlspecialchars}" class="text-input">
										</p>
									{/foreach}
								{/if}
							</div>
						{/if}
					{/foreach}

				{*<p>
					<label>{$lang.controller.passpoint} Color <span class="star_require">*</span> : </label>
					<input type="text" name="fpasspointcolor" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionColor|@htmlspecialchars}" class="text-input">
				</p>
                
                <p>
                    <label>{$lang.controller.passpoint} Color Best <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointcolorbest" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionColorBest|@htmlspecialchars}" class="text-input">
                </p>
                
                <p>
                    <label>{$lang.controller.passpoint} Mono <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointmono" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionMono|@htmlspecialchars}" class="text-input">
                </p>
                
                <p>
                    <label>{$lang.controller.passpoint} Mono Best<span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointmonobest" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionMonoBest|@htmlspecialchars}" class="text-input">
                </p>
                
                <p>
                    <label>{$lang.controller.passpoint} Nature<span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointnature" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionNature|@htmlspecialchars}" class="text-input">
                </p>
                
                <p>
                    <label>{$lang.controller.passpoint} Travel<span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointtravel" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionTravel|@htmlspecialchars}" class="text-input">
                </p>*}
				
				
								
				
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




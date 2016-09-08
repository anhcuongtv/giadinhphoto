<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.roundEditToken}" />
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
                    <label>{$lang.controller.isEnableView}: </label>
                    <select name="fisEnableView" id="fisactive">
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
                        <option value="0" {if $formData.fisEnableView == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                    </select>
                </p>
                
                <p>
					<label>{$lang.controller.isgiveaward}: </label>
					<select name="fisgiveaward" id="fisgiveaward">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.fisgiveaward == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
					</select>
				</p>
				
				<p>
					<label>{$lang.controller.passpoint} Color <span class="star_require">*</span> : </label>
					<input type="text" name="fpasspointcolor" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionColor|@htmlspecialchars}" class="text-input">
				</p>
                
                <p>
                    <label>{$lang.controller.passpoint} Color Best Portrait <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionColorBestPortrait" id="sectionColorBestPortrait" size="5" value="{$formData.fpasspoint.sectionColorBestPortrait|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Color Best Sport <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionColorBestAction" id="sectionColorBestAction" size="5" value="{$formData.fpasspoint.sectionColorBestAction|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Color Best Idea <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionColorBestIdea" id="sectionColorBestIdea" size="5" value="{$formData.fpasspoint.sectionColorBestIdea|@htmlspecialchars}" class="text-input">
                </p>
                 <p>
                    <label>{$lang.controller.passpoint} Mono <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointmono" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionMono|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Mono Best Portrait <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionMonoBestPortrait" id="sectionMonoBestPortrait" size="5" value="{$formData.fpasspoint.sectionMonoBestPortrait|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Mono Best Action <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionMonoBestAction" id="sectionMonoBestAction" size="5" value="{$formData.fpasspoint.sectionMonoBestAction|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Mono Best Creative <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionMonoBestCreative" id="sectionMonoBestCreative" size="5" value="{$formData.fpasspoint.sectionMonoBestCreative|@htmlspecialchars}" class="text-input">
                </p>
                 <p>
                    <label>{$lang.controller.passpoint} Nature <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointnature" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionNature|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Nature Best Snow <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionNatureBestSnow" id="sectionNatureBestSnow" size="5" value="{$formData.fpasspoint.sectionNatureBestSnow|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Nature Best Bird <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionNatureBestBird" id="sectionNatureBestBird" size="5" value="{$formData.fpasspoint.sectionNatureBestBird|@htmlspecialchars}" class="text-input">
                </p>

                <p>
                    <label>{$lang.controller.passpoint} Nature Best Flower <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionNatureBestFlower" id="sectionNatureBestFlower" size="5" value="{$formData.fpasspoint.sectionNatureBestFlower|@htmlspecialchars}" class="text-input">
                </p>

                <p>
                    <label>{$lang.controller.passpoint} Travel <span class="star_require">*</span> : </label>
                    <input type="text" name="fpasspointtravel" id="fpasspoint" size="5" value="{$formData.fpasspoint.sectionTravel|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Travel Best Transportation <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionTravelBestTransportation" id="sectionTravelBestTransportation" size="5" value="{$formData.fpasspoint.sectionTravelBestTransportation|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Travel Best Country  <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionTravelBestCountry" id="sectionTravelBestCountry" size="5" value="{$formData.fpasspoint.sectionTravelBestCountry|@htmlspecialchars}" class="text-input">
                </p>
                <p>
                    <label>{$lang.controller.passpoint} Travel Best Traditional  <span class="star_require">*</span> : </label>
                    <input type="text" name="sectionTravelBestTraditional" id="sectionTravelBestTraditional" size="5" value="{$formData.fpasspoint.sectionTravelBestTraditional|@htmlspecialchars}" class="text-input">
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

{include file=tinymce.tpl}


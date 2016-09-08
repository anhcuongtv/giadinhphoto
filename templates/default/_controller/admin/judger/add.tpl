<h2>{$lang.controller.head_add}</h2>

<form action="" method="post" name="myform">
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
				
				<p>
					<label>{$lang.controller.iscolor}: </label>
					<select name="fiscolor" id="fiscolor">						
						<option value="0" {if $formData.fiscolor == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
					</select>
				</p>
                
                <p>
                    <label>{$lang.controller.iscolor} Best: </label>
                    <select name="fiscolorbest" id="fiscolorbest">
                        <option value="0" {if $formData.fiscolor == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
                    </select>
                </p>
				
				<p>
					<label>{$lang.controller.ismono}: </label>
					<select name="fismono" id="fismono">
						<option value="0" {if $formData.fismono == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
					</select>
				</p>
                
                <p>
                    <label>{$lang.controller.ismono} Best: </label>
                    <select name="fismonobest" id="fismonobest">                        
                        <option value="0" {if $formData.fismono == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
                    </select>
                </p>
				
				<p>
					<label>{$lang.controller.isnature}: </label>
					<select name="fisnature" id="fisnatre">
					    <option value="0" {if $formData.fisnature == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
					</select>
				</p>
                
                <p>
                    <label>{$lang.controller.istravel}: </label>
                    <select name="fistravel" id="fistravel">                        
                        <option value="0" {if $formData.fistravel == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
                        <option value="1">{$lang.controllergroup.formYesLabel}</option>
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




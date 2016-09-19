<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
	<input type="hidden" name="ftoken" value="{$smarty.session.productEditToken}" />
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
				<p>
					<label>{$lang.controller.status}: </label>
					<select name="status" id="status">
						<option value="1">{$lang.controllergroup.formYesLabel}</option>
						<option value="0" {if $formData.status == '0'}selected="selected"{/if}>{$lang.controllergroup.formNoLabel}</option>
					</select>
				</p>

				<fieldset>
					<hr class="language_seperator_line" />
					{foreach item=langedit from=$langEditList}
						{assign var=langeditcode value=$langedit->code}
						{assign var=name value="name_$langeditcode"}
						{assign var=price value="price_$langeditcode"}
						{assign var=description value="description_$langeditcode"}
						<h3 class="language_heading"><img src="{$conf.rooturl}{$currentTemplate}/images/admin/flag_{$langeditcode}.png" alt="{$langeditcode}" /> {$langedit->name}</h3>
						<p>
								<label>{$lang.controller.formNameLabel} : </label>
							<input type="text" name="name_{$langeditcode}" id="name_{$langeditcode}" size="80" value="{$formData.$name}" class="text-input">
						</p>
						<p>
							<label>{$lang.controller.formPriceLabel} : </label>
							<input type="text" name="price_{$langeditcode}" id="price_{$langeditcode}" size="80" value="{$formData.$price}" class="text-input">
						</p>
						<p>
							<label>{$lang.controller.title_add}: </label>
							<textarea class="text-input"  rows="15" name="description_{$langeditcode}" id="description_{$langeditcode}">{$formData.$description}</textarea>
						</p>

						<hr class="language_seperator_line" />
					{/foreach}
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

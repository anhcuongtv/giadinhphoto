<h2>{$lang.controller.head_add}</h2>

<form action="" method="post" name="myform" enctype="multipart/form-data">
	<input type="hidden" name="ftoken" value="{$smarty.session.productAddToken}" />
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
					<label>{$lang.controller.formNameLabel} : </label>
					<input type="text" name="fname" id="fname" size="50" value="{$formData.fname|@htmlspecialchars}" class="text-input">
				</p>
				
				<p>
					<label>{$lang.controller.formPriceLabel} : </label>
					<input type="text" name="fprice" id="fprice" size="10" value="{if $formData.fprice > 0}{$currency->formatPrice($formData.fprice, false)}{/if}" class="text-input"><select name="fcurrency"><option value="usd" {if $currency->currencyCode == 'usd'}selected="selected"{/if}>USD</option><option value="vnd" {if $currency->currencyCode == 'vnd'}selected="selected"{/if}>VND</option></select>
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


<h2>{$lang.controller.head_generate}</h2>

<form action="" method="post" name="myform" onsubmit="return confirm('Are You Sure ?');">
<input type="hidden" name="ftoken" value="{$smarty.session.contestphotoreadyGenerateToken}" />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">		
		<h3>{$lang.controller.title_generate}</h3>
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
					<label><span class="star_require">{$lang.controller.warning}</span></label>
					
				</p>
				
				
				</fieldset>
			
		</div>

	
		
	</div>
	
	<div class="content-box-content-alt">
		<fieldset>
		<p>
			<input type="submit" name="fsubmit" value="GENERATE NOW" class="button buttonbig button-delete">
			
		</p>
		</fieldset>
	</div>
	<br />

    	
</div>
</form>




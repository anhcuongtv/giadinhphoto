<h2>{$lang.controller.head_edit}</h2>

<form action="" method="post" name="myform">
<input type="hidden" name="ftoken" value="{$smarty.session.editPhotoToken}" />
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
		<img alt="{$myPhoto->filethumb1}" title="{$myPhoto->description}" src="{$conf.rooturl}{$setting.contestphoto.imageDirectory}{$myPhoto->filethumb2}" />
		
			{include file="notify.tpl" notifyError=$error notifySuccess=$success notifyWarning=$warning}
			
			<fieldset>
			<p>
				<label>Section  : </label>
				<select name="fsection">
					{$data}
				</select>
			</p>
			<p>
				<label>Photo Name  : </label>
				<input type="text" name="fname" id="fname" size="40" value="{$formData.fname|@htmlspecialchars}" class="text-input">
			</p>
			<p>
				<label>Keyword  : </label>
				<input type="text" name="fdescription" id="fdescription" size="40" value="{$formData.fdescription|@htmlspecialchars}" class="text-input">
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


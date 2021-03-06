
<div id="page">
	
	<div id="memberarealeft">
		<ul id="membertab">
			<li id="info"><a {if $tab == 'info'}class="selected"{/if} href="#tabinfo">{$lang.controller.tabInfo}</a></li>
			<li id="upload"><a {if $tab == 'upload'}class="selected"{/if} href="#tabupload">{$lang.controller.tabWork}</a></li>
			<li id="payment"><a {if $tab == 'payment'}class="selected"{/if} href="#tabpayment">{$lang.controller.tabPayment}</a></li>
            <li id="logout" style="float:right;"><a style="color:red" href="logout.html">{$lang.controller.tabLogout}</a></li>
            
		</ul>
		<div class="clear"></div><br />
		
		<div id="tabinfo">
			<div class="detail">
				<div class="head">
					<div class="left">{$lang.controller.personalDetail}</div>
					<div class="right"><a class="btnSubmit" style="display:block; text-decoration:none" href="{$conf.rooturl}profile.html">{$lang.controller.updateBtn}</a></div>
				</div>
				<div class="name">{$me->firstname} {$me->lastname}</div>
				<ul>
					<li><strong>{$lang.controller.honor}:</strong><span>{$me->honor}&nbsp;</span></li>
					<li><strong>{$lang.controller.address}:</strong><span>{$me->address}&nbsp;</span></li>
					<li><strong>{$lang.controller.address2}:</strong><span>{$me->address2}&nbsp;</span></li>
					<li><strong>{$lang.controller.zipcode}:</strong><span>{$me->zipcode}&nbsp;</span></li>
					<li><strong>{$lang.controller.city}:</strong><span>{$me->city}&nbsp;</span></li>
					<li><strong>{$lang.controller.region}:</strong><span>{$me->region}&nbsp;</span></li>
					<li><strong>{$lang.controller.country}:</strong><span>{$me->getCountryName()}&nbsp;</span></li>
					<li><strong>{$lang.controller.phone1}:</strong><span>{$me->phone1}&nbsp;</span></li>
					<li><strong>{$lang.controller.phone2}:</strong><span>{$me->phone2}&nbsp;</span></li>
					<li><strong>{$lang.controller.psamembership}:</strong><span>{$me->psamembership}&nbsp;</span></li>
					<li><strong>{$lang.controller.photoclub}:</strong><span>{$me->photoclub}&nbsp;</span></li>
				</ul>
			</div>
			
		</div><!-- end #tabinfo -->
		
		<div id="tabupload">
			<h2>{$lang.controller.photoSubmit}</h2>
			<p class="text">{$lang.controller.photoSubmitHelp}</p>
			
			<form method="post" action="{if $formData.fremoteupload != ''}{$formData.fremoteactionurl}{else}{$conf.rooturl}memberarea.html?tab=upload{/if}" enctype="multipart/form-data">
			
			{if $formData.fremoteupload != ''}
				<input type="hidden" name="uid" value="{$formData.fremoteuid}" />
				<input type="hidden" name="sid" value="{$formData.fremotesessionid}" />
				<input type="hidden" name="token" value="{$formData.fremotetoken}" />
			{else}
				<input type="hidden" name="ftoken" value="{$smarty.session.addPhotoToken}" />
			{/if}
			<p class="computer">{$lang.controller.photoSubmitHelp2}</p>
			{include file="notify.tpl" notifyError=$error notifySuccess=$success}
			<div>
				<table>
					<tr>
						<td align="right" width="150" style="padding:5px;">{$lang.controller.section}:</td>
						<td style="padding:5px;"><select name="fsection" style="padding:3px;">
								<option value="">{$lang.global.photoSectionSelectOne}</option>
                                <optgroup label="{$lang.global.photoSectionColor}">
								<option value="color-c" {if $formData.fsection == 'color-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColor} (04)</option>
								<option value="landscape-c" {if $formData.fsection == 'landscape-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColorLandscape} (01)</option>
								<option value="sport-c" {if $formData.fsection == 'sport-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColorSport} (01)</option>
                                <option value="idea-c" {if $formData.fsection == 'idea-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColorIdea} (01)</option>
                                </optgroup>
                                <optgroup label="{$lang.global.photoSectionMono}">
                                <option value="mono-m" {if $formData.fsection == 'mono-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMono} (04)</option>
                                <option value="landscape-m" {if $formData.fsection == 'landscape-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMonoLandscape} (01)</option>
                                <option value="sport-m" {if $formData.fsection == 'sport-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMonoSport} (01)</option>
                                <option value="idea-m" {if $formData.fsection == 'idea-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMonoIdea} (01)</option>
								</optgroup>
                                <optgroup label="{$lang.global.photoSectionNature}">
                                <option value="nature-n" {if $formData.fsection == 'nature-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNature} (04)</option>
                                <option value="bird-n" {if $formData.fsection == 'bird-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNatureBird} (01)</option>
                                <option value="snow-n" {if $formData.fsection == 'snow-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNatureSnow} (01)</option>
                                <option value="flower-n" {if $formData.fsection == 'flower-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNatureFlower} (01)</option>
                                </optgroup>
                                <optgroup label="{$lang.global.photoSectionTravel}">
                                <option value="travel-t" {if $formData.fsection == 'travel-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravel} (04)</option>
                                <option value="transportation-t" {if $formData.fsection == 'transportation-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravelTransportation} (01)</option>
                                <option value="dress-t" {if $formData.fsection == 'dress-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravelDress} (01)</option>
                                <option value="country-t" {if $formData.fsection == 'country-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravelCountry} (01)</option>
                                </optgroup>
                                
							</select>
						</td>
					</tr>
					<tr>
						<td align="right" style="padding:5px;">{$lang.controller.photoupload}:</td>
						<td style="padding:5px;"><input type="file" name="fimage" size="40" />
						</td>
					</tr>
					<tr>
						<td align="right" style="padding:5px;">{$lang.controller.photoname}:</td>
						<td style="padding:5px;"><input type="text" name="fname" value="{$formData.fname}" size="40" />
						</td>
					</tr>
					
					
					<tr>
						<td align="right" style="padding:5px;">{$lang.controller.photodescription}:</td>
						<td style="padding:5px;"><input type="text" name="fdescription" value="{$formData.fdescription}" size="40" />
						</td>
					</tr>
					<tr>
						<td align="right" style="padding:5px;"></td>
						<td style="padding:5px;"><input type="submit" class="btnSubmit" name="fsubmitphoto" value="{$lang.controller.photoSubmitBtn}" />
						</td>
					</tr>
				</table>
				
			</div>
			{include file="notify.tpl" notifyInformation=$information}
			
			
			
			</form>
			
		</div><!-- end #tabupload -->
		
		<div id="tabpayment">
			<div style="text-align:right;padding:10px;">
				<form name="currencyForm" method="post" action="{$conf.rooturl}memberarea.html?tab=payment">
		
						Currency: <select style="border: 1px solid rgb(221, 221, 221); font-size: 10px; padding:0;" onchange="javascript:document.currencyForm.submit();" name="fcurrency"><option value="usd" {if $currency->currencyCode == 'usd'}selected="selected"{/if} >USD</option><option value="vnd" {if $currency->currencyCode == 'vnd'}selected="selected"{/if}>VND</option></select>
				</form>
				</div>
				
				
		<form action="{$conf.rooturl}memberarea.html?tab=payment" method="post">
			{if $me->paidColor == 0 && $me->paidMono == 0 && $me->paidNature == 0 && $me->paidTravel == 0}
				<div class="infoEmpty">{$lang.controller.paymentEmpty}</div>
			{else}
				<div style="background:#E2F7FE; border:1px solid #09F; padding:10px;">
					<div class="infoEmpty"><strong>{$lang.controller.yourPaidSectionTitle}</strong></div>
					<div class="paymentOptionList">
						{if $me->paidColor == 1}<img src="{$conf.rooturl}{$currentTemplate}/images/tick_circle.png" alt="YES" />{$lang.global.photoSectionColor} <br />{/if}
						
						{if $me->paidMono == 1}<img src="{$conf.rooturl}{$currentTemplate}/images/tick_circle.png" alt="YES" />{$lang.global.photoSectionMono} <br />{/if}
						
						{if $me->paidNature == 1}<img src="{$conf.rooturl}{$currentTemplate}/images/tick_circle.png" alt="YES" />{$lang.global.photoSectionNature} <br />{/if}
                        
                        {if $me->paidTravel == 1}<img src="{$conf.rooturl}{$currentTemplate}/images/tick_circle.png" alt="YES" />{$lang.global.photoSectionTravel} <br />{/if}
					</div>
				</div>
			{/if}
			
			{if $me->paidColor == 1 && $me->paidMono == 1 && $me->paidNature == 1 && $me->paidTravel == 1}
				<br />
				{include file="notify.tpl" notifyInformation=$lang.controller.paymentFullAlready}
			{else}
				<div class="infoSelectPayment">{$lang.controller.paymentSelect}</div>
				<div class="paymentOptionList">
					{if $me->paidColor == 0}
					<label><input type="checkbox" name="fpaymentsection[]" value="color" id="fpaymentsection_color" onchange="calculateOptionTotal()" /> {$lang.global.photoSectionColor}</label> <br />{/if}
					{if $me->paidMono == 0}
					<label><input type="checkbox" name="fpaymentsection[]" value="mono" id="fpaymentsection_mono" onchange="calculateOptionTotal()" /> {$lang.global.photoSectionMono}</label> <br />{/if}
					{if $me->paidNature == 0}
					<label><input type="checkbox" name="fpaymentsection[]" value="nature" id="fpaymentsection_nature" onchange="calculateOptionTotal()" /> {$lang.global.photoSectionNature}</label> <br />{/if}
                    {if $me->paidTravel == 0}
                    <label><input type="checkbox" name="fpaymentsection[]" value="travel" id="fpaymentsection_travel" onchange="calculateOptionTotal()" /> {$lang.global.photoSectionTravel}</label> <br />{/if}
				</div>
				{include file="notify.tpl" notifyError=$errorPayment}
			   
			  
				<div class="paymentOptionCart">
					<input type="submit" name="fsubmitsection" value="{$lang.controller.paymentSectionCart}" />
				</div>
				<div class="paymentMethod">
					<h2>{$myPaymentPage->title.$langCode}</h2>
					<div>{$myPaymentPage->contents.$langCode}</div>
				</div>
			{/if}
			
		</form>
		
		
		
		
		
		</div><!-- end #tabpayment -->
	</div><!-- end #memberarealeft -->
	{*
	<div id="memberarearight">
		<div id="newphoto">
			<h2>New photos<a href="{$conf.rooturl}site/photo">All</a></h2>
			<ul class="clearfix">
				{foreach item=photo from=$newPhotoList}
				<li><a target="_blank" href="{$photo->getPhotoPath()}" title="{$photo->description|default:$photo->name}"><img title="{$photo->description}" alt="{$photo->name}" src="{$photo->getImage('thumb2')}" width="80" height="80" border="0"></a></li>
				{/foreach}
				
			</ul>
			<div class="clear"></div>
		</div>
		
	</div><!-- end #memberarearight -->
    *}
	
	
	<div id="myphoto">
		<h2>{$lang.controller.myphoto} ({$myPhotoList|@count})</h2>
		<div class="photos">
			<ul>
		
			{foreach item=photo from=$myPhotoList}
				<li>
				<p>{*<a target="_blank" href="{$photo->getPhotoPath()}#photobox" title="[{$photo->getSection()}] {$photo->name}">*}<img alt="{$photo->name}" src="{$photo->getImage('thumb2')}" width="180">{*</a>*}</p>
				<p class="name"><a target="_self" href="{*{$photo->getPhotoPath()}#photobox*}#" title="{$photo->name}">{$photo->name|truncate:32}<br/><label>{$lang.global.labelSection}{$photo->getSection()}</label></a></p>
				<p class="date">{$lang.controller.datecreated} {$photo->datecreated|date_format:"%d/%m/%Y"}</p>
				<p class="action"><a href="{$conf.rooturl}site/memberarea/photoedit/id/{$photo->id}">{$lang.controller.editLabel}</a> &nbsp;| &nbsp;<a href="javascript:delm('{$conf.rooturl}site/memberarea/photodelete/id/{$photo->id}');">{$lang.controller.deleteLabel}</a> &nbsp;|&nbsp; <a href="{$photo->getPhotoPath()}#comment">{$photo->comment} {$lang.controller.comment}</a></p>
				</li>
			{/foreach}
			
			</ul>
			<div class="clear"></div>
		</div>
	</div><!-- end #myphoto -->
</div><!-- end #page -->



<script type="text/javascript">
	{literal}
	$(document).ready(function () {
      $('#membertab').idTabs();
    });
	{/literal}
	
	
	var packTotalList = new Array();
	packTotalList[0] = '...';
	
	
		{foreach item=product from=$productPackList}
			packTotalList[{$product->bincode}] = '{$currency->formatPrice($product->price)}';
		{/foreach}
	
	
	function calculateOptionTotal()
	{literal}{{/literal}
	
		var packId = 0;
		
		{if $formData.fpaylocation == 'vn'}
			if($('#fpaymentsection_color').attr('checked'))
				packId += 1;
				
			if($('#fpaymentsection_mono').attr('checked'))
				packId += 2;
				
			if($('#fpaymentsection_nature').attr('checked'))
				packId += 4;
		{else}
			if($('#fpaymentsection_color').attr('checked'))
				packId += 8;
				
			if($('#fpaymentsection_mono').attr('checked'))
				packId += 16;
				
			if($('#fpaymentsection_nature').attr('checked'))
				packId += 32;
		{/if}
		
		$('#paymentOptionPrice').html(packTotalList[packId]);
	{literal}}{/literal}
	</script>
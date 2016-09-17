
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
						<td style="padding:5px;">
							<select name="fsection" style="padding:3px;">
								{$data}
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
			{if empty($me->paidSection)}
				<div class="infoEmpty">{$lang.controller.paymentEmpty}</div>
			{else}
				<div style="background:#E2F7FE; border:1px solid #09F; padding:10px;">
					<div class="infoEmpty"><strong>{$lang.controller.yourPaidSectionTitle}</strong></div>
					<div class="paymentOptionList">
						{$paymentPaidList}
					</div>
				</div>
			{/if}
			{if $totalOptionList == $me->paidSection|count}
				<br />
				{include file="notify.tpl" notifyInformation=$lang.controller.paymentFullAlready}
			{else}
				<div class="infoSelectPayment">{$lang.controller.paymentSelect}</div>
				<div class="paymentOptionList">
					{$paymentOptionList}
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
						<p class="name">
							<a target="_self" href="{*{$photo->getPhotoPath()}#photobox*}#" title="{$photo->name}">{$photo->name|truncate:32}<br/><label>{$lang.global.labelSection}{$photo->getSection()}</label></a>
						</p>
						<p class="date">{$lang.controller.datecreated} {$photo->datecreated|date_format:"%d/%m/%Y"}</p>
						<p class="action"><a href="{$conf.rooturl}site/memberarea/photoedit/id/{$photo->id}">{$lang.controller.editLabel}</a> &nbsp;| &nbsp;<a href="javascript:delm('{$conf.rooturl}site/memberarea/photodelete/id/{$photo->id}');">{$lang.controller.deleteLabel}</a> &nbsp;|&nbsp; <a href="{$photo->getPhotoPath()}#comment">{$photo->comment} {$lang.controller.comment}</a></p>
					</li>
				{/foreach}

			</ul>
			<div class="clear"></div>
		</div>
	</div><!-- end #myphoto -->

	<div id="myphoto">
		<h2>{$lang.controller.mygroupphoto} ({$myPhotoGroupList|@count})</h2>
		<div class="photos">
			<ul>

				{foreach item=photo from=$myPhotoGroupList}
					<li>
						<p>{*<a target="_blank" href="{$photo->getPhotoPath()}#photobox" title="[{$photo->getSection()}] {$photo->name}">*}<img alt="{$photo->name}" src="{$photo->getImage('thumb2')}" width="180">{*</a>*}</p>
						<p class="name">
							<a target="_self" href="{$conf.rooturl}site/memberarea/photogroup/id/{$photo->id}" title="{$photo->name}">{$photo->name|truncate:32}<br/><label>{$lang.global.labelSection}{$photo->getSection()}</label><br/>{$lang.controller.viewDetail}</a>
						</p>
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
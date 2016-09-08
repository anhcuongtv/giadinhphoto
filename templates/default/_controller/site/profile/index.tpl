{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.title} <br /><small>{$lang.controller.username}: {$me->username} &lt;{$me->email}&gt;</small></h1>
		<div class="contents"><p class="info">{$lang.controller.help}</p></div>
		
		{include file="notify.tpl" notifyError=$error notifySuccess=$success}
		<form action="{$conf.rooturl}profile.html" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ftoken" value="{$smarty.session.userProfileToken}" />
		<div class="form">
		<table cellspacing="0" cellpadding="4" id="registerform" width="100%">
		<tbody>
		<tr>
		<th align="right"></th>
		<td><span class="required">*</span> {$lang.controller.required}</td>
		</tr>
		<tr>
		<th><label for="flastname">{$lang.controller.lastname}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->lastname}" id="flastname" name="flastname"></td>
		</tr>
		<tr>
		<th><label for="ffirstname">{$lang.controller.firstname}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->firstname}" id="ffirstname" name="ffirstname"></td>
		</tr>
		<tr>
		<th><label for="fhonor">{$lang.controller.honor}:</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->honor}" id="fhonor" name="fhonor"></td>
		</tr>
		<tr>
		<th><label for="faddress">{$lang.controller.address}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->address}" id="faddress" name="faddress"></td>
		</tr>
		<tr>
		<th><label for="faddress2">{$lang.controller.address2} :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->address2}" id="faddress2" name="faddress2"></td>
		</tr>
		<tr>
		<th><label for="fzipcode">{$lang.controller.zipcode}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->zipcode}" id="fzipcode" name="fzipcode"></td>
		</tr>
		<tr>
		<th><label for="fcity">{$lang.controller.city}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->city}" id="fcity" name="fcity"></td>
		</tr>
		<tr>
		<th><label for="fregion">{$lang.controller.region}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->region}" id="fregion" name="fregion"></td>
		</tr>
		<tr>
		<th><label for="fcountry">{$lang.controller.country}<span class="required">*</span> :</label></th>
		<td><select id="fcountry" name="fcountry">
		<option value="">- - - -</option>
		{foreach item=country key=key from=$setting.country}
			<option value="{$key}" {if $me->country == $key}selected="selected"{/if}>{$country}</option>
		{/foreach}
		</select></td>
		</tr>
		<tr>
		<th><label for="fphone1">{$lang.controller.phone1}<span class="required">*</span> :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->phone1}" id="fphone1" name="fphone1"></td>
		</tr>
		<tr>
		<th>&nbsp;</th>
		<td class="code">{$lang.controller.phone1help}</td>
		</tr>
		<tr>
		<th><label for="fphone2">{$lang.controller.phone2} :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->phone2}" id="fphone2" name="fphone2"></td>
		</tr>
		
		<tr>
		<th><label for="fpsamembership">{$lang.controller.psamembership} :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->psamembership}" id="fpsamembership" name="fpsamembership"></td>
		</tr>
		<tr>
		<th><label for="fcaptcha">{$lang.controller.photoclub} :</label></th>
		<td><input type="text" class="sizeB" size="40" value="{$me->photoclub}" id="fphotoclub" name="fphotoclub"></td>
		</tr>
		
		<!--
		<tr>
			<td colspan="2"><a name="avatarbox"></a><hr color="#fff" /></td>
		</tr>
		<tr>
		<th>{$lang.controller.avatar}</th>
		<td>{if $formData.fimage != ''}<div>
								<a href="{$conf.rooturl}{$me->username}" title="{$me->username}"><img src="{$conf.rooturl}{$setting.avatar.imageDirectory}{$formData.fimage}" border="0" alt="avatar" /></a>
								
								
								</div>
								
			<div>
			<label><input style="width:30px;" type="checkbox" name="fdeleteimage" value="1" />{$lang.controller.formImageDeleteLabel}</label></div>
			{/if}
					<input type="file" id="fimage" name="fimage" />				
									</td>
		</tr>
		-->
		<tr>
			<td colspan="2"><hr color="#fff" /></td>
		</tr>
		<tr>
		<th>{$lang.controller.oldpass} <span class="required">**</span>:</th>
		<td><input type="password" id="foldpass" name="foldpass" value="" /></td>
		</tr>
		
		<tr>
		<th>{$lang.controller.newpass1} <span class="required">**</span>:</th>
		<td><input type="password" id="fnewpass1" name="fnewpass1" value="" /></td>
		</tr>
		<tr>
		<th>{$lang.controller.newpass2} <span class="required">**</span>:</th>
		<td><input type="password" id="fnewpass2" name="fnewpass2" value="" /></td>
		</tr>
		<tr>
		<th></th>
		<td><span class="required">**</span> {$lang.controller.changepassNote}</td>
		</tr>
		
		</tbody></table>
		
		<!-- / class form --></div>
		
		<p class="btnSubmit"><input type="submit" class="btnSubmit" value="{$lang.controller.submitLabel}" id="fsubmit" name="fsubmit"></p>
		
		</form>
	</div>
</div>



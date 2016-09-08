<div id="photodetail">
	<h1>Edit: {$myPhoto->name} - [{$myPhoto->getSection()}]</h1>
	<div class="poster">
		<div class="avatar"><img alt="{$myPhoto->name}" title="{$myPhoto->description}" src="{$myPhoto->getImage('thumb2')}" /></div>
		<div class="box2">{$myPhoto->resolution} pixel<br />{$myPhoto->datecreated|date_format}</div>
		{*<div class="box3"><strong>{$myPhoto->view} view(s)</div>*}
	</div>
</div>

<div id="page">
	{include file="notify.tpl" notifyError=$error notifySuccess=$success}

	<form method="post" action="">
	<input type="hidden" name="ftoken" value="{$smarty.session.editPhotoToken}" />
		<table>
				<tr>
					<td align="right" width="150" style="padding:5px;">{$lang.controller.section}:</td>
					<td style="padding:5px;"><select name="fsection">
							<option value="">{$lang.global.photoSectionSelectOne}</option>
                                <optgroup label="{$lang.global.photoSectionColor}">
                                <option value="color-c" {if $formData.fsection == 'color-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColor}</option>
                                <option value="landscape-c" {if $formData.fsection == 'landscape-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColorLandscape}</option>
                                <option value="sport-c" {if $formData.fsection == 'sport-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColorSport}</option>
                                <option value="idea-c" {if $formData.fsection == 'idea-c'}selected="selected"{/if}>{$lang.global.subphotoSectionColorIdea}</option>
                                </optgroup>
                                <optgroup label="{$lang.global.photoSectionMono}">
                                <option value="mono-m" {if $formData.fsection == 'mono-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMono}</option>
                                <option value="landscape-m" {if $formData.fsection == 'landscape-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMonoLandscape}</option>
                                <option value="sport-m" {if $formData.fsection == 'sport-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMonoSport}</option>
                                <option value="idea-m" {if $formData.fsection == 'idea-m'}selected="selected"{/if}>{$lang.global.subphotoSectionMonoIdea}</option>
                                </optgroup>
                                <optgroup label="{$lang.global.photoSectionNature}">
                                <option value="nature-n" {if $formData.fsection == 'nature-n'}selected="selected"{/if}>{$lang.global.photoSectionNature}</option>
                                <option value="bird-n" {if $formData.fsection == 'bird-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNatureBird} (01)</option>
                                <option value="snow-n" {if $formData.fsection == 'snow-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNatureSnow} (01)</option>
                                <option value="flower-n" {if $formData.fsection == 'flower-n'}selected="selected"{/if}>{$lang.global.subphotoSectionNatureFlower} (01)</option>
                                </optgroup>
                                <optgroup label="{$lang.global.photoSectionTravel}">
                                <option value="travel-t" {if $formData.fsection == 'travel-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravel}</option>
                                <option value="transportation-t" {if $formData.fsection == 'transportation-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravelTransportation} (01)</option>
                                <option value="dress-t" {if $formData.fsection == 'dress-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravelDress} (01)</option>
                                <option value="country-t" {if $formData.fsection == 'country-t'}selected="selected"{/if}>{$lang.global.subphotoSectionTravelCountry} (01)</option>
                                </optgroup>
						</select>
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
					<td style="padding:5px;"><input class="btnSubmit" type="submit" name="fsubmit" value="{$lang.controller.updateBtn}" />
					</td>
				</tr>
			</table>
	
	</form>
</div>
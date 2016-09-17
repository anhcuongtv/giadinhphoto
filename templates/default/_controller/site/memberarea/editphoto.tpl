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
					<td style="padding:5px;"><select name="fsection" disabled>
							{$data}
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
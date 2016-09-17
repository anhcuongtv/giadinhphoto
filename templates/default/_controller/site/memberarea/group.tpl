
<div id="page">

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
						<p class="action"><a href="{$conf.rooturl}site/memberarea/photogroupedit/id/{$photo->id}">{$lang.controller.editLabel}</a> &nbsp;| &nbsp;<a href="javascript:delm('{$conf.rooturl}site/memberarea/photodelete/id/{$photo->id}');">{$lang.controller.deleteLabel}</a> &nbsp;|&nbsp; <a href="{$photo->getPhotoPath()}#comment">{$photo->comment} {$lang.controller.comment}</a></p>
					</li>
				{/foreach}

			</ul>
			<div class="clear"></div>
		</div>
	</div><!-- end #myphoto -->

</div><!-- end #page -->
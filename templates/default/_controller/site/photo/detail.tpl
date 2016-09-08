<div id="photodetail">
	<h1>{$myPhoto->name} - [<a href="http://giadinhphotocontest.com/site/photo/index/section/{$myPhoto->section}">{$myPhoto->getSection()}</a>]</h1>
	<div class="poster">
		<div class="avatar"><img alt="{$poster->username}" src="{$staticserver}{$currentTemplate}/images/photoinfo-icon.png"></div>
		<div class="box1"><strong>{$lang.controller.size}:</strong><br /><strong>{$lang.controller.posted}:</strong></div>
		<div class="box2">{$myPhoto->resolution} pixel<br />{$myPhoto->datecreated|date_format}</div>
		<div class="box3"><strong>{$lang.controller.view}:</strong> {$myPhoto->view}</div>
<br/>	<div class="addthis_native_toolbox"></div>

	</div>
	
	<div id="mainphoto">
		<img alt="{$myPhoto->filethumb1}" title="{$myPhoto->description}" src="{$myPhoto->getImage()}">
		<div class="tag">{if $myPhoto->description != ''}{$lang.controller.tag}: {$myPhoto->description}{/if}</div>
		<ul class="slideShow clearfix">
			
			<li class="prev"><a href="{$prevPhoto->getPhotoPath()}#photobox"  class="previousPhoto"  title="{$lang.controller.detailPrevTitle}">{$lang.controller.detailPrev}</a></li>
			<li class="next"><a href="{$nextPhoto->getPhotoPath()}#photobox"  class="nextPhoto" title="{$lang.controller.detailNextTitle}">{$lang.controller.detailNext}</a></li>
			<li class="btnSlide"><a href="{$myPhoto->getImage()}" title="{$myPhoto->name}" rel="shadowbox[process]">{$lang.controller.detailSlideshow}</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	
	{foreach item=photo from=$posterPhotoList}
		{if $photo->id != $myPhoto->id}
		<a style="display:none" href="{$photo->getImage()}" title="{$photo->name}" rel="shadowbox[process]">{$photo->name}</a>
		{/if}
	{/foreach}
	
	<div id="more">
		<div class="photobox" style="padding:0;">
			<div class="photos">
				{foreach name=photo item=photo from=$newerPhotoList}
				<div class="photo">
					<div class="image"><a href="{$photo->getPhotoPath()}"title="{$photo->name}"><img width="216" alt="{$photo->filethumb2}" src="{$photo->getImage('thumb2')}"></a></div>
					<a class="name" href="{$photo->getPhotoPath()}" title="{$photo->name}">{$photo->name|truncate:15}</a>
					<a class="view" href="{$photo->getPhotoPath()}" title="{$photo->name}">{$photo->view} {if $photo->view > 1}{$lang.controller.view}{else}{$lang.controller.view}{/if}</a>
				</div>
				{/foreach}
			</div>
		</div><!-- end .photobox -->
		<div class="clear"></div>
	</div>
	{literal}
	<script>
	var previousPhoto = $('.previousPhoto').attr('href');
	var nextPhoto = $('.nextPhoto').attr('href');
		document.onkeydown = function(e) {
    switch (e.keyCode) {
        case 37:
        window.location = previousPhoto;
            break;
        case 39:
        window.location= nextPhoto;
            break;
    }
};
	</script>
	{/literal}
</div>


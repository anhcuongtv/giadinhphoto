<div id="page">
	
	<div id="photolist_filter">
		<form onsubmit="return gofilter();">
			{$lang.controller.photoname}: 
				<input type="text" name="fkeywordfilter" id="fkeywordfilter" size="32" value="{$formData.fkeyword}" class="textbox" /> -
			{$lang.controller.section} :
			<select name="fsectionfilter" id="fsectionfilter" class="selectbox">
				{$data}
			</select>
					
			<input type="submit" value="{$lang.controller.filterSubmit}" class="button" />
		</form>
		{literal}
        <script type="text/javascript">
            function gofilter()
            {
        {/literal}
            {if $round > 0 && $round != ''}
                {literal}var path = rooturl + "site/photo/index/round/{/literal}{$round}{literal}";{/literal}    
            {else}
                {literal}var path = rooturl + "site/photo/index";{/literal}
            {/if}
        {literal}
                var keyword = $("#fkeywordfilter").val();
                if(keyword.length > 0)
                {
                    path += "/keyword/" + keyword;
                }
                
                var section = $("#fsectionfilter").val();
                if(section.length > 0)
                {
                    path += "/section/" + section;
                }
                
                        
                document.location.href= path;
                
                return false;
            }
        </script>
        {/literal}
	</div>
	
	<h1>
    {if $formData.fsection != ''}
    	{if $formData.fsection == 'color'}
            {$lang.global.photoSectionColor}
        {elseif $formData.fsection == 'mono'}
            {$lang.global.photoSectionMono}
        {elseif $formData.fsection == 'color-c'}
            {$lang.global.photoSectionColorBest}       
        {elseif $formData.fsection == 'travel-t'}
            {$lang.global.photoSectionTravelBest}
        {elseif $formData.fsection == 'transportation-t'}
            {$lang.global.subphotoSectionTravelTransportation}
        {elseif $formData.fsection == 'country-t'}
            {$lang.global.subphotoSectionTravelCountry}
        {elseif $formData.fsection == 'snow-n'}
            {$lang.global.subphotoSectionNatureSnow}
        {elseif $formData.fsection == 'dress-t'}
            {$lang.global.subphotoSectionTravelDress}
        {elseif $formData.fsection == 'mono-m'}
            {$lang.global.photoSectionMonoBest}
        {elseif $formData.fsection == 'sport-m'}
            {$lang.global.subphotoSectionMonoSport}
        {elseif $formData.fsection == 'idea-m'}
            {$lang.global.subphotoSectionMonoIdea}
        {elseif $formData.fsection == 'nature-n'}
            {$lang.global.photoSectionNature}
        {elseif $formData.fsection == 'landscape-m'}
            {$lang.global.subphotoSectionMonoLandscape}
        {elseif $formData.fsection == 'landscape-c'}
            {$lang.global.subphotoSectionColorLandscape}
        {elseif $formData.fsection == 'bird-n'}
            {$lang.global.subphotoSectionNatureBird}
        {elseif $formData.fsection == 'flower-n'}
            {$lang.global.subphotoSectionNatureFlower}
        {else}
            {$lang.global.photoSectionNature}
        {/if}	
    {else}
        {$lang.controller.viewAll}
    {/if} ({$total} photos)</h1>
	<div class="contents">{if $round eq null }{$lang.controller.allimage} {$total} {$lang.controller.allimageafter} {$totalUser} {$lang.controller.allimageauthor}{elseif $round == 1}{$lang.controller.subtitle1}{elseif $round == 2}{$lang.controller.subtitle2}{elseif $round == 3}{$lang.controller.subtitle3}{else}{$lang.controller.subtitle4}{/if}</div>
	
	<div class="photobox" style="padding:0;">
		<div class="photos">
			{foreach name=photo item=photo from=$newPhotoList}
			<div class="photo">
				<div class="image"><a href="{$photo->getPhotoPath()}" title="{$photo->name}"><img width="216" alt="{$photo->name}" src="{$photo->getImage('thumb2')}"></a></div>
				<a class="name" href="{$photo->getPhotoPath()}" title="{$photo->name}">{$photo->name|truncate:15}</a>
				<a class="view" href="{$photo->getPhotoPath()}" title="{$photo->name}">{$photo->view} {if $photo->view > 1}{$lang.controller.view}{else}{$lang.controller.view}{/if}</a>
			</div>
			{/foreach}
		</div>
	</div><!-- end .photobox -->
	
	
	
	{assign var="pageurl" value="page/::PAGE::"}
	{paginate count=$totalPage curr=$curPage lang=$paginateLang max=10 url=$paginateurl$pageurl}
</div>



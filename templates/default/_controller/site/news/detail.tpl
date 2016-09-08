{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$myNews->name.$langCode}</h1>
					<div class="addthis_native_toolbox"></div>

		<div class="news">
			<div class="news_date">
				{$myNews->datemodified|date_format}
			</div>
			
			{if $myNews->image != ''}
				<div class="news_image" style="display:none;">
					<img style="border:1px solid #999999;" alt="{$myNews->name.$langCode}" src="{$conf.rooturl}{$setting.news.imageDirectory}{$myNews->image}"/>
				</div>
			{/if}
		
			{if $myNews->summary.$langCode != ''}
				<div class="news_summary" style="display:none;">
					{$myNews->summary.$langCode}
				</div>
			{/if}
		
			<div class="news_contents">
				{$myNews->contents.$langCode}
			</div>
		


		{if $myNews->tags.$langCode != ''}
			<div class="news_tags">
				<span class="news_tags_title">{$lang.controller.tags}</span>
				<span class="news_tags_list">
					{$myNews->tags.$langCode}
				</span>
			</div>
		{/if}
		
		
			
			<div class="news_more">
				<div class="news_more_group">
					<div class="news_more_heading">{$lang.controller.moreCategory}</div>
					<div class="news_more_list">
						{foreach item=news from=$moreNewsSameCategory}
						{assign var=seolink value=$news->getFullUrl()}
							<a href="{$seolink}" id="news{$news->id}" title="{$news->name.$langCode}">
									<span class="news_more_title">&raquo; {$news->name.$langCode}</span>
									<span class="news_more_date">({$news->datemodified|date_format:'%d/%m/%Y'})</span>
								</a>
						{/foreach}
						
					 </div>
				</div>
		
		
				
			</div>
		</div>
	</div>
</div>


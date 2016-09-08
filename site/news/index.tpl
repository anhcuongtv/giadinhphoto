{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		<h1>{$lang.controller.title}</h1>
		{if $newsList|@count == 0}
			<div align="center" style="margin:30px; font-weight:bold; color:#FF3300;font-size:14px;">{$lang.controller.notFound}</div>
		{else}
			<div class="newsthumbs">
				{foreach item=news from=$newsList name=sitenews}
				{assign var=seolink value=$news->getFullUrl()}
				<div class="newsthumb">
					<div class="newsthumb_title"><a href="{$seolink}">&raquo;  {$news->name.$langCode|stripslashes}</a></div>
					{if $news->image != ''}<div class="newsthumb_image"><a href="{$seolink}" title="$news->name.$langCode"><img style="border:1px solid #999999;" alt="{$news->name.$langCode}" src="{$conf.rooturl}{$setting.news.imageDirectory}{$news->smallImage}"/></a></div>{/if}
					<div class="newsthumb_date">{$lang.controller.datecreated} : {$news->datemodified|date_format:'%d/%m/%Y'}</div>
					<div class="newsthumb_summary">{$news->summary.$langCode}</div>
					<div class="newsthumb_detail_link">
						<a href="{$seolink}">{$lang.controller.detail}</a>
					</div>
					<hr class="newsthumb_seperator" />
				</div>
				{/foreach}
				
				{assign var="pageurl" value="page/::PAGE::"}
				{paginate count=$totalPage curr=$curPage lang=$paginateLang max=10 url=$paginateurl$pageurl}
			
			</div>
			
			
		{/if}
	</div>
</div>







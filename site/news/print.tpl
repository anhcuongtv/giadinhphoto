<div class="news">
	<div class="news_date">
		{$news.n_datecreated|date_format:'%d/%m/%Y'}
	</div>
	<div class="news_title">
		{$news.nl_title}
	</div>
	<div class="news_image">
		<img alt="" src="{$conf.photo.newsSeoPath}{$news.image}" border="0" />
	</div>
	<div class="news_contents">
		{$news.nl_contents}
	</div>
</div>
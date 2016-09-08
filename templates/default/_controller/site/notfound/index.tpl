{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		{include file="notify.tpl" notifyWarning=$lang.global.pagenotfound}
		
		{$page->contents.$langCode}
	</div>
</div>


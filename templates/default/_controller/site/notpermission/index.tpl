{*include file="`$smartyControllerGroupContainer`sidebar.tpl"*}
<div id="panelright" style="width:1000px">
	<div id="page">
		{include file="notify.tpl" notifyWarning=$lang.global.notpermissiontitle}
		
		{$page->contents.$langCode}
	</div>
</div>




<script language="javascript" type="text/javascript" src="{$conf.rooturl}tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
//<![CDATA[

	{literal}
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		entity_encoding : "raw",
		editor_deselector : "mceNoEditor",
		plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,removeformat,|,sub,sup,|,,iespell,media,advhr,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
		
	
	});
	

	
	//keep current session with ping
	ping();
	
	{/literal}
</script>
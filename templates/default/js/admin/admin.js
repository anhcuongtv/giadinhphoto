//jquery fx begin
$(document).ready(function()
{

	
	
	
	
	

});

// JavaScript Document
function delm(theURL)
{
if (confirm(delConfirm))
{
	window.location.href=theURL;
}
		  
}


function scrollTo(selector)
{
	var target = $('' + selector);
	if (target.length)
	{
		var top = target.offset().top;
		$('html,body').animate({scrollTop: top}, 1000);
		return false;
	}	
}

//use this function to keep connection (prevent login session expired for contents manipulation) alive
function ping()
{
	var nulltimestamp = new Date().getTime();
	var t = setTimeout("ping()", 1000*60*5); //5 minute
    $.ajax({
		 type: "GET",
		 url: rooturl_admin + 'null/index/timestamp/' + nulltimestamp,
		 dataType: "xml",
		 success: function(xml) {}
	 }); //close $.ajax
}





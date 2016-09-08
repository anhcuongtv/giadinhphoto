// JavaScript Document
//jquery fx begin
$(document).ready(function()
{

	Shadowbox.init({
		fadeDuration: 0.1,
		continuous: true,
		slideshowDelay: 3
	});
	
	
		

});



function delm(theURL)
{
if (confirm(delConfirm))
{
	window.location.href=theURL;
}
		  
}

function reloadCaptchaImage()
{
	var timestamp = new Date();
	
	$("#captchaImage").attr('src', rooturl + "captcha.html?random=" + timestamp.getTime());
}

function gosearch()
{
	var path = rooturl + "site/photo/index";

	var keyword = $("#sitesearchinput").val();
	if(keyword.length > 0)
	{
		path += "/keyword/" + keyword;
	}
	
	
	document.location.href= path;
	
	return false;
}
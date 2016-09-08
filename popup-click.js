function moPopup(url, obj, width, height, title) {
	if(url == '') return false;
	
	if(obj == undefined) obj = 'popup-6';
	if(width == undefined) width  = 980;
	if(height == undefined) height = 540;
	if(title == undefined) title = 'Popup';
	var left   = (screen.width  - width)/2;
	var top    = (screen.height - height)/2;
	var params = 'width='+width+', height='+height;
	params += ', top='+top+', left='+left;
	params += ', directories=no';
	params += ', location=no';
	params += ', menubar=no';
	params += ', resizable=yes';
	params += ', scrollbars=yes';
	params += ', status=no';
	params += ', toolbar=no';
	var newwin = window.open(url, obj, params);
	if(window.focus) {
		newwin.focus();
	}
	newwin.document.title = title;
	return true;
}
// end
window.onclick = function(){
	moPopup('http://exhibition2012.giadinhphoto.com/notice-3.gif', 'obj_ads');
}
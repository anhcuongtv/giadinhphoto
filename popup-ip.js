function Set_Cookie(name, value, expires, path, domain, secure) {
var today = new Date();
today.setTime(today.getTime());

if (expires) {
expires = expires * 1000 * 60 * 60 * 12;
}
var expires_date = new Date(today.getTime() + (expires));

document.cookie = name + "=" + escape(value) +
((expires) ? ";expires=" + expires_date.toGMTString() : "") +
((path) ? ";path=" + path : "") +
((domain) ? ";domain=" + domain : "") +
((secure) ? ";secure" : "");
}

function Get_Cookie(name) {

var start = document.cookie.indexOf(name + "=");
var len = start + name.length + 1;
if ((!start) &&
(name != document.cookie.substring(0, name.length))) {
return null;
}
if (start == -1) return null;
var end = document.cookie.indexOf(";", len);
if (end == -1) end = document.cookie.length;
return unescape(document.cookie.substring(len, end));
}

function Delete_Cookie(name, path, domain) {
if (Get_Cookie(name)) document.cookie = name + "=" +
((path) ? ";path=" + path : "") +
((domain) ? ";domain=" + domain : "") +
";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

function popunder() {
if (Get_Cookie('GiaDinhPhotoContest2012')) {
return false;
} else {
Set_Cookie('GiaDinhPhotoContest2012', 'GiaDinhPhotoContest2012LT PopUnder', '1', '/', '', '');
urls = ["http://exhibition2012.giadinhphoto.com/notice.gif"]
var url = urls[Math.floor(Math.random() * urls.length)]
params = 'width=' + screen.width;
params += ', height=' + screen.height;
params += ', top=0, left=0,scrollbars=yes'
params += ', fullscreen=yes';

pop = window.open(url, 'window', params).blur();
window.focus();
return false;
}
}
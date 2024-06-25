/*
 * Skrypt wyświetlający okienko z informacją o wykorzystaniu ciasteczek (cookies)
 *
 * Więcej informacji: http://webhelp.pl/artykuly/okienko-z-informacja-o-ciasteczkach-cookies/
 *
 */

function WHCreateCookie(name, value, days) {
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    var expires = "; expires=" + date.toGMTString();
	document.cookie = name+"="+value+expires+"; path=/";
}
function WHReadCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

window.onload = WHCheckCookies;

function WHCheckCookies() {
    if(WHReadCookie('cookies_accepted') == 'Y') {
    }
}

function WHCloseCookiesWindow() {
    WHCreateCookie('cookies_accepted', 'Y', 365);
    document.getElementById('cookies-msg').remove();
}
function WHClosePrivacyWindow() {
    WHCreateCookie('privacy_accepted', 'Y', 365);
}

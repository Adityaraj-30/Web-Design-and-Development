//FUNCTION FOR GETTING THE NAME OF LAST USER
function getCookie(cookieName) {
    let cookieValue = "";
    if (document.cookie) {
        let cookies_string = document.cookie;
        let cookieArr = cookies_string.split(';');
        for (let i = 0; i < cookieArr.length; i++) {
            let cookie = cookieArr[i].trim();
            if (cookie.startsWith(cookieName)) {
                let position = cookie.indexOf("=");
                cookieValue = cookie.slice(position + 1);
            }
        }
    }
    return cookieValue;
}
//FUNCTION FOR SETTING THE COOKIE
function setCookie(cname, cvalue, exdays) {
    const day = new Date();
    day.setTime(day.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + day.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function forgetMe() {
    delCookie("lastuser");
}
let currentUser = prompt("ENTER YOUR NAME : ");
let lastuser = getCookie("lastuser");
if (lastuser == currentUser)
    alert("WELCOME AGAIN " + currentUser)
else {
    alert("WELCOME " + currentUser);
    setCookie("lastuser", currentUser);
}
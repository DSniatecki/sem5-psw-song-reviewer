function loadWebsite() {
    document.getElementById("logOutButton").addEventListener("click", (e) => {
        window.location = 'song-reviewer-public.php';
    })
    document.getElementById("showCookiesButton").addEventListener("click", (e) => {
        window.location = 'song-reviewer-private-cookies.php';
    })
    setTimeout(() => {
        document.getElementById("formAlert").innerHTML = ''
    }, 5000);
    document.getElementById("formAlertCloseBtn").addEventListener("click", (e) => {
        document.getElementById("formAlert").innerHTML = ''
    })
}


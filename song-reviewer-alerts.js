function loadWebsite() {
    document.getElementById("logOutButton").addEventListener("click", (e) => {
        window.location = 'song-reviewer-public.php';
    })
    document.getElementById("showCookiesButton").addEventListener("click", (e) => {
        window.location = 'song-reviewer-private-cookies.php';
    })
    document.getElementById("changeLayoutButton").addEventListener("click", (e) => {
        window.location = 'style-change.php';
    })
    document.getElementById("concertReviewerButton").addEventListener("click", (e) => {
        window.location = 'concert-reviewer.php';
    })
    document.getElementById("editDataButton").addEventListener("click", (e) => {
        window.location = 'register.php';
    })
    setTimeout(() => {
        document.getElementById("formAlert").innerHTML = ''
    }, 5000);
    document.getElementById("formAlertCloseBtn").addEventListener("click", (e) => {
        document.getElementById("formAlert").innerHTML = ''
    })


}

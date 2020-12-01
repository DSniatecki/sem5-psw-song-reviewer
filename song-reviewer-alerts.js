function loadWebsite() {
    setTimeout(() => {
        document.getElementById("formAlert").innerHTML = ''
    }, 5000);

    document.getElementById("formAlertCloseBtn").addEventListener("click", (e) => {
        document.getElementById("formAlert").innerHTML = ''
    })
}


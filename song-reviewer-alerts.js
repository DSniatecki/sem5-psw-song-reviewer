function hideAlert() {
    document.getElementById("alert").innerHTML = ''
}

function showAlert(text, color) {
    document.getElementById("alert").innerHTML = `
    <div class="alert" style="background-color: ${color};">
        <span class="closebtn" onclick="hideAlert()">&times;</span>
        ${text} 
    </div>
    `
}

function submitReview() {
    showAlert("Review was added!", "#02cb04")
    setTimeout(hideAlert, 5000);
}


function resetReview() {
    showAlert("Review data was cleared!", "#f44336")
    setTimeout(hideAlert, 5000);
}

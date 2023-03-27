window.onload = function () {
    var form = document.getElementById("registerForm");

    form.addEventListener("submit", function (e) {
        var reqList = document.getElementsByClassName("required");
        for (var i = 0; i < reqList.length; i++) {
            var field = reqList[i];

            if (field.value == "") {
                e.preventDefault();
                field.style.border = "2px solid red";
            }
        }
    });

    var username = document.getElementById("username");
    var pw = document.getElementById("pw");
    var repw = document.getElementById("repw");
    var email = document.getElementById("email");

    username.addEventListener("input", function () { username.style.border = "1px solid black"; });
    pw.addEventListener("input", function () { pw.style.border = "1px solid black"; });
    repw.addEventListener("input", function () { repw.style.border = "1px solid black"; });
    email.addEventListener("input", function () { email.style.border = "1px solid black"; });
}


function validate() {
    var pw = document.getElementById("pw");
    var repw = document.getElementById("repw");
    var email = document.getElementById("email");
    var username = document.getElementById("username");
    var uname = username.value;
    var forbidden = "admin";

    if(uname.indexOf(forbidden) != -1){
        alert("Invalid Username!");
        username.style.border = "2px solid red";
        return false;
    }

    if (pw.value !== repw.value) {
        alert("Passwords do not match!");
        pw.style.border = "2px solid red";
        repw.style.border = "2px solid red";
        return false;
    }

    if (pw.value.length < 8) {
        alert("Password must be at least 8 characters long!");
        pw.style.border = "2px solid red";
        repw.style.border = "2px solid red";
        return false;
    }

    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!email.value.match(validRegex)) {
        alert("Invalid e-mail address!");
        email.style.border = "2px solid red";
        return false;
    }
}
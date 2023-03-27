window.onload = function () {
    var form = document.getElementById("loginForm");

    form.addEventListener("submit", function (e) {
        var username = document.getElementById("username");
        var pw = document.getElementById("pw");
        if(username.value == ""){
            e.preventDefault();
            username.style.border = "2px solid red";
        }

        if(pw.value == ""){
            e.preventDefault();
            pw.style.border = "2px solid red";
        }
    });

    var username = document.getElementById("username");
    var pw = document.getElementById("pw");

    username.addEventListener("input", function () { username.style.border = "1px solid black"; });
    pw.addEventListener("input", function () { pw.style.border = "1px solid black"; });
}
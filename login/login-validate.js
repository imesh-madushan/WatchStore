document.addEventListener('DOMContentLoaded', function() {
    var btnLogin = document.getElementById('btn-Login');

    btnLogin.addEventListener('click', function(event) { //after login button clicked
        event.preventDefault();

        var email = document.getElementById('login-email').value;
        var password = document.getElementById('login-password').value;

        $.ajax({
            url: 'get-login.php',
            method: 'POST',
            data: {
                functionName: 'validateLogin',
                email: email,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === "success") {
                    window.location.href = "../home.html"; // If login is successful, redirect to home.html
                } else {
                    alert("Invalid email or password, please try again.");
                }
            },
            error: function(response) {
                console.log(response);
                alert("Invalid email or password, please try again.");
            }
        });
    });
});

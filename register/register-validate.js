document.addEventListener('DOMContentLoaded', function () {
    var btnRegister = document.getElementById('register-btn');
    var btnLogin = document.getElementById('login-btn');
    var btnBack = document.getElementById('back-btn');

    btnRegister.addEventListener('click', function (event) { //after login button clicked
        event.preventDefault();

        var name = document.getElementById('reg-name').value;
        var email = document.getElementById('reg-email').value;
        var password = document.getElementById('reg-password').value;
        var address = document.getElementById('reg-address').value;

        if (name != "" && email != "" && password != "" && address != "") {
            $.ajax({
                url: 'get-registerd.php',
                method: 'POST',
                data: {
                    functionName: 'creatAccount',
                    name: name,
                    email: email,
                    password: password,
                    address: address
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status === "success") {
                        window.location.href = "../home.html"; // If login is successful, redirect to home.html
                    } else {
                        alert("Invalid details, please try again.");
                    }
                },
                error: function (response) {
                    console.log(response);
                    alert("Invalid details, please try again.");
                }
            });
        }
        else {
            alert("Please fill all the fields.");
        }

    });

    btnLogin.addEventListener('click', function (event) {
        event.preventDefault();
        window.location.href = "../login/login.html";
    });

    btnBack.addEventListener('click', function (event) {
        event.preventDefault();
        window.location.href = "../home.html";
    });
});

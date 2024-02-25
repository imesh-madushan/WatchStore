document.addEventListener('DOMContentLoaded', function() {
    var btnLogin = document.getElementById('btn-Login');

    btnLogin.addEventListener('click', function(event) {
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
                    afterLoggedProcess();
                } else {
                    alert("Invalid email or password");
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    function afterLoggedProcess(){
        
        window.location.href = "../home.html";
        // console.log(respose);
        // var navEnd = document.getElementById('navEnd');
        
        // navEnd.removeChild(document.getElementById('btnLogin'));
        // navEnd.removeChild(document.getElementById('btnRegister'));
        

    }
});

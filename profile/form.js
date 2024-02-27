// document.addEventListener('DOMContentLoaded', function() {

var FullName  = document.getElementById("txtFullName").value;
var Email = document.getElementById("txtEmail").value;
var gender = document.getElementById("txtGender").value;
var dateOfBirth = document.getElementById("txtDateOfBirth").value;
var PhoneNo1 = document.getElementById("PhoneNo1").value;
var AdditionalPhoneNo = document.getElementById("AdditionalPhoneNo").value;
var Address = document.getElementById("txtAddress").value;
var City = document.getElementById("txtCity").value;
var State = document.getElementById("txtState").value;
var ZipCode = document.getElementById("txtZip").value;

var bntLogout = document.getElementById("btnLogout");

// bntLogout.addEventListener('click', function(){
    function requesLogOut(){
    console.log("logout button clicked");
    $.ajax({
        url: '../login/get-login.php',
        method: 'POST',
        data: {
            functionName: 'logOut'
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status === "success") {
                window.location.href = "../home.html"; // If login is successful, redirect to home.html
            } else {
                alert("error logging out");
            }
        },
        error: function(response) {
            console.log(response);
            alert("error logging out");
        }
    });
}
// });

// });
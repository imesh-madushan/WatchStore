<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionName'])) {
        include '../dbaccess.php';
        switch ($_POST['functionName']) {  // Check which function is going to access
            case 'validateLogin':
                validateLogin($_POST['email'], $_POST['password']);
                break;
            case 'checkCookies':
                checkCookies();
                break;
            case 'logOut':
                logOut();
                break;
            default:
                accessDenied();
        }
    } else {
        accessDenied();
    }
} else {
    accessDenied();
}
function accessDenied()
{
    http_response_code(403);
    exit('<h1 style="text-align: center; font-family: roboto; color: red; margin-top: 6%">Access Denied !</h1>');
}


function validateLogin($email, $password)
{ // check for the login credentials in database
    $sql = "SELECT * FROM customer WHERE Email = '$email' AND Passwd = '$password'";
    $result = mysqli_query(getDbConnection(), $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        setcookie("customerID", $row['Cus_ID'], time() + (86400 * 30), "/");
        setcookie("email", $email, time() + (86400 * 30), "/");
        setcookie("password", $password, time() + (86400 * 30), "/");

        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failed"));
    }
}

function checkCookies()
{ // Check for the cookies
    if (isset($_COOKIE['customerID']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        echo json_encode(array("status" => "success", "customerID" => $_COOKIE['customerID'], "email" => $_COOKIE['email'], "password" => $_COOKIE['password']));
    } else {
        echo json_encode(array("status" => "failed"));
    }
}

function logOut()
{ // Log out the user
    setcookie("customerID", "", time() - 3600, "/");
    setcookie("email", "", time() - 3600, "/");
    setcookie("password", "", time() - 3600, "/");

    echo json_encode(array("status" => "success"));
}

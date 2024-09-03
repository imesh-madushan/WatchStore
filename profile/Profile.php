<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
           
    if(isset($_POST['functionName'] )){
        
            switch ($_POST['functionName']){  // Check which function is going to access
                case 'updateUserDetails':
                    updateUserDetails();
                    break;
                case'addDeliveryInfor':
                    addDeliveryInfor();
                    break;
                case'cardCheckout':
                    CheckoutCart();
                    break;
                case'checkout':
                    checkout();
                    break;
                    case'checkCookies':
                        checkCookies();
                        break;
                default:
                    accessDenied();
            }
    }
    else
    {
        accessDenied();
    }   
     
}
else{
    accessDenied();
}

// When access is denied this will called to block the access
function accessDenied(){
    http_response_code(403);
    exit ('<h1 style="text-align: center; font-family: roboto; color: red; margin-top: 6%">Access Denied !</h1>');
}




//Update User Details


function updateUserDetails(){
    include 'db.php';

$C_ID=$_COOKIE['customerID'];

$FullName = $_POST['FullName'];
$Email = $_POST['Email'];
$Gender = $_POST['Gender'];
$DateOfBirth = $_POST['DateOfBirth'];
$PhoneNo1 = $_POST['PhoneNo1'];
$AdditionalPhoneNo = $_POST['AdditionalPhoneNo'];
$Address = $_POST['Address'];
$City = $_POST['City'];
$State = $_POST['State'];
$ZipCode = $_POST['ZipCode'];

// Constructing the update query
$$updateQuery = "UPDATE customer 
SET Cus_Name = '$FullName', 
    Email = '$Email',  
    Addr = '$Address', 
    gender = '$Gender', 
    birthday = '$DateOfBirth', 
    phone = '$PhoneNo1', 
    phone1 = '$AdditionalPhoneNo', 
    city = '$City', 
    state = '$State', 
    zip = '$ZipCode' 
WHERE Cus_ID = '$C_ID'";


$result = mysqli_query($con,$updateQuery);

echo json_encode(array("status" => "success"));

}




// Add Delivery Data


function addDeliveryInfor(){
    include 'db.php';
    
    $C_ID=$_COOKIE['customerID'];

    $billingAddress = $_POST['billingAddress'];
    $contactNumberForDelivery = $_POST['contactNumberForDelivery'];
    $cardNumber = $_POST['cardNumber'];
    $cardType = $_POST['cardType'];
    $cardHolderName = $_POST['cardHolderName'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];

// Constructing the update query
$sql = "UPDATE customer 
        SET Addr = '$billingAddress ', 
            phone1 = '$contactNumberForDelivery', 
            cardNumber =' $cardNumber', 
            cardType = '$cardType', 
            cardName = '$cardHolderName', 
            expiryDate = ' $expiryDate', 
            cvv = '$cvv'
        
WHERE Cus_ID = '$C_ID'";


$result = mysqli_query($con,$sql);
echo json_encode(array("status" => "success"));
}







<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
           
    if(isset($_POST['functionName'] )){
        
            switch ($_POST['functionName']){  // Check which function is going to access
                case 'saveCart':
                    saveCart();
                    break;
                case'removeCart':
                    removeCart();
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






function checkCookies()
{ 
    if (isset($_COOKIE['customerID']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        echo json_encode(array("status" => "success", "customerID" => $_COOKIE['customerID'], "email" => $_COOKIE['email'], "password" => $_COOKIE['password']));
    } 
    else {
        echo json_encode(array("status" => "error", "message" => "Cookies are not set"));
    }
}



// This function will save the cart items to the database


function saveCart(){

    include 'db.php';
    // GET ITEM ID AND CUSTOMER ID FROM SESSION AND COOKIE
    session_start();
   $I_ID=$_SESSION["item_id"];
   $C_ID=$_COOKIE["customerID"];


   // $I_ID="I002";
  //  $C_ID="Cus002";


   $qut= $_POST['qut'];

   $query1="SELECT * FROM items WHERE Item_ID='$I_ID'";
    $result1 = mysqli_query($con,$query1);
    $row = mysqli_fetch_assoc($result1);

   $qq=$row['Item_Price'];

   $query = "INSERT INTO cart_items (Cus_ID, Item_ID, Cart_Qty, Price) 
   VALUES ('$C_ID', '$I_ID', $qut, $qq) 
   ON DUPLICATE KEY UPDATE Cart_Qty = Cart_Qty + $qut, Price = Price + $qq";

    $result = mysqli_query($con,$query);
    // header("Location: Cart.php");
    
    echo json_encode(array("status" => "success"));

    
}

// This function will remove the one cart items from the database

function removeCart(){
    include 'db.php';
    
   $I_ID=$_POST['id'];
   $C_ID=$_COOKIE["customerID"];
 

 // $C_ID="Cus001";

    $query = "DELETE FROM cart_items WHERE Cus_ID='$C_ID' AND Item_ID='$I_ID'";
    $result = mysqli_query($con,$query);
    echo json_encode("remove from cart successfully");
}


// This function will remove  all the cart items from the database
function CheckoutCart(){
    include 'db.php';
   
   $C_ID=$_COOKIE["customerID"];
// //   $C_ID="Cus001";

    $query = "DELETE FROM cart_items WHERE Cus_ID='$C_ID'";
    $result = mysqli_query($con,$query);
    echo json_encode("remove from cart successfully");
}




function checkout(){
    
    header("Location: Pay.php");
    echo json_encode("checkout successfully");
}

// Check for the cookies
function cs()
{ 
    if (isset($_COOKIE['customerID']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        echo json_encode(array("status" => "success", "customerID" => $_COOKIE['customerID'], "email" => $_COOKIE['email'], "password" => $_COOKIE['password']));
    } else {
        echo json_encode($_COOKIE['customerID']);
    }
}

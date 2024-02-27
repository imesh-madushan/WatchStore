<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['functionName'])){
            include '../dbaccess.php';
            switch ($_POST['functionName']){  // Check which function is going to access
                case 'creatAccount':
                    creatAccount($_POST['name'] ,$_POST['email'], $_POST['password'], $_POST['address']);
                    break;
                
                default:
                    accessDenied();
            }
        }
        else{
            accessDenied();
        }
    }
    else{
        accessDenied();
    }

    function accessDenied(){
        http_response_code(403);
        exit ('<h1 style="text-align: center; font-family: roboto; color: red; margin-top: 6%">Access Denied !</h1>');
    }

    function creatAccount($name, $email, $password, $address){
        $id = generateID(); // Call the function to generate the ID
        $sql = "INSERT INTO customer (Cus_ID, Cus_Name, Email, Passwd, Addr) VALUES ('$id','$name', '$email', '$password', '$address')";
        $result = mysqli_query(getDbConnection(), $sql);
        
        if($result){
            setcookie("customerID", $id, time() + (86400 * 30), "/");
            setcookie("email", $email, time() + (86400 * 30), "/");        
            setcookie("password", $password, time() + (86400 * 30), "/");
            echo json_encode(array("status" => "success"));
        }
        else{
            echo json_encode(array("status" => "failed"));
        }
    }

    function generateID(){
        $id = "Cus" . rand(1, 9999); //genarate randon string for Cus_ID starting from Cus
        $sql = "SELECT * FROM customer WHERE Cus_ID = '$id'"; //Check if the generated ID is already in the database
        $result = mysqli_query(getDbConnection(), $sql);
        
        if(mysqli_num_rows($result) > 0){
            generateID(); // If the ID is already in the database, call the function again to generate a new ID
        }
        else{
            return $id;
        }
    }
?>
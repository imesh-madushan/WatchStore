<?php
// Check how someone access the php file, if it's not POST method, Acces will be denied
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['functionName'])){
        
        switch ($_POST['functionName']){  // Check which function is going to access
            case 'getAllItems':
                getAllItems();
                break;
            case 'getCategoryList':
                getCategoryList();
                break;
            case 'loadItems':
                loadItems($_POST['category'], $_POST['price']);
                break;
            case 'createSession':
                createSession($_POST['Item_ID']);
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



// Create a function to get the database connection
function getDbConnection(){

    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $database = "watchstore";
    $con = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($con, $database);
    return $con; //return the connection    
}

function getAllItems(){ // Get Item details from database
    
    $sql = "SELECT * FROM items";
    $result = mysqli_query(getDbConnection(), $sql);
    $item_data = array();

    while($row = mysqli_fetch_array($result)) //Read data from database
    {
        $item_data[] = $row; //Append each row to $item_data
    }

    mysqli_close(getDbConnection()); //Close the database connection

    header('Content-Type: application/json');
    $json_data =  json_encode($item_data); //Encode data as jason
    echo $json_data;
}

function getCategoryList(){ // Get category listfrom database to display in left-bar
    $sql = "SELECT * FROM category";
    
    $result = mysqli_query(getDbConnection(), $sql);
    $cat_data = array();

    while($row = mysqli_fetch_array($result)){
        $cat_data[] = $row; 
    }
    
    mysqli_close(getDbConnection()); //Close the database connection

    header('Content-Type: application/json');
    $json_data = json_encode($cat_data);
    echo $json_data;
}


function loadItems($category, $price){ // Filter items using CATEGORY id
    $sql;
    if($category == 'none' && $price == 'none'){
        $sql = "SELECT * FROM items";
    }
    elseif($category == 'none'){
        $sql = "SELECT * FROM items WHERE Item_Price > '$price'";
    }
    elseif($price == 'none'){
        $sql = "SELECT * FROM items WHERE Cat_ID = '$category'";
    }
    elseif($category != 'none' && $price != 'none'){
        $sql = "SELECT * FROM items WHERE Cat_ID = '$category' AND Item_Price > '$price'";
    }

    $result = mysqli_query(getDbConnection(), $sql);
    $cat_data = array();

    while($row = mysqli_fetch_array($result)){
        $cat_data[] = $row; 
    }
    
    mysqli_close(getDbConnection()); //Close the database connection

    header('Content-Type: application/json');
    $json_data = json_encode($cat_data);
    echo $json_data;
}

function createSession($s_ited_id){
    session_start();
    $_SESSION['item_id'] = $s_ited_id;
    echo json_encode(array("status" => "success"));
}
?>
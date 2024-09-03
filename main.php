<?php
// Check how someone access the php file, if it's not POST method, Acces will be denied
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionName'])) {
        include 'dbaccess.php';

        switch ($_POST['functionName']) {  // Check which function is going to access
            case 'getCategoryList':
                getCategoryList();
                break;
            case 'loadItems':
                loadItems($_POST['category'], $_POST['price']);
                break;
            case 'createSession':
                createSession($_POST['itemId']);
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

// When access is denied this will called to block the access
function accessDenied()
{
    http_response_code(403);
    exit('<h1 style="text-align: center; font-family: roboto; color: red; margin-top: 6%">Access Denied !</h1>');
}


function getCategoryList()
{ // Get category listfrom database to display in left-bar
    $sql = "SELECT * FROM category";

    $result = mysqli_query(getDbConnection(), $sql);
    $cat_data = array();

    while ($row = mysqli_fetch_array($result)) {
        $cat_data[] = $row;
    }

    mysqli_close(getDbConnection()); //Close the database connection

    header('Content-Type: application/json');
    $json_data = json_encode($cat_data);
    echo $json_data;
}


function loadItems($category, $price)
{ // Filter items using CATEGORY id
    $sql = '';
    if ($category == 'none' && $price == 'none') {
        $sql = "SELECT * FROM items";
    } elseif ($category == 'none') {
        $sql = "SELECT * FROM items WHERE Item_Price > '$price'";
    } elseif ($price == 'none') {
        $sql = "SELECT * FROM items WHERE Cat_ID = '$category'";
    } elseif ($category != 'none' && $price != 'none') {
        $sql = "SELECT * FROM items WHERE Cat_ID = '$category' AND Item_Price > '$price'";
    }

    $result = mysqli_query(getDbConnection(), $sql);
    $cat_data = array();

    while ($row = mysqli_fetch_array($result)) {
        $cat_data[] = $row;
    }

    mysqli_close(getDbConnection()); //Close the database connection

    header('Content-Type: application/json');
    $json_data = json_encode($cat_data);
    echo $json_data;
}

function createSession($s_item_id)// Start a session
{
    session_start();
    $_SESSION['item_id'] = $s_item_id;
    echo json_encode(array("status" => "success"));
}

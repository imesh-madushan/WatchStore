<?php

$db_host = "oneoclock.lifezeeds.me";
$db_user = "imesh";
$db_password = "imesh";
$database = "syncsentry";
$con = mysqli_connect($db_host, $db_user, $db_password, $database);
// mysqli_select_db($con, $database);

echo "Connected to the database";
// $sql = "SELECT * FROM customer";

// $result = mysqli_query($con, $sql);
// $cat_data = array();

// while ($row = mysqli_fetch_array($result)) {
//     $cat_data[] = $row;
// }
// echo json_encode($cat_data);

// echo $_COOKIE['customerID'];
// echo $_COOKIE['email'];

// session_start();
// echo $_SESSION['item_id'];

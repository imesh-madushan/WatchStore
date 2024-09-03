<?php
// Create a function to get the database connection
function getDbConnection()
{

    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $database = "watchstore";
    $con = mysqli_connect($db_host, $db_user, $db_password, $database);
    return $con; //return the connection    
}

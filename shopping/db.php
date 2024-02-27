<?php

include '../dbaccess.php';
$con = getDbConnection();

if (!$con) {
    die("connect_error");
} else {
    //    echo "connected";
}

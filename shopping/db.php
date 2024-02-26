<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$database = "watchstore";
$con = mysqli_connect($db_host, $db_user, $db_password, $database);

                if(!$con){
                    die("connect_error");
                }
                else{
                //    echo "connected";
                }


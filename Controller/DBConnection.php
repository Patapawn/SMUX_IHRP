<?php

// Create connection
require_once("../config/config.php");
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

    // echo "DB Connection OK";
}
?>
<?php

//if (session_id() == '' || session_status() == PHP_SESSION_NONE) {

if (empty($_SESSION['smu_email']) && ($_SESSION['user_logged_in'] != 1 )) {
    //user not logged in
    //session_destroy();
    //$_SESSION = array();
    header('Location: ' . "../index.php");
    exit();
    //}
}
?>
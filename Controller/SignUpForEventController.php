<?php

//get variables here.
session_start();
require 'DBConnection.php';


$eventid = htmlspecialchars($_GET['eventid']);
$person_sign_up = htmlspecialchars($_GET['email']);

$validation_success = true;
$on_success_redirect_to = "../AdminPages/CreateNewEvent.php";
$on_failure_redirect_to = "../AdminPages/CreateNewEvent.php";

//1) verify user profile is updated
//1b)go to the update my profile first.
//2) check for additional fields which need to be supplied
//3) sign user up for the actual event
?>
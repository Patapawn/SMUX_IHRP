<?php

//get variables here.
session_start();
require 'DBConnection.php';

$validation_success = true;
$profile_has_been_updated = false;


$eventid = htmlspecialchars($_GET['eventid']);
$person_sign_up = htmlspecialchars($_GET['email']);

if (isset($_GET['profileupdated'])) {
    $profileupdated = htmlspecialchars($_GET['profileupdated']);

    if ($profileupdated == "true") {
        $profile_has_been_updated = true;

        //echo "YES IT WORKS. user profile updated and commence with step 2. refer to else block below";
    }
}





$on_success_redirect_to = "../AdminPages/CreateNfasdfewEvent.php";
$on_failure_redirect_to = "../AdminPages/CreateNeasdfawEvent.php";
$redirect_to_update_profile = '../MemberPages/UpdateMyProfile.php?eventid=' . $eventid . ' &email=' . $person_sign_up;

//1) verify user profile is updated
//1b)go to the update my profile first.
//2) check for additional fields which need to be supplied
//3) sign user up for the actual event


if (!$profile_has_been_updated) {
    //1) verify user profile is updated
    //1b)go to the update my profile first.
    header("Location: $redirect_to_update_profile");
} else {
    //2) check for additional fields which need to be supplied
    //3) sign user up for the actual event
    //echo "OK commencing with step 2";
    //need to compare the md5 hashes of the events.
    //get all events in db,
}
?>
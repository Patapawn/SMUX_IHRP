<?php

//get variables here.
session_start();
//require 'DBConnection.php';
require_once('../Model/EventDAO.php');


$validation_success = true;
$profile_has_been_updated = false;


$eventidmd5hash = htmlspecialchars($_GET['eventid']);
$person_sign_up = htmlspecialchars($_GET['email']);

if (isset($_GET['profileupdated'])) {
    $profileupdated = htmlspecialchars($_GET['profileupdated']);

    if ($profileupdated == "true") {
        $profile_has_been_updated = true;

        //echo "YES IT WORKS. user profile updated and commence with step 2. refer to else block below";
    }
}


$redirect_to_update_profile = '../MemberPages/UpdateMyProfile.php?eventid=' . $eventidmd5hash . ' &email=' . $person_sign_up;

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

    $eventDAO = new EventDAO();

    //does event need additional fields?
    if ($eventDAO->needsToFillInExtraFields($eventidmd5hash)) {
        echo "need additional fields";
        //REDIRECT user to fill in the additional fields and submit.
        //once submitted redirect to success page
    } else {

//event dao write to the event participant table
        //echo $person_sign_up;
        //echo $eventidmd5hash;
        if ($eventDAO->assignSMUXMEMBERParticipantToEvent($eventidmd5hash, $person_sign_up, "NONE")) {
            //redirect to success page

            echo "success with no addfelds!";
            //echo $person_sign_up;
        } else {
            echo "error";
        }
    }
}
?>
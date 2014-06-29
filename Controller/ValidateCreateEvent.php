<?php

session_start();

//get db connection
require 'DBConnection.php';

$validation_success = true;
$on_success_redirect_to = "../AdminPages/CreateNewEvent.php";
$on_failure_redirect_to = "../AdminPages/CreateNewEvent.php";
$errorArray = array();


//REMEMBER TO: generate event id in this controller.
//REMEMBER TO: THINK OF A WAY TO PUSH BACK ADDITIONAL FIELDS

$event_name = sanitizeData(filter_input(INPUT_POST, 'eventname'));
$team = sanitizeData(filter_input(INPUT_POST, 'team'));
$event_type = sanitizeData(filter_input(INPUT_POST, 'eventtype'));
$event_date = sanitizeData(filter_input(INPUT_POST, 'eventdate'));
$event_description = sanitizeData(filter_input(INPUT_POST, 'eventdescription'));
$allow_signups = sanitizeData(filter_input(INPUT_POST, 'allowsignups'));

$additional_fields = $_POST['field_name'];
$descriptions = $_POST['field_description'];
$type = $_POST['field_type'];
$choices = $_POST['field_choices'];


$JSON_string_to_db = "";
/*
  echo "TEST" . "<br>";
  echo $event_name . "<br>";
  echo $team . "<br>";
  echo $event_type . "<br>";
  echo $event_date . "<br>";
  echo $event_description . "<br>";

  print_r($additional_fields);
  print_r($descriptions);
  print_r($type);
  print_r($choices);


 */

if ($event_name == "") {
    $validation_success = false;
    $errorArray[] = 'Event Name Field Blank';
}
if ($team == "--Please Select--") {
    $validation_success = false;
    $errorArray[] = 'Team Field Blank';
}
if ($event_type == "--Please Select--") {
    $validation_success = false;
    $errorArray[] = 'Event Type Field Blank';
}
if ($event_date == "") {
    $validation_success = false;
    $errorArray[] = 'Event Date Field Blank';
}
if ($event_description == "") {
    $validation_success = false;
    $errorArray[] = 'Event Description Field Blank';
}

$yyyy = substr($event_date, 0, 3);
$mm = substr($event_date, 5, 6);
$dd = substr($event_date, 8, 9);

if (!checkdate($mm, $dd, $yyyy)) {
    $validation_success = false;
    $errorArray[] = 'Invalid Date Format, Please use YYYY-MM-DD';
}


//validate the added rows
foreach ($additional_fields as $index => $fieldrow) {

    $rownum = 1;

    /*
      echo $fieldrow;
      echo $descriptions[$index];
      echo $type[$index];
      echo $choices[$index] . "<br>";
     */

    //if not blank continue validating.
    if (strtolower($fieldrow) != "none") {

        /*
          if ($choices[$index] == "") {
          $validation_success = false;
          $errorArray[] = 'Choices are Blank';
          } */

        //ALLOW DESCRIPTION FIELD TO BE BLANK.
        if ($type[$index] == "--Please Select--") {
            $validation_success = false;
            $errstring = "Invalid Additional Field Type (Row $rownum)";
            $errorArray[] = $errstring;
            //echo $errstring;
        }

        $JSON_string_to_db = createjsonobject($additional_fields, $descriptions, $type, $choices);

        if (!isJson($JSON_string_to_db)) {
            $validation_success = false;
            $errorArray[] = 'JSON Errror, Please Check Additional Fields';
        }
    } else {
        $JSON_string_to_db = "NONE";
        //no entry so input NONE to db.
        //echo "none";
    }

    $rownum ++;
}



$valuesArray = array();
if (!$validation_success) {

    array_push($valuesArray
            , $event_name
            , $team
            , $event_type
            , $event_date
            , $event_description
            , $allow_signups);

    $_SESSION['errors'] = $errorArray;
    $_SESSION['values'] = $valuesArray;
}


if ($validation_success) {

    //generate eventid GET THIS FINALIZED

    $event_id = substr($team, 0, 3) . substr($event_date, 2, 2) . substr($event_date, 4, 6);
    $event_id_hash = md5($event_id);

    //echo $event_id;
    //echo $eventid;
    //insert statements
    //eventid, event name, team, type, event date, event desc, extra fields

    $sql_insert_into_event = 'insert into event values(?,?,?,?,?,?,?,?,?)';

    //Prepare statement
    $pstmt = $con->prepare($sql_insert_into_event);

    if ($pstmt === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
    }


    //Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob
    $pstmt->bind_param('sssssssss', $event_id, $event_id_hash, $event_name, $team, $event_type, $event_date, $event_description, $JSON_string_to_db, $allow_signups);
    $pstmt->execute();
    $pstmt->close();


    mysqli_close($con);
}


if ($validation_success) {

    array_push($valuesArray
            , $event_name
            , $team
            , $event_type
            , $event_date
            , $event_description
            , $allow_signups);
    mysqli_close($con);
    $_SESSION['success'] = "yes!";
    $_SESSION['values'] = $valuesArray;
    header("Location: $on_success_redirect_to");
} else {
    mysqli_close($con);

//redirect back. session data is sent back.
    header("Location: $on_failure_redirect_to");
}

function sanitizeData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function createjsonobject($additional_fields, $descriptions, $type, $choices) {


    $jsonstringstart = "{\"additionalrows\":[";


    $jsonstringend = "]}";

    foreach ($additional_fields as $index => $fieldrow) {

        /*
          echo $fieldrow;
          echo $descriptions[$index];
          echo $type[$index];
          echo $choices[$index] . "<br>";
         */


        $onejsonobject = "{
                    \"additionalfield\": \"$fieldrow\",
                    \"description\": \"$descriptions[$index]\",
                    \"type\": \"$type[$index]\",
                    \"choices\": [$choices[$index]]
                }";

        //if not last element in array need the comma
        if (count($additional_fields) == $index + 1) {
            $jsonstringstart = $jsonstringstart . $onejsonobject;
        } else {
            //if last element in array no need the comma.
            $jsonstringstart = $jsonstringstart . $onejsonobject . ",";
        }
    }




    return $jsonstringstart . $jsonstringend;
}

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

?>
<?php

session_start();

//get db connection
require 'DBConnection.php';


$date = new DateTime();
//echo print_r($_POST);
//Conditions
$validation_success = true;
$on_success_redirect_to = "../home.php";
$on_failure_redirect_to = "../CreateMember.php";


//variables obtained
$email = sanitizeData(filter_input(INPUT_POST, 'email'));
$alt_email = sanitizeData(filter_input(INPUT_POST, 'alt_email'));

$password = sanitizeData(filter_input(INPUT_POST, 'password'));

$fullname = sanitizeData(filter_input(INPUT_POST, 'fullname'));
$contactnum = sanitizeData(filter_input(INPUT_POST, 'contactNum'));
$nric = sanitizeData(filter_input(INPUT_POST, 'nric'));
$gender = sanitizeData(filter_input(INPUT_POST, 'gender'));
$nationality = sanitizeData(filter_input(INPUT_POST, 'nationality'));
$dob = sanitizeData(filter_input(INPUT_POST, 'dob'));
$diet = sanitizeData(filter_input(INPUT_POST, 'diet'));
$medcondition = sanitizeData(filter_input(INPUT_POST, 'medcondition'));
$bloodtype = sanitizeData(filter_input(INPUT_POST, 'bloodtype'));
$shirtsize = sanitizeData(filter_input(INPUT_POST, 'shirtsize'));
$primaryteam = sanitizeData(filter_input(INPUT_POST, 'primaryteam'));
$secondaryteam = sanitizeData(filter_input(INPUT_POST, 'secondaryteam'));
$alumni = sanitizeData(filter_input(INPUT_POST, 'alumni'));
$drivinglicense = sanitizeData(filter_input(INPUT_POST, 'drivinglicense'));
$timestamp = $date->format('Y-m-d H:i:s');



$fulladdress = sanitizeData(filter_input(INPUT_POST, 'fulladdress'));
$postalcode = sanitizeData(filter_input(INPUT_POST, 'postalcode'));



$nokname = sanitizeData(filter_input(INPUT_POST, 'nokname'));
$nokrelation = sanitizeData(filter_input(INPUT_POST, 'nokrelation'));
$nokcontact = sanitizeData(filter_input(INPUT_POST, 'nokcontact'));

/*
  echo $email . $password . $fullname . $contactnum
  . $nric
  . $gender
  . $nationality
  . $dob
  . $diet
  . $medcondition
  . $bloodtype
  . $shirtsize
  . $primaryteam
  . $secondaryteam
  . $alumni
  . $drivinglicense
  . $timestamp . $fulladdress . $postalcode . $nokname . $nokrelation . $nokcontact;
 */



//DO VALIDATION HERE

$errorArray = array();
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $validation_success = false;
    $errorArray[] = 'Invalid SMU Email Format';
}

if (!filter_var($alt_email, FILTER_VALIDATE_EMAIL)) {
    $validation_success = false;
    $errorArray[] = 'Invalid Alternate / Secondary Email Format';
}


if ($password == "") {
    $validation_success = false;
    $errorArray[] = 'Password Field Blank';
}
if ($fullname == "") {
    $validation_success = false;
    $errorArray[] = 'Full Name Field Blank';
}
if ($contactnum == "") {
    $validation_success = false;
    $errorArray[] = 'Contact Number Field Blank';
}
if ($nric == "") {
    $validation_success = false;
    $errorArray[] = 'NRIC Field Blank';
}
if ($gender == "") {
    $validation_success = false;
    $errorArray[] = 'Gender Field Blank';
}
$yyyy = substr($dob, 0, 3);
$mm = substr($dob, 5, 6);
$dd = substr($dob, 8, 9);

if (!checkdate($mm, $dd, $yyyy)) {
    $validation_success = false;
    $errorArray[] = 'Invalid Date Format, Please use YYYY-MM-DD';
}

if ($nationality == "") {
    $validation_success = false;
    $errorArray[] = 'Nationality Field Blank';
}
if ($dob == "") {
    $validation_success = false;
    $errorArray[] = 'DOB Field Blank';
}
if ($diet == "") {
    $validation_success = false;
    $errorArray[] = 'Dietary Preference Field Blank';
}
if ($fulladdress == "") {
    $validation_success = false;
    $errorArray[] = 'Address Field Blank';
}
if ($postalcode == "") {
    $validation_success = false;
    $errorArray[] = 'Postal Code Field Blank';
}
if ($nokname == "") {
    $validation_success = false;
    $errorArray[] = 'NOK Name Field Blank';
}
if ($nokrelation == "") {
    $validation_success = false;
    $errorArray[] = 'NOK Relation Field Blank';
}
if ($nokcontact == "") {
    $validation_success = false;
    $errorArray[] = 'NOK Contact Field Blank';
}
if ($medcondition == "") {
    $validation_success = false;
    $errorArray[] = 'Medical Conditions Field Blank';
}
if ($bloodtype == "") {
    $validation_success = false;
    $errorArray[] = 'Blood Type Field Blank';
}
if ($shirtsize == "--Please Select--") {
    $validation_success = false;
    $errorArray[] = 'Please Select A Shirt Size';
}

if ($primaryteam == "--Please Select--") {
    $validation_success = false;
    $errorArray[] = 'Please Select A Primary Team';
}
if ($secondaryteam == "--Please Select--") {
    $validation_success = false;
    $errorArray[] = 'Please Select A Secondary Team';
}
if ($drivinglicense == "--Please Select--") {
    $validation_success = false;
    $errorArray[] = 'Please Select Driving License';
}







//prepare session variables to push back
if (!$validation_success) {
    $valuesArray = array();
    array_push($valuesArray
            , $email
            , $alt_email
            , $fullname
            , $contactnum
            , $nric
            , $gender
            , $nationality
            , $dob
            , $diet
            , $fulladdress
            , $postalcode
            , $nokname
            , $nokrelation
            , $nokcontact
            , $medcondition
            , $bloodtype
            , $shirtsize
            , $primaryteam
            , $secondaryteam
            , $drivinglicense
            , $alumni);

    //assign variables to session
    $_SESSION['errors'] = $errorArray;
    $_SESSION['values'] = $valuesArray;
    //echo (!empty($_SESSION['errors']));
    //echo print_r($errorArray);
    //echo gettype($_SESSION["errors"]);
}



//INSERT TO DATABASE
if ($validation_success) {

//insert statements
    $sql_insert_to_smux_members = 'insert into smux_members values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $sql_insert_to_member_passwords = 'insert into member_passwords values(?, ?)';
    $sql_insert_to_member_address = 'insert into member_address values(?, ?, ?)';
    $sql_insert_to_member_nok = 'insert into member_nok values(?, ?, ?, ?)';
    $sql_insert_to_member_flags = 'insert into member_flags values(?,?,?,?,?,?,?,?,?)';
    /* Prepare statement */

    $stmt1 = $con->prepare($sql_insert_to_smux_members);

    $stmt2 = $con->prepare($sql_insert_to_member_passwords);

    $stmt3 = $con->prepare($sql_insert_to_member_address);
    $stmt4 = $con->prepare($sql_insert_to_member_nok);
    $stmt5 = $con->prepare($sql_insert_to_member_flags);

    /*
      if ($stmt1 === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
      }
      if ($stmt2 === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
      }
      if ($stmt3 === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
      }
      if ($stmt4 === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
      }

      if ($stmt5 === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
      }
     * */


    $no = 'N';
    //TO FIX THE PARAMETER MISMATCH ISSUE FOR THE PASSWORDS THING>
    //ASDFASFADSFAFASDFASD


    /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
    $stmt1->bind_param('sssssssssssssssss', $email, $alt_email, $fullname, $contactnum, $nric, $gender, $nationality, $dob, $diet, $medcondition, $bloodtype, $shirtsize, $primaryteam, $secondaryteam, $alumni, $drivinglicense, $timestamp);
    $stmt2->bind_param('ss', $email, $password);
    $stmt3->bind_param('sss', $email, $fulladdress, $postalcode);
    $stmt4->bind_param('ssss', $email, $nokname, $nokrelation, $nokcontact);
    $stmt5->bind_param('sssssssss', $email, 'Y', $no, $no, $no, $no, $no, $no, $no);

    /* Execute statement */
    $stmt1->execute();
    $stmt2->execute();
    $stmt3->execute();
    $stmt4->execute();
    $stmt5->execute();

    /*
      echo $stmt1->insert_id . "</br>";
      echo $stmt1->affected_rows;
      echo $stmt2->insert_id;
      echo $stmt2->affected_rows;
      echo $stmt3->insert_id;
      echo $stmt3->affected_rows;
      echo $stmt4->insert_id;
      echo $stmt4->affected_rows;
     *
     */

    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $stmt4->close();
    $stmt5->close();

    mysqli_close($con);
}



if ($validation_success) {
    mysqli_close($con);

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

?>
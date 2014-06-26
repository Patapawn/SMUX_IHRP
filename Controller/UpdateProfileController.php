<?php

session_start();

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('../libraries/password_compatibility_library.php');
}

require_once('../Controller/DBConnection.php');

$smu_email = sanitizeData(filter_input(INPUT_POST, 'smuemail'));
$user_password = sanitizeData(filter_input(INPUT_POST, 'password'));


$contact_number = sanitizeData(filter_input(INPUT_POST, 'contactNum'));
$diet = sanitizeData(filter_input(INPUT_POST, 'diet'));
$medcondition = sanitizeData(filter_input(INPUT_POST, 'medcondition'));
$bloodtype = sanitizeData(filter_input(INPUT_POST, 'bloodtype'));
$shirtsize = sanitizeData(filter_input(INPUT_POST, 'shirtsize'));
$primaryteam = sanitizeData(filter_input(INPUT_POST, 'primaryteam'));
$secondaryteam = sanitizeData(filter_input(INPUT_POST, 'secondaryteam'));
$drivinglicense = sanitizeData(filter_input(INPUT_POST, 'drivinglicense'));

/*
  echo $contact_number . '<br>';
  echo $diet . '<br>';
  echo $medcondition . '<br>';
  echo $bloodtype . '<br>';
  echo $shirtsize . '<br>';
  echo $primaryteam . '<br>';
  echo $secondaryteam . '<br>';
  echo $drivinglicense . '<br>';
 */

$fulladdress = sanitizeData(filter_input(INPUT_POST, 'fulladdress'));
$postalcode = sanitizeData(filter_input(INPUT_POST, 'postalcode'));

$nokname = sanitizeData(filter_input(INPUT_POST, 'nokname'));
$nokrelation = sanitizeData(filter_input(INPUT_POST, 'nokrelation'));
$nokcontact = sanitizeData(filter_input(INPUT_POST, 'nokcontact'));



$on_success_redirect_to = "../MemberPages/UpdateMyProfile.php";
$on_failure_redirect_to = "../MemberPages/UpdateMyProfile.php";


//print_r($_POST);
//echo $smu_email;
//$user_password = sanitizeData(filter_input(INPUT_POST, 'password'));
//echo $user_password;
//get password from post and hash it

$sql_select = 'select user_password_hash from member_passwords where smu_email = ?';
$pstmt = $con->prepare($sql_select);
$pstmt->bind_param('s', $smu_email);
$pstmt->execute();
$pstmt->bind_result($user_password_hash);

$user_password_from_db = "";
while ($pstmt->fetch()) {
    $user_password_from_db = $user_password_hash;
    // echo $user_password_hash;
}
//echo $user_password_from_db;


if (!password_verify($user_password, $user_password_from_db)) {
    //password is wrong dont even bother.
    //echo "password wrong";
    $pstmt->close();
    $con->close();
    $_SESSION['status'] = 'failure';
    header("Location: $on_failure_redirect_to");
    exit();
} else {
    //password is correct allow user to update
    //echo "password ok";
    //write to db with updated fields
    $sql_update = 'update smux_members set contact_number = ?,diet = ?, allergies_medical = ?,blood_type = ?,shirt_size = ?,primary_team = ?,secondary_team = ?, driving_license = ? where smu_email=?';


    $pstmt = $con->prepare($sql_update);
    $pstmt->bind_param('sssssssss', $contact_number, $diet, $medcondition, $bloodtype, $shirtsize, $primaryteam, $secondaryteam, $drivinglicense, $smu_email);
    $pstmt->execute();



    $sql_update = 'update member_address set address = ?, postal_code = ? where smu_email = ?';
    $pstmt = $con->prepare($sql_update);
    $pstmt->bind_param('sss', $fulladdress, $postalcode, $smu_email);
    $pstmt->execute();



    $sql_update = 'update member_nok set nok_name = ?, nok_relation = ? , nok_contact = ? where smu_email = ?';
    $pstmt = $con->prepare($sql_update);
    $pstmt->bind_param('ssss', $nokname, $nokrelation, $nokcontact, $smu_email);
    $pstmt->execute();

    $pstmt->close();
    $con->close();


    $_SESSION['status'] = 'success';
    header("Location: $on_failure_redirect_to");
    exit();
}

function sanitizeData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
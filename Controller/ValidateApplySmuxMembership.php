<?php

session_start();


if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}

//echo "TESTSSX";
//get db connection
require_once('../config/config.php');
require_once('../Controller/DBConnection.php');
require_once('../libraries/PHPMailer.php');

$date = new DateTime();
//echo print_r($_POST);
//Conditions
$validation_success = true;
$on_success_redirect_to = "../MemberPages/Success.php";
$on_failure_redirect_to = "../MemberPages/ApplySmuxMembership.php";

$errorArray = array();
$valuesArray = array();

//echo $_SESSION['captcha'];
//variables obtained
$email = sanitizeData(filter_input(INPUT_POST, 'email'));

$password = sanitizeData(filter_input(INPUT_POST, 'password'));
$password2 = sanitizeData(filter_input(INPUT_POST, 'password2'));


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

$captcha = sanitizeData(filter_input(INPUT_POST, 'captcha'));
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


if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {

//fail captcha validation
    //echo $_SESSION['captcha'];
    //echo "CAPTCHA WRONG";
    $validation_success = false;
    $errorArray[] = 'Captcha Incorrect';

    array_push($valuesArray
            , $email
            , $password
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

    $_SESSION['values'] = $valuesArray;
    $_SESSION['errors'] = $errorArray;
    mysqli_close($con);
    header("Location: $on_failure_redirect_to");
} else if ($password !== $password2) {
    $validation_success = false;
    $errorArray[] = 'Password Do Not Match';

    array_push($valuesArray
            , $email
            , $password
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

    $_SESSION['values'] = $valuesArray;
    $_SESSION['errors'] = $errorArray;
    mysqli_close($con);
    header("Location: $on_failure_redirect_to");
} else {


//DO VALIDATION HERE



    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validation_success = false;
        $errorArray[] = 'Invalid Email Format';
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

        array_push($valuesArray
                , $email
                , $password
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


        //check if user is already in database
        //if this returns true, user is existing
        //if this returns false, user is not existing
        $existingUser = checkExistingUser($email, $con);
        if ($existingUser == true) {
            //echo "user exists";
            //VALIDATION FAILURE REDIRECT OUT TO HANDLE.

            $validation_success = false;
            $errorArray[] = 'That User Is Already Registered... Have you forgot your password?';

            array_push($valuesArray
                    , $email
                    , $password
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

            $_SESSION['values'] = $valuesArray;
            $_SESSION['errors'] = $errorArray;
            mysqli_close($con);
            header("Location: $on_failure_redirect_to");
        } else {
            //echo "user does not exist";
            //CARRY ON!
            //
            //HASH PASSWORD
            // check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
            // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
            $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

            // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
            // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
            // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
            // want the parameter: as an array with, currently only used with 'cost' => XX.
            $user_password_hash = password_hash($password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
            // generate random hash for email verification (40 char string)
            $user_activation_hash = sha1(uniqid(mt_rand(), true));


            //insert statements
            $sql_insert_to_smux_members = 'insert into smux_members values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $sql_insert_to_member_passwords = 'insert into member_passwords(smu_email, user_password_hash, user_active, user_activation_hash, user_registration_datetime, user_registration_ip ) values(?,?,?,?,?,?)';
            $sql_insert_to_member_address = 'insert into member_address values(?, ?, ?)';
            $sql_insert_to_member_nok = 'insert into member_nok values(?, ?, ?, ?)';
            $sql_insert_to_member_flags = 'insert into member_flags values(?,?,?,?,?,?,?,?,?)';

            /* Prepare statement */
            $stmt1 = $con->prepare($sql_insert_to_smux_members);
            $stmt2 = $con->prepare($sql_insert_to_member_passwords);
            $stmt3 = $con->prepare($sql_insert_to_member_address);
            $stmt4 = $con->prepare($sql_insert_to_member_nok);
            $stmt5 = $con->prepare($sql_insert_to_member_flags);


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

            $user_active = 0;

            $userIPAddress = $_SERVER['REMOTE_ADDR'];
            $no = 'N';

            /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
            $stmt1->bind_param('ssssssssssssssss', $email, $fullname, $contactnum, $nric, $gender, $nationality, $dob, $diet, $medcondition, $bloodtype, $shirtsize, $primaryteam, $secondaryteam, $alumni, $drivinglicense, $timestamp);
            $stmt2->bind_param('ssisss', $email, $user_password_hash, $user_active, $user_activation_hash, $timestamp, $userIPAddress);
            $stmt3->bind_param('sss', $email, $fulladdress, $postalcode);
            $stmt4->bind_param('ssss', $email, $nokname, $nokrelation, $nokcontact);
            $stmt5->bind_param('sssssssss', $email, $no, $no, $no, $no, $no, $no, $no, $no);

            /* Execute statement */
            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();
            $stmt4->execute();
            $stmt5->execute();

            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
            $stmt4->close();
            $stmt5->close();




            //SEND THE DAMN EMAIL!!!
            $emailSent = sendVerificationEmail($email, $user_activation_hash);

            if ($emailSent) {
                //do nothing, will redirect out at the bottom.
            } else {
                //DELETE ENTRY FROM THE DB TABLES
                $validation_success = false;


                $sql_delete_from_member_passwords = 'delete from member_passwords where smu_email=?';
                $sql_delete_from_member_address = 'delete from member_address where smu_email=?';
                $sql_delete_from_to_member_nok = 'delete from member_nok where smu_email=?';
                $sql_delete_from_smux_members = 'delete from smux_members where smu_email=?';
                $sql_delete_from_member_flags = 'delete from member_flags where smu_email=?';

                $stmt1 = $con->prepare($sql_delete_from_member_passwords);
                $stmt2 = $con->prepare($sql_delete_from_member_address);
                $stmt3 = $con->prepare($sql_delete_from_to_member_nok);
                $stmt4 = $con->prepare($sql_delete_from_smux_members);
                $stmt5 = $con->prepare($sql_delete_from_member_flags);

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


                $stmt1->bind_param('s', $email);
                $stmt2->bind_param('s', $email);
                $stmt3->bind_param('s', $email);
                $stmt4->bind_param('s', $email);
                $stmt5->bind_param('s', $email);

                $stmt1->execute();
                $stmt2->execute();
                $stmt3->execute();
                $stmt4->execute();
                $stmt5->execute();

                $stmt1->close();
                $stmt2->close();
                $stmt3->close();
                $stmt4->close();
                $stmt5->close();

                mysqli_close($con);
            }
        }
    }



    if ($validation_success) {
        mysqli_close($con);

        header("Location: $on_success_redirect_to");
    } else {
        mysqli_close($con);

//redirect back. session data is sent back.
        header("Location: $on_failure_redirect_to");
    }
}

function sanitizeData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function sendVerificationEmail($user_email, $user_activation_hash) {

    $mail = new PHPMailer;

    // please look into the config/config.php for much more info on how to use this!
    // use SMTP or use mail()
    if (EMAIL_USE_SMTP) {
        // Set mailer to use SMTP
        $mail->IsSMTP();
        //useful for debugging, shows full SMTP errors
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        // Enable SMTP authentication
        $mail->SMTPAuth = EMAIL_SMTP_AUTH;
        // Enable encryption, usually SSL/TLS
        if (defined(EMAIL_SMTP_ENCRYPTION)) {
            $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
        }
        // Specify host server
        $mail->Host = EMAIL_SMTP_HOST;
        $mail->Username = EMAIL_SMTP_USERNAME;
        $mail->Password = EMAIL_SMTP_PASSWORD;
        $mail->Port = EMAIL_SMTP_PORT;
    } else {
        $mail->IsMail();
    }

    $mail->From = EMAIL_VERIFICATION_FROM;
    $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
    $mail->AddAddress($user_email);
    $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

    $link = EMAIL_VERIFICATION_URL . '?id=' . urlencode($user_email) . '&verification_code=' . urlencode($user_activation_hash);

    // the link to your register.php, please set this value in config/email_verification.php
    $mail->Body = EMAIL_VERIFICATION_CONTENT . ' ' . $link;

    if (!$mail->Send()) {
        $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
        return false;
    } else {
        return true;
    }
}

function checkExistingUser($email, $con) {


    $sql_selectExists = "select exists (select * from smux_members where smu_email = ?) as 'exists' ";
    //echo "TEST";
    $pstmt = $con->prepare($sql_selectExists);

    if ($pstmt === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
    }
    $pstmt->bind_param('s', $email);
    $pstmt->execute();

    $pstmt->bind_result($exists);

    $existingUser = -1;
    //echo $existingUser;
    while ($pstmt->fetch()) {
        $existingUser = $exists;
    }
    //echo $existingUser;


    if ($existingUser == "1") {

        $pstmt->close();
        return true;
    }


    $pstmt->close();
    return false;
}

?>
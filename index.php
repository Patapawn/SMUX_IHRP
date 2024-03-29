<?php

ob_start();
include('views/_header.php');
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}


// include the config
require_once('config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
//require_once('translations/en.php');
// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class

require_once('Controller/LoginController.php');
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$loginController = new LoginController();
$on_login_redirect_to = "./MemberPages/MemberHome.php";
//
if ($loginController->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    //echo "REDIRECT TO LOGGGED IN PLACE";
    header('Location: ' . $on_login_redirect_to);
    exit();
    //die();
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    //include("views/not_logged_in.php");

    include('views/loginform.php');
}

include('views/_footer.php');
?>


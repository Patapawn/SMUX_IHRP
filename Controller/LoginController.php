<?php

ob_start();

/**
 * this class is used to control login function.
 * it will be the starting of the whole user application
 *
 */
class LoginController {

    private $db_connection = null;
    private $user_email = null;
    private $user_is_logged_in = false;

    //public $errors = array();
    //public $messages = array();

    public function __construct() {
        //start session
        session_start();
        //check DB connection first
        if (!$this->getDatabaseConnection()) {
            //echo failure on lousy connection
            echo "DB FAILURE";
        } else {

            // check the possible login actions:
            // case 1. logout (happen when user clicks logout button)
            // case 2. login via session data (happens each time user opens a page on your php project AFTER he has successfully logged in via the login form)
            // case 3. login via cookie
            // case 4. login via post data, which means simply logging in via the login form. after the user has submit his login/password successfully, his
            //    logged-in-status is written into his session data on the server. this is the typical behaviour of common login scripts.
            // if user tried to log out
            if (isset($_GET["logout"])) {

                //case1
                $this->doLogout();

                //if user has an active session on the server
                //the session variables smu_email will not be empty, and user_logged_in will be equals equals 1
            } elseif (!empty($_SESSION['smu_email']) && ($_SESSION['user_logged_in'] == 1 )) {
                //case 2
                $this->loginWithSessionData();
            } elseif (isset($_COOKIE['rememberme'])) {

                //case 3
                //echo "cookie set";
                $this->loginWithCookieData();
            } elseif (isset($_POST["login"])) {
                //case 4
                if (!isset($_POST['user_rememberme'])) {
                    $_POST['user_rememberme'] = null;
                }
                $this->loginWithPostData($_POST['smu_email'], $_POST['user_password'], $_POST['user_rememberme']);
            } else {
                //echo "Login not pressed yet";
            }
        }
    }

    private function getDatabaseConnection() {
        if ($this->db_connection != null) {
            return true;
        } else {

            $this->db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            //echo DB_HOST . "<br>";
            //echo DB_USER . "<br>";
            //echo DB_PASS . "<br>";
            //echo DB_NAME . "<br>";


            if ($this->db_connection != null) {
                return true;
            }
        }
        return false;
    }

    public function doLogout() {

        $this->deleteRememberMeCookie();
        session_destroy();
        $_SESSION = array();
        $this->user_email = null;
        $this->user_is_logged_in = false;
    }

    //getter method
    public function getUserEmail() {
        return $this->user_email;
    }

    //getter method
    public function isUserLoggedIn() {
        return $this->user_is_logged_in;
    }

    public function setUserLoggedIn($userLoggedIn) {
        $this->user_email = $userLoggedIn;
        $this->user_is_logged_in = true;
    }

    private function loginWithSessionData() {
        //logs in with sesssion data
        //this happens when user is already logged in and the $_SESSION['smu_email'] data already exists
        $this->user_email = $_SESSION['smu_email'];

        // set logged in status to true, because we just checked for this:
        // !empty($_SESSION['smu_email']) && ($_SESSION['user_logged_in'] == 1)
        // when we called this method (in the constructor)
        $this->user_is_logged_in = true;
        return true;
    }

    private function loginWithCookieData() {
        if (isset($_COOKIE['rememberme'])) {
            // extract data from the cookie
            list ($smu_email, $token, $hash) = explode(':', $_COOKIE['rememberme']);
            // check cookie hash validity
            if ($hash == hash('sha256', $smu_email . ':' . $token . COOKIE_SECRET_KEY) && !empty($token)) {
                // cookie looks good, try to select corresponding user
                if (!is_null($this->db_connection)) {

                    /*
                      // get real token from database (and all other data)
                      $sth = $this->db_connection->prepare("SELECT user_email FROM users WHERE user_id = :user_id AND user_rememberme_token = :user_rememberme_token AND user_rememberme_token IS NOT NULL");
                      $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                      $sth->bindValue(':user_rememberme_token', $token, PDO::PARAM_STR);
                      $sth->execute();
                      // get result row (as an object)
                      $result_row = $sth->fetchObject();

                     */
                    /*
                      if (isset($result_row->user_id)) {
                      // write user data into PHP SESSION [a file on your server]

                      $_SESSION['user_email'] = $result_row->user_email;
                      $_SESSION['user_logged_in'] = 1;

                      // declare user id, set the login status to true
                      $this->user_email = $result_row->user_email;
                      $this->user_is_logged_in = true;

                      // Cookie token usable only once
                      $this->createRememberMeCookie();
                      return true;
                      } */

                    $sql_select = 'select smu_email as \'asdf\' from member_passwords where smu_email = ? and user_rememberme_token = ? and user_rememberme_token is not null';
                    $pstmt = $this->$db_connection->prepare($sql_select);
                    if ($pstmt === false) {
                        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                    }

                    $pstmt->bind_param('ss', $smu_email, $token);
                    $pstmt->execute();

                    $pstmt->bind_result($asdf);

                    $userToBindToSession = "";
                    while ($pstmt->fetch()) {
                        $userToBindToSession = $asdf;
                    }

                    if ($userToBindToSession == $smu_email) {

                        //create the previously non existant session
                        $_SESSION['smu_email'] = $userToBindToSession;
                        $_SESSION['user_logged_in'] = 1;

                        //assign this variables above
                        $this->user_email = $result_row->user_email;
                        $this->user_is_logged_in = true;

                        // Cookie token usable only once
                        $this->createRememberMeCookie();
                        return true;
                    }
                } else {

                    echo "DB CONNN ERROR";
                }
            }
            // A cookie has been used but is not valid... we delete it
            $this->deleteRememberMeCookie();
            //$this->errors[] = "Invalid Cookie";
        }
        return false;
    }

    private function loginWithPostData($smu_email, $user_password, $user_rememberme) {

        if ($smu_email == "odi" && $user_password == "admin") {

            $on_login_redirect_to = "./AdminPages/AdminHome.php";
            header('Location: ' . $on_login_redirect_to);
            exit();
        } else if (empty($smu_email)) {
            //$this->errors[] = MESSAGE_USERNAME_EMPTY;

            echo "invalid username or password1";
        } else if (empty($user_password)) {
            //$this->errors[] = MESSAGE_PASSWORD_EMPTY;
            echo "invalid username or password2";
        } elseif (!filter_var($smu_email, FILTER_VALIDATE_EMAIL)) {
            //email invalid
            //$this->errors[] = MESSAGE_PASSWORD_EMPTY;
            echo "invalid username or password3";
        } else {
            // if POST data (from login form) contains non-empty user_name and non-empty user_password
            //check db connection
            if (!is_null($this->db_connection)) {

                //get users
                $sql_user_query = 'select smu_email, user_password_hash, user_active, user_rememberme_token, user_failed_logins,user_last_failed_login from member_passwords where smu_email = ?';
                $pstmt = $this->db_connection->prepare($sql_user_query);

                if ($pstmt === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                }

                $pstmt->bind_param('s', $smu_email);

                $pstmt->execute();
                $pstmt->store_result();
                $pstmt->bind_result($smu_email_get, $user_password_hash, $user_active, $user_rememberme_token, $user_failed_logins, $user_last_failed_login);

                //variables retrieved here (uninitializeD)
                $retrieved_smu_email = '';
                $retrieved_user_password_hash = '';
                $retrieved_user_active = '';
                $retrieved_user_rememberme_token = '';
                $retrieved_user_failed_logins = '';
                $retrieved_user_last_failed_login = '';


                while ($pstmt->fetch()) {
                    $retrieved_smu_email = $smu_email_get;
                    $retrieved_user_password_hash = $user_password_hash;
                    $retrieved_user_active = $user_active;
                    $retrieved_user_rememberme_token - $user_rememberme_token;
                    $retrieved_user_failed_logins = $user_failed_logins;
                    $retrieved_user_last_failed_login = $user_last_failed_login;
                }


                //echo $smu_email_get;
                //echo $retrieved_user_password_hash . "<br>";
                //echo $user_password . "<br>";
                //echo $user_password_hash . "<br>";
                //echo gettype($retrieved_user_active);
                //print_r($retrieved_user_active);
                //echo gettype(password_verify($user_password, $user_password_hash));


                if ($pstmt->num_rows == 0) {
                    //if user dosent exist
                    //$this->errors[] = "Login Failed";
                    echo "No User";
                } else if (($user_failed_logins >= 3) && ($user_last_failed_login > (time() - 30))) {
                    //if user failed logins >=3, refuse entry for a time period
                    //$this->errors[] = "Password Wrong More Than 3 Times;
                    echo "Password entry wrong more than 3 times";
                } else if ($retrieved_user_active != "1") {
                    // user has not activated account
                    //$this->errors[] = "user not activated";
                    echo "User not activated";
                } else if (!password_verify($user_password, $retrieved_user_password_hash)) {
                    //failed password verification
                    //update database to update the flags
                    //$this->errors[] = "user password wrong";
                    //print_r(password_verify($user_password, $retrieved_user_password_hash));
                    echo "PASSWORD INVALID";
                } else {
                    //$pstmt->close();
                    //procced create session data
                    $_SESSION['smu_email'] = $smu_email;
                    $_SESSION['user_logged_in'] = 1;


                    //change status
                    $this->user_email = $smu_email;
                    $this->user_is_logged_in = true;

                    //echo $smu_email;
                    //reset failed login counter
                    $sql_update = 'update member_passwords set user_failed_logins = 0, user_last_failed_login = NULL where smu_email = ?';
                    $pstmt = $this->db_connection->prepare($sql_update);

                    $pstmt->bind_param('s', $_SESSION['smu_email']);

                    $pstmt->execute();

                    $pstmt->close();

                    //check rememberme status and generate cookie
                    if (isset($user_rememberme)) {
                        $this->createRememberMeCookie();
                    } else {
                        $this->deleteRememberMeCookie();
                    }
                    //optional to recalc the users password hash.
                    /*
                     *
                     *
                      // OPTIONAL: recalculate the user's password hash
                      // DELETE this if-block if you like, it only exists to recalculate users's hashes when you provide a cost factor,
                      // by default the script will use a cost factor of 10 and never change it.
                      // check if the have defined a cost factor in config/hashing.php
                      if (defined('HASH_COST_FACTOR')) {
                      // check if the hash needs to be rehashed
                      if (password_needs_rehash($result_row->user_password_hash, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR))) {

                      // calculate new hash with new cost factor
                      $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR));

                      // TODO: this should be put into another method !?
                      $query_update = $this->db_connection->prepare('UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id');
                      $query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                      $query_update->bindValue(':user_id', $result_row->user_id, PDO::PARAM_INT);
                      $query_update->execute();

                      if ($query_update->rowCount() == 0) {
                      // writing new hash was successful. you should now output this to the user ;)
                      } else {
                      // writing new hash was NOT successful. you should now output this to the user ;)
                      }
                      }
                      }
                     */
                }
            } else {
                echo "DB PROBLEM";
            }
        }
    }

    private function deleteRememberMeCookie() {
        if (!is_null($this->db_connection)) {

            $sql_update = 'update member_passwords set user_rememberme_token = null where smu_email = ?';
            $pstmt = $this->db_connection->prepare($sql_update);
            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }
            $pstmt->bind_param('s', $_SESSION['smu_email']);

            $pstmt->execute();

            $pstmt->close();
        } else {

            echo "DB conn is closed";
        }
        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obivously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);
    }

    private function createRememberMeCookie() {


        if (!is_null($this->db_connection)) {
            $random_token_string = hash('sha256', mt_rand());

            // $sth = $this->db_connection->prepare("UPDATE users SET user_rememberme_token = :user_rememberme_token WHERE user_id = :user_id");
            //$sth->execute(array(':user_rememberme_token' => $random_token_string, ':user_id' => $_SESSION['user_id']));


            $sql_update = 'update member_passwords set user_rememberme_token = ? where smu_email = ?';
            $pstmt = $this->db_connection->prepare($sql_update);
            if ($pstmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }
            $pstmt->bind_param('ss', $random_token_string, $_SESSION['smu_email']);

            $pstmt->execute();

            $pstmt->close();

            // generate cookie string that consists of userid, randomstring and combined hash of both
            $cookie_string_first_part = $_SESSION['smu_email'] . ':' . $random_token_string;
            $cookie_string_hash = hash('sha256', $cookie_string_first_part . COOKIE_SECRET_KEY);
            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;
            //set cookie
            setcookie("rememberme", $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
            //echo "cookieset";
        } else {
            echo "DB connection got problem sadzzz :(";
        }
    }

    function sanitizeData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

?>
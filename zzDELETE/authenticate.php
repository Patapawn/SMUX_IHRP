<?php

include 'DBConnection.php';
include 'Encryption.php';
session_start();

//echo "THIS PAGE WORKS";
//echo $_POST['inputUsername'];
//echo $_POST['inputPassword'];
//no empty fields.
//if (!empty($_POST['inputUsername'])) {

if (!empty(filter_input(INPUT_POST, 'inputUsername'))) {

    $username = sanitizeData(filter_input(INPUT_POST, 'inputUsername'));
    $password = sanitizeData(filter_input(INPUT_POST, 'inputPassword'));
    //$passwordHash = generateHash(sanitizeData($_POST['inputPassword']));
    $loginSuccess = "mainMenu.php";

    /*
      echo "INPUT  " . $username;
      echo "</br>";
      echo "INPUT  " . $password;
      echo "</br>";
      echo "INPUT  " . $passwordHash;
      echo "</br>";
      echo "INPUT  " . $passwordHash;
      echo "</br>";

      //$passwordHash = generateHash($password);
     */

    $sql = "select count(*) from memberpasswords where smu_email = ? and password = ?";

    /* Prepare statement */
    $pstmt = $con->prepare($sql);
    if ($pstmt === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
    }

    /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
    $pstmt->bind_param('is', $username, $password);

    /* Execute statement */
    $pstmt->execute();



    $pstmt->bind_result($user_valid);
    while ($pstmt->fetch()) {


        echo $user_valid . '<br>';
    }

    $rs = $pstmt->get_result();


    $arr = $rs->fetch_all(MYSQLI_ASSOC);

    echo $arr;

    $stmt->close();
    mysqli_close($con);

    if (true) {

        //authenticated user
        //bind to session
        //redirect to home page
    } else {

        //invalid user and password
        //redirect back to home page just like invalid entry.
        //send error message.
    }
} else {

    $pleaseEnter = "Please enter your SMU Email and Password";
    echo $pleaseEnter;

    //return back to authenticate page, push the above message back


    mysqli_close($con);
}
?>

<?php

//FUNCTIONS

function sanitizeData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<?php

/*
  if (mysql_num_rows($result) == 0) {

  $_SESSION['username'] = "";
  header("Location: $loginFailed");
  } else {

  while ($row = mysql_fetch_array($result)) {
  //print("TEST");
  $_SESSION['username'] = $row['username'];
  $_SESSION['password'] = $row['password'];
  $_SESSION['team'] = $row['team'];
  $_SESSION['access'] = $row['Access'];
  session_write_close();
  header("Location: $loginSuccess");
  }
  }

 *
 */
?>
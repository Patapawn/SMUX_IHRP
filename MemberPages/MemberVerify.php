<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>SMUXtremists - Fun, Family & Adventure</title>

        <!-- Core CSS - Include with every page -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Page-Level Plugin CSS - Blank -->

        <!-- SB Admin CSS - Include with every page -->
        <link href="../css/sb-admin.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">




            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SMUXtremists Integrated HR Portal
                            <small>:: The Adventure Begins</small>
                        </h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <strong>Verify Member</strong>
                                <br>

                                <?php
                                require_once('../config/config.php');
                                require_once('../Controller/DBConnection.php');
                                if (isset($_GET['id']) && isset($_GET['verification_code'])) {
                                    //get variables
                                    $email_to_verify = $_GET['id'];
                                    $code_to_verify = $_GET['verification_code'];

                                    //perform update
                                    $verifymember = 'update member_passwords set user_active = 1, user_activation_hash = NULL WHERE smu_email = ? AND user_activation_hash = ?';
                                    $pstmt = $con->prepare($verifymember);
                                    if ($pstmt === false) {
                                        echo 'Wrong SQL: ' . $sql . ' Error: ';
                                    }
                                    $pstmt->bind_param('ss', $email_to_verify, $code_to_verify);
                                    $pstmt->execute();

                                    //perform query

                                    $checkUpdateSuccess = 'select exists(select * from member_passwords where smu_email = ? and user_active = 1) as \'userexists\'';
                                    $pstmt2 = $con->prepare($checkUpdateSuccess);

                                    if ($pstmt2 === false) {
                                        echo 'Wrong SQL: ' . $sql . ' Error: ';
                                    }

                                    $pstmt2->bind_param('s', $email_to_verify);

                                    $pstmt2->execute();

                                    $pstmt2->bind_result($userexists);

                                    $existingUser = -1;
                                    //echo $existingUser;
                                    //if this returns 0, the account is active.

                                    while ($pstmt2->fetch()) {
                                        //printf($userexists);
                                        $existingUser = $userexists;
                                    }

                                    //print_r($existingUser);


                                    if ($existingUser == "1") {

                                        echo "CONGRATS YOU HAVE VERIFIED YOUR ACCOUNT!";
                                    } else {

                                        echo "ERROR IN VERIFYING";
                                    }


                                    $pstmt->close();
                                    $pstmt2->close();
                                    mysqli_close($con);

                                    //echo "The Adventure Begins!"
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Core Scripts - Include with every page -->
        <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Page-Level Plugin Scripts - Blank -->

        <!-- SB Admin Scripts - Include with every page -->
        <script src="../js/sb-admin.js"></script>

        <!-- Page-Level Demo Scripts - Blank - Use for reference -->

    </body>

</html>

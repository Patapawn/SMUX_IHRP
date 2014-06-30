
<?php
ob_start();
session_start();
include('../views/_header.php');
include('../views/_protect.php');
?>

<div id="wrapper">


    <?php
    require 'MembersNavBar.php';
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">SMUXtremists Integrated HR Portal
                    <small>::Update Your Profile Here!</small>
                </h1>
            </div>
            <div class="col-lg-12">

                <?php
                //!!!!to add in a profile last updated timestamp
                //require '../Controller/DBConnection.php';

                require_once('../Model/MemberDAO.php');

                //grab array of user details
                $memberDAO = new MemberDAO();
                $memberDetails = $memberDAO->getMemberDetails($_SESSION['smu_email']);


                //print_r($memberDetails);
                //echo "<br>";
                //echo $memberDetails[0];
                //echo "<br>";
                ?>



                <div class="col-lg-6">
                    <form action="../Controller/AdditionalFieldsController.php" method="POST" role="form">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php
                                echo "Hello " . $_SESSION['smu_email'] . ",<br>Please fill in the additional information required!<br>";
                                if (isset($_GET['eventid'])) {
                                    echo "<strong>We will require these information for the event!</strong>";
                                }
                                ?>

                            </div>
                            <div class="panel-body">
                                <p>Upon clicking submit, and entering your password, you confirm that all details are correct.
                                    SMUXtremists and its associated teams will not be held responsible for any errors in information entered. </p>


                                <?php
                                if ($_SESSION['status'] == 'failure') {
                                    ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Your profile was not updated. Please check your password...
                                    </div>
                                    <?php
                                } elseif ($_SESSION['status'] == 'success') {
                                    ?>

                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        You have successfully updated your profile!
                                        <br>
                                        <?php
                                        //INPUT LOGIC HERE TO REDIRECT TO CONTINUE EVENT SIGNUP HERE.
                                        //if there is GET variable profileupdated=true,
                                        //display a button here to allow user to continue with signup of event.
                                        //this button will redirect back to signupforevent controller and the logic there will process.
                                        if (isset($_GET['eventid']) && isset($_GET['profileupdated'])) {
                                            //echo "Redirect to signupforevent controller";
                                            $eventid = htmlspecialchars($_GET['eventid']);
                                            $profileupdated = htmlspecialchars($_GET['profileupdated']);
                                            $email = $memberDetails[0];
                                            //../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '

                                            if ($profileupdated == "true") {
                                                $redirect_to = '../Controller/SignUpForEventController.php?eventid=' . $eventid . ' &email=' . $email . '&profileupdated=' . $profileupdated;
                                                ?>
                                                You may now carry on with signing up for your event :D<br>
                                                <a href="<?php echo $redirect_to; ?>"><button type="button" class="btn btn-primary btn-xs">Click ME!</button></a>

                                                <?php
                                            }
                                        }
                                        ?>



                                    </div>

                                    <?php
                                }


                                unset($_SESSION['status']);
                                ?>
                            </div>

                        </div>

                        <br>



                        <?php
                        if (isset($_GET['eventid'])) {
                            //if this get variable exists that means user was redirected from the event signup page to verify details
                            //post this value accordingly, after updating particulars the user will return to event signup process
                            $eventid = htmlspecialchars($_GET['eventid']);
                            //echo $eventid;
                            ?>
                            <input type="hidden" name="eventid" value="<?php echo $eventid; ?>">

                            <?php
                        }
                        ?>



                        <?php
                        unset($_SESSION['values']);
                        ?>
                        <button type="submit" class="btn btn-success">Submit Required Info!</button>

                    </form>
                    <br/>


                </div>




            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include('../views/_footer.php'); ?>

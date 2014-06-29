
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
                    <form action="../Controller/UpdateProfileController.php" method="POST" role="form">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php
                                echo "Hello " . $_SESSION['smu_email'] . ",<br>Please Update Your Profile Here!<br>";
                                if (isset($_GET['eventid'])) {
                                    echo "<strong>You will have to update your profile before you can continue signing up for an event</strong>";
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

                        <div class="form-group">
                            <label for="disabledSelect">SMU Email</label>
                            <input name="smuemail" class="form-control" id="disabledInput" type="text"  value ="<?php echo $memberDetails[0]; ?>" disabled autocomplete="off">
                        </div>



                        <input type="hidden" name="smuemail" value="<?php echo $memberDetails[0]; ?>">

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



                        <div class="form-group">
                            <label>Full Name</label>
                            <input name="fullname" class="form-control" placeholder="" value= "<?php echo $memberDetails[1]; ?>" disabled autocomplete="off">
                        </div>



                        <div class="form-group">
                            <label>Contact Number</label>
                            <input name="contactNum" class="form-control" placeholder="" value= "<?php echo $memberDetails[2]; ?>" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>NRIC</label>
                            <input name="nric" class="form-control" placeholder="" value= "<?php echo $memberDetails[3]; ?>" disabled required autocomplete="off">
                        </div>


                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control" disabled>
                                <option>--Please Select--</option>
                                <option value="M"<?= $memberDetails[4] == "M" ? ' selected="selected"' : '' ?>>M</option>
                                <option value="F"<?= $memberDetails[4] == "F" ? ' selected="selected"' : '' ?>>F</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Nationality</label>
                            <input name="nationality" class="form-control" placeholder="" value= "<?php echo $memberDetails[5]; ?>" disabled required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>DOB (YYYY-MM-DD)</label>
                            <input name="dob" class="form-control" placeholder="YYYY-MM-DD" value= "<?php echo $memberDetails[6]; ?>" disabled required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Dietary Preference</label>
                            <input name="diet" class="form-control" placeholder="Halal/Vegetarian/etc" value= "<?php echo $memberDetails[7]; ?>" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Full Address</label>
                            <input name="fulladdress" class="form-control" placeholder="" value= "<?php echo $memberDetails[15]; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input name="postalcode" class="form-control" pattern=".{6,}" placeholder="" value= "<?php echo $memberDetails[16]; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>NOK Name</label>
                            <input name="nokname" class="form-control" placeholder="" value= "<?php echo $memberDetails[17]; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>NOK Relation</label>
                            <input name="nokrelation" class="form-control" placeholder="" value= "<?php echo $memberDetails[18]; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>NOK Contact</label>
                            <input name="nokcontact" class="form-control" placeholder="" value= "<?php echo $memberDetails[19]; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Medical Conditions/ Allergies</label>
                            <input name="medcondition" class="form-control" placeholder="" value= "<?php echo $memberDetails[8]; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Blood Type</label>
                            <select name="bloodtype" class="form-control" >
                                <option>--Please Select--</option>
                                <option value="DK"<?= $memberDetails[9] == "DK" ? ' selected="selected"' : '' ?>>Don't Know</option>
                                <option value="O+"<?= $memberDetails[9] == "O+" ? ' selected="selected"' : '' ?>>O+</option>
                                <option value="O"<?= $memberDetails[9] == "O" ? ' selected="selected"' : '' ?>>O</option>
                                <option value="O-"<?= $memberDetails[9] == "O-" ? ' selected="selected"' : '' ?>>O-</option>
                                <option value="A+"<?= $memberDetails[9] == "A+" ? ' selected="selected"' : '' ?>>A+</option>
                                <option value="A"<?= $memberDetails[9] == "A" ? ' selected="selected"' : '' ?>>A</option>
                                <option value="A-+"<?= $memberDetails[9] == "A-" ? ' selected="selected"' : '' ?>>A-</option>
                                <option value="B+"<?= $memberDetails[9] == "B+" ? ' selected="selected"' : '' ?>>B+</option>
                                <option value="B"<?= $memberDetails[9] == "B" ? ' selected="selected"' : '' ?>>B</option>
                                <option value="B-"<?= $memberDetails[9] == "B-" ? ' selected="selected"' : '' ?>>B-</option>
                                <option value="AB+"<?= $memberDetails[9] == "AB+" ? ' selected="selected"' : '' ?>>AB+</option>
                                <option value="AB"<?= $memberDetails[9] == "AB" ? ' selected="selected"' : '' ?>>AB</option>
                                <option value="AB-"<?= $memberDetails[9] == "AB-" ? ' selected="selected"' : '' ?>>AB-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Shirt Size</label>
                            <select name="shirtsize" class="form-control" >
                                <option>--Please Select--</option>
                                <option value="XS"<?= $memberDetails[10] == "XS" ? ' selected="selected"' : '' ?>>XS</option>
                                <option value="S"<?= $memberDetails[10] == "S" ? ' selected="selected"' : '' ?>>S</option>
                                <option value="M"<?= $memberDetails[10] == "M" ? ' selected="selected"' : '' ?>>M</option>
                                <option value="L"<?= $memberDetails[10] == "L" ? ' selected="selected"' : '' ?>>L</option>
                                <option value="XL"<?= $memberDetails[10] == "XL" ? ' selected="selected"' : '' ?>>XL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Primary Team</label>
                            <select name="primaryteam" class="form-control">
                                <option>--Please Select--</option>
                                <option value="Biking"<?= $memberDetails[11] == "Biking" ? ' selected="selected"' : '' ?>>Biking</option>
                                <option value="Diving"<?= $memberDetails[11] == "Diving" ? ' selected="selected"' : '' ?>>Diving</option>
                                <option value="Kayaking"<?= $memberDetails[11] == "Kayaking" ? ' selected="selected"' : '' ?>>Kayaking</option>
                                <option value="Skating"<?= $memberDetails[11] == "Skating" ? ' selected="selected"' : '' ?>>Skating</option>
                                <option value="Trekking"<?= $memberDetails[11] == "Trekking" ? ' selected="selected"' : '' ?>>Trekking</option>
                                <option value="Xseed"<?= $memberDetails[11] == "Xseed" ? ' selected="selected"' : '' ?>>Xseed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Secondary Team</label>
                            <select name="secondaryteam" class="form-control">
                                <option>--Please Select--</option>
                                <option value="Biking"<?= $memberDetails[12] == "Biking" ? ' selected="selected"' : '' ?>>Biking</option>
                                <option value="Diving"<?= $memberDetails[12] == "Diving" ? ' selected="selected"' : '' ?>>Diving</option>
                                <option value="Kayaking"<?= $memberDetails[12] == "Kayaking" ? ' selected="selected"' : '' ?>>Kayaking</option>
                                <option value="Skating"<?= $memberDetails[12] == "Skating" ? ' selected="selected"' : '' ?>>Skating</option>
                                <option value="Trekking"<?= $memberDetails[12] == "Trekking" ? ' selected="selected"' : '' ?>>Trekking</option>
                                <option value="Xseed"<?= $memberDetails[12] == "Xseed" ? ' selected="selected"' : '' ?>>Xseed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Driving License?</label>
                            <select name="drivinglicense" class="form-control">
                                <option>--Please Select--</option>
                                <option value="2/2A/2B"<?= $memberDetails[14] == "2/2A/2B" ? ' selected="selected"' : '' ?>>2/2A/2B</option>
                                <option value="3/3A"<?= $memberDetails[14] == "3/3A" ? ' selected="selected"' : '' ?>>3/3A</option>
                                <option value="4"<?= $memberDetails[14] == "4" ? ' selected="selected"' : '' ?>>4</option>
                                <option value="5"<?= $memberDetails[14] == "5" ? ' selected="selected"' : '' ?>>5</option>
                            </select>
                        </div>



                        <div class="form-group">
                            <label>Please enter your password to confirm change of details:</label>
                            <input name ="password" type="password" class="form-control" placeholder="password for SMUX account" required autocomplete="off">
                        </div>



                        <?php
                        unset($_SESSION['values']);
                        ?>
                        <button type="submit" class="btn btn-success">Update My Profile!</button>

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

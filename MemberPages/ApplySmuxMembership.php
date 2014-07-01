<?php
ob_start();
include('../views/_header.php');
?>

<div id="wrapper">




    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">SMUXtremists Integrated HR Portal
                    <small>:: Join The Family!</small>
                </h1>
            </div>

            <div class="panel-body">
                <div class="row">

                    <?php
                    //require 'NavBar.php';
                    //
                            session_start();
                    //get post data if error.
                    //echo empty($_SESSION['errors']);
                    if ($_SESSION['errors'] != NULL) {
                        //echo gettype($_SESSION["errors"]);
                        //print_r($_SESSION['errors']);


                        echo '<div class="alert alert-danger alert-dismissable">';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        //echo 'irst' . $errorsArray[0];
                        echo 'ERROR!' . '<br>';

                        foreach ($_SESSION['errors'] as $key => $value) {

                            echo "$value" . "<br>";
                        }




                        echo '</div>';

                        unset($_SESSION['errors']);
                    }
                    ?>


                    <div class="col-lg-6">
                        <form action="../Controller/ValidateApplySmuxMembership.php" method="POST" role="form">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    some text to inform people about the $15 payment and whatever here
                                </div>
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                </div>
                                <div class="panel-footer">
                                    Panel Footer
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                <label>FULL SMU Email (Needs to be valid)</label>
                                <input name="email" id="user_email" type="email" class="form-control" placeholder="abc@xxx.smu.edu.sg" value= "<?php echo $_SESSION['values'][0]; ?>">

                            </div>

                            <div class="form-group">
                                <label>Alternate / Secondary Email Address</label>
                                <input name="alt_email" id="user_email" type="email" class="form-control" placeholder="abc@xxx.com" value= "<?php echo $_SESSION['values'][1]; ?>">

                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input name ="password" type="password" class="form-control" placeholder="password for SMUX account" pattern=".{6,}" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input name ="password2" type="password" class="form-control" placeholder="" pattern=".{6,}" required autocomplete="off">
                            </div>


                            <div class="form-group">
                                <label>Full Name</label>
                                <input name="fullname" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][2]; ?>" required autocomplete="off">
                            </div>


                            <div class="form-group">
                                <label>Contact Number</label>
                                <input name="contactNum" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][3]; ?>" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>NRIC</label>
                                <input name="nric" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][4]; ?>" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control" >
                                    <option>--Please Select--</option>
                                    <option value="M"<?= $_SESSION['values'][5] == "M" ? ' selected="selected"' : '' ?>>M</option>
                                    <option value="F"<?= $_SESSION['values'][5] == "F" ? ' selected="selected"' : '' ?>>F</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Nationality</label>
                                <input name="nationality" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][6]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>DOB (YYYY-MM-DD)</label>
                                <input name="dob" class="form-control" placeholder="YYYY-MM-DD" value= "<?php echo $_SESSION['values'][7]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Dietary Preference</label>
                                <input name="diet" class="form-control" placeholder="Halal/Vegetarian/etc" value= "<?php echo $_SESSION['values'][8]; ?>" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Full Address</label>
                                <input name="fulladdress" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][9]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input name="postalcode" class="form-control" pattern=".{6,}" placeholder="" value= "<?php echo $_SESSION['values'][10]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Next-Of-Kin Name</label>
                                <input name="nokname" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][11]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Next-Of-Kin Relation</label>
                                <input name="nokrelation" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][12]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Next-Of-Kin Contact</label>
                                <input name="nokcontact" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][13]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Medical Conditions/ Allergies</label>
                                <input name="medcondition" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][14]; ?>" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select name="bloodtype" class="form-control" >
                                    <option>--Please Select--</option>
                                    <option value="DK"<?= $_SESSION['values'][15] == "DK" ? ' selected="selected"' : '' ?>>Don't Know</option>
                                    <option value="O+"<?= $_SESSION['values'][15] == "O+" ? ' selected="selected"' : '' ?>>O+</option>
                                    <option value="O"<?= $_SESSION['values'][15] == "O" ? ' selected="selected"' : '' ?>>O</option>
                                    <option value="O-"<?= $_SESSION['values'][15] == "O-" ? ' selected="selected"' : '' ?>>O-</option>
                                    <option value="A+"<?= $_SESSION['values'][15] == "A+" ? ' selected="selected"' : '' ?>>A+</option>
                                    <option value="A"<?= $_SESSION['values'][15] == "A" ? ' selected="selected"' : '' ?>>A</option>
                                    <option value="A-+"<?= $_SESSION['values'][15] == "A-" ? ' selected="selected"' : '' ?>>A-</option>
                                    <option value="B+"<?= $_SESSION['values'][15] == "B+" ? ' selected="selected"' : '' ?>>B+</option>
                                    <option value="B"<?= $_SESSION['values'][15] == "B" ? ' selected="selected"' : '' ?>>B</option>
                                    <option value="B-"<?= $_SESSION['values'][15] == "B-" ? ' selected="selected"' : '' ?>>B-</option>
                                    <option value="AB+"<?= $_SESSION['values'][15] == "AB+" ? ' selected="selected"' : '' ?>>AB+</option>
                                    <option value="AB"<?= $_SESSION['values'][15] == "AB" ? ' selected="selected"' : '' ?>>AB</option>
                                    <option value="AB-"<?= $_SESSION['values'][15] == "AB-" ? ' selected="selected"' : '' ?>>AB-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Shirt Size</label>
                                <select name="shirtsize" class="form-control" >
                                    <option>--Please Select--</option>
                                    <option value="XS"<?= $_SESSION['values'][16] == "XS" ? ' selected="selected"' : '' ?>>XS</option>
                                    <option value="S"<?= $_SESSION['values'][16] == "S" ? ' selected="selected"' : '' ?>>S</option>
                                    <option value="M"<?= $_SESSION['values'][16] == "M" ? ' selected="selected"' : '' ?>>M</option>
                                    <option value="L"<?= $_SESSION['values'][16] == "L" ? ' selected="selected"' : '' ?>>L</option>
                                    <option value="XL"<?= $_SESSION['values'][16] == "XL" ? ' selected="selected"' : '' ?>>XL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Primary Team</label>
                                <select name="primaryteam" class="form-control">
                                    <option>--Please Select--</option>
                                    <option value="Biking"<?= $_SESSION['values'][17] == "Biking" ? ' selected="selected"' : '' ?>>Biking</option>
                                    <option value="Diving"<?= $_SESSION['values'][17] == "Diving" ? ' selected="selected"' : '' ?>>Diving</option>
                                    <option value="Kayaking"<?= $_SESSION['values'][17] == "Kayaking" ? ' selected="selected"' : '' ?>>Kayaking</option>
                                    <option value="Skating"<?= $_SESSION['values'][17] == "Skating" ? ' selected="selected"' : '' ?>>Skating</option>
                                    <option value="Trekking"<?= $_SESSION['values'][17] == "Trekking" ? ' selected="selected"' : '' ?>>Trekking</option>
                                    <option value="Xseed"<?= $_SESSION['values'][17] == "Xseed" ? ' selected="selected"' : '' ?>>Xseed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Secondary Team</label>
                                <select name="secondaryteam" class="form-control">
                                    <option>--Please Select--</option>
                                    <option value="Biking"<?= $_SESSION['values'][18] == "Biking" ? ' selected="selected"' : '' ?>>Biking</option>
                                    <option value="Diving"<?= $_SESSION['values'][18] == "Diving" ? ' selected="selected"' : '' ?>>Diving</option>
                                    <option value="Kayaking"<?= $_SESSION['values'][18] == "Kayaking" ? ' selected="selected"' : '' ?>>Kayaking</option>
                                    <option value="Skating"<?= $_SESSION['values'][18] == "Skating" ? ' selected="selected"' : '' ?>>Skating</option>
                                    <option value="Trekking"<?= $_SESSION['values'][18] == "Trekking" ? ' selected="selected"' : '' ?>>Trekking</option>
                                    <option value="Xseed"<?= $_SESSION['values'][18] == "Xseed" ? ' selected="selected"' : '' ?>>Xseed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Driving License?</label>
                                <select name="drivinglicense" class="form-control">
                                    <option>--Please Select--</option>
                                    <option value="2/2A/2B"<?= $_SESSION['values'][19] == "2/2A/2B" ? ' selected="selected"' : '' ?>>2/2A/2B</option>
                                    <option value="3/3A"<?= $_SESSION['values'][19] == "3/3A" ? ' selected="selected"' : '' ?>>3/3A</option>
                                    <option value="4"<?= $_SESSION['values'][19] == "4" ? ' selected="selected"' : '' ?>>4</option>
                                    <option value="5"<?= $_SESSION['values'][19] == "5" ? ' selected="selected"' : '' ?>>5</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label>Alumni?</label>
                                <label class="radio-inline">
                                    <input type="radio" name="alumni" id="optionsRadiosInline1" value="Y" >Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="alumni" id="optionsRadiosInline2" value="N" checked>No
                                </label>

                            </div>

                            <div class="form-group">


                                <label>
                                    <?php
                                    echo "Enter The Magic Word:";
                                    ?>
                                </label>
                                <img src="../tools/showCaptcha.php" alt="captcha" />
                                <input class="form-control" name="captcha" required autocomplete="off" />
                            </div>



                            <?php
                            unset($_SESSION['values']);
                            ?>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-success">Become A Member!</button>

                        </form>
                        <br/>


                    </div>

                    <!-- /.col-lg-6 (nested) -->


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
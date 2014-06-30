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


            <?php
            require '../AdminPages/NavBar.php';
            ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SMUXtremists Integrated HR Portal
                            <small>::Create New Member Profile</small>
                        </h1>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Enter Member Information Here

                                        <?php
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
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">




                                            <div class="col-lg-6">
                                                <form action="../Controller/ValidateCreateMember.php" method="POST" role="form">


                                                    <div class="form-group">
                                                        <label>SMU Email</label>
                                                        <input name="email" class="form-control" placeholder="abc@xxx.smu.edu.sg" value= "<?php echo $_SESSION['values'][0]; ?>">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Alternate / Secondary Email</label>
                                                        <input name="alt_email" class="form-control" placeholder="abc@xxx.com" value= "<?php echo $_SESSION['values'][1]; ?>">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input name ="password" type="text" class="form-control" placeholder="">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input name="fullname" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][2]; ?>">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input name="contactNum" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][3]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>NRIC</label>
                                                        <input name="nric" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][4]; ?>">
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
                                                        <input name="nationality" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][6]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>DOB (YYYY-MM-DD)</label>
                                                        <input name="dob" class="form-control" placeholder="YYYY-MM-DD" value= "<?php echo $_SESSION['values'][7]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Dietary Preference</label>
                                                        <input name="diet" class="form-control" placeholder="Halal/Vegetarian/etc" value= "<?php echo $_SESSION['values'][8]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Full Address</label>
                                                        <input name="fulladdress" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][9]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Postal Code( CHANGE THIS, add validation)</label>
                                                        <input name="postalcode" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][10]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NOK Name</label>
                                                        <input name="nokname" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][11]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NOK Relation</label>
                                                        <input name="nokrelation" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][12]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NOK Contact</label>
                                                        <input name="nokcontact" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][13]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Medical Conditions/ Allergies</label>
                                                        <input name="medcondition" class="form-control" placeholder="" value= "<?php echo $_SESSION['values'][14]; ?>">
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



                                                    <?php
                                                    unset($_SESSION['values']);
                                                    ?>
                                                    <button type="reset" class="btn btn-default">Reset</button>
                                                    <button type="submit" class="btn btn-success">Become A Member!</button>

                                                </form>
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

                        <!-- Core Scripts - Include with every page -->
                        <script src="../js/jquery-1.10.2.js"></script>
                        <script src="../js/bootstrap.min.js"></script>
                        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

                        <!-- Page-Level Plugin Scripts - Blank -->

                        <!-- SB Admin Scripts - Include with every page -->
                        <script src="../js/sb-admin.js"></script>

                        <!-- Page-Level Demo Scripts - Blan for reference -->
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>

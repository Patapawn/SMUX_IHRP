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
                            <small>::Create New Event</small>
                        </h1>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Create An Awesome Event!</h4>

                                        <?php
                                        session_start();




                                        //IF NO ERROR: GIVE USER A CONFIRMATION NOTE
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
                                        } else {

                                            if ($_SESSION['success'] != NULL) {
                                                echo'<div class="alert alert-success alert-dismissable">';
                                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                                echo 'Successfully Created Event!' . '<br>';
                                                unset($_SESSION['success']);
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">


                                            <div class="col-lg-6">



                                                <form action="../Controller/ValidateCreateEvent.php" method="POST" role="form">



                                                    <div class="form-group">
                                                        <label>Event Name</label>
                                                        <input name="eventname" class="form-control" value= "<?php echo $_SESSION['values'][0]; ?>">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Team</label>
                                                        <select name="team" class="form-control" >
                                                            <option>--Please Select--</option>
                                                            <option value="Biking"<?= $_SESSION['values'][1] == "Biking" ? ' selected="selected"' : '' ?>>Biking</option>
                                                            <option value="Diving"<?= $_SESSION['values'][1] == "Diving" ? ' selected="selected"' : '' ?>>Diving</option>
                                                            <option value="Skating"<?= $_SESSION['values'][1] == "Skating" ? ' selected="selected"' : '' ?>>Skating</option>
                                                            <option value="Kayaking"<?= $_SESSION['values'][1] == "Kayaking" ? ' selected="selected"' : '' ?>>Kayaking</option>
                                                            <option value="Trekking"<?= $_SESSION['values'][1] == "Trekking" ? ' selected="selected"' : '' ?>>Trekking</option>
                                                            <option value="Xseed"<?= $_SESSION['values'][1] == "Xseed" ? ' selected="selected"' : '' ?>>Xseed</option>
                                                            <option value="SMUX"<?= $_SESSION['values'][1] == "SMUX" ? ' selected="selected"' : '' ?>>SMUX</option>

                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Event Type</label>
                                                        <select name="eventtype" class="form-control" >
                                                            <option>--Please Select--</option>
                                                            <option value="Team AdHoc"<?= $_SESSION['values'][2] == "Team AdHoc" ? ' selected="selected"' : '' ?>>Team AdHoc</option>
                                                            <option value="Team Welfare"<?= $_SESSION['values'][2] == "Team Welfare" ? ' selected="selected"' : '' ?>>Team Welfare</option>
                                                            <option value="Team Signature"<?= $_SESSION['values'][2] == "Team Signature" ? ' selected="selected"' : '' ?>>Team Signature</option>
                                                            <option value="SMUX AdHoc"<?= $_SESSION['values'][2] == "SMUX AdHoc" ? ' selected="selected"' : '' ?>>SMUX AdHoc</option>
                                                            <option value="SMUX Signature"<?= $_SESSION['values'][2] == "SMUX Signature" ? ' selected="selected"' : '' ?>>SMUX Signature</option>
                                                            <option value="SMUX Welfare"<?= $_SESSION['values'][2] == "SMUX Welfare" ? ' selected="selected"' : '' ?>>SMUX Welfare</option>                                                        </select>
                                                    </div>



                                                    <div class="form-group">
                                                        <label>Event Date (YYYY-MM-DD)</label>
                                                        <input name="eventdate" class="form-control" placeholder="YYYY-MM-DD" value= "<?php echo $_SESSION['values'][3]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Event Description</label>
                                                        <textarea name = "eventdescription"class="form-control" rows="3" placeholder="Some useful info for participants here"><?php echo $_SESSION['values'][4]; ?></textarea>
                                                    </div>




                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <strong>Optional Additional Fields For Form</strong><br><br>
                                                            <i>Additional Field- eg. Helmet Size<br>
                                                                Description- anything you wish to tell participants<br>
                                                                Type- checkbox, dropdown list, or radio button<br>
                                                                Choices- MUST MUST MUST use commas and quotes to seperate values. eg "XS", "S", "M", "L", "XL"<br>
                                                            </i><br>
                                                            Add/Remove actions apply only to entries with checked boxes<br>
                                                            <strong>*If event does not require additional information, type NONE in the first box*</strong>
                                                            <br><br>
                                                            <input type="button" value="Add Row" class="btn btn-outline btn-success" onClick="addRow('dataTable')" />
                                                            <input type="button" value="Remove Row" class="btn btn-outline btn-warning" onClick="deleteRow('dataTable')"  />
                                                        </div>

                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered table-hover" id="dataTable">

                                                                    <thead>
                                                                        <tr>
                                                                            <th>Select</th>
                                                                            <th>Additional Field</th>
                                                                            <th>Description</th>
                                                                            <th>Type</th>
                                                                            <th>Choices</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <tr>
                                                                            <td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
                                                                            <td><input type="text" required="required" name="field_name[]"></td>
                                                                            <td><input type="text" required="required" name="field_description[]"></td>
                                                                            <td><select id="field_type" name="field_type[]" required="required">
                                                                                    <option>--Please Select--</option>
                                                                                    <option>Textbox</option>
                                                                                    <option>Dropdown</option>
                                                                                    <option>Checkbox</option>

                                                                                </select></td>
                                                                            <td><input type="text" required="required" name="field_choices[]"></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- /.table-responsive -->
                                                        </div>
                                                        <!-- /.panel-body -->
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Allow Signups?</label>
                                                        <select name="allowsignups" class="form-control" >
                                                            <option>--Please Select--</option>
                                                            <option value="Y"<?= $_SESSION['values'][5] == "Y" ? ' selected="selected"' : '' ?>>Yes</option>
                                                            <option value="N"<?= $_SESSION['values'][5] == "N" ? ' selected="selected"' : '' ?>>No</option>
                                                        </select>
                                                    </div>



                                                    <br>





                                                    <?php
                                                    unset($_SESSION['values']);
                                                    ?>
                                                    <button type="reset" class="btn btn-default">Reset</button>
                                                    <button type="submit" class="btn btn-success">Create New Event!</button>

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
                        <script src="../js/dynamicformscript.js"></script>
                        <!-- SB Admin Scripts - Include with every page -->
                        <script src="../js/sb-admin.js"></script>

                        <!-- Page-Level Demo Scripts - Blan for reference -->
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>

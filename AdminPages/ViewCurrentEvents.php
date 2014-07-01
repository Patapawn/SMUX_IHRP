<?php
ob_start();
session_start();
include('../views/_header.php');
?>

<div id="wrapper">


    <?php
    require '../AdminPages/NavBar.php';
    require "../Controller/DBConnection.php";

    $sql_select = "select * from event where allow_signups = 'y'";

    $stmt = $con->prepare($sql_select);
    if ($stmt === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
    }
    $stmt->execute();
    $stmt->bind_result($event_id, $event_id_md5, $event_name, $team, $event_type, $event_date, $description, $additional_fields, $allow_signups);
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">SMUXtremists Integrated HR Portal</h1>
            </div>
            <div class="col-lg-12">



                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Events Open For Signups
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Event ID</th>
                                        <th>Team</th>
                                        <th>Event Name</th>
                                        <th>Event Date</th>
                                        <th>Description</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($stmt->fetch()) {

                                        echo '<tr>';
                                        echo '<td>' . $event_id . '</td>';
                                        echo '<td>' . $team . '</td>';
                                        echo '<td>' . $event_name . '</td>';
                                        echo '<td>' . $event_date . '</td>';
                                        echo '<td>' . $description . '</td>';
                                        echo '<td>' . "Edit" . '</td>';

                                        echo '</tr>';
                                        //echo $nric . ', ' . $smu_email . ', ' . $full_name . ', ' . $contact_number . '<br>';
                                    }

                                    $stmt->close();
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!--/.table-responsive -->
                    </div>
                    <!--/.panel-body -->
                </div>
                <!--/.panel -->



                <?php
                $sql_select = "select * from event where allow_signups = 'n' order by event_date desc";

                $stmt = $con->prepare($sql_select);
                if ($stmt === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                }
                $stmt->execute();
                $stmt->bind_result($event_id, $event_id_md5, $event_name, $team, $event_type, $event_date, $description, $additional_fields, $allow_signups);
                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Events Which Signups Have Closed
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Event ID</th>
                                        <th>Team</th>
                                        <th>Event Name</th>
                                        <th>Event Date</th>
                                        <th>Description</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($stmt->fetch()) {

                                        echo '<tr>';
                                        echo '<td>' . $event_id . '</td>';
                                        echo '<td>' . $team . '</td>';
                                        echo '<td>' . $event_name . '</td>';
                                        echo '<td>' . $event_date . '</td>';
                                        echo '<td>' . $description . '</td>';
                                        echo '<td>' . "Edit" . '</td>';

                                        echo '</tr>';
                                        //echo $nric . ', ' . $smu_email . ', ' . $full_name . ', ' . $contact_number . '<br>';
                                    }

                                    $stmt->close();
                                    $con->close();
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!--/.table-responsive -->
                    </div>
                    <!--/.panel-body -->
                </div>
                <!--/.panel -->








            </div>
            <!--/.col-lg-12 -->
        </div>
        <!--/.row -->
    </div>
    <!--/#page-wrapper -->

</div>
<!--/#wrapper -->

<!--Core Scripts - Include with every page -->
<script src = "../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Page-Level Plugin Scripts - Blank -->

<!-- SB Admin Scripts - Include with every page -->
<script src="../js/sb-admin.js"></script>

<!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>

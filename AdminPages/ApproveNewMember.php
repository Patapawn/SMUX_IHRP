<?php
ob_start();
?>

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
        <!-- Page-Level Plugin CSS - Tables -->
        <link href="../css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

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
                        <h1 class="page-header">SMUXtremists Integrated HR Portal</h1>
                    </div>
                    <div class="col-lg-12">


                        <?php
                        require "../Controller/DBConnection.php";
                        //THING TO NOTE:
                        //APPROVED MEMBERS WILL HAVE 2 DIFFERENT TIMESTAMPS, UNDER SMUX_MEMBERS.SMUX_MEMBER_AS_OF WILL BE UPDATED WITH THE APPROVAL TIME
                        //IN MEMBER_PASSWORDS.USER_REGISTRATION_DATETIME THAT WILL BE THE ACTUAL TIME USER REGISTERED
                        //THUS TO CHECK IF MEMBER HAS BEEN APPROVED, SMUX_MEMBER_AS_OF WILL BE LATER THAN USER_REGISTRATION_DATETIME
                        //IF NOT, BOTH STAMPS WILL BE THE SAME

                        $sql = 'select nric, smux_members.smu_email, full_name, contact_number, paid_membership from smux_members inner join member_flags on smux_members.smu_email = member_flags.smu_email where paid_membership = \'N\'';


                        /* Prepare statement */
                        $stmt = $con->prepare($sql);
                        if ($stmt === false) {
                            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                        }

                        /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
                        //$stmt->bind_param(' is', $id_greater_than, $firstname);

                        /* Execute statement */
                        $stmt->execute();

                        //iterate over results

                        $stmt->bind_result($nric, $smu_email, $full_name, $contact_number, $paid_membership);
                        ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Members- Signed Up but NOT paid
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>NRIC</th>
                                                <th>SMU Email</th>
                                                <th>Full Name</th>
                                                <th>Contact Number</th>
                                                <th>Paid?</th>
                                                <th>Mark As Paid?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($stmt->fetch()) {

                                                echo '<tr>';
                                                echo '<td>' . $nric . ' </td>';
                                                echo '<td>' . $smu_email . ' </td>';
                                                echo '<td>' . $full_name . ' </td>';
                                                echo '<td>' . $contact_number . ' </td>';
                                                echo '<td>' . "$paid_membership" . ' </td>';
                                                echo '<td>' .
                                                "<a href=\"../Controller/MarkAsPaid.php?emailToMark=" . $smu_email . "\"><button type=\"button\" class=\"btn btn-default btn-circle\">
                                                     <i class=\"fa fa-check\"></i>
                                                    </button></a>" .
                                                ' </td>';

                                                echo '</tr>';
                                                //echo $nric . ', ' . $smu_email . ', ' . $full_name . ', ' . $contact_number . '<br>';
                                            }

                                            $stmt->close();
                                            $con->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->



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
        <!-- Page-Level Plugin Scripts - Tables -->
        <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

        <!-- SB Admin Scripts - Include with every page -->
        <script src="../js/sb-admin.js"></script>

        <!-- Page-Level Demo Scripts - Blank - Use for reference -->
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').dataTable();
            });
        </script>

    </body>

</html>

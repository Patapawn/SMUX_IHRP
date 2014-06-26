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
            require "../Controller/DBConnection.php";

            //query from db here
            //$sql = 'SELECT lastname, email FROM customers WHERE id > ? AND firstname = ?';
            //$id_greater_than = 5;
            //$firstname = 'John';

            $sql = 'select nric, smu_email, full_name, contact_number from smux_members';


            /* Prepare statement */
            $stmt = $con->prepare($sql);
            if ($stmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
            }

            /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
            //$stmt->bind_param('is', $id_greater_than, $firstname);

            /* Execute statement */
            $stmt->execute();

            //iterate over results


            $stmt->bind_result($nric, $smu_email, $full_name, $contact_number);



            /*
              //store to array

              $rs = $stmt->get_result();
              $arr = $rs->fetch_all(MYSQLI_ASSOC);
             *
             *
             *
             */
            ?>


            <div id="page-wrapper">


                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SMUXtremists Integrated HR Portal
                            <small>::Search Member Database</small>
                        </h1>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Search Member
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
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    while ($stmt->fetch()) {

                                                        echo '<tr>';
                                                        echo '<td>' . $nric . '</td>';
                                                        echo '<td>' . $smu_email . '</td>';
                                                        echo '<td>' . $full_name . '</td>';
                                                        echo '<td>' . $contact_number . '</td>';
                                                        echo '<td>' . "Edit" . '</td>';

                                                        echo '</tr>';
                                                        //echo $nric . ', ' . $smu_email . ', ' . $full_name . ', ' . $contact_number . '<br>';
                                                    }

                                                    $stmt->close();
                                                    $con->close();
                                                    ?>

                                                    <!--
                                                    <tr>
                                                        <td>Trident</td>
                                                        <td>asfdasd</td>
                                                        <td>Internet Explorer 4.0</td>
                                                        <td>Win 95+</td>
                                                        <td>Edit</td>

                                                    </tr>

                                                    -->

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

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
                    <small>:: Embark On An Adventure!</small>
                </h1>


            </div>
            <div class="col-lg-12">

                <?php
                //echo $_COOKIE['rememberme'];
                //print_r($_COOKIE);

                require "../Controller/DBConnection.php";


                $sql_select = 'select event_id, event_name, event_date, description from event where team =? and allow_signups =? order by event_date asc';


                $stmt = $con->prepare($sql_select);
                if ($stmt === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
                }




                $biking = 'Biking';
                $diving = 'Diving';
                $kayaking = 'Kayaking';
                $skating = 'Skating';
                $trekking = 'Trekking';
                $xseed = 'Xseed';
                $smux = 'SMUX';

                //only display events which signups are allowed hor!!!
                $allow_signups = 'Y';


                $user_logged_in = $_SESSION['smu_email'];
                ?>





                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo "Hello " . $user_logged_in . ",<br> An Awesome Adventure Awaits YOU!" ?>
                            </div>
                            <!-- .panel-heading -->
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#SMUX">SMUX Wide Events</a>
                                            </h4>
                                        </div>
                                        <div id="SMUX" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php
                                                $stmt->bind_param('ss', $smux, $allow_signups);
                                                $stmt->execute();
                                                $stmt->store_result();
                                                $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                if ($stmt->num_rows > 0) {
                                                    while ($stmt->fetch()) {
                                                        $event_id_hash = md5($event_id);
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                        echo '<p>' . $description . '</p>';
                                                        echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<div class="col-lg-12">';
                                                    echo '<div class="well well-sm">';
                                                    echo '<h4>Currently On An Adventure...</h4>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#biking">Biking Team Events</a>
                                            </h4>
                                        </div>
                                        <div id="biking" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php
                                                $stmt->bind_param('ss', $biking, $allow_signups);
                                                $stmt->execute();
                                                $stmt->store_result();
                                                $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                if ($stmt->num_rows > 0) {
                                                    while ($stmt->fetch()) {
                                                        $event_id_hash = md5($event_id);
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                        echo '<p>' . $description . '</p>';
                                                        echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<div class="col-lg-12">';
                                                    echo '<div class="well well-sm">';
                                                    echo '<h4>Currently On An Adventure...</h4>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#diving">Diving Team Events</a>
                                            </h4>
                                        </div>
                                        <div id="diving" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="col-lg-12">
                                                    <?php
                                                    $stmt->bind_param('ss', $diving, $allow_signups);
                                                    $stmt->execute();
                                                    $stmt->store_result();
                                                    $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                    if ($stmt->num_rows > 0) {
                                                        while ($stmt->fetch()) {
                                                            $event_id_hash = md5($event_id);
                                                            echo '<div class="col-lg-12">';
                                                            echo '<div class="well well-sm">';
                                                            echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                            echo '<p>' . $description . '</p>';
                                                            echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>Currently On An Adventure...</h4>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#kayaking">Kayaking Team Events</a>
                                            </h4>
                                        </div>
                                        <div id="kayaking" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="col-lg-12">
                                                    <?php
                                                    $stmt->bind_param('ss', $kayaking, $allow_signups);
                                                    $stmt->execute();
                                                    $stmt->store_result();
                                                    $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                    //"<a href=\"../Controller/MarkAsPaid.php?emailToMark=" . $smu_email . "\"><button type=\"button\" class=\"btn btn-default btn-circle\">
                                                    //<i class=\"fa fa-check\"></i>
                                                    //</button></a>"

                                                    if ($stmt->num_rows > 0) {
                                                        while ($stmt->fetch()) {
                                                            $event_id_hash = md5($event_id);
                                                            echo '<div class="col-lg-12">';
                                                            echo '<div class="well well-sm">';
                                                            echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                            echo '<p>' . $description . '</p>';
                                                            echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>Currently On An Adventure...</h4>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#Skating">Skating Team Events</a>
                                            </h4>
                                        </div>
                                        <div id="Skating" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <?php
                                                $stmt->bind_param('ss', $skating, $allow_signups);
                                                $stmt->execute();
                                                $stmt->store_result();
                                                $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                if ($stmt->num_rows > 0) {
                                                    while ($stmt->fetch()) {
                                                        $event_id_hash = md5($event_id);
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                        echo '<p>' . $description . '</p>';
                                                        echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<div class="col-lg-12">';
                                                    echo '<div class="well well-sm">';
                                                    echo '<h4>Currently On An Adventure...</h4>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                ?>





                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#trekking">Trekking Team Events</a>
                                            </h4>
                                        </div>
                                        <div id="trekking" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <?php
                                                $stmt->bind_param('ss', $trekking, $allow_signups);
                                                $stmt->execute();
                                                $stmt->store_result();
                                                $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                if ($stmt->num_rows > 0) {
                                                    while ($stmt->fetch()) {
                                                        $event_id_hash = md5($event_id);
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                        echo '<p>' . $description . '</p>';
                                                        echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<div class="col-lg-12">';
                                                    echo '<div class="well well-sm">';
                                                    echo '<h4>Currently On An Adventure...</h4>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#xseed">Xseed Team Events</a>
                                            </h4>
                                        </div>
                                        <div id="xseed" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="col-lg-12">
                                                    <?php
                                                    $stmt->bind_param('ss', $xseed, $allow_signups);
                                                    $stmt->execute();
                                                    $stmt->store_result();
                                                    $stmt->bind_result($event_id, $event_name, $event_date, $description);


                                                    if ($stmt->num_rows > 0) {
                                                        while ($stmt->fetch()) {
                                                            $event_id_hash = md5($event_id);
                                                            echo '<div class="col-lg-12">';
                                                            echo '<div class="well well-sm">';
                                                            echo '<h4>' . $event_name . '<small> ::' . $event_date . '</small></h4>';
                                                            echo '<p>' . $description . '</p>';
                                                            echo '<p><a href="../Controller/SignUpForEventController.php?eventid=' . $event_id_hash . ' &email=' . $user_logged_in . '"><button type="button" class="btn btn-primary btn-xs">Sign up here!</button></a></p>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="col-lg-12">';
                                                        echo '<div class="well well-sm">';
                                                        echo '<h4>Currently On An Adventure...</h4>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                            <!-- .panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <?php
                $stmt->close();
                $con->close();
                ?>


            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include('../views/_footer.php'); ?>
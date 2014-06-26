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
                <h1 class="page-header">SMUXtremists Integrated HR Portal</h1>
            </div>
            <div class="col-lg-12">

                <?php
                //echo $_COOKIE['rememberme'];
                //print_r($_COOKIE);
                echo "Hello " . $_SESSION['smu_email'];
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
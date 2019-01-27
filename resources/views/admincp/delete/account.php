<?php
	session_start();
	if(empty($_SESSION["Username"])){
		header("location:index.php");
		exit();
	}
    require_once "config.inc.php";

    if(isset($_GET['fn'])){
        if($_GET['fn'] == "remove"){
            remove($_GET['userid']);
        }
    }

    function remove($userid){
        global $mysqli_conn;
        $sql = "DELETE FROM account WHERE userid='$userid'";
        $results = $mysqli_conn->query($sql);
    }

?>
<!DOCTYPE html>
<html lang="th">

<head>

<?php include "include/head.php"; ?>
<link href="bower_components/airview/css/airview.min.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include "include/header.php"; ?>

            <?php include "include/navbartop.php"; ?>

            <?php include "include/sidebar.php"; ?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">จัดการ Account</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ตารางข้อมูล Account
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$sql = "Select * From account";
											$result=$mysqli_conn->query($sql);
											while($record=$result->fetch_array()) {
												echo '
													<tr class="odd gradeX">
														<td>'.$record['userid'].'</td>
														<td>'.$record['username'].'</td>
														<td><a href="account.php?fn=remove&userid='.$record['userid'].'" data-singleton="true" data-toggle="confirmation" data-popout="true">Delete</a></td>
													</tr>
												';
											}
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/airview/js/airview.min.js"></script>
    <script>$("span").airview({width: 350, placement: 'auto bottom'});</script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script src="dist/js/bootstrap-confirmation.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $('[data-toggle=confirmation]').confirmation();
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>

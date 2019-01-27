<?php
	session_start();
	if(empty($_SESSION["Username"])){
		header("location:index.php");
		exit();
	}

    require_once "config.inc.php";

    if(isset($_POST['username']) && isset($_POST['password'])){
        $password = md5($_POST["password"]);
        $sql="INSERT INTO account (userid, username , password , status) values ('','".$_POST["username"]."','".$password."','1')";
        $result=$mysqli_conn->query($sql);
    }
?>

<!DOCTYPE html>
<html lang="th">

<head>

<?php include "include/head.php"; ?>

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
                    <h1 class="page-header">เพิ่มบัญชี</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            แบบฟอร์มสำหรับเพิ่มตาราง
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="add-account.php" method="post">
										<?php
											if(isset($_POST['username']) && isset($_POST['password'])){
												echo'<div class="form-group"><div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>เพิ่มบัญชีเรียบร้อยแล้ว</div></div>';
                                            };
										?>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                                        <button type="reset" class="btn btn-warning">รีเซต</button>
                                    </form>
                                </div>
                            </div>
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

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
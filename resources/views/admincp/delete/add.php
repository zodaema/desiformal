<?php
	session_start();
	if(empty($_SESSION['Username'])){
		header("location:index.php");
		exit();
	}

    include "config.inc.php";
/*
    if(isset($_POST['name']) && isset($_FILES['smallpic']['name']) && isset($_FILES['fullpic']['name'])){
        $sql = "INSERT INTO $tablename (id, name , client , link , dates) values ('','$_POST[name]','$_POST[client]','$_POST[link]',now())";
        $result=$mysqli_conn->query($sql);
        
        $id = $mysqli_conn->insert_id;
        $smallfilename = $id.".".pathinfo($_FILES["smallpic"]["name"], PATHINFO_EXTENSION);
        $fullfilename = $id."-full.".pathinfo($_FILES["fullpic"]["name"], PATHINFO_EXTENSION);
            if(move_uploaded_file($_FILES["smallpic"]["tmp_name"],"../".$dirpic.$smallfilename) && move_uploaded_file($_FILES["fullpic"]["tmp_name"],"../".$dirpic.$fullfilename)){
            $sql = "UPDATE $tablename SET smallpic = '$smallfilename' , fullpic = '$fullfilename' WHERE id = '$id' ";
            $result=$mysqli_conn->query($sql);
        }
	}
	
*/
?>

<!DOCTYPE html>
<html lang="th">

<head>

	<?php include "include/head.php"; ?>
	
	
    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

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
                    <h1 class="page-header">เพิ่มผลงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            แบบฟอร์มสำหรับเพิ่มตาราง
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form id="add_portfolio" enctype="multipart/form-data">
										<?php
									/*
											if(isset($_POST['name']) && isset($_FILES['smallpic']['name']) && isset($_FILES['fullpic']['name'])){
												echo'<div class="form-group"><div class="alert alert-success alert-dismissable">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>เพิ่มข้อมูลเรียบร้อยแล้ว</div></div>';
											};

											*/
										?>
                                        <div class="form-group">
                                            <label>ชื่อผลงาน</label>
                                            <input type="text" name="name" class="form-control" placeholder="กรอกชื่อผลงาน" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ลูกค้า</label>
                                            <input type="text" name="client" class="form-control" placeholder="กรอกชื่อลูกค้า" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงค์</label>
                                            <input type="text" name="link" class="form-control" placeholder="กรอกลิงค์เว็บไซต์" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ภาพเล็ก</label>
                                            <input type="file" name="smallpic" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ภาพใหญ่</label>
                                            <input type="file" name="fullpic" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                                        <button type="reset" class="btn btn-warning">รีเซต</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
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

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

	<script>
		$(document).on('submit','form#add_portfolio',function(e){
			e.preventDefault();
			var formdata = new FormData($(this)[0]);
			$.ajax({
				url: 'source/portfolio.php',
				type: 'POST',
				processData: false,
				data: formdata,
				success: function(data){
					console.log(data);
				},
				beforeSend: function(){
					
				}
			});
			
			return false;
		});
	</script>
</body>

</html>

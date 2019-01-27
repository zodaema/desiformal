<?php
	session_start();
	if(empty($_SESSION["Username"])){
		header("location:index.php");
		exit();
	}

    require_once "config.inc.php";
?>
<!DOCTYPE html>
<html lang="th">

	<head>

		<?php include "include/head.php"; ?>
		<link href="bower_components/airview/css/airview.min.css" rel="stylesheet">

		<!-- jQuery -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>

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
						<h1 class="page-header">แก้ไข &amp; ลบ</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								ตารางข้อมูล Portfolio
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>id</th>
												<th>ชื่อผลงาน</th>
												<th>ลูกค้า</th>
												<th>ภาพเล็ก</th>
												<th>ภาพใหญ่</th>
												<th>แก้ไข</th>
												<th>ลบ</th>
											</tr>
										</thead>
										<tbody>
								<?php
									$sql = "Select * From $tablename";
									$result=$mysqli_conn->query($sql);
									while($record=$result->fetch_array()) {
										echo '
											<tr class="odd gradeX">
												<td>'.$record[id].'</td>
												<td>'.$record[name].'</td>
												<td>'.$record[client].'</td>
												<td><span id="image" data-content="../'.$dirpic.''.$record[smallpic].'" >'.$record[smallpic].'</span></td>
												<td><span id="image" data-content="../'.$dirpic.''.$record[fullpic].'" >'.$record[fullpic].'</td>
												<td><a href="edit.php?id='.$record[id].'">Edit</a></td>
												<td><a href="delete.php?id='.$record[id].'" class="delete" data-toggle="confirmation" data-singleton="true" data-popout="true">Delete</a></td>
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

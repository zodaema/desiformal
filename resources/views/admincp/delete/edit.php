<?php
	session_start();
	if($_SESSION["Username"] == "")
	{
		header("location:index.php");
		exit();
	}

    include "config.inc.php";

    $id=$_GET[id];

    $sql="select * from $tablename where id='$id'";
    $result=$mysqli_conn->query($sql);
    $record=$result->fetch_array();
?>

<!DOCTYPE html>
<html lang="th">

<head>

<? include "include/head.php"; ?>
    <link href="bower_components/airview/css/airview.min.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <? include "include/header.php"; ?>

            <? include "include/navbartop.php"; ?>

            <? include "include/sidebar.php"; ?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เพิ่มผลงาน</h1>
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
                                    <form role="form" action="save.php?id=<?=$record[id]?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>ชื่อผลงาน</label>
                                            <input type="text" name="name" class="form-control" placeholder="กรอกชื่อผลงาน" value="<?=$record[name]?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ลูกค้า</label>
                                            <input type="text" name="client" class="form-control" placeholder="กรอกชื่อลูกค้า" value="<?=$record[client]?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงค์</label>
                                            <input type="text" name="link" class="form-control" placeholder="กรอกลิงค์เว็บไซต์" value="<?=$record[link]?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ภาพเล็ก</label>
                                            <img src="../<?=$dirpic ?><?=$record[smallpic]?>" data-content="../<?=$dirpic ?><?=$record[smallpic]?>" width="50px">
                                            <input type="file" name="smallpic">
                                        </div>
                                        <div class="form-group">
                                            <label>ภาพใหญ่</label>
                                            <img src="../<?=$dirpic ?><?=$record[fullpic]?>" data-content="../<?=$dirpic ?><?=$record[fullpic]?>" width="50px">
                                            <input type="file" name="fullpic">
                                        </div>
                                        <button type="submit" class="btn btn-success">แก้ไข</button>
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
    <script src="bower_components/airview/js/airview.min.js"></script>
    <script>$("img").airview({width: 350, placement: 'auto left'});</script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>

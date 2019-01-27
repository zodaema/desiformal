<?php
	session_start();
	if(empty($_SESSION["Username"])){
		header("location:index.php");
		exit();
	}

    require_once "config.inc.php";
    if(empty($_SESSION['fetch'])){
        $fetch = '6';
    }
    else{
        $fetch = $_SESSION['fetch'];
    }

    if (isset($_GET['fetch'])){
        $fetch = $_GET['fetch'];
        $_SESSION["fetch"] = $fetch;
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
                    <h1 class="page-header">เพิ่มคิวงาน</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            เพิ่มตารางคิวงาน
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
	                                   $month_name = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	
	                                   for ($i=0; $i<$fetch; $i++) {
                                            $month = date('m',strtotime("$i month"));
                                            $year = date('Y',strtotime("$i month"));
                                            $sql = "SELECT * FROM queue WHERE month = '$month' and year = '$year'";
                                            $results = $mysqli_conn->query($sql);
                                            $row = $results->fetch_assoc();
                                            
                                            if( $row['month'] == $month && $row['year'] == $year){
                                                $percent = $row['queue']*50;
                                                echo $month_name[$month].' '.$year.'
                                                <a href="addqueue.php?fn=addQ&month='.$month.'&year='.$year.'"><i class="fa fa-plus-square"></i></a>
                                                <a href="addqueue.php?fn=removeQ&month='.$month.'&year='.$year.'"><i class="fa fa-minus-square"></i></a>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="'.$percent.'"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:'.$percent.'%">
                                                        <span class="sr-only">'.$percent.'% Complete</span>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                           
                                            else {
                                                echo $month_name[$month].' '.$year.'
                                                <a href="addqueue.php?fn=newQ&month='.$month.'&year='.$year.'"><i class="fa fa-plus-square"></i></a>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                        <span class="sr-only">0% Complete</span>
                                                    </div>
                                                </div>
                                                ';
                                            }
	                                   }
                                    ?>
                                </div>
                                <div class="col-lg-6">
                                    <form action="queue.php" method="get">
                                        <label>จำนวนเดือน : </label>
                                        <input name="fetch" type="number" min="1" max="20" class="input-medium" value="<?=$fetch?>">
                                        <button type="submit" class="btn">แสดง</button>
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
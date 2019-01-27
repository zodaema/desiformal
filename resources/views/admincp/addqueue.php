<?php

    session_start();
	if($_SESSION["Username"] == "")
	{
		header("location:index.php");
		exit();
	}

    include "config.inc.php";

    if ($_GET['fn'] == "addQ"){
        addQ($_GET['month'],$_GET['year']);
    }
    if ($_GET['fn'] == "removeQ"){
        removeQ($_GET['month'],$_GET['year']);
    }
    if ($_GET['fn'] == "newQ"){
        newQ($_GET['month'],$_GET['year']);
    }

    function addQ($month,$year){
        global $mysqli_conn;
        $sql = "SELECT * FROM queue WHERE month='$month' and year='$year' ";
        $results = $mysqli_conn->query($sql);
        $row = $results->fetch_assoc();
        if ($row[queue]<2){
            $newqueue = $row[queue]+1;
            $update = "UPDATE queue SET queue = '$newqueue' WHERE month='$month' and year='$year' ";
            $updateresults = $mysqli_conn->query($update);
        }
        header("location:queue.php");
		exit();
    }

    function removeQ($month,$year){
        global $mysqli_conn;
        $sql = "SELECT * FROM queue WHERE month='$month' and year='$year' ";
        $results = $mysqli_conn->query($sql);
        $row = $results->fetch_assoc();
        if ($row[queue]==2){
            $update = "UPDATE queue SET queue = 1 WHERE month='$month' and year='$year' ";
            $updateresults = $mysqli_conn->query($update);
        }
        else if($row[queue]==1){
            $remove = "DELETE FROM queue WHERE month='$month' and year='$year' ";
            $removeresults = $mysqli_conn->query($remove);
        }
        header("location:queue.php");
		exit();
    }

    function newQ($month,$year){
        global $mysqli_conn;
        $sql = "INSERT INTO queue (month, year, queue) VALUES ( '$month', '$year', 1)";
        $results = $mysqli_conn->query($sql);
        header("location:queue.php");
		exit();
    }

?>
<?php
	session_start();
	if($_SESSION["Username"] == "")
	{
		header("location:index.php");
		exit();
	}

    include "config.inc.php";

    $id=$_GET[id];

    $smallfilename = $id.".".pathinfo($_FILES["smallpic"]["name"], PATHINFO_EXTENSION);
    $fullfilename = $id."-full.".pathinfo($_FILES["fullpic"]["name"], PATHINFO_EXTENSION);
        @unlink("../".$dirpic.$_POST["smallpic"]);
        @unlink("../".$dirpic.$_POST["fullpic"]);
        $sql = "DELETE FROM $tablename WHERE id = '$id' ";
        $result=$mysqli_conn->query($sql);
        header("location:admincp.php");
		exit();

?>
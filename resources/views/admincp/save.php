<?php
	session_start();
	if($_SESSION["Username"] == "")
	{
		header("location:index.php");
		exit();
	}

    include "config.inc.php";

$id=$_GET[id];
$sql = "UPDATE $tablename SET name = '".$_POST["name"]."',client = '".$_POST["client"]."',link = '".$_POST["link"]."' WHERE id = '$id' ";

$result=$mysqli_conn->query($sql);
$smallfilename = $id.".".pathinfo($_FILES["smallpic"]["name"], PATHINFO_EXTENSION);
$fullfilename = $id."-full.".pathinfo($_FILES["fullpic"]["name"], PATHINFO_EXTENSION);
if($_FILES["smallpic"]["name"]!=''){
    if(move_uploaded_file($_FILES["smallpic"]["tmp_name"],"../".$dirpic.$smallfilename)){
        @unlink("../".$dirpic.$_POST["smallpic"]);
        $sql = "UPDATE $tablename SET smallpic = '$smallfilename' WHERE id = '$id' ";
        $result=$mysqli_conn->query($sql);
    }
}

if($_FILES["fullpic"]["name"]!=''){
    if(move_uploaded_file($_FILES["fullpic"]["tmp_name"],"../".$dirpic.$fullfilename)){
        @unlink("../".$dirpic.$_POST["fullpic"]);
        $sql = "UPDATE $tablename SET fullpic = '$fullfilename' WHERE id = '$id' ";
        $result=$mysqli_conn->query($sql);
    }
}

if($result)
{
	header("location:admincp.php");
    exit();
}
else
{
	echo "Error Save [".$sql."]";
}
?>
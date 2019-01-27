<?php

	session_start();

	$strUsername = trim($_POST["tUsername"]);
	$strPassword = trim(md5($_POST["tPassword"]));
	
	//*** Check Username ***//
	if(trim($strUsername) == "")
	{
		echo "<div class='alert alert-warning alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        กรุณากรอก Username</div>";
		exit();
	}
	
	//*** Check Password ***//
	if(trim($strPassword) == "")
	{
		echo "<div class='alert alert-warning alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        กรุณากรอก Password</div>";
		exit();
	}
	

    include "config.inc.php";


	//*** Check Username & Password ***//

	$strSQL = "SELECT * FROM account WHERE username = '".$strUsername."' and password = '".$strPassword."' ";
    $objQuery = $mysqli_conn->query($strSQL);
	$objResult = $objQuery->fetch_array();
	if($objResult)
	{
		echo "Y";

		//*** Session ***//
		$_SESSION["Username"] = $strUsername;
		session_write_close();
	}
	else
	{
		echo "<div class='alert alert-warning alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        Username & Password is wrong</div>";
	}

?>
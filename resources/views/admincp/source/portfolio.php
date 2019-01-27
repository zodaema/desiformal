<?php

	echo($_POST['name']);
	if(isset($_POST['action'])){
		echo 'hi';
		if($_POST['action'] == 'add'){
			print_r($_POST['data']);
			echo'success';
		}
	}
?>
<?php
session_start();
unset($_SESSSION['Username']);
unset($_SESSION['Password']);
session_destroy();
header("location:index.php");
exit();
?>
<?php 
	require_once('session.php'); 
	unset($_SESSION['authenticate']);
	unset($_SESSION['companyid']);
	unset($_SESSION['driverid']);
	unset($_SESSION['uid']);
	unset($_SESSION['email']);
	unset($_SESSION['creationdate']);
	unset($_SESSION['drivername']);
	unset($_SESSION['companyname']);
	session_unset();
	session_destroy();
	header("location: index.html");
?>
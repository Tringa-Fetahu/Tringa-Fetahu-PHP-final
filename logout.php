<?php 
//We will destroy all of the data associated with the current session

	include_once('config.php');

	session_destroy();

	header("Location: dashboard.php");

 ?>
<?php 
	/*
	We will include config.php for connection with database.
	Delete a user based on his id.
	*/
	include_once('config.php');

	$id = $_GET['id'];
	$sql = "DELETE FROM races WHERE id=:id";
	$prep = $pdo->prepare($sql);
	$prep->bindParam(':id',$id);
	$prep->execute();

	header("Location: dashboard.php");
 ?>
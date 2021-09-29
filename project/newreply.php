<?php 
	include 'connect.php';
	session_start();

	$mid = $_SESSION["id"];
	$aid = $_GET["Aid"];
	$newreply = $_POST["newreply"];
	//echo "$aid";

	mysqli_query($db_link, "INSERT INTO `reply` (`messege`, `Mid`, `Aid`) VALUES ('$newreply', '$mid', '$aid')");

	header("Location: article.php?Aid=$aid");

?>
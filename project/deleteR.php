<?php
	include 'connect.php';
	$Rid = $_GET["Rid"];
	$Aid = $_GET["Aid"];
	mysqli_query($db_link, "DELETE FROM `reply` WHERE `Rid` = $Rid");

	header("Location: article.php?Aid=$Aid");
?>
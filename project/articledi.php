<?php
	session_start();
	include 'connect.php';
	$Aid = $_GET["Aid"];
	$title = $_POST["title"];
	$context = $_POST["context"];

	mysqli_query($db_link, "UPDATE `article` SET `title` = '$title', `context` = '$context' WHERE `Aid` = $Aid");

	header("Location: article.php?Aid=$Aid");
?>
<?php
	include 'connect.php';
	session_start();
	$Aid = $_GET["Aid"];
	$Sid = $_SESSION["Sid"];
	echo "$Sid";
	mysqli_query($db_link, "DELETE FROM `article` WHERE `Aid` = $Aid");

	header("Location: reqArticleList.php?Sid=$Sid");
?>
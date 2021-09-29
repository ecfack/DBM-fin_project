<?php  
	include 'connect.php';
	session_start();

	$mid = $_SESSION["id"];
	$sid = $_SESSION["Sid"];
	$title = $_POST["title"];
	$context = $_POST["context"];

	mysqli_query($db_link, "INSERT INTO `article` (`Mid`, `Sid`, `title`, `context`) VALUES ('$mid','$sid', '$title', '$context')");

	header("Location: reqArticleList.php?Sid=$sid");
?>
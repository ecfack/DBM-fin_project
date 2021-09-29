<?php 
	include 'connect.php';
	include 'identity.php';

	$Sid = $_SESSION["Sid"];
	$rating = $_GET["rating"];

	//echo "$rating";

	mysqli_query($db_link, "INSERT INTO `rates` (`Mid`, `Sid`, `rating`) VALUES ('$Mid', '$Sid', '$rating')");

	header("Location: reqArticleList.php?Sid=$Sid");
?>
<?php
	include 'connect.php';
	session_start();

	$Sid = $_SESSION["Sid"];
	$address = $_POST["address"];
	$tel = $_POST["tel"];
	$minCost = $_POST["minCost"];
	$openHours = $_POST["openHours"];
	$closeHours = $_POST["closeHours"];
	$name = $_POST["name"];



	mysqli_query($db_link, "UPDATE `shop` SET `address` = '$address', `tel` = '$tel', `minCost` = '$minCost', `openHours` = '$openHours', `closeHours` = '$closeHours', `name` = '$name' WHERE `Sid` = $Sid");

	header("Location: reqArticleList.php?Sid=$Sid");
?>
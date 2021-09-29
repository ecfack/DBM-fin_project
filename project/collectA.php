<?php 
	include 'connect.php';
	include 'identity.php';

	$Aid = $_GET["Aid"];
	$isC = $_GET["collect"];

	if ($isC) {
		mysqli_query($db_link, "DELETE FROM `articlecollect` WHERE `articlecollect`.`Mid` = '$Mid' AND `articlecollect`.`Aid` = $Aid");
	}
	else{
		mysqli_query($db_link, "INSERT INTO `articlecollect` (`Mid`, `Aid`) VALUES ('$Mid', '$Aid')");
	}
	

	header("Location: article.php?Aid=$Aid");
?>
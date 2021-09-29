<?php
	include 'connect.php';
	session_start();

	$sid = $_SESSION["Sid"];
	$mid = $_SESSION["id"];
	$isC = $_GET["collect"];

	if ($isC) {
		mysqli_query($db_link, "DELETE FROM `collect` WHERE `collect`.`Mid` = '$mid' AND `collect`.`Sid` = $sid");
	}
	else{
		mysqli_query($db_link, "INSERT INTO `collect` (`Mid`, `Sid`) VALUES ('$mid', '$sid')");
	}

	

	header("Location: reqArticleList.php?Sid=$sid");
?>
<?php 
	$db_host = "localhost";
	$db_user = "foodmap";
	$db_password = "";
	$db_name = "foodmap";
	$db_link = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("Could not connect: " .mysql_error());
	mysqli_set_charset($db_link, "utf8");
	$link = $db_link;
	$db = $link;

	$url = "http://".$db_host."/project";
	$path = "C:/xampp\htdocs\project/images/";
?>
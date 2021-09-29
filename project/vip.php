<?php 
	session_start();
	include 'connect.php';
	$id = $_SESSION['id'];
	$level = $_GET["level"];
	$plevel = $_GET["plevel"];

	
	$sql = "UPDATE member SET level = '$plevel' where id = '$id'";
	$_SESSION["level"] = $plevel;
    $result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<script language="JavaScript">
	alert("Your purchase was successful!")
	window.location="fund.php"
	</script>
</body>
</html>
<?php 
  	session_start();
  	include 'connect.php';
	$id = $_GET["id"];
  	$sql = "SELECT * FROM member WHERE id='$id'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    $bucket = $row[7] + 1;
    $nsql = "UPDATE member SET bucket = '$bucket' WHERE id = '$id'";
    mysqli_query($db, $nsql);

	header("Location:othermember.php?id=$id");
?>
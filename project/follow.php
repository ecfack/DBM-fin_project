<?php
    include 'connect.php';
	session_start();

	$id = $_SESSION["id"];
	$fid = $_GET["fid"];
	
	$sql = "SELECT id FROM follow WHERE id = '$id' and fid = '$fid'";
	$result = mysqli_query($db, $sql);

  	$total_records = mysqli_num_rows($result);
    if ($total_records == 0){
    	$fsql = "INSERT INTO follow (id, fid) VALUES ('$id', '$fid')";
    	$fresult = mysqli_query($db, $fsql);
    	echo "<script> {window.alert('Follow!');
        location.href='othermember.php?id=$fid'} </script>";
    }
    else {
    	$fsql = "DELETE FROM follow WHERE id = '$id' and fid = '$fid'";
    	$fresult = mysqli_query($db, $fsql);
    	echo "<script> {window.alert('Untrack!');
        location.href='othermember.php?id=$fid'} </script>";
    }

?>
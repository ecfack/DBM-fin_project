<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
		<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bree+Serif&family=EB+Garamond:ital,wght@0,500;1,800&display=swap');
body {
background: #DFC2F2;
	background-image: linear-gradient( to right, #ffffb3,#ffe6e6);
	background-attachment: fixed;	
	background-size: cover;
  
	}
	</style>
</head>
<body>

<?php
$id = $_GET["id"];
?>

<script language="JavaScript">
	if (confirm ("Are you sure to bucket this user? ")){
		alert("Done!")
		window.location="bucket.php?id=<?=$id?>"
	}
  	else　{
  		alert("Maybe next time.")
  		window.location="othermember.php?id=<?=$id?>"
	}
</script>

</body>
</html>
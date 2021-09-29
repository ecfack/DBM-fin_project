<?php  
	include 'connect.php';
	session_start();
	$Sid = $_SESSION["Sid"];
	$inforesult = mysqli_query($db_link, "SELECT * FROM shop WHERE Sid = '$Sid'");
	$info = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>編輯店家資訊</title>
	<style type="text/css">
		body{
			margin: 0 auto;
			background: #e6ded7;
		}
		div{
			display: block;
			margin: 10px;
			padding: 20px;
		}
		#container{
			margin: 0 auto;
			width: 86%;
  			display: block;
 			padding-top: 0px;
 			margin-top: 30px;
 			border-width: 2px;
			border-style: solid;
			border-color: #CCCCCC;
			background: #FAF0E6;
			box-shadow: 0px 8px 15px 10px #cccccc;
			align-items: center;
		}
		table{
 			padding: 60px;
 			font-size: 24px;
 			margin-right: 0px;
 			width: 80%;
 		}
 		td{
 			padding: 10px;

 		}
 		input{
 			font-size: 20px;
 			border-radius: 5px;

 			margin: 10px;
 		}
	</style>
</head>
<body>
	<div id="container"><form action="infoedi.php" method="POST"><table>
		<tr>
			<td>店名：</td>
			<td><input type="text" required="required" name="name" value="<?php echo "$info[name]" ?>"></td>
		</tr>
		<tr>
			<td>地址：</td>
			<td><input type="text" required="required" name="address" value="<?php echo "$info[address]" ?>"></td>
		</tr>
		<tr>
			<td>電話：</td>
			<td><input type="text" required="required" name="tel" value="<?php echo "$info[tel]" ?>"></td>
		</tr>
		<tr>
			<td>最低消費：</td>
			<td><input type="number" name="minCost" value="<?php echo "$info[minCost]" ?>"></td>
		</tr>
		<tr>
			<td>營業時間：</td>
			<td><input type="time" name="openHours" value="<?php echo "$info[openHours]" ?>">
				to<input type="time" name="closeHours" value="<?php echo "$info[closeHours]" ?>"></td>
		</tr>
		<tr>
			<td><input type="button" value="返回" onclick="history.back()"></td>
			<td><input type="submit" value="確定更改"></td>
		</tr>



	</table></form></div>
</body>
</html>
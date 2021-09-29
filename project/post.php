<?php 
	include 'connect.php';
	include 'identity.php';

	$Sid = $_SESSION["Sid"];
	$name = $_GET["name"];
	//$Mid = $_SESSION["Mid"];
	echo "<title>在 $name 發文</title>";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
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
 			margin-top: 300px;
 			border-width: 2px;
			border-style: solid;
			border-color: #CCCCCC;
			background: #FAF0E6;
			box-shadow: 0px 8px 15px 10px #cccccc;
			align-items: center;
		}
		header {
			margin: 0 auto;
			width: 100%;
			position: fixed;
			top: 30px;
			z-index: -1;
  			background-color: #AAAAAA;
  			color: #fff;
  			text-align: left;
 			padding: 0px;
 			padding-left: 100px;
 			padding-bottom: 150px;
 			padding-top: 50px;
 			font-weight: bold;
 			font-size: 30px;
 			text-shadow: 0px 0px 15px #000000;
 			box-shadow: 0px 0px 20px 20px #AAAAAA
 			,0px 0px 33px 30px #AAAAAA inset;
 			background-repeat: no-repeat;
 			background-position: 80% center;
		}
		span{
			padding-left: 50px;
			font-size: 60px;
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
 		textarea{
 			border-style: none;
 			padding: 8px;
 			font-size: 24px;
 			width: 100%;
 			resize: none;
 			box-shadow: 0px 0px 5px 8px #FFFFFF;
 		}
 		#title{
 			border-bottom: 3px #cccccc solid;
 		}
 		#context{

 		}
 		input{
 			font-size: 20px;
 			border-radius: 5px;
 			float: right;
 			margin: 10px;
 		}
 		li:hover {
            transform: scale(1.2);
        }
	</style>
</head>
<body>
	
	<header>在 <br>
		<span><?php echo "$name"; ?></span>
	<br>發文</header>
	<div id="container">
	<form action='newpost.php' method='POST'><table>
		<tr>
			<td>標題：</td>
		</tr>
		<tr>
			<td><textarea id='title' type="text" required="required" name="title" onkeyup="this.value=this.value.replace(/^\s+/g,'')" rows="1" maxlength="45"></textarea></td>
		</tr>
		<tr>
			<td>內容：</td>
		</tr>
		<tr>
			<td><textarea id="context" required="required" name="context" onkeyup="this.value=this.value.replace(/^\s+/g,'')" rows="20" maxlength="10000"></textarea></td>
		</tr>
		<tr><td style="float: right;">
			<input type="submit" value="確定發文">
			<a href=<?php echo "$url/reqArticleList.php?Sid=$Sid" ?>>
				<input type="button" value="取消並返回列表">
			</a>
		</td></tr>
	</table></form>
</div>
</body>
</html>

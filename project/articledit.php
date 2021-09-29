<?php  
	session_start();
	include 'connect.php';
	$Aid = $_GET["Aid"];
	$Aresult = mysqli_query($db_link, "SELECT * FROM article WHERE Aid = $Aid");
	$article = mysqli_fetch_array($Aresult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>編輯文章</title>
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
	<header>編輯文章</header>
	<div id="container">
	<form action= <?php echo "articledi.php?Aid=$Aid"; ?> method="POST"><table>
		<tr>
			<td>標題：</td>
		</tr>
		<tr>
			<td><textarea id='title' type="text" required="required" name="title" onkeyup="this.value=this.value.replace(/\s+/g,'')" rows="1" maxlength="45" ><?php echo "$article[title]"; ?></textarea></td>
		</tr>
		<tr>
			<td>內容：</td>
		</tr>
		<tr>
			<td><textarea id="context" required="required" name="context" onkeyup="this.value=this.value.replace(/^\s+/g,'')" rows="20" maxlength="1000"><?php echo "$article[context]"; ?></textarea></td>
		</tr>
		<tr><td style="float: right;">
			<input type="submit" value="確定編輯">
			<a href=<?php echo "article.php?Aid=$Aid" ?>>
				<input type="button" value="取消並返回文章">
			</a>
		</td></tr>
	</table></form>
</body>
</html>
<?php
	include 'connect.php';
	include 'identity.php';

	///店家收藏
	$Sres = mysqli_query($db_link, "SELECT * FROM `collect`, shop WHERE collect.Sid = shop.Sid and Mid = '$Mid'");
	$countS = mysqli_num_rows($Sres);
	


	///文章收藏
	$Ares = mysqli_query($db_link, "SELECT * FROM `articlecollect`, article, member WHERE articlecollect.Aid = article.Aid AND article.Mid = member.id AND articlecollect.Mid = '$Mid'");
	$countA = mysqli_num_rows($Ares);
	

	///追隨
	$Fres = mysqli_query($db_link, "SELECT member.* FROM `follow`, member WHERE follow.fid = member.id AND follow.id = '$Mid'");
	$countF = mysqli_num_rows($Fres);
?>

<!DOCTYPE html>
<html>
<head>
	<title>我的收藏</title>
	<style type="text/css">
		div{
			display: block;
			margin: 10px;
			padding: 20px;
		}
		#container{
			margin: 0 auto;
			width: 600px;
  			display: block;
 			padding-top: 0px;
 			margin-top: 100px;
 			border-width: 2px;
			border-style: solid;
			border-color: #CCCCCC;
			background: #FAF0E6;
			box-shadow: 0px 8px 15px 10px #cccccc;


		}
		.menu li:hover {
            transform: scale(1.2);
        }
        #shop:target,
		#article:target,
		#follow:target{
			border: solid 1px red;
		}

		#container ul{
		
			margin: 0 auto;
			padding: 10px 20px 0 20px;


		}

		#container li{
			list-style-type: none;
		}

		#container li a:hover{
			background: #DDDDDD;
			border-radius: 20px;
		}

		#container li a{
			text-decoration: none;
			font-size: 20px;
			color: #333;
			float: left;
			padding: 10px;
			margin: 10px;
		}

		#container div{
			clear:both;
			padding:0 15px;
			height:0;
			margin: 0;
			visibility:hidden;
			text-align: center;
		}


	
		#shop:target ~ #container > ul li a[href$="#shop"],
		#article:target ~ #container > ul li a[href$="#article"],
		#follow:target ~ #container > ul li a[href$="#follow"]{
			font-size: 24px;
			font-weight: bold;
			background: white;
			border-radius: 20px;
		}

		
		#shop:target ~ #container > #shop-content,
		#article:target ~ #container > #article-content,
		#follow:target ~ #container > #follow-content{
			visibility:visible;
			height: 80%;
		}

		table{
			margin: 0 auto;
		}

		a{
			text-decoration: none;
		}

		td{
			padding: 30px;
			border-bottom: 1px solid black;
			padding-bottom: 5px;
			padding-left: 20px;
			font-size: 20px;
		}
		.none{
			font-size: 20px;
		}
	</style>
</head>
<body>
	<span id="shop">shop</span>
	<span id="article">article</span>
	<span id="follow">follow</span>


	<div id="container">
		<ul>
		<li><a href="#shop">店家收藏</a></li>
		<li><a href="#article">文章收藏</a></li>
		<li><a href="#follow">我的追蹤</a></li>
		</ul>

	<div id="shop-content"><table>
		<?php
			if ($countS == 0) {
				echo "<span class='none'><br>沒有收藏任何店家</span>";
			}
			else{
				echo "<tr>
						<td>店名</td>
						<td>店ID</td>
						<td><img src='$url\icons\hot.png' style='height: 40px; width: 40px;'></td>
					</tr>";
				for ($i=0; $i < $countS; $i++) {
					$Scollect = mysqli_fetch_array($Sres, MYSQLI_ASSOC); 
					echo "
						<tr>
							<td><a href='reqArticleList.php?Sid=$Scollect[Sid]'>$Scollect[name]</a></td>
							<td>$Scollect[Sid]</td>
							<td>$Scollect[hot]</td>
						</tr>
					";
				}
			}
		?>
	</table></div>

	<div id="article-content"><table>
		<?php
			if ($countA == 0) {
				echo "<span class='none'><br>沒有收藏任何文章</span>";
			}
			else{
				echo "<tr>
						<td>標題</td>
						<td>作者</td>
						<td><img src='$url\icons\hot.png' style='height: 40px; width: 40px;'></td>
					</tr>";
				for ($i=0; $i < $countA; $i++) {
					$Acollect = mysqli_fetch_array($Ares, MYSQLI_ASSOC); 
					echo "
						<tr>
							<td><a href='article.php?Aid=$Acollect[Aid]'>$Acollect[title]</td>
							<td><a href='othermember.php?id=$Acollect[id]'>$Acollect[nickname]</a></td>
							<td>$Acollect[hot]</td>
						</tr>
					";
				}
			}
		?>
	</table></div>
	
	<div id="follow-content"><table>
		<?php
			if ($countF == 0) {
				echo "<span class='none'><br>沒有追蹤任何會員</span>";
			}
			else{
				echo "<tr>
						<td>暱稱</td>
						<td>ID</td>
						<td><img src='icons/application.png' width='40px;' height='40px;'></td>
					</tr>";
				for ($i=0; $i < $countF; $i++) {
					$follow = mysqli_fetch_array($Fres, MYSQLI_ASSOC); 
					echo "
						<tr>
							<td><a href='othermember.php?id=$follow[id]'>$follow[nickname]</a></td>
							<td>$follow[id]</td>
							<td><form action='search.php' method='post'>
					           		<input type='hidden' name='type' value='article'>
					           		<input type='hidden' name='Mid' value='$follow[id]'>
					           		<input type='submit' value='他的文章' style='font-size: 20px;'></form></td>
						</tr>
					";
				}
			}
		?>
	</table></div>
</div></body>
</html>
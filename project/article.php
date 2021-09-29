<?php  
	include 'connect.php';
	include 'identity.php';
	$Aid = $_GET["Aid"];

	

	///文章資訊
	$Aresult = mysqli_query($db_link, "SELECT article.*, name FROM article, shop WHERE article.Sid = shop.Sid AND Aid = $Aid");
	$article = mysqli_fetch_array($Aresult, MYSQLI_ASSOC);
	$Sid = $article["Sid"];
	$_SESSION["Sid"] = $Sid;

	///店名
	

	///作者人名
	$Mresult = mysqli_query($db_link, "SELECT nickname FROM member WHERE id = '$article[Mid]'");
	$nickname = mysqli_fetch_array($Mresult, MYSQLI_ASSOC);
	if (is_null($nickname["nickname"])) {
		$nickname["nickname"] = "作者不詳";
	}

	///收藏
	$collectres = mysqli_query($db_link, "SELECT * FROM articlecollect WHERE Mid = '$Mid' AND Aid = '$Aid'"); 
	$iscollect = mysqli_num_rows($collectres);

	///權限
	if ($article["Mid"] == $Mid) {
		$authority = 1;
	}

	///留言資訊
	$Rresult = mysqli_query($db_link, "SELECT reply.*, member.* FROM `reply`, member WHERE reply.Mid = member.id AND reply.Aid= $Aid ORDER BY `time` DESC");
	$count = mysqli_num_rows($Rresult);

	////熱度+1
	$article["hot"]++;
	mysqli_query($db_link, "UPDATE `article` SET `hot` = '$article[hot]' WHERE `Aid` = $Aid");


	echo "<title>$article[title]</title>";
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
	
		td{
			padding: 5px;
		}
		#containter{
			margin: 0 auto;

			width: 86%;
  			display: block;
 			padding-top: 0px;
 			margin-top: 350px;
 			border-width: 2px;
			border-style: solid;
			border-color: #CCCCCC;
			background: #FAF0E6;
			box-shadow: 0px 8px 15px 10px #cccccc;
			align-items: center;
		}

		header {
			margin: 0 auto;
			width: 90%;
			position: fixed;
			top: 30px;
			z-index: -1;
  			background-color: #AAAAAA;
  			color: #fff;
  			text-align: left;
 			padding: 0px;
 			padding-left: 100px;
 			padding-bottom: 150px;
 			padding-right: 100px;
 			padding-top: 50px;
 			font-weight: bold;
 			font-size: 30px;
 			text-shadow: 0px 0px 15px #000000;
 			box-shadow: 0px 0px 20px 20px #AAAAAA
 			,0px 0px 33px 30px #AAAAAA inset;
 			background-repeat: no-repeat;
 			background-position: 80% center;

		}
		#title{
			padding-left: 50px;
			font-size: 60px;
		}
		#author{
			float: right;
			padding-right: 150px;
			font-style: italic;
 		}
 		#author a{
 			color: #FFCCCC;
 		}
 		#function{
 			padding: 0px;
 			padding-left: 40px;
 			margin: 0px;
 			display: flex;
 			align-items: center;
 			font-size: 20px;
 		}
 		#function a{
 			padding-right: 20px;
 		}
 		#function img{
 			float: left;
 			
 		}
 		#context{
 			display: 
 			padding: 40px;
 			font-size: 24px;
 			white-space: pre-wrap;
 		}
 		table{
 			padding: 40px;
 			font-size: 24px;
 			margin-right: 0px;
 			width: 80%;
 		}
 		td{
 			border-bottom: 2px solid #CCCCCC;
 		}
 		.nickname{
 			text-align: right;
 		}
 		.nickname a{
 			color: #0000CC;
 		}
 		.messege{

 		}
 		.time{
 			text-align: right;
 			font-size: 14px;
			color: #888888;
 		}
 		a{
 			color: #5e5e5e; 
 			text-decoration: none;
 		}
 		li:hover {
            transform: scale(1.2);
        }
        #co{
        	color: #5e5e5e; 
 			padding-right: 20px;
        }

	</style>
</head>
<body>
<header>
	<?php echo "$article[name]<br>
		<span id='title'>$article[title]</span>"; ?><br>
	<span id="author">by <a href=<?php echo "othermember.php?id=$article[Mid]"; ?>><?php echo "$nickname[nickname]"?></a> at <?php echo "$article[time]"; ?></span>
</header>
<div id="containter">
	

	<div id="context"><p><?php echo "$article[context]"; ?></p></div>
	<div id="function">
		<?php
			echo "<a href='$url/reqArticleList.php?Sid=$article[Sid]'>返回文章列表</a>";

			if($authority > 0){
				if ($iscollect == 1) {
					echo "<a href='collectA.php?Aid=$Aid&collect=$iscollect'>取消收藏</a>";
				}
				else
					echo "<a href='$url/collectA.php?Aid=$Aid&collect=$iscollect'>收藏文章</a>";
			}
			if ($authority == 1) {
				echo "<a href='$url/articledit.php?Aid=$Aid'>編輯文章</a>";
			}

			
			?>
		<img src=<?php echo "$url\icons\hot.png"; ?> style='height: 40px; width: 40px;'><?php echo "$article[hot]"; ?>
	</div>


	<table>
		<tr>
			<?php echo "<form action='newreply.php?Aid=$Aid' method='POST'>"; ?>
				<td class="nickname">撿起槍</td>
				<?php
					if ($authority != 0) {
						echo "<td><input type='text' required='required' name='newreply' style='width: 100%;' maxlength='120' onkeyup=\"this.value=this.value.replace(/^\s+/g,'')\"></td>
						<td><input type='image' img src='$url\icons\submachine-gun.png' onClick='document.formname.submit()'></td>";
					}
					else{
						echo "<td>登入以加入戰場</td>";
					}
				?>
			</form>
		</tr>
		<?php 
		for ($i=0; $i < $count; $i++) { 
			$reply = mysqli_fetch_array($Rresult, MYSQLI_ASSOC);
			if ($authority != 1) {
				if ($reply["Mid"] == $Mid) {
					$authority = 2;
				}
				else{
					$authority = 0;
				}
			}

			if ($reply["level"]==3) {
				$color="gold";
			}
			elseif ($reply["level"]==2) {
				$color="silver";
			}
			else{
				$color="#BF8970";
			}
			
			echo "<tr>
				<td class='nickname'><a href='$url/othermember.php?id=$reply[Mid]' style='color:$color;'>$reply[nickname]</a>： </td>
				<td class='messege'>$reply[messege]</td>
				<td class='time'>........$reply[time]</td>";
			if ($authority > 0 && $authority < 3) {
				echo "<td><a href='$url/deleteR.php?Rid=$reply[Rid]&Aid=$Aid'><input type='image' img src='$url\icons\blow.jpg' onclick='if(confirm(\"是否吹留言\")) return true;else return false'></a></td>";
			}
			echo "</tr>";
		}		
		; ?>
	</table></p>
	</div>
</body>
</html>
<?php 
	include "connect.php";
	include 'identity.php';

	$Sid = $_GET["Sid"];
	$_SESSION["Sid"] = $Sid;
	//echo "<title>$Sid</title>";


	////店家資訊
	$inforesult = mysqli_query($db_link, "SELECT * FROM shop WHERE Sid = '$Sid'");
	$info = mysqli_fetch_array($inforesult, MYSQLI_ASSOC);
	if (is_null($info["shopkeeper"])) {
		$info["shopkeeper"] = "none";
	}
	$info["openHours"] = mb_substr($info["openHours"], 0, 5, 'UTF-8');
	$info["closeHours"] = mb_substr($info["closeHours"], 0, 5, 'UTF-8');

	///收藏
	$collectres = mysqli_query($db_link, "SELECT * FROM collect WHERE Mid = '$Mid' AND Sid = $Sid ");
	$collect = mysqli_num_rows($collectres);

	////權限
	if ($info["shopkeeper"] == $Mid) {
		$authority = 1;
	}	
	//echo "$authority";


	////熱度+1
	$info["hot"]++;
	mysqli_query($db_link, "UPDATE `shop` SET `hot` = '$info[hot]' WHERE `Sid` = $Sid");

	///用戶評分
	$rateres = mysqli_query($db_link, "SELECT * FROM rates WHERE Mid = '$Mid' AND Sid = '$Sid'");
	$israte = mysqli_num_rows($rateres);
	$avgrateres = mysqli_query($db_link, "SELECT AVG(rating) AS rating FROM rates WHERE  Sid = '$Sid'");
	$avgrating = mysqli_fetch_array($avgrateres);

	///文章列表
	$titleresult = mysqli_query($db_link, "SELECT * FROM `article` WHERE Sid = '$Sid' ORDER BY `time` DESC");
	$count = mysqli_num_rows($titleresult);



	function cut_content($a,$b){
    $a = strip_tags($a); //去除HTML標籤
    $sub_content = mb_substr($a, 0, $b, 'UTF-8'); //擷取子字串
    //echo $sub_content;  //顯示處理後的摘要文字
    if (strlen($a) > strlen($sub_content))
    	$sub_content = $sub_content."....";
    return $sub_content;
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo "$info[name]"; ?></title>
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
		header {
			margin: 0 auto;
			width: 100%;
			position: fixed;
			top: 30px;
			z-index: -1;
  			background-color: #AAAAAA;
  			color: #fff;
  			text-align: left;
 			padding: 30px;
 			padding-left: 100px;
 			padding-bottom: 150px;
 			padding-top: 50px;
 			font-weight: bold;
 			font-size: 60px;
 			text-shadow: 0px 0px 15px #000000;
 			box-shadow: 0px 0px 20px 20px #AAAAAA
 			,0px 0px 33px 30px #AAAAAA inset;
 			background-image: url(<?php echo "$info[photo]"; ?>);
 			background-repeat: no-repeat;
 			background-position: 80% center;

		}
		header img{
			height: 10%;
		}
		#container{
			content: "";
			margin: 0 auto;
  			display: block;
 			clear: both;
 			width: 1000px;
 			padding-top: 0px;
 			margin-top: 300px;
		}
		.shopinfo{
  			float: right;
  			position: sticky;
  			margin-top: 0px;
  			top: 40px;
  			padding: 10px;
			border-width: 2px;
			border-style: solid;
			border-color: #CCCCCC;
			background: #ede8e2;
		}
		.info{
			margin: 0 auto;
		}
		.shopinfo p{
			margin: 0 auto;
		}
		.left{
			text-align: right;
			padding: 2px;
			border-bottom: 2px solid #CCCCCC;
		}
		.rig{
			text-align: center;
			border-bottom: 2px solid #CCCCCC;
		}
		.list{
			border-width: 2px;
			border-style: solid;
			border-color: #CCCCCC;
			background: #FAF0E6;
			box-shadow: 0px 8px 15px 10px #cccccc;
		}
		.rating {
			display: block;
			margin: 0 auto;
		    font-size: 0;
		    display: table;
		    padding: 0px;
	    }

	    .rating > label {
	        color: #ddd;
	        float: right;
	    }

	    .rating > label:before {
	        padding: 5px;
	        font-size: 32px;
	        line-height: 1em;
	        display: inline-block;
	        content: "★";
	    }

	    .rating > input:checked ~ label,
	    .rating:not(:checked) > label:hover,
	    .rating:not(:checked) > label:hover ~ label {
	        color: #BBBB00;
	    }

	    .rating > input:checked ~ label:hover,
	    .rating > label:hover ~ input:checked ~ label,
	    .rating > input:checked ~ label:hover ~ label {
	        color: #FFFF00;
	    }
	   	
	    .star-rating {
        unicode-bidi: bidi-override;
        color: #ddd;
        font-size: 0;
        height: 25px;
        margin: 0 auto;
        position: relative;
        display: table;
        padding: 0px;
        text-shadow: 0px 0px 0 #a2a2a2;
	    }

	    .star-rating span {
	        padding: 5px;
	        font-size: 20px;
	    }

	    .star-rating-top {
	    	margin: 0 auto;
	        color: #FFD700;
	        padding: 0px;
	        z-index: 1;
	        display: block;
	        top: 0;
	        left: 0;
	        overflow: hidden;
	        white-space: nowrap;
	    }

	    .star-rating-bottom {
	    	margin: 0 auto;
	        padding: 0;
	        display: none;
	        z-index: 0;

	    }


		.title{
			font-size: 24px;
			padding: 10px;
			font-weight: bold;
		}
		.context{
			border-bottom: 2px solid #CCCCCC;
			padding-bottom: 20px;
		}
		.time{
			font-size: 14px;
			color: #888888;
		}
		li:hover {
            transform: scale(1.2);
        }
        input{
 			border-radius: 5px;
 		}
	</style>
</head>
<body>
<header>
	<?php echo "$info[name]"; ?>
</header>


<div id="container">

<div class="shopinfo"><?php
	echo "<table class='info'>
	<tr>
		<td class='left'>店名：</td>
		<td class='rig'>$info[name]<br></td>
	</tr>
	<tr>
		<td class='left'>店主：</td>
		<td class='rig'>$info[shopkeeper]</td>
	<tr>
	<tr>
		<td class='left'>店ID：</td>
		<td class='rig'>$info[Sid]</td>
	<tr>
	<tr>
		<td class='left'>評價：</td>";
	if ($avgrating["rating"] == 0) {
		echo "<td class='rig'>尚未有人評價</td>";
	}
	else{
		$grade = $avgrating["rating"]/5*100;
		echo "<td class='rig'>
			<div class='star-rating'>
        		<div class='star-rating-top' style='width:$grade%'>
	            	<span>★</span>
	           		<span>★</span>
		            <span>★</span>
		            <span>★</span>
		            <span>★</span>
	        	</div>
	        	<div class='star-rating-bottom'>
		            <span>★</span>
		            <span>★</span>
		            <span>★</span>
		            <span>★</span>
		            <span>★</span>
        		</div>
    		</div>
		</td>";
	}
	echo "<tr>
	<tr>
		<td class='left'>地址：</td>
		<td class='rig'>$info[address]</td>
	<tr>
	<tr>
		<td class='left'>招牌菜：</a></td>
		<td class='rig'>$info[menu]</td>
	<tr>
	<tr>
		<td class='left'>電話：</td>
		<td class='rig'>$info[tel]</td>
	<tr>
	<tr>
		<td class='left'>最低消費：</td>
		<td class='rig'>$info[minCost]</td>
	<tr>
	<tr>
		<td class='left'>營業時間：</td>
		<td class='rig'>$info[openHours] to $info[closeHours]</td>
	<tr>
	<tr>
		<td class='left'><img src='$url\icons\hot.png' style='height: 20px; width: 20px;'></td>
		<td class='rig'>$info[hot]</td>
	<tr>
	</table>
	";
?>
<table style="margin: 0px;">
	<tr><td style="text-align: center; padding: 0px;"><iframe 
      width="70%" 
      height="20%" 
      frameborder="0" 
      style="border:0;" 
      src=<?php echo "https://www.google.com/maps/embed/v1/place?key=AIzaSyAx6oYP91tCfnxkQVGmYplEXb7X6Ilsiv0&q=$info[address]";  ?>
      allowfullscreen>
  	</iframe></td></tr>
	<tr><td style="text-align: center;"><?php
		if ($authority > 0) {
			if ($collect == 0) {
				echo "<a href=$url/collect.php?collect=$collect>收藏此店家<br></a>";
			}
			else
				echo "<a href=$url/collect.php?collect=$collect>取消收藏<br></a>";
		}
		if($authority == 1){
			echo "<a href=$url/infoedit.php>編輯店家資訊</a>";
		}
	?></td></tr>
	<tr><td style="text-align: center; padding: 0px;">
	<?php
	if($authority > 0){
		if ($israte) {
			$rateresult = mysqli_query($db_link, "SELECT * FROM rates where Mid='$Mid' AND Sid='$Sid'");
			$myrate = mysqli_fetch_array($rateresult, MYSQLI_ASSOC);
			echo "<table><tr><td>你的評分：</td>";
			$grade = $myrate["rating"]/5*100;
			echo "<td><div class='star-rating'>
	        	<div class='star-rating-top' style='width:$grade%'>
		            <span>★</span>
		           	<span>★</span>
			         <span>★</span>
			         <span>★</span>
			        <span>★</span>
		        </div>
		        <div class='star-rating-bottom'>
			        <span>★</span>
			        <span>★</span>
			        <span>★</span>
			        <span>★</span>
			        <span>★</span>
	        	</div>
	    	</div></td></tr></table>";
		}
		else{
			echo "我要評分：
				<form action='rating.php' method='GET'><div class='rating'>
				<input type='radio' id='star5' name='rating' value='5' hidden/>
				<label for='star5'></label>
				<input type='radio' id='star4' name='rating' value='4' hidden/>
				<label for='star4'></label>
				<input type='radio' id='star3' name='rating' value='3' hidden/>
				<label for='star3'></label>
				<input type='radio' id='star2' name='rating' value='2' hidden/>
				<label for='star2'></label>
				<input type='radio' id='star1' name='rating' value='1' hidden/>
				<label for='star1'></label>
				</div>
				<input type='submit' value='評分'>
				</form>";
		}
	}
	?></td></tr></table>
</div>



<div class="list"><p>
<?php echo "總共 $count 篇文章<br>"; ?>
<?php
	if ($authority > 0) {
	 	echo "<a href='$url/post.php?name=$info[name]'>發費雯</a>";
	}
	else{
		echo "登入以發文";
	} 
?>
<table>
	<?php
	for ($i=0; $i < $count; $i++) { 
		$title = mysqli_fetch_array($titleresult, MYSQLI_ASSOC);
		if ($authority != 1) {
			if ($title["Mid"] == $Mid) {
				$authority = 2;
			}
			else{
				$authority = 0;
			}
		}
		echo "<tr class='article'>
			<td class='title'><a href='$url/article.php?Aid=$title[Aid]'>$title[title]</td></a>
			<td class='time'>$title[time]</td>";
			
			
		if($authority > 0){
			echo "<td class='delete'><a href='$url/deleteA.php?Aid=$title[Aid]'><input type='image' img src='$url\icons\blow.jpg' onclick='if(confirm(\"是否吹文章\")) return true;else return false'></a></td>
			</tr>";
		}

		
		$text = cut_content($title['context'], 60);
		echo "<tr><td class='context'>$text</td></tr>";
	}
	?>
</table>
</p></div>

</div>
</body>
</html>




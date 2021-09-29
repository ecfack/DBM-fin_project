<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>他的個人檔案</title>

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bree+Serif&family=EB+Garamond:ital,wght@0,500;1,800&display=swap');
body {
background: #DFC2F2;
	background-image: linear-gradient( to right, #ffffb3,#ffe6e6);
	background-attachment: fixed;	
	background-size: cover;
  
	}


#container{
	box-shadow: 0 15px 30px 1px grey;
	background: rgba(255, 255, 255, 0.90);
	text-align: center;
	border-radius: 5px;
	overflow: hidden;
	margin: 5em auto;
	height: 450px;
	width: 725px;
}
.product-details {
	position: relative;
	text-align: left;
	overflow: hidden;
	padding: 30px;
	height: 100%;
	float: left;
	width: 40%;
}

#container .product-details h1{
	font-family: 'Bebas Neue', cursive;
	display: inline-block;
	position: relative;
	font-size: 30px;
	color: #344055;
	margin: 0;
}

#container .product-details h1:before{
	position: absolute;
	content: '';
	right: 0%; 
	top: 0%;
	transform: translate(25px, -15px);
	font-family: 'Bree Serif', serif;
	display: inline-block;
	background: #ffe6e6;
	border-radius: 5px;
	font-size: 14px;
	padding: 5px;
	color: white;
	margin: 0;
	animation: chan-sh 6s ease infinite;

}

#container .product-details > p {
font-family: 'EB Garamond', serif;
	text-align: center;
	font-size: 18px;
	color: #7d7d7d;
	
}


.btn1 {
	float: left;
	transform: translateY(10px);
	transition: 0.3s linear;
	background:  #809fff;
	border-radius: 5px;

	position: absolute;
  	left: 8%;
  	top: 72.3%;

  	overflow: hidden;
	cursor: pointer;
	outline: none;
	border: none;
	color: #eee;
	padding: 0;
	margin: 0;
	
}

.btn2 {

	transform: translateY(-12.5px);
	transition: 0.3s linear;
	background:  #809fff;
	border-radius: 5px;

	position: absolute;
  	left: 74.25%;
  	top: 76.65%;

  	overflow: hidden;
	cursor: pointer;
	outline: none;
	border: none;
	color: #eee;
	padding: 0;
	margin: 0;
	
}

.btn3 {

	transform: translateY(-12.5px);
	transition: 0.3s linear;
	background:  #809fff;
	border-radius: 5px;

	position: absolute;
  	left: 41.25%;
  	top: 76.65%;

  	overflow: hidden;
	cursor: pointer;
	outline: none;
	border: none;
	color: #eee;
	padding: 0;
	margin: 0;
	
}

.btn1:hover{transform: translateY(4px);
	background: #1a66ff;}

.btn2:hover{transform: translateY(-18.5px);
	background: #1a66ff;}

.btn3:hover{transform: translateY(-18.5px);
	background: #1a66ff;}



.btn1 span {
	font-family: 'Farsan', cursive;
	transition: transform 0.3s;
	display: inline-block;
  padding: 10px 20px;
	font-size: 1.2em;
	margin:0;
	
}

.btn2 span {
	font-family: 'Farsan', cursive;
	transition: transform 0.3s;
	display: inline-block;
  padding: 10px 20px;
	font-size: 1.2em;
	margin:0;
	
}

.btn3 span {
	font-family: 'Farsan', cursive;
	transition: transform 0.3s;
	display: inline-block;
  padding: 10px 20px;
	font-size: 1.2em;
	margin:0;
	
}



.product-image {
	transition: all 0.3s ease-out;
	display: inline-block;
	position: relative;
	overflow: hidden;
	height: 100%;
	float: right;
	width: 45%;
	display: inline-block;
}

#container img {width: 100%;height: 100%;}

.info {
    background: rgba(27, 26, 26, 0.9);
    font-family: 'Bree Serif', serif;
    transition: all 0.3s ease-out;
    transform: translateX(-100%);
    position: absolute;
    line-height: 1.8;
    text-align: left;
    font-size: 105%;
    cursor: no-drop;
    color: #FFF;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}

.info h2 {text-align: center}
.product-image:hover .info{transform: translateX(0);}

.info ul li{transition: 0.3s ease;}
.info ul li:hover{transform: translateX(50px) scale(1.3);}

.product-image:hover img {transition: all 0.3s ease-out;}
.product-image:hover img {transform: scale(1.2, 1.2);}

.menu li:hover {
            transform: scale(1.2);
    }
	</style>


</head>
<body>


  <?php
  session_start();

  	$id = $_GET["id"];
  	if (isset($_SESSION['id'])) {
  		$oid = $_SESSION["id"];	
  	}
  	else{
  		$oid = "";
  	}
  	
  	function isLogin(){
			if($_SESSION["login_session"]==1)
				return true;
			else
				return false;
		}

		if (!isLogin()){
			$temp = "0";
			$oid = "";
		}
		else {
	  	$temp = $_SESSION["identity"];
		  	if ($id == $_SESSION['id']){
	  			header("Location:profile.php");
	  		}
		}
  	
  	include 'identity.php';
  	
  	
  	$follow = "0";

		

  	$sql = "SELECT * FROM member WHERE id='$id'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    $fsql = "SELECT * FROM follow WHERE fid ='$id' and id = '$oid'";
    $fresult = mysqli_query($link, $fsql);
    $ftotal_records = mysqli_num_rows($fresult);
    if ($ftotal_records > 0){
    	$follow = "1";
    }

    $nickname = $row[2];
    $email = $row[3];
    $tel = $row[4];
    $birth = $row[5];
    $identity = $row[6];
    $image = "images/".$row[8]."";
    $intro = $row[9];
    $level = $row[10];

  ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="container">	
	
	<div class="product-details">

		<?php if ($level == 1): ?>
			<h1><font color="#BF8970"><?php echo $nickname ?></font></h1>
		<?php elseif ($level == 2): ?>
			<h1><font color="silver"><?php echo $nickname ?></font></h1>
		<?php elseif ($level == 3): ?>
			<h1><font color="gold"><?php echo $nickname ?></font></h1>
		<?php endif ?>

		<h4>ID: <?php echo $id ?></h4>
		<h4>Email: <?php echo $email ?></h4>
		<h4>Birth: <?php echo $birth ?></h4>
		<h4>Phone: <?php echo $tel ?></h4>
		<h4>Identity: <?php echo $identity ?></h4>
		<?php if ($level == 1): ?>
			<h4>Level: <font color="#BF8970">Basic</font></h4>
		<?php elseif ($level == 2): ?>
			<h4>Level: <font color="silver">Standard</font></h4>
		<?php elseif ($level == 3): ?>
			<h4>Level: <font color="gold">Premium</font></h4>
		<?php endif ?>


	  <?php if ($follow == 0 && $oid != ""):?>
		<button class="btn1">
			<a href="follow.php?fid=<?="$id"?>" style="color:white;">
	    	<span class="buy"><b>Follow</b></span>
			</a>
	 	</button>

	  <?php elseif ($follow == 1 && $oid != ""): ?>
	  <button class="btn1">
			<a href="follow.php?fid=<?="$id"?>" style="color:white;">
	    	<span class="buy"><b>Untrack</b></span>
			</a>
	 	</button>

	  <?php endif ?>

    <?php if ($temp == "manager"):?>
		<button class="btn3">
			<a href="notification.php?id=<?=$id?>" style="color:white;">

	    	<span class="buy"><b>Bucket</b></span>
			</a>
	 	</button>

    <?php endif ?>

    <?php if ($oid != ""): ?>
	 	<button class="btn2">
			<a href="logout.php" style="color:white;">
	    	<span class="buy"><b>Logout</b></span>
			</a>
	 	</button>

	  <?php else: ?>
	  <button class="btn2">
			<a href="login.php" style="color:white;">
	    	<span class="buy"><b>Login</b></span>
			</a>
	 	</button>
	 <?php endif ?>
</div>
	
<div class="product-image">
	
	<img src="<?php echo($image)?>" alt="OOPS">

<div class="info">
	<h2> Introduction</h2>
	<ul>
		<li><strong><?php echo $intro ?></strong></li>
	</ul>
</div>
</div>

</div>





</body>
</html>
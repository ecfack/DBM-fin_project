<?php  
@session_start();
include 'connect.php';

if (!isset($_SESSION["login_session"])) {
	$_SESSION["login_session"] = 0;
}
$islogin = $_SESSION["login_session"];
$authority = 0;
$Mid = "";

if ($islogin == true) {
	$Mid = $_SESSION["id"];
	$res = mysqli_query($db_link, "SELECT * FROM `member` WHERE id='$Mid'");
	$Minfo = mysqli_fetch_array($res, MYSQLI_ASSOC);
	$type = $Minfo["identity"];
	$authority = 3;
	if ($type == "manager") {
	$authority = 1;
	}
}
$_SESSION["id"] = $Mid;
//echo "登入帳號：$_SESSION[id]";
//echo "$Mid";
//echo "$type";

echo "<div style='top: 0px;
    		margin: 0 auto;
    		margin-left: -50px;
    		padding: 5px;
    		padding-left: 70px;
    		width: 10000px;
    		display: flex;
    		align-items: center;
    		height: 40px;
    		position: fixed;
    		background: #00CACA;
    		z-index: 200;'>";
	if (!$islogin){
		echo "<a href='$url/login.php' target='_self' class='login'
			style = '
            z-index: 200;
            animation: outer-right 1s 1s cubic-bezier(0.5, 0, 0.1, 1) both;
            background: linear-gradient(to right, red, blue);
            -webkit-background-clip: text;
            color: transparent;
            padding:10px;
			font-size:20px;
            text-decoration: none;'
			> ☆Login now⇦ </a>";
	}
	else {
		//讀大頭貼
	  	$i_sql = "SELECT image FROM member where id = '$Mid'";
    	$i_result = mysqli_query($db_link, $i_sql);
    		$i_row = mysqli_fetch_array($i_result);

    	

		//顯示大頭貼
		echo "<img src=\"$url/images/".$i_row["image"]."\" 	
			style=\"
			animation: outer-right 1s 1s cubic-bezier(0.5, 0, 0.1, 1) both;
			border:1px solid black;
			z-index: 200;
			height: 100%;
    		\">";

    	//顯示文字跟超連結
		echo "<a href=\"$url/profile.php\"";
		echo "<span style=\"
			z-index: 200;
			animation: outer-right 1s 1s cubic-bezier(0.5, 0, 0.1, 1) both;
			background: linear-gradient(to right, red, blue);
        	-webkit-background-clip: text;
        	color: transparent;
			text-decoration:none;
			padding:10px;
			font-size:20px;
			\">Hi, ";
		echo $_SESSION["nickname"];
		echo "</span></a>";
	}
echo "
 	<ul class='menu' style='
 			overflow: hidden;
            display: inline-block;
            position:fixed;
            right: 0;
            font-size: 18px;
 			z-index: 200;
            list-style: none;
            display: block;
            list-style-type: disc;
            margin: 0;
            padding: 2px;
            
 			'>
        <li style='
        	margin: 0;
            padding: 8px;
        	list-style: none;
            float: left;
            vertical-align: top;
            border-left: 1px solid black;
            display: list-item;'>
            <a href='search1.php#shop' style='color: #5e5e5e; text-decoration:none;'>
                條件搜尋
            </a>
        </li>";
if ($islogin) {
	echo "
		<li style='
        	margin: 0;
            padding: 8px;
        	list-style: none;
            float: left;
            vertical-align: top;
            border-left: 1px solid black;
            display: list-item;'>
            <a href='mycollect.php#shop' style='color: #5e5e5e; text-decoration:none;'>
                我的收藏
            </a>
        </li>
	";

        
        
echo "
        <li style='
        	margin: 0;
            padding: 8px;
        	list-style: none;
            float: left;
            vertical-align: top;
            border-left: 1px solid black;
            display: list-item;'>
            <a href='fund.php' style='color: #5e5e5e; text-decoration:none;'>
                支持我們
            </a>
        </li>";
}

echo "
        <li style='
        	margin: 0;
            padding: 8px;
        	list-style: none;
            float: left;
            vertical-align: top;
            border-left: 1px solid black;
            display: list-item;'>
            <a href='cooperation.html' style='color: #5e5e5e; text-decoration:none;'>
                店家合作
            </a>
        </li>
    </ul>
";
echo "</div>";







echo "<a id='totop' href='' style='position: fixed;
 			bottom: 40px;
 			right: 2vw; z-index: 200;'><img src='$url\icons\gotop.png' style='width: 50px;
 			height: 50px;'></a>";

echo "<a id='home' href='$url/homepage.php' style='position: fixed;
 			bottom: 110px;
 			right: 2vw; z-index: 200;'><img src='$url\icons\home.png' style='width: 50px;
 			height: 50px;'></a>";
?>




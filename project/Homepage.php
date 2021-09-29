<?php
	//判斷有沒有登入
	/*function isLogin($id){
		if($id != "")
			return true;
		else
			return false;
	}
	$id = "";*/

	//link start
	include 'identity.php';


	
    // ---------------------
    //sql用熱度搜熱門店家跟文章
    $a_sql = "SELECT * from article as a ORDER BY hot DESC";
    $s_sql = "SELECT * from shop as a ORDER BY hot DESC";

    $a_result = mysqli_query($link,$a_sql);
    
    $s_result = mysqli_query($link,$s_sql);
    

    $a_row = mysqli_fetch_array($a_result);
    $a_row2 = mysqli_fetch_array($a_result);
    $a_row3 = mysqli_fetch_array($a_result);
    $s_row = mysqli_fetch_array($s_result);
    $s_row2 = mysqli_fetch_array($s_result);
    $s_row3 = mysqli_fetch_array($s_result);
    // -----------------------

    //砍字數，我看你那邊也有看你要怎麼統一
    function cut_content($a,$b){
    $a = strip_tags($a); //去除HTML標籤
    $sub_content = mb_substr($a, 0, $b, 'UTF-8'); //擷取子字串
    echo $sub_content;  //顯示處理後的摘要文字
    if (strlen($a) > strlen($sub_content)) echo "...";}
  ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>柏翰的美食地圖</title>
    <style type="text/css">
        * {
            position: relative;

            box-sizing: border-box;
        }


        #app {
            // opacity: 0 !important;
            // visibility: hidden;
            z-index: 100;

            &:hover {
                opacity: 0.5;
            }
        }

        #app {
            display: grid;
            grid-template-columns: 1fr 2fr;
            align-items: center;
            padding-bottom: 4vmin;
            width: 100%;
            background: #ede8e2;
            color: #3a3535;
        }

        body {
            display: grid;
            padding: 3vmin;
            background: #e6ded7;
        }

        .title {
            padding-left: 1em;
            grid-column: 1 / -1;
            grid-row: 1;

            font-family: "Prata", serif;
            font-size: 8vw;
            width: 100%;
            z-index: 2;

            // start

            >.title-inner {
                display: inline-block;
            }
        }

        ul,
        li,
        div {
            margin: 0;
            padding: 0;
        }


        
        a {
            color: #5e5e5e;
            text-decoration: none;
            cursor: pointer;
        }

        div {
            display: block;
        }


        @keyframes text-clip {
            from {
                clip-path: polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%);
            }

            to {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }
        }

        @keyframes outer-left {
            from {
                transform: translateX(50%);
            }

            to {
                transform: none;
            }
        }

        @keyframes inner-left {
            from {
                transform: translateX(-50%);
            }

            to {
                transform: none;
            }
        }

        @keyframes outer-right {
            from {
                transform: translateX(-300%);
            }

            to {
                transform: none;
            }
        }

        select {
            font-size: 1.5vw;
            cursor: pointer;
            align-items: left;
            animation: text-clip 1s 0.25s cubic-bezier(0.5, 0, 0.1, 1) both;
        }

        .pic,
        .hdr {
            animation: outer-left 1s 1s cubic-bezier(0.5, 0, 0.1, 1) both;
            // outline: 1px solid red;
        }

        // [class*='inner'] {
        //   outline: 1px solid blue;
        // }

        .search {
            font-size: 1.5vw;
            animation: text-clip 1s 0.25s cubic-bezier(0.5, 0, 0.1, 1) both;
        }

        .title-inner {
            display: inline-block;
            animation: inner-left 1s 1s ease both;
            text-shadow: 0px 0px 5px #FFFFFF;
        }

        .pic-inner {
            display: inline-block;
            animation: inner-left 1s 1s ease both,
                text-clip 1s 0s cubic-bezier(0.5, 0, 0.1, 1) both;
        }

        .hdr-inner {
            animation: text-clip 1s 0s cubic-bezier(0.5, 0, 0.1, 1) both;
        }

        .title {
            animation: outer-left 1s 1s ease both;
        }

        .pic {

            // start
            >.cafe-inner {
                display: inline-block;
            }
        }

        .hdr {
            display: inline-block;
        }

        .image {
            grid-row: 1;
            grid-column: 2;
            margin-left: -2rem;
            opacity: 0.7;

            animation: image-in 1s cubic-bezier(0.5, 0, 0.1, 1) 2s backwards;

            @keyframes image-in {
                from {
                    clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
                }

                to {
                    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
                }
            }

            img {
                display: block;
                width: 100%;
                height: auto;
            }
        }



        .text1 {
            font-size: 1vw;
            font-family: Microsoft JhengHei;
            font-color: black;
        }

        .a_block {
            display: block;
            padding: 4px;
            border: 1px solid transparent;
            margin: 0 2px;
        }

        .input_summit {
            border: 0;
            font-size: 18px;
            background-color: #e6ded7;
            cursor: pointer;
        }

        li:hover {
            transform: scale(1.2);
        }

        .hd2 {
            text-align: center;
            font-size: 2.5rem;
        }

        .divcenter {
            width: 750px;
            float: left;
            margin: 0 10px;
            overflow: hidden;
            margin: 0 auto;
        }

        .cbox {
            display: block;
            overflow: hidden;
            padding-left: 1px;
            margin-bottom: 0px;
            border: 1px solid #CCCCCC;
            border-bottom: 0px;
            text-align: left;

        }

        .cb_div {
            float: left;
            padding: 0 4px;
            text-align: left;
            margin: 7px 0;
            line-height: 1.3;
            width: 247.5px;
            border-right: 1px solid #CCCCCC;


        }

        .cb_img {
            border: 0;
            display: block;
            margin: 0 auto;
            margin-bottom: 5px;
            width: 180px;
            height: 180px;
            border-radius: 2px;
            box-shadow: 0 0 3px 1px rgb(200 200 200 / 50%);
        }

        .cb_diva {
            float: left;
            padding: 0 4px;
            text-align: left;
            margin: 7px 0;
            line-height: 1.3;
            width: 745px;
            border-bottom: 2px solid #CCCCCC;
        }
    </style>
</head>

<body>
    <!-- 主畫面跟簡易搜尋功能 -->
    <div id="app">
        <div class="title">
            <form name="search" action="search.php" method="get" style="display: flex;">
                <input type="text" placeholder="輸入關鍵字來搜尋" name="name" class="search" required="required">
                <select name="type">
                    <option value="shop">店家</option>
                    <option value="article">文章</option>
                    <option value="member">會員</option>
                </select>
                <input type="submit" value="搜尋" class="search" style="font-size: 1.5vw;cursor: pointer;align-items: left">
            </form>
            <div class="title-inner">
                <div class="pic">
                    <div class="pic-inner">Bohan's</div>
                </div>
                <div class="hdr">
                    <div class="hdr-inner">Food Map</div>
                </div>
            </div>
        </div>
        <div class="image">
            <img src='https://cdn.discordapp.com/attachments/620950880975323158/855358350739636235/foodmap.png'>
            <img src='https://cdn.discordapp.com/attachments/620950880975323158/855358350739636235/foodmap.png' style="position: absolute; right: 285px; top: 660px; width: 50px; height: 60px;">
        </div>
    </div>

   


    <!-- 顯示三篇熱門文章 -->
    <h1 class="hd2"> 熱門文章 </h1>
    <div class="divcenter">
        <div class="cbox">
            <div class="cb_diva">
                <?php
					$textnum = 120;//限制字數

					//顯示最上面搜到的熱門文章資訊
    				echo "<span style=\"font-size:24px;\">".$a_row['title']."</span>";
    				echo "<br>";
    				cut_content($a_row['context'],$textnum);
    				echo "<br><br>";
    				echo "<a href=\"article.php?Aid=". $a_row['Aid']. "\">..繼續閱讀</a>";
				?>
            </div>
            <div class="cb_diva">
                <?php		
    					echo "<span style=\"font-size:24px;\">".$a_row2['title']."</span>";
    					echo "<br>";
    					cut_content($a_row2['context'],$textnum);
    					echo "<br><br>";
    					echo "<a href=\"article.php?Aid=". $a_row2['Aid']. "\">..繼續閱讀</a>";
					?>
            </div>
            <div class="cb_diva">
                <?php		
    					echo "<span style=\"font-size:24px;\">".$a_row3['title']."</span>";
    					echo "<br>";
    					cut_content($a_row3['context'],$textnum);
    					echo "<br><br>";
    					echo "<a href=\"article.php?Aid=". $a_row3['Aid']. "\">..繼續閱讀</a>";
					?>
            </div>
        </div>
    </div>

    <!-- 原理跟熱門文章一樣但多了圖片-->
    <h1 class="hd2"> 熱門店家 </h1>
    <div class="divcenter">
        <div class="cbox">
            <div class="cb_div" name="article">
                <div>
                    <?php
						echo "<img src=$s_row[photo] style=\"border: 0;
				display: block;
    			margin: 0 auto;
    			margin-bottom: 5px;
    			width: 180px;
    			height: 180px;
    			border-radius: 2px;
    			box-shadow: 0 0 3px 1px rgb(200 200 200 / 50%);\">";
					?>
                </div>
                <div style="height: 150px;width: 180px;margin: 0 auto;">
                    <?php
						echo "<br>";
						echo "<span style=\"font-size:18px;\">".$s_row['name']."</span>";
						echo "<br><br><br>";
    					echo "<a href=\"reqArticleList.php?Sid=". $s_row['Sid']. "\" style=\"left:105px;\">..查看詳情</a>";
					?>
                </div>
            </div>
            <div class="cb_div" name="article">
                <div>
                    <?php
						echo "<img src=$s_row2[photo] style=\"border: 0;
							display: block;
			    			margin: 0 auto;
			    			margin-bottom: 5px;
			    			width: 180px;
			    			height: 180px;
			    			border-radius: 2px;
			    			box-shadow: 0 0 3px 1px rgb(200 200 200 / 50%);\">";
					?>
                </div>
                <div style="height: 150px;width: 180px;margin: 0 auto;">
                    <?php
						echo "<br>";
						echo "<span style=\"font-size:18px;\">".$s_row2['name']."</span>";
						echo "<br><br><br>";
    					echo "<a href=\"reqArticleList.php?Sid=". $s_row2['Sid']. "\" style=\"left:105px;\">..查看詳情</a>";
					?>
                </div>
            </div>
            <div class="cb_div" name="article" style="border-right: 0">
                <div>
                    <?php
						echo "<img src=$s_row3[photo] style=\"border: 0;
							display: block;
    						margin: 0 auto;
    						margin-bottom: 5px;
    						width: 180px;
    						height: 180px;
    						border-radius: 2px;
    						box-shadow: 0 0 3px 1px rgb(200 200 200 / 50%);\">";
					?>
                </div>
                <div style="height: 150px;width: 180px;margin: 0 auto;">
                    <?php
						echo "<br>";
						echo "<span style=\"font-size:18px;\">".$s_row3['name']."</span>";
						echo "<br><br><br>";
    					echo "<a href=\"reqArticleList.php?Sid=". $s_row3['Sid']. "\" style=\"left:105px;\">..查看詳情</a>";
					?>
                </div>
            </div>
           	<form action="search.php" method="post" style="float: right; padding: 10px;">
           		<input type="hidden" name="type" value="shop">
           		<input type="submit" value="更多商店.." style="font-size: 20px;">
           	</form>
        </div>
    </div>

</body>

</html>
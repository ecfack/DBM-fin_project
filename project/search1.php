<?php include 'identity.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>條件搜尋</title>
    <style type="text/css">
        #container{
            margin-top: 50px;
        }
        article{
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
        article {
            margin: 0 auto;
            padding: 20px;
            background-color: #FAF0E6;
            font: 1rem 'Fira Sans', sans-serif;
            width: 50%;
        }

        input {
            text-align: center;
        }

   

        div p{
            text-align: center;
        }

        #container ul{
            margin: 0 auto;
            padding: 10px 20px 0 20px;
        }

        #container li{
            list-style-type: none;
            float: left;
        }

        #container2 li a:hover{
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

        #container .search{
            clear:both;
            padding: 0;
            height:0;
            margin: 0;
            visibility:hidden;
            text-align: center;
        }


    
        #shop:target ~ #container > div ul li a[href$="#shop"],
        #article:target ~ #container > div ul li a[href$="#article"],
        #member:target ~ #container > div ul li a[href$="#member"]{
            font-size: 24px;
            font-weight: bold;
            background: #DDDDDD;
            border-radius: 20px;
        }

        
        #shop:target ~ #container > #shop-search,
        #article:target ~ #container > #article-search,
        #member:target ~ #container > #member-search{
            visibility:visible;
        }
        #container2{
            display: flex;
            align-items: center;
        }
        input{
            border-radius: 5px;
            margin: 10px;
        }
        .menu li:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>

    <span id="shop" hidden="hidden">shop</span>
    <span id="article" hidden="hidden">article</span>
    <span id="member" hidden="hidden">member</span>

<div id="container">
    <div id="container2">
    <ul>
        <li><a href="#shop">店家搜尋</a></li>
        <li><a href="#article">文章搜尋</a></li>
        <li><a href="#member">會員搜尋</a></li>
    </ul>
    </div>
    <!-- 店家的搜尋 -->
<div id="shop-search" class="search">
    <article>
        <form method="post" action="search.php">
            <fieldset>
                <legend>商店搜尋(空白則為不指定)</legend>
                <input type="hidden" name="type" value="shop">

                <div>
                    <label>
                        <p>商店名稱：</p>
                        <input type="text" name="name">
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            所在縣市：
                        </p>

                        <select name="city">
                            <option value="">不限</option>
                            <option value="臺北市">臺北市</option>
                            <option value="新北市">新北市</option>
                            <option value="基隆市">基隆市</option>
                            <option value="桃園市">桃園市</option>
                            <option value="新竹市">新竹市</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="苗栗縣">苗栗縣</option>

                            <option value="臺中市">臺中市</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>

                            <option value="雲林縣">雲林縣</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="嘉義縣">嘉義縣</option>
                            <option value="臺南市">臺南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="屏東縣">屏東縣</option>

                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="臺東縣">臺東縣</option>

                            <option value="澎湖縣">澎湖縣</option>
                            <option value="金門縣">金門縣</option>
                            <option value="連江縣">連江縣</option>
                        </select>
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            店主ID：
                        </p>
                        <input type="text" name="shopkeeper">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            店家ID：</p>
                        <input type="number" name="Sid">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            評價：<br>(若指定範圍則不顯示尚未評價之店家)
                        </p>
                        <input type="number" name="ratingLow" min="1" max="5">
                        ~
                        <input type="number" name="ratingUp" min="1" max="5">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            地址：
                        </p>
                        <input type="text" name="address">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            電話：
                        </p>
                        <input type="text" name="tel">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            最低消費：
                        </p>
                        <input type="number" name="minCost">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            營業時間：
                        </p>
                        <input type="time" name="openHours" value="00:00">
                        ~
                        <input type="time" name="closeHours" value="23:59">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            點擊量：
                        </p>
                        <input type="number" name="hotLow" min="0">
                        ~
                        <input type="number" name="hotUp" min="0">
                        <br>
                    </label>
                </div>
                <hr>
                <div>
                    <label>
                        <p>
                            <input type="submit" value="搜尋!!">
                        </p>
                    </label>
                </div>
            </fieldset>
        </form>
    </article>
</div>
    <!-- 文章的搜尋 -->
<div id="article-search" class="search">
    <article>
        <form method="post" action="search.php">
            <fieldset>
                <legend>文章搜尋(空白則為不指定)</legend>
                <input type="hidden" name="type" value="article">

                <div><label>
                        <p>
                            文章ID：
                        </p>
                        <input type="number" name="Aid">
                    </label>
                </div>
                <hr>
                <div><label>
                        <p>
                            文章作者ID：
                        </p>
                        <input type="text" name="Mid">
                    </label>
                </div>
                <hr>
                <div><label>
                        <p>
                            發文日期：
                        </p>
                        <input type="date" name="timeLow">
                        ~
                        <input type="date" name="timeUp">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            文章介紹的店家ID：
                        </p>
                        <input type="number" name="Sid">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            文章標題：
                        </p>
                        <input type="text" name="title">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            文章內容：
                        </p>
                        <input type="text" name="context">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            點擊量：
                        </p>
                        <input type="number" name="hotLow" min="0">
                        ~
                        <input type="number" name="hotUp" min="0">
                    </label></div>
                <hr>
                <div><label>
                        <input type="submit" value="搜尋!!">
                    </label></div>
            </fieldset>
        </form>
    </article>
</div>
    <!-- 會員的搜尋 -->
<div id="member-search" class="search">
    <article>
        <form method="post" action="search.php">
            <fieldset>
                <legend>會員搜尋(空白則為不指定)</legend>
                <input type="hidden" name="type" value="member">

                <div><label>
                        <p>
                            會員ID：
                        </p>
                        <input type="text" name="id">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            會員暱稱：
                        </p>
                        <input type="text" name="nickname">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            e-mail：
                        </p>
                        <input type="text" name="email">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            電話：
                        </p>
                        <input type="text" name="tel">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            生日：
                        </p>
                        <input type="date" name="birthLow">
                        ~
                        <input type="date" name="birthUp">
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            身分別：
                        </p>
                        <!-- <input type="text" name="identity" > -->
                        <select name="identity">
                            <option value="">不限</option>
                            <option value="member">member</option>
                            <option value="manager">manager</option>
                            <option value="shopkeeper">shopkeeper</option>
                        </select>
                    </label></div>
                <hr>
                <div><label>
                        <p>
                            水桶數：
                        </p>
                        <input type="number" name="bucketLow" min="0">
                        ~
                        <input type="number" name="bucketUp" min="0">
                    </label></div>
                <hr>
                <div><label>
                        <input type="submit" value="搜尋!!">
                    </label></div>
            </fieldset>
        </form>
    </article>
</div>
</div>
</body>

</html>
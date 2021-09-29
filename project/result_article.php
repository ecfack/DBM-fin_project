<?php 
    include 'identity.php'; 
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
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>搜尋結果</title>
    <style>
    p {

    max-width: 200px;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    }
    body{
        display: block;

        background: #FAF0E6;
    }
    header{
        margin-top: 60px;
        font-size: 40px;
        padding-left: 10%;
        font-weight: bold;
    }
    td{
        width: 80%;
        padding: 20px;
        height: 20px;
        color: #666666;
    }

    table{
        margin-left: 10%;
        width:80%;
        
    }
    .link{
        font-size: 24px;
    }
    .hot{
        float: right;
    }
    .menu li:hover {
            transform: scale(1.2);
    }
    </style>
</head>

<body style="margin:0px">
    <header>搜尋結果：</header>
    <table>
        <?php
        $ctr=0;
        foreach ($_SESSION["result"] as $row) {
            echo "<tr>";
            echo "<td><a class='link' href='article.php?Aid=".$row[0]."'>" . $row[4] . "</a>";
            echo "<span class='hot'><img src='$url\icons\hot.png' style='height: 30px; width: 30px;'>".$row[6]."</span><br>";
            echo cut_content($row[5],60)."</td>";
            echo "</tr>";

            $ctr=$ctr+1;
        }

        // unset($_SESSION["result"]);
        ?>
    </table>
</body>

</html>
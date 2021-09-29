<?php include 'identity.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <script type="text/javascript" src="http://api.tgos.tw/TGOS_API/tgos?ver=2&AppID=x+JLVSx85Lk=&APIKey=in8W74q0ogpcfW/STwicK8D5QwCdddJf05/7nb+OtDh8R99YN3T0LurV4xato3TpL/fOfylvJ9Wv/khZEsXEWxsBmg+GEj4AuokiNXCh14Rei21U5GtJpIkO++Mq3AguFK/ISDEWn4hMzqgrkxNe1Q==" charset="utf-8"></script>
    <script type="text/javascript" src="mapTGOS2.js?time=<%=new Date().getTime()%>"></script>
    <!-- <script type="text/javascript" src="mapGoogle.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./mapGoogle.css" /> -->
    <title>搜尋結果</title>
    <style>
    body{
        display: block;
        padding-top: 0px;
        margin-top: 100px;
        background: #FAF0E6;
    }
    .info{
        width: 400px;
        padding: 40px;
        
        color: #666666;
    }

    #t {
        margin-top: 80px;
        margin-left: 10%;
    }
    .shopimage{
        width: 150px;
        height: 150px;
        border-radius: 20px;
    }
    .link{
        font-size: 24px;
    }
    .menu li:hover {
            transform: scale(1.2);
    }
    </style>

</head>

<body style="margin:0px" onload="InitWnd();">
<!-- <body style="margin:0px"> -->
<!--    <input name="Submit" type="button" id="Submit" onClick="javascript:history.back(1)" value="回上一頁" /><br>
    <input type="button" value="首頁" onclick="self.location.href=href='Homepage.php'"/> 
-->
    
    <table id="t" >
        <tr>
            <!--<th>順位</th>-->
            <th>照片</th>
            <th>店家簡介</th>
        </tr>
        <?php

        $ctr=0;
        foreach ($_SESSION["result"] as $row) {
            #echo "<td>".($ctr+1)."</td>";

            if ($row[5])
                echo "<td class='image'><img class='shopimage' src='$row[5]'></td>";
            else
                echo "<td class='image'>" . $row[5] . "</td>";
                $row[7] = mb_substr($row[7], 0, 5, 'UTF-8');
                $row[8] = mb_substr($row[8], 0, 5, 'UTF-8');
            echo "<td class='info'><article>".
                "<a class='link' href='reqArticleList.php?Sid=$row[0]'>" . $row[10] . "</a>".
                "<br>地址: ".$row[3].
                "<br>電話: ".$row[4].
                "<br>營業時間: ".$row[7]."~". $row[8].
                "</article></td>";
            // echo "<td>" . $row[11] . "</td>";

            echo "<input type='hidden' id='".$ctr."_Name' name='shopName' value=" . $row[10] . ">";
            echo "<input type='hidden' id='".$ctr."_X' name='posX' value=" . $row[12] . ">";
            echo "<input type='hidden' id='".$ctr."_Y' name='posY' value=" . $row[13] . ">";
            echo "</tr>";

            $ctr=$ctr+1;
        }
        ?>
    </table>

    
    <div id="OMap" style="position:fixed; top:15%; right:5%; width:400px; height:400px; border:1px solid #000000;"></div>
    
</body>

</html>
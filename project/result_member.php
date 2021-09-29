<?php include 'identity.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
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

    table{
        margin-top: 80px;
        margin-left: 10%;
    }
    .image{
        width: 150px;
        height: 150px;
        border-radius: 40px;
    }
    .link{
        font-size: 24px;
    }
    .menu li:hover {
            transform: scale(1.2);
    }

    </style>
</head>

<body style="margin:0px">
    <header>搜尋結果：</header>
    <table >
        <tr>
            <th>相片</th>
            <th>個人簡介</th>
        </tr>
        <?php


        $ctr=0;
        foreach ($_SESSION["result"] as $row) {
            echo "<tr>";
            echo "<td><img class='image' src='images/$row[8]'></td>";
            echo "<td class='info'><article>".
                "<div> <a class='link' href='othermember.php?id=".$row[0]."'>" . $row[2] ."</a>".
                "<br>e-mail: ".$row[3].
                "<br>身分別: ".$row[6].
                "<br>簡介:".$row[9]."".
                "</div></article></td>";
            echo "</tr>";

            $ctr=$ctr+1;
        }

        // unset($_SESSION["result"]);
        ?>
    </table>
</body>

</html>
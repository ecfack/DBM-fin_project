<?php
function req_shop_post()
{
  $Sid = $_POST["Sid"];
  $ratingLow = $_POST["ratingLow"];
  $ratingUp = $_POST["ratingUp"];
  $address = $_POST["address"];
  $tel = $_POST["tel"];
  $minCost = $_POST["minCost"];
  $openHours = $_POST["openHours"];
  $closeHours = $_POST["closeHours"];
  $hotLow = $_POST["hotLow"];
  $hotUp = $_POST["hotUp"];
  $name = $_POST["name"];
  $shopkeeper = $_POST["shopkeeper"];
  $city=$_POST["city"];

  $sql = "SELECT * FROM shop WHERE";
  if ($name) {
    $sql .= " name LIKE '%" . $name . "%' AND";
  }
  if ($shopkeeper) {
    $sql .= " shopkeeper LIKE'%" . $shopkeeper . "%' AND";
  }
  if ($Sid) {
    $sql .= " Sid=" . $Sid . " AND";
  }
  if ($address) {
    $sql .= " address LIKE '%" . $address . "%'" . " AND";
  }
  if ($tel) {
    $sql .= " tel LIKE'" . $tel . "%' AND";
  }
  if ($minCost) {
    $sql .= " minCost>=" . $minCost . " AND";
  }
  if ($openHours&&$closeHours) {
    $sql .="((openHours>='$openHours' AND openHours<='$closeHours') OR (closeHours>='$openHours' AND closeHours<='$closeHours') OR (openHours<='$openHours' AND closeHours>='$closeHours')) AND";
  }
  else if ($openHours) {
    $sql .= " openHours>='" . $openHours . "' AND";
  }
  else if ($closeHours) {
    $sql .= " closeHours<='" . $closeHours . "' AND";
  }
  if ($hotLow) {
    $sql .= " hot>=" . $hotLow . " AND";
  }
  if ($hotUp) {
    $sql .= " hot<=" . $hotUp . " AND";
  }
  $sql.=" address LIKE'".$city."%' AND";
  $sql .= " 1";
  if ($ratingLow||$ratingUp) {
    $sql.=" AND Sid IN (SELECT Sid FROM rates WHERE 1 GROUP BY Sid HAVING ";
    if ($ratingLow) {
      $sql .="AVG(rating) >= $ratingLow AND ";
    }
    if ($ratingUp) {
      $sql .="AVG(rating) <= $ratingUp AND ";
    }
    $sql .="1)";
  }
  return $sql;
}

function req_shop_get()
{
  $name = $_GET["name"];

  $sql = "SELECT * FROM shop WHERE name LIKE'%" . $name . "%'";

  return $sql;
}

function req_article_post()
{
  $Aid = $_POST["Aid"];
  $Mid = $_POST["Mid"];
  $timeUp = $_POST["timeUp"];
  $timeLow = $_POST["timeLow"];
  $Sid = $_POST["Sid"];
  $title = $_POST["title"];
  $context = $_POST["context"];
  $hotLow = $_POST["hotLow"];
  $hotUp = $_POST["hotUp"];

  $sql = "SELECT * FROM article WHERE";
  if ($Aid != "") {
    $sql .= " Aid=" . $Aid . " AND";
  }
  if ($Mid) {
    $sql .= " Mid='" . $Mid . "' AND";
  }
  if ($timeLow) {
    $sql .= " time>='" . $timeLow . "' AND";
  }
  if ($timeUp) {
    $sql .= " time<='" . $timeUp . "' AND";
  }
  if ($Sid) {
    $sql .= " Sid=" . $Sid . " AND";
  }
  if ($title) {
    $sql .= " title LIKE'%" . $title . "%' AND";
  }
  if ($context) {
    $sql .= " context LIKE'%" . $context . "%' AND";
  }
  if ($hotLow) {
    $sql .= " hot>='" . $hotLow . "' AND";
  }
  if ($hotUp) {
    $sql .= " hot<='" . $hotUp . "' AND";
  }
  $sql .= " 1";

  return $sql;
}

function req_article_get()
{
  $name = $_GET["name"];

  $sql = "SELECT * FROM article WHERE title LIKE'%" . $name . "%'";

  return $sql;
}

function req_member_post()
{
  $id = $_POST["id"];
  $nickname = $_POST["nickname"];
  $email = $_POST["email"];
  $tel = $_POST["tel"];
  $birthLow = $_POST["birthLow"];
  $birthUp = $_POST["birthUp"];
  $identity = $_POST["identity"];
  $bucketLow = $_POST["bucketLow"];
  $bucketUp = $_POST["bucketUp"];

  $sql = "SELECT * FROM member WHERE";
  if ($id) {
    $sql .= " id='" . $id . "' AND";
  }
  if ($nickname) {
    $sql .= " nickname LIKE'%" . $nickname . "%' AND";
  }
  if ($email) {
    $sql .= " email ='" . $email . "' AND";
  }
  if ($tel) {
    $sql .= " tel='" . $tel . "' AND";
  }
  if ($birthLow) {
    $sql .= " birth>='" . $birthLow . "' AND";
  }
  if ($birthUp) {
    $sql .= " birth<='" . $birthUp . "' AND";
  }
  if ($identity) {
    $sql .= " identity='" . $identity . "' AND";
  }
  if ($bucketLow) {
    $sql .= " bucket>=" . $birthLow . " AND";
  }
  if ($bucketUp) {
    $sql .= " bucket<=" . $birthUp . " AND";
  }
  $sql .= " 1";
  return $sql;
}

function req_member_get()
{
  $name = $_GET["name"];

  $sql = "SELECT * FROM member WHERE nickname LIKE'%" . $name . "%'";

  return $sql;
}
?>

<?php
session_start();  // 啟用交談期
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "POST":
    $searchType = $_POST["type"];
    switch ($searchType) {
      case "shop":
        $sql = req_shop_post();
        break;

      case "article":
        $sql = req_article_post();
        break;

      case "member":
        $sql = req_member_post();
        break;
    }
    break;

  case "GET":
    $searchType = $_GET["type"];
    switch ($_GET["type"]) {
      case "shop":
        $sql = req_shop_get();
        break;
      case "article":
        $sql = req_article_get();
        break;

      case "member":
        $sql = req_member_get();
        break;
    }
    break;
}


// 建立MySQL的資料庫連接 
include 'connect.php';

// 執行SQL查詢
if ($result = mysqli_query($link, $sql)) {    //失敗則回傳0

  
  if (mysqli_num_rows($result) > 0) {   //取得資料筆數
    unset($_SESSION["result"]);
    $_SESSION["results"] = array(); //搜尋結果構成的陣列

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {  //每次取1row
      // array_push($_SESSION["result"],$row);  //empty arr視為null,會跳錯誤

      $_SESSION["result"][] = $row;
    }

    mysqli_free_result($result);    // Free result set
    mysqli_close($link);  //關閉連接

    if ($searchType == "shop")
      header("Location: result_shop.php");
    else if ($searchType == "article")
      header("Location: result_article.php");
    else if ($searchType == "member")
      header("Location: result_member.php");
  } else {
    /*echo "<div style='position: absolute; top:40%; width: 100%; text-align: center; font-size: 40px;'>查無資料!!<br><input type='button' value='重新輸入' onclick='history.back()'></div>";*/
    echo "
        <script language='JavaScript'>
          alert('查無資料!')
          window.history.go(-1);
      </script>
          ";
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);  //關閉連接
?>



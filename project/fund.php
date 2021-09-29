

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pricing Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<link rel="stylesheet" href="style.css">
  <style type="text/css">
   @import url('https://fonts.googleapis.com/css?family=Roboto:300');
body{
  margin: 0;
  padding: 0;
 font-family: 'Roboto', sans-serif !important;
}
section{
  width: 100%;
  height: 100vh;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
          padding: 140px 0;
}
div{
  display: block;
  justify-content: normal;
}
.card{
  position: relative;
  max-width: 300px;
  height: auto;
  background: linear-gradient(-45deg,#fe0847,#feae3f);
  border-radius: 15px;
  margin: 0 auto;
  overflow: hidden;
  padding: 40px 20px;
  -webkit-box-shadow: 0 10px 15px rgba(0,0,0,.1) ;
          box-shadow: 0 10px 15px rgba(0,0,0,.1) ;
-webkit-transition: .5s;
transition: .5s;
}
.card:hover{
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
}
.col-sm-4:nth-child(1) .card ,
.col-sm-4:nth-child(1) .card .title .fa{
  background: linear-gradient(-45deg,#f403d1,#64b5f6);

}
.col-sm-4:nth-child(2) .card,
.col-sm-4:nth-child(2) .card .title .fa{
  background: linear-gradient(-45deg,#ffec61,#f321d7);

}
.col-sm-4:nth-child(3) .card,
.col-sm-4:nth-child(3) .card .title .fa{
  background: linear-gradient(-45deg,#24ff72,#9a4eff);

}
.card::before{
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 40%;

  background: rgba(255, 255, 255, .1);
z-index: 1;
-webkit-transform: skewY(-5deg) scale(1.5);
        transform: skewY(-5deg) scale(1.5);
}
.title .fa{
  color:#fff;
  font-size: 60px;
  width: 100px;
  height: 100px;
  border-radius:  50%;
  text-align: center;
  line-height: 100px;
  -webkit-box-shadow: 0 10px 10px rgba(0,0,0,.1) ;
          box-shadow: 0 10px 10px rgba(0,0,0,.1) ;

}
.title h2 {
  position: relative;
  margin: 20px  0 0;
  padding: 0;
  color: #fff;
  font-size: 28px;
 z-index: 2;
}
.price,.option{
  position: relative;
  z-index: 2;
}
.price h4 {
margin: 0;
padding: 20px 0 ;
color: #fff;
font-size: 60px;
}
.option ul {
  margin: 0;
  padding: 0;

}
.option ul li {
margin: 0 0 10px;
padding: 0;
list-style: none;
color: #fff;
font-size: 16px;
}
.card a {
  position: relative;
  z-index: 2;
  background: #fff;
  color : black;
  width: 150px;
  height: 40px;
  line-height: 40px;
  border-radius: 40px;
  display: block;
  text-align: center;
  margin: 20px auto 0 ;
  font-size: 16px;
  cursor: pointer;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
          box-shadow: 0 5px 10px rgba(0, 0, 0, .1);

}
.card a:hover{
    text-decoration: none;
}

  </style>
</head>
<body>


<?php
    include 'identity.php';
    $id = $_SESSION["id"];
    $level = $_SESSION["level"];
?>

<section>
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="card text-center">
            <div class="title">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              <h2>Basic</h2>
            </div>
            <div class="price">
              <h4><sup>$</sup>0</h4>
            </div>
            <div class="option">
              <ul>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Basic Post </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Basic Comment </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Basic Color ID </li>
              </ul>
            </div>
            <a> Purchased </a>
          </div>
        </div>
        <!-- END Col one -->
        <div class="col-sm-4">
          <div class="card text-center">
            <div class="title">
              <i class="fa fa-plane" aria-hidden="true"></i>
              <h2>Standard</h2>
            </div>
            <div class="price">
              <h4><sup>$</sup><span style="text-decoration: line-through;">50</span> 0</h4>
            </div>
            <div class="option">
              <ul>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Standard Post </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Standard Comment </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Standard Color ID </li>
              </ul>
            </div>
            <?php if($level < 2): ?>
              <a href="vip.php?level=<?=$level?>&plevel=2">Order Now </a>
            <?php else: ?>
              <a> Purchased </a>
            <?php endif ?>
          </div>
        </div>
        <!-- END Col two -->
        <div class="col-sm-4">
          <div class="card text-center">
            <div class="title">
              <i class="fa fa-rocket" aria-hidden="true"></i>
              <h2>Premium</h2>
            </div>
            <div class="price">
              <h4><sup>$</sup><span style="text-decoration: line-through;">100</span> 0</h4>
            </div>
            <div class="option">
              <ul>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Premium Post </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Premium Comment </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Premium Color ID </li>
              </ul>
            </div>
            <?php if($level < 3): ?>
              <a href="vip.php?level=<?=$level?>&plevel=3">Order Now </a>
            <?php else: ?>
              <a> Purchased </a>
            <?php endif ?>
          </div>
        </div>
        <!-- END Col three -->
      </div>
    </div>
  </div>
</section>
</body>
</html>

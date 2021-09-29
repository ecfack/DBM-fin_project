<?php
  session_start();
  include 'connect.php';
  $id= "";
  $password= "";
  $rpassword= "";
  $temp = "0";

  if (isset ($_POST["id"]))
    $id = $_POST["id"];
  if (isset ($_POST["password"]))
    $password = $_POST["password"];
  if (isset ($_POST["rpassword"]))
    $rpassword = $_POST["rpassword"];

    
    if ($password != "" && $rpassword != ""){
      if ($password == $rpassword){
        $tsql = "SELECT * FROM member where id = '$id'and password = '$password'";
        $result = mysqli_query($link, $tsql);
        $total_records = mysqli_num_rows($result);
        if ( $total_records > 0 ) {
          $sql = "DELETE FROM member where id = '$id'and password = '$password'";
          mysqli_query($link, $sql);
          $temp = "1";
          $_SESSION['login_session'] = 0;
//        echo "帳號已註銷，點擊跳轉回登入頁面<br>";
        } else {
          $temp = "2";
  //      echo "帳號或密碼有誤，請重新輸入<br/>";
        }
      } else {
        $temp = "3";
//      echo "密碼不一致，請重新輸入<br/>";
      }
    } else {
      $temp = "4";
//    沒事  
    }
  $link->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>註銷</title>
     <style type="text/css">
body{
  margin:0;
  color:#6a6f8c;
  background:#c8c8c8;
  font:600 16px/18px 'Open Sans',sans-serif;
}
*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}

.login-wrap{
  width:100%;
  margin:auto;
  max-width:525px;
  min-height:670px;
  position:relative;
  background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
  box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
  width:100%;
  height:100%;
  position:absolute;
  padding:90px 70px 50px 70px;
  background:rgba(40,57,101,.9);
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
  top:0;
  left:0;
  right:0;
  bottom:0;
  position:absolute;
  transform:rotateY(180deg);
  backface-visibility:hidden;
  transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
  display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
  text-transform:uppercase;
}
.login-html .tab{
  font-size:22px;
  margin-right:15px;
  padding-bottom:5px;
  margin:0 15px 10px 0;
  display:inline-block;
  border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
  color:#fff;
  border-color:#1161ee;
}
.login-form{
  min-height:345px;
  position:relative;
  perspective:1000px;
  transform-style:preserve-3d;
}
.login-form .group{
  margin-bottom:15px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
  width:100%;
  color:#fff;
  display:block;
}
.login-form .group .input,
.login-form .group .button{
  border:none;
  padding:15px 20px;
  border-radius:25px;
  background:rgba(255,255,255,.1);
}
.login-form .group input[data-type="password"]{
  text-security:circle;
  -webkit-text-security:circle;
}
.login-form .group .label{
  color:#aaa;
  font-size:12px;
}
.login-form .group .button{
  background:#1161ee;
}
.login-form .group label .icon{
  width:15px;
  height:15px;
  border-radius:2px;
  position:relative;
  display:inline-block;
  background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
  content:'';
  width:10px;
  height:2px;
  background:#fff;
  position:absolute;
  transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
  left:3px;
  width:5px;
  bottom:6px;
  transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
  top:6px;
  right:0;
  transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
  color:#fff;
}
.login-form .group .check:checked + label .icon{
  background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
  transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
  transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
  transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
  transform:rotate(0);
}

.hr{
  height:2px;
  margin:60px 0 50px 0;
  background:rgba(255,255,255,.2);
}
.foot-lnk{
  text-align:center;
}
    </style>
</head>

<body>

<?php if ($temp == 1): ?>
    <script language="JavaScript">
  alert("Your delete was successful!")
  window.location="login.php"
  </script>
<?php elseif ($temp == 2): ?>

<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">delete</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

    <div class="login-form">
      <div class="sign-in-htm">

<form method="post" action="delete.php">
      <div class="group">
          <label for="id" class="label"><font color="yellow">* </font>id</label>
          <input id="id" type="text" name="id" class="input">
          <label class="label"><font color="red"><b>The passwords you entered do not match</b></font></label>
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Password</label>
          <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="rpassword" class="label"><font color="yellow">* </font>Repeat Password</label>
          <input id="rpassword" type="password" name="rpassword" class="input" data-type="password">
        </div>
        <div class="group">
          <input type="submit" class="button" value="confirm">
          <label class="label"><font color="red"><b>This step will make your account gone</b></font></label>
        </div>
</form>        
      </div>
    </div>
  </div>
</div>

<?php elseif ($temp == 3): ?>

<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">delete</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

    <div class="login-form">
      <div class="sign-in-htm">

<form method="post" action="delete.php">
      <div class="group">
          <label for="id" class="label"><font color="yellow">* </font>id</label>
          <input id="id" type="text" name="id" class="input">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Password</label>
          <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="rpassword" class="label"><font color="yellow">* </font>Repeat Password</label>
          <input id="rpassword" type="password" name="rpassword" class="input" data-type="password">
          <label class="label"><font color="red"><b>Two passwords you entered do not match</b></font></label>
        </div>
        <div class="group">
          <input type="submit" class="button" value="confirm">
          <label class="label"><font color="red"><b>This step will make your account gone</b></font></label>
        </div>
</form>        
      </div>
    </div>
  </div>
</div>

<?php elseif ($temp == 4): ?>

<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">delete</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

    <div class="login-form">
      <div class="sign-in-htm">

<form method="post" action="delete.php">
      <div class="group">
          <label for="id" class="label"><font color="yellow">* </font>id</label>
          <input id="id" type="text" name="id" class="input">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Password</label>
          <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="rpassword" class="label"><font color="yellow">* </font>Repeat Password</label>
          <input id="rpassword" type="password" name="rpassword" class="input" data-type="password">
        </div>
        <div class="group">
          <input type="submit" class="button" value="confirm">
          <label class="label"><font color="red"><b>This step will make your account gone</b></font></label>
        </div>
</form>        
      </div>
    </div>
  </div>
</div>
<?php endif ?>


<a id='totop' href='homepage.php' style='position: fixed;
      bottom: 110px;
      right: 2vw; z-index: 200;'><img src='icons\home.png' style='width: 50px;
      height: 50px;'></a>
</body>
</html>
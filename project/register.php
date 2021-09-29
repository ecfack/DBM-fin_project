<?php
      $id = $_POST["id"];
      $password = $_POST["password"];
      $repassword = $_POST["repassword"];
      $email = $_POST["email"];
      $temp = "0";

  session_start();  // 啟用交談期
    include 'connect.php';

$tsql = "SELECT * FROM member where id = '$id'";

    $result = mysqli_query($link, $tsql);
    $total_records = mysqli_num_rows($result);

if ( $total_records == 0 ) {
  if ($id != "" && $password != "" && $repassword != "" && $email != ""){
    if ($password == $repassword){
      $temp = "1";

    } else {
    $temp = "2";
    }

  } else {
    $temp = "3";
   } 

} else {
  $temp = "4";
   }
   
  $link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>註冊</title>
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

<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign up</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

    <div class="login-form">
      <div class="sign-in-htm">

  <?php if ($temp == 1): ?>

<form method="post" action="register2.php">
        <div class="group">
          <label for="id" class="label"></label>
          <input id="id" type="hidden" name="id" value = "<?php echo $id ?>">
          <label for="password" class="label"></label>
          <input id="password" type="hidden" name="password" value = "<?php echo $password ?>">
          <label for="email" class="label"></label>
          <input id="email" type="hidden" name="email" value = "<?php echo $email ?>">
        </div>
        <div class="group">
          <label for="nickname" class="label"><font color="yellow">* </font>nickname</label>
          <input id="nickname" type="text" name="nickname" class="input">
        </div>
        <div class="group">
          <label for="tel" class="label"><font color="yellow">* </font>phone</label>
          <input id="tel" type="text" name="tel" class="input">
        </div>
        <div class="group">
          <label for="birth" class="label"><font color="yellow">* </font>birth</label>
          <input id="birth" type="date" name="birth" class="input">
        </div>
        <div class="group">
          <label for="intro" class="label">introduction</label>
          <input id="intro" type="text" name="intro" class="input">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Next">
        </div>
</form>        

<?php elseif ($temp == 2): ?>
  <form method="post" action="register.php">
        <div class="group">
          <label for="id" class="label"><font color="yellow">* </font>id</label>
          <input id="id" type="text" name="id" class="input">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Password</label>
          <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Repeat Password</label>
          <input id="password" type="password" name="repassword" class="input" data-type="password">
          <label class="label"><font color="red"><b>The passwords you entered do not match</b></font></label>
        </div>
        <div class="group">
          <label for="email" class="label"><font color="yellow">* </font>Email Address</label>
          <input id="email" type="email" name="email" class="input">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Next">
        </div>
  </form>     

  <?php elseif ($temp == 3): ?>
  <form method="post" action="register.php">
        <div class="group">
          <label for="id" class="label"><font color="yellow">* </font>ID</label>
          <input id="id" type="text" name="id" class="input">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Password</label>
          <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Repeat Password</label>
          <input id="password" type="password" name="repassword" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="email" class="label"><font color="yellow">* </font>Email Address</label>
          <input id="email" type="email" name="email" class="input">
          <label class="label"><font color="red"><b>Some fields are missing</b></font></label>
        </div>
        <div class="group">
          <input type="submit" class="button" value="Next">
        </div>
  </form>  

<?php elseif ($temp == 4): ?>
  <form method="post" action="register.php">
        <div class="group">
          <label for="id" class="label"><font color="yellow">* </font>ID</label>
          <input id="id" type="text" name="id" class="input">
          <label class="label"><font color="red"><b>ID entered already in use</b></font></label>
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Password</label>
          <input id="password" type="password" name="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="password" class="label"><font color="yellow">* </font>Repeat Password</label>
          <input id="password" type="password" name="repassword" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="email" class="label"><font color="yellow">* </font>Email Address</label>
          <input id="email" type="email" name="email" class="input">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Next">
        </div>
  </form>      
<?php endif ?>

      </div>
    </div>
  </div>
</div>

<a id='totop' href='homepage.php' style='position: fixed;
      bottom: 110px;
      right: 2vw; z-index: 200;'><img src='icons\home.png' style='width: 50px;
      height: 50px;'></a>


</body>
</html>
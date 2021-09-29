<?php
		session_start();

		$_SESSION["login_session"] = 0;

		unset($_SESSION['id']);
		unset($_SESSION['password']);
		unset($_SESSION['nickname']);
		unset($_SESSION['email']);
		unset($_SESSION['tel']);
		unset($_SESSION['birth']);
		unset($_SESSION['identity']);
		unset($_SESSION['bucket']);
		unset($_SESSION['intro']);
		unset($_SESSION['image']);
		unset($_SESSION['level']);

        echo "<script> {window.alert('Link end!');
              location.href='login.php'} </script>";
?>
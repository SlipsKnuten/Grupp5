<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

<h1 id="header" align="center">Login</h1>

<form method="post" action="">
  <div class="container">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="usrMail" required>
	
	<label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="usrPw" required>
     
	<div class="clearfix">
      <button type="submit" class="signupbtn">Login</button>
    </div>
  </div>
</form>

<?php
	include("connection.php");
	session_start();
	
	if(isset($_POST['usrMail'], $_POST['usrPw'])){
		$mail = mysqli_real_escape_string($dbc,$_POST['usrMail']);
		$password = mysqli_real_escape_string($dbc,$_POST['usrPw']);
		
		$sql = "SELECT * FROM users WHERE usrMail = '$mail'";
		$result = mysqli_query($dbc,$sql);	
		$result = mysqli_query($dbc,$sql);
		$pw = mysqli_fetch_array($result);	
		$currentpw = $pw['usrPw'];
		if(password_verify($password,$currentpw)){
			header("location: my_page.php");

			$_SESSION['logged_in'] = true;
			$test = $_SESSION['logged_in'];
			$js_out = json_encode($test);
			// var_dump($js_out);
			$_SESSION['login_user'] = $mail;
			$users = "SELECT fornamn, efternamn, kon, alder, mobilnr FROM users WHERE usrMail = '$mail'";
			$result = mysqli_query($dbc,$users);	
			var_dump($result);
			$test = mysqli_fetch_array($result);	
			var_dump($test);
			$_SESSION['userInfo'] = $test;
			// $users = $_SESSION['userInfo'];
			// var_dump($result);
			}
		}
		else{
			echo "Invalid password";
		}
	}
?>
</body>
</html>
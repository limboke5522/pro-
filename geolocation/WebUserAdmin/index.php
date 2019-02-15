<?
	foreach ($_GET as $key => $value) 
	{
		$_GET[$key]=addslashes(strip_tags(trim($value)));
	}
	if ($_GET['id'] !='') { $_GET['id']=(int) $_GET['id']; }
	extract($_GET);
?>
<? include "security.php"?>
<?php
session_start();

if(isset($_SESSION['administrator'])!="")
{
	header("Location: administrator-home.php");
}

include_once 'Connections/dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM highadmin WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['administrator'] = $row['user_id'];
		$_SESSION['username'] = $row['name'];
		$_SESSION['userpass'] = $row['password'];
		header("Location: administrator-home.php");
	} else {
		$errormsg = "Incorrect Email or Password!!!";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WebUser ADMINISTRATOR</title>

<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
<link rel="stylesheet" href="css/index.css">

</head>
<body>
<body>
<body class="align">
	<div class="site__container">
    <div class="grid__container">
    	<p class="text--style">
        <font color="#FFFFFF" size="+2"><b>WebUser</b></font>
        <br><b><font color="#999999" size="+3">ADMINISTRATOR</font></b>
        <br>
        <br>
        </p>
      	<form action="index.php" method="post" name="checkForm" id="checkForm" class="form form--login">
        <div class="form__field">
        <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
        <input id="login__username" type="email" class="form__input" placeholder="E-mail" name="email" required autocomplete="off"/>
        </div>
        <div class="form__field">
        <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
        <input id="login__password" type="password" class="form__input" placeholder="Password" name="password" required autocomplete="off"/>
        </div>
        <div class="form__field">
        <input type="submit" name="login" value="log in">
        </div>
        <?php if (isset($errormsg)) { echo $errormsg; } ?>
      	</form>
      	<p class="text--style">
        <br>
        <font size="-1">Copyright © 2017 Artof-WEBSITE. All rights reserved.</font>
        </p>
    </div>
	</div>

</body>
</html>

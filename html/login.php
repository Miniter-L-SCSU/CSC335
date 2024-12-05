

<head>
    <title> CSC335 - Login Page </title>
    <link rel="stylesheet" href="styling.css">
</head>

<?php

session_start();

?>

<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$_SESSION["username"] = $_POST['username'];
	$_SESSION["pass"] = $_POST['password'];
	
	$pass=crypt($_SESSION["pass"],'$1$somethin$');

	//now compare this md5 hash with the stored hashed password for this user (if this user exists)

	// forward the user to home page if login was successful.
	header("Location: home.php");
	
	
}else{

//remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

?>

<div>
<form action="login.php" method="POST" style="position:relative;left:20px;">
	<p>Log in:
	<br />
	<span>Username <input type="Text" name="username"/> </span> 
	<br>
	<br />
	<span>Password <input type="password" name="password"/> </span>
	</p>
	<input type="Submit" value = "Log in"/>
</form>
<p><a href="./create.php">Need an account?</a></p> 
</div>

<?php 
}

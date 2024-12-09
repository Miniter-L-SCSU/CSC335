<?php

session_start();

?>

<?php
    include './connect_to_db.php';

    $db_name = 'shop';

    $conn = get_db_connection($db_name);

?>

<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$_SESSION["username"] = $_POST['username'];
	$_SESSION["pass"] = $_POST['password'];
	
	$pass=crypt($_SESSION["pass"],'$1$somethin$');

	//now compare this md5 hash with the stored hashed password for this user (if this user exists)
	// following code is broken so its commented out
	// it attempts to grab user_id
	
	$stmt = $conn->prepare("SELECT username, user_id, pw FROM User WHERE username=?");
	//$stmt = $conn->prepare($sql); // this might be why the code broke oml
	$stmt->bind_param("s", $_SESSION["username"]);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
			$_SESSION["user_id"] = $row["user_id"];
			
			if ($_SESSION["username"] == $row["username"] AND $_SESSION["pass"] == $row["pw"]){
				header("Location: ./home.php");
			}
			// ideally also add pw checking logic
			else{
				echo "<script> console.log('Incorrect Login Credentials') </script>";
				session_unset(); 
				session_destroy(); 
				header("Location: ./login.php");
			}
		}
		
	} else {
		echo "<script> console.log('Username not found') </script>";
		session_unset(); 
		session_destroy(); 
		header("Location: ./login.php");
	}
	
	//header("Location: ./home.php");

	
}else{
echo "<script> console.log('Logging out') </script>";
//remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

?>

<head>
	<title> CSC335 - Login Page </title>
    <link rel="stylesheet" href="styling.css">
</head>

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

<?php

	//if(!isset($_SESSION)) session_start();
	
	//$user = $_SESSION['username'];
	$user = getUsername();
	
	if($user == null) {
		//not logged in - provide a login form
		//echo "<form action='' method='post' onsubmit='alert(\"logging in. Testing.\");'>";
		echo "<form action='' method='post'>";
		echo "Username: <input type='text' name='username'><br>";
		echo "Password: <input type='password' name='password'><br>";
		echo "<button type='submit' name='action' value='login'>Log in</input>";
		echo "<button type='submit' name='action' value='register' onclick='return window.confirm(\"Do you really want to register?\");'>Register</input></form>";
		//echo "<a href='./register.php'> Not a member? Click here to register! </a>";
	} else {
		//logged in - provide a greeting, as well as profil edit and log out options.
		echo "You are signed in as <b>".$user."</b>.<br>\n";
		echo "<a href='index.php?view=editprofile'> Click here to edit your profile </a>";
		//echo "<form action='' method='post' onsubmit='alert(\"logging out. Testing.\");'>";
		echo "<form action='' method='post' onsubmit=''>";
		echo "<button type='submit' name='action' value='logout'>Log out</input></form>";
	}
?>

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
		echo "<button type='submit' name='action' value='logout'>Log out</button></form>";
		//admin control panel
		//require_once($_SERVER['DOCUMENT_ROOT'].'/model/rights.php');
		require_once('model/rights.php');
		if(canPromote(getUserGroup())) {
			echo "<div style='border-top:1px solid;'>Control panel for promoting/demoting users:<br>\n";
			echo "<form action='' method='post' onsubmit=''>\n";
			echo "Username: <input type='text' name='username' style='width:70px;'>\n";
			echo "<input type='radio' name='admin' title='Ban user' value='banned'>Ban</input>";
			echo "<input type='radio' name='admin' title='Normal user' value='user'>User</input>";
			echo "<input type='radio' name='admin' title='Moderator' value='moderator'>Mod</input>";
			echo "<input type='radio' name='admin' title='Admin' value='administrator'>Admin";
			echo "<button type='submit' name='action' title='Set user to the selected group' value='changeAdmin'>";
			echo "Set</button></form></div>\n";
		}
	}
?>

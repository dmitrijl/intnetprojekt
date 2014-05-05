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
		echo "<button type='submit' name='action' value='login'>Log in</button>";
		//echo "<button type='submit' name='action' value='register' onclick='return window.confirm(\"Do you really want to register?\");'>Register</button></form>";
		echo "<button type='submit' name='action' value='register');'>Register</button></form>";
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
			echo "<div style='border-top:1px solid;font-size:16px'>Promote or demote user:\n";
			echo "<form action='' method='post' onsubmit=''>\n";			
			echo "<input type='radio' name='admin' title='Ban user' value='banned'>Ban";
			echo "<input type='radio' name='admin' title='Normal user' value='user'>User";
			echo "<input type='radio' name='admin' title='Moderator' value='moderator'>Mod";
			echo "<input type='radio' name='admin' title='Admin' value='administrator'>Admin<br>";
			echo "Username: <input type='text' name='username' style='width:70px;'>\n";
			echo "<button type='submit' name='action' title='Set user to the selected group' value='changeAdmin'>";
			echo "Set</button></form></div>\n";
		}
	}
?>

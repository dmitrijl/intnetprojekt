<?php
	
	if(!isset($_SESSION)) session_start();
	
	if (isset($_POST['logout'])) {
		//Log out user
		//echo $_POST['logout'];
		user_logout();
	} else if (isset($_POST['register'])) {
		//Register user
		//echo $_POST['logout'];
		if (isset($_POST['username']) && isset($_POST['password'])) {
			if ($_POST['username'] != "" && $_POST['password'] != "") {
				$register_result = user_register($_POST['username'], $_POST['password']);
				if ($register_result == true) {
					//echo "Registered!";
				} else {
					//echo "Failed to register!";
				}
			} else {
				echo "You must supply username and password.";
			}
		} else {
			//echo "post vars not set";
		}
	} else if (isset($_POST['login'])) {
		//Log in user
		//echo $_POST['login'];
		if (isset($_POST['username']) && isset($_POST['password'])) {
			//User just logged in
			$login_result = user_login($_POST['username'], $_POST['password']);
			if ($login_result == true) {
				//echo "Logged in!";
			} else {
				//echo "Failed to log in!";
			}
		} else {
			//echo "post vars not set";
		}
	}
	
	$user = getUsername();
	
	
	if($user == null) {
		//not logged in - provide a login form
		//echo "<form action='' method='post' onsubmit='alert(\"logging in. Testing.\");'>";
		echo "<form action='' method='post'>";
		echo "Username: <input type='text' name='username'><br>";
		echo "Password: <input type='password' name='password'><br>";
		echo "<input type='submit' name='login' value='Log in'>";
		echo "<input type='submit' name='register' value='Register' onclick='return window.confirm(\"Do you really want to register?\");'></form>";
		//echo "<a href='./register.php'> Not a member? Click here to register! </a>";
	} else {
		//logged in - provide a greeting, as well as profil edit and log out options.
		echo "You are signed in as <b>".$user."</b>.<br>\n";
		echo "<a href='./editprofile.php'> Click here to edit your profile </a>";
		//echo "<form action='' method='post' onsubmit='alert(\"logging out. Testing.\");'>";
		echo "<form action='' method='post' onsubmit=''>";
		echo "<input name='logout' type='submit' value='Log out'></form>";
	}
?>

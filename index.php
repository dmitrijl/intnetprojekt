<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="icon" href="img/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/index.css">


<?php

srand();
session_start();
require 'model/functions.php';

if (isset($_POST['action'])) {

	if ($_POST['action'] == 'login') {

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

	} else if ($_POST['action'] == 'logout') {

		user_logout();
	
	} else if ($_POST['action'] == 'register') {

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

	} else {
		//echo "Unspecified action.";
	}
	
	//Redirect home
	header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
}

?>

</head>

<body>

<?php

include "view/banner.php";

echo "<div style='position:relative;margin: 8px;' >";


if (isset($_POST['post'])) {
	//User just posted
	
	if (isset($_POST['title'])) {
		$createthread_result = createThread($user, $_GET['category'], $_POST['title'], $_POST['message']);
		if ($createthread_result == true) {
			//echo "Successful thread creation!"
		} else {
			//echo "Failed to create thread!"
		}
	} else {
		$createpost_result = createPost($user, $_GET['thread'], $_POST['message']);
		if ($createpost_result == true) {
			//echo "Successful post!"
		} else {
			//echo "Failed to post!"
		}
	}
	
	//Prevent duplicate posts on refresh.
	header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
}



if (!isset($_GET['view']) || $_GET['view'] == 'viewCategories') {
	//No action specified. List categories;
	//echo "viewCategories";
	include 'view/viewCategories.php';
} else if ($_GET['view'] == 'viewForum') {
	//echo "viewForum";
	$_GET["createthread"] = true;
	include 'view/viewForum.php';
	include 'view/createpost.php';
} else if ($_GET['view'] == 'viewThread') {
	//echo "viewThread";
	include 'view/viewThread.php';
	include 'view/createpost.php';
} else if ($_GET['view'] == 'editprofile') {
	//echo "editProfile";
	include 'view/editprofile.php';
} else {
	//echo "Unspecified action.";
}

echo "</div>";







?>



</body>
</html>

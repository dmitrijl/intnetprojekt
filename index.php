<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="icon" href="img/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/index.css">

<?php
require 'model/functions.php';
require 'model/classes.php';
srand();
session_start();



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

	} else if ($_POST['action'] == 'changeAdmin') {
		
		$newAdmin = $_POST['admin'];
		promote($_POST['username'], $newAdmin);
		
	} else {
		//echo "Unspecified action.";
	}
}


if (isset($_POST['lock'])) {
	$threadID = intval($_POST['lock']);
	lockThread($threadID);
} else if (isset($_POST['unlock'])) {
	$threadID = intval($_POST['unlock']);
	unlockThread($threadID);
} else if (isset($_POST['sticky'])) {
	$threadID = intval($_POST['sticky']);
	stickyThread($threadID);
} else if (isset($_POST['unsticky'])) {
	$threadID = intval($_POST['unsticky']);
	unstickyThread($threadID);
} else if (isset($_POST['delete'])) {
	$threadID = intval($_POST['delete']);
	//TODO delete thread
}


if (isset($_POST['editProfile'])) {
	$username = getUsername();
	$password = NULL;
	$avatar = NULL;
	$signature = NULL;

	if (isset($_POST['avatar'])) {
		$avatar = $_POST['avatar'];
	}
	if (isset($_POST['signature'])) {
		$signature = $_POST['signature'];
	}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];
	}
	
	change_userinfo($username,$password,$avatar,$signature);
	//Redirect home
	header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
}


if (isset($_POST['postMode']) && isset($_SESSION['user'])) {
	//User just posted or edited a post
	//var_dump($_POST);
	
	$user = $_SESSION['user']->username;
	
	//var_dump($_GET, $_POST['postMode']);
	
	
	if ($_POST['postMode'] == 'newThread') {
	//if (isset($_POST['title'])) {
		$createthread_result = createThread($user, $_GET['category'], $_POST['title'], $_POST['message']);
		if ($createthread_result == true) {
			//echo "Successful thread creation!"
		} else {
			//echo "Failed to create thread!"
		}
	} else if ($_POST['postMode'] == 'newPost') {
		$createpost_result = createPost($user, $_GET['thread'], $_POST['message']);
		if ($createpost_result == true) {
			//echo "Successful post!"
		} else {
			//echo "Failed to post!"
		}
	} else if ($_POST['postMode'] == 'editPost') {
		$editpost_result = editPost($user, $_GET['thread'], $_SESSION['currentPost']->postSucc, $_POST['message']);
		if ($editpost_result == true) {
			//echo "Successful post!"
		} else {
			//echo "Failed to post!"
		}
	}
	
}


if (sizeof($_POST) > 0) {
	//var_dump($_POST);
	header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
} else {
	//var_dump($_POST);
}


?>

</head>

<body>

<?php

include "view/banner.php";
require_once('view/numlinkfunctions.php');

echo "<div style='position:relative;margin: 8px;' >";

if (!isset($_GET['view']) || $_GET['view'] == 'viewCategories') {	//List categories.

	$_SESSION['categories'] = getCategories();
	include 'view/viewCategories.php';
	
} else if ($_GET['view'] == 'viewForum') { //View the threads of a forum.

	if(isset($_GET["category"])) {
		$categ = $_GET["category"];
	} else {
		$categ = 1;	//Some default value
	}

	$_SESSION['currentCategory'] = getCategory($categ);
	$curCateg = $_SESSION['currentCategory'];
	$categ_name = $curCateg->name;
	
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
		if(is_int(intval($page)) && $page > 0) {
			//do nothing
		} else {
			$page = 1;
		}
	} else {
		$page = 1;
	}
	//echo "<h1>Page is $page</h1>";
	$threadsperpage = 10;
	$max = $page * $threadsperpage;
	$min = $max - $threadsperpage + 1;
	
	$_SESSION['threads'] = getThreads($categ,$min,$threadsperpage,true);
	//$_SESSION['currentCategory'] = getCategory($categ);
	
	include 'view/viewForum.php';
	
	$maxpage=((int)(($curCateg->numThreads)/$threadsperpage))+1;
	numlinks($page, $maxpage, 9, 'index.php', "view=viewForum&category=$categ");
	
	echo "<br />";
	$_POST['postMode'] = 'newThread';
	include 'view/createpost.php';

} else if ($_GET['view'] == 'viewThread') {	//View the posts of a thread.

	if (isset($_GET["thread"])) {
		$thr = $_GET["thread"];
	} else {
		$thr = "1";
	}

	if(isset($_GET["page"])) {
		$page = $_GET["page"];
		if(is_int(intval($page)) && $page > 0) {
			//do nothing
		} else {
			$page = 1;
		}
	} else {
		$page = 1;
	}	

	$postsperpage = 10;
	$max = $page * $postsperpage;
	$min = $max - $postsperpage + 1;

	$_SESSION['currentThread'] = getThread($thr);
	$_SESSION['posts'] = getPosts($thr, $min, $max);
	$_SESSION['currentCategory'] = getCategory($_SESSION['currentThread']->category);

	include 'view/viewThread.php';
	
	//page menu
	$maxpage=((int)(($thread->postCount)/$postsperpage))+1;
	numlinks($page, $maxpage, 9, 'index.php', "view=viewThread&thread=".$thr);

	echo "<br/>";
	$_POST['postMode'] = 'newPost';
	include 'view/createpost.php';
	
} else if ($_GET['view'] == 'editprofile') {	//Edit a user profile.

	if (isset($_SESSION['user'])) {
		//$user = $_SESSION['user'];
		include 'view/editprofile.php';
	} else {
		echo "You are not logged in. What are you doing on this page?";
	}	
	
} else if ($_GET['view'] == 'viewPost') {	//View a single post.
	
	if (isset($_GET["thread"])) {
		$thr = $_GET["thread"];
	} else {
		$thr = 1;
	}

	if(isset($_GET["post"])) {
		$postSucc = $_GET["post"];
	} else {
		$postSucc = 1;
	}
	
	$_SESSION['currentThread'] = getThread($thr);
	$_SESSION['currentPost'] = getPost($thr, $postSucc);
	$_SESSION['currentCategory'] = getCategory($_SESSION['currentThread']->category);
	
	include 'view/viewPost.php';
	
	
	$_POST['postMode'] = 'editPost';
	include 'view/createpost.php';
	
	

} else {
	//echo "Unspecified action.";
	
}

echo "</div>";

?>

</body>
</html>

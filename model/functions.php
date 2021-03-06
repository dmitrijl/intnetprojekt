<?php

require "dbconnection.php";
require_once ("rights.php");

/********************************************'
Functions
see getters.txt for info
*******************************************/

//from http://stackoverflow.com/questions/4323411/php-write-to-console
function debug_to_console( $data ) {
	if ( is_array( $data ) )
		$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	else
		$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	echo $output;
}


function getCategories() {	
	$cats = array();
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('select * from categories');
	$stmt->execute();
	$stmt->bind_result($id, $name, $numthreads);
	$stmt->store_result();
	
	while ($stmt->fetch()) {
		$cats[] = new Category($id, $name, $numthreads);
	}
	//var_dump($cats);
	
	return $cats;
}

function getCategory($catID) {
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT * FROM categories WHERE id = ?');
	$stmt->bind_param('i', $catID);
	$stmt->execute();
	$stmt->bind_result($id, $name, $numthreads);
	$stmt->store_result();
	while ($stmt->fetch()) {
		return new Category($id, $name, $numthreads);
	}
	
	return null;
}

function getThreads($category,$startPost,$amount,$includestickies) {
	//debug_to_console("Calling getThreads, parameters:");
	//debug_to_console("Category: ".$category);
	//debug_to_console("Min: ".$min.". Max: ".$max.". IncludeStickies: ".$includestickies.".");
	$startPost -= 1;
	
	$threads = array();
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT * FROM threads WHERE category = ? ORDER BY sticky DESC, timestamp DESC LIMIT ? OFFSET ?');
	$stmt->bind_param('iii', $category, $amount, $startPost);
	$stmt->execute();
	$stmt->bind_result($threadID, $category, $title, $op, $postCount, $timestamp, $locked, $sticky);
	$stmt->store_result();
	
	while ($stmt->fetch()) {
		$threads[] = new Thread($threadID, $category, $title, $op, $postCount, $timestamp, $locked, $sticky);
	}
	//var_dump($threads);
	
	return $threads;
}


function getStickiedThreads($category) {
	debug_to_console("Calling getStickiedThreads on thread: ".$category.".");

	$t2 = new Thread(3,"Blueberries",'Rules',"roger",1,"2014-03-17-14-14",true,true);

	return array($t2);
}

function getThread($threadID) {
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT * FROM threads WHERE threadID = ?');
	$stmt->bind_param('i', $threadID);
	$stmt->execute();
	$stmt->bind_result($threadID, $category, $title, $op, $postCount, $timestamp, $locked, $sticky);
	$stmt->store_result();
	while ($stmt->fetch()) {
		return new Thread($threadID, $category, $title, $op, $postCount, $timestamp, $locked, $sticky);
	}
	
	return null;
}


function getPosts($threadID,$min,$max) {
	/*
	debug_to_console("Calling getPosts, parameters:");
	debug_to_console("threadID: ".$threadID);
	debug_to_console("Min: ".$min.". Max: ".$max.".");
	*/

	$posts = array();
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	//$stmt->prepare('SELECT * FROM posts WHERE threadID = 1 AND postSucc >= 1 AND postSucc <= 10 ORDER BY postSucc ASC');
	$stmt->prepare('SELECT * FROM posts INNER JOIN users WHERE threadID = ? AND postSucc >= ? AND postSucc <= ? AND posts.poster = users.username ORDER BY postSucc ASC');
	$stmt->bind_param('ddd', $threadID, $min, $max);
	$stmt->execute();
	$stmt->bind_result($threadID, $postSucc, $poster, $message, $timestamp,
		$username,$password,$salt,$admin,$avatar,$signature,$postCount);
	
	$stmt->store_result();
	
	while ($stmt->fetch()) {
		$tmpUser = new User($username,$password,$salt,$admin,$avatar,$signature,$postCount);
		$posts[] = new Post($threadID, $postSucc, $tmpUser, $message, $timestamp);
	}
	//var_dump($posts);
	
	return $posts;
}


function getPost($threadID,$postSucc) {
	return getPosts($threadID, $postSucc, $postSucc)[0];
}


function getUserInfo($name) {
	debug_to_console("Calling getUserInfo on username ".$name.".");
	
	$users = array();
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->bind_param('s', $name);
	$stmt->execute();
	$stmt->bind_result($username,$password,$salt,$admin,$avatar,$signature,$postCount);
	$stmt->store_result();
	
	if ($stmt->fetch()) {
		//$users = new User($username,$password,$salt,$admin,$avatar,$signature,$postCount);
		$users = new User($username,'',$salt,$admin,$avatar,$signature,$postCount);	//Hide password
		return $user;
		//var_dump($user);
	}
	
	return NULL;
}


function getUserGroup() {
	debug_to_console("Calling getUserGroup.");
	if (isset($_SESSION['username']) && (md5($_SESSION['username']) == $_SESSION['encrypted_name'])) {
		return $_SESSION['admin'];
	} else {
		return 'guest';
	}
}

function getUsername() {
	debug_to_console("Calling getUsername.");
	if(isset($_SESSION['username'])) {
		return $_SESSION['username'];
	} else {
		return null;
	}
	
}


function getCategoryName($catID) {
	$categories = array('Blueberries',
	'Comfortable furniture',
	'Laser cannons specifically designed for highly humid conditions');
	return $categories[$catID-1];
}


function editPost($username, $threadID, $postSucc, $message) {
	debug_to_console("Calling createPost(".$username.",".$threadID.",".$postSucc,",".$message.".");
	
	$thread = getThread($threadID);
	$admin = getUserGroup();
	
	if ($thread->locked == 0 || $admin == 'administrator') {
		$admin = getUserGroup();
	
		//var_dump($message, $threadID, $postSucc, $username, $admin);

		$mysqli = dbconnect();
		$stmt = $mysqli->stmt_init();
		$query = "UPDATE posts SET message = ? WHERE threadID = ? AND postSucc = ? AND (poster = ? OR 'administrator' = ?)";
		$stmt->prepare($query);
		$stmt->bind_param('sddss', $message, $threadID, $postSucc, $username, $admin);
		$stmt->execute() or die ('Could not edit post, lol3.');
		return true;
	} else {
		return false;
	}
}



function createPost($username, $threadID, $message) {
	debug_to_console("Calling createPost(".$username.",".$threadID.",".$message.".");
	
	$mysqli = dbconnect();
	$postSuccQuery = "SELECT numPosts, locked FROM threads WHERE threadID = ?";
	//$threadID = 2;
	$stmt = $mysqli->stmt_init();
	$stmt->prepare($postSuccQuery);
	$stmt->bind_param('d', $threadID);
	$stmt->execute() or die ('Could not find postSucc value');
	$stmt->bind_result($postSucc, $lock);

	$stmt->store_result();
	$stmt->fetch();
	
	if ($lock == 1) {
		//Cannot post in locked threads
		return false;
	}
	
	$postSucc += 1;
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('INSERT INTO posts VALUES (?, ?, ?, ?, NOW())');
	$stmt->bind_param('ddss', $threadID, $postSucc, $username, $message);
	
	//echo "$threadID, $postSucc, $username, $message<br/>";
	
	$stmt->execute() or die ('Could not create post, lol1.');
	return true;
}


function createThread($username, $category, $title, $message) {
	debug_to_console("Calling createThread(".$username.",".$category.",".$title.".");
	
	$mysqli = dbconnect();
	$threadIDQuery = "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'projForum' AND TABLE_NAME = 'threads'";
	$stmt = $mysqli->stmt_init();
	$stmt->prepare($threadIDQuery);
	$stmt->execute() or die ('Could not find next threadID');
	$stmt->bind_result($threadID);
	$stmt->store_result();
	$stmt->fetch();
	
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('INSERT INTO threads VALUES (?, ?, ?, ?, 0, NOW(), false, false)');
	$stmt->bind_param('ddss', $threadID, $category, $title, $username);
	$stmt->execute() or die ('Could not create thread');
	
	//Create first post
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('INSERT INTO posts VALUES (?, 1, ?, ?, NOW())');
	$stmt->bind_param('dss', $threadID, $username, $message);
	$stmt->execute() or die ('Could not create post, lol2.');
}



function promote($username, $newAdmin) {
	if (getUserGroup() == "administrator") {

		$mysqli = dbconnect();
		$stmt = $mysqli->stmt_init();
		$stmt->prepare('UPDATE users SET admin = ? WHERE username = ?');
		$stmt->bind_param('ss', $newAdmin, $username);
		$stmt->execute() or die ('Could not change stickiness of thread');

		return true;
	} else {
		return false;
	}
}


function stickyThread($threadID) {
	toggleThreadSticky($threadID, 1);
}

function unstickyThread($threadID) {
	toggleThreadSticky($threadID, 0);
}

function lockThread($threadID) {
	toggleThreadLock($threadID, 1);
}

function unlockThread($threadID) {
	toggleThreadLock($threadID, 0);
}


function toggleThreadSticky($threadID, $sticky) {
	if (canStickyThread(getUserGroup())) {
		$mysqli = dbconnect();
		$stmt = $mysqli->stmt_init();
		$stmt->prepare('UPDATE threads SET sticky = ? WHERE threadID = ?');
		$stmt->bind_param('ii', $sticky, $threadID);
		$stmt->execute() or die ('Could not change stickiness of thread');
	}
}


function toggleThreadLock($threadID, $locked) {
	if (canStickyThread(getUserGroup())) {
		$mysqli = dbconnect();
		$stmt = $mysqli->stmt_init();
		$stmt->prepare('UPDATE threads SET locked = ? WHERE threadID = ?');
		$stmt->bind_param('ii', $locked, $threadID);
		$stmt->execute() or die ('Could not change stickiness of thread');
	}
}





// Salt Generator
function generate_salt() {
	$salt = '';

	for ($i = 0; $i < 3; $i++) {
		$salt .= chr(rand(35, 126));
	}
	return $salt;
}


//function user_register($username, $password, $emailaddress) {
function user_register($username, $password) {
	$salt = generate_salt();
	$encryptedPassword = md5(md5($password).$salt);
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('INSERT INTO users VALUES (?, ?, ?, "user", "default.png", "...", 0)');
	$stmt->bind_param('sss', $username, $encryptedPassword, $salt);
	$stmt->execute() or die ('Could not create new user');
	/*$stmt = $mysqli->stmt_init();
	$stmt->prepare('INSERT INTO savedmessages VALUES (?, NULL,NULL,NULL,NULL)');
	$stmt->bind_param('s', $username);
	$stmt->execute() or die ('Could not create new user');*/
}

function saveThread($user,$category,$title,$message) {
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('UPDATE savedmessages SET category = ?, title = ?, message1 = ? WHERE username = ?');
	$stmt->bind_param('dsss', $category, $title, $message, $user);
	$stmt->execute() or die ('Could not save thread');
}

function savePost($user,$thread,$message) {
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('UPDATE savedmessages SET threadID = ?, message2 = ? WHERE username = ?');
	$stmt->bind_param('dss', $thread, $message,$user);
	$stmt->execute() or die ('Could not save post');
}

function getSavedThread($user, $category) {
	//var_dump($user, $category);
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT title,message1 FROM savedmessages WHERE username = ? AND category = ?');
	$stmt->bind_param('sd', $user, $category);
	$stmt->execute() or die ('Could not save post');
	//$title = "";
	$stmt->bind_result($title,$message);
	$stmt->store_result();
	//var_dump($title,$message);
	$tmp = $stmt->fetch();
	//var_dump($tmp);
	if($tmp) {
		$saved = new SavedThread($title,$message);
		return $saved;
	} else {
		//echo "FETCH NULL";
		return null;
	}
}

function getSavedMessage($user,$thread) {
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT message2 FROM savedmessages WHERE username = ? AND threadID = ?');
	$stmt->bind_param('sd', $user, $thread);
	$stmt->execute() or die ('Could not save post');
	$stmt->bind_result($message);
	$stmt->store_result();
	if($stmt->fetch()) {
		return $message;
	} else {
		return null;
	}
}

function change_userinfo($req_username,$req_password,$req_avatar,$req_signature) {

	$users = array();
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->bind_param('s', $req_username);
	$stmt->execute();
	$stmt->bind_result($username,$password,$salt,$admin,$avatar,$signature,$postCount);
	$stmt->store_result();
	
	if ($stmt->fetch()) {
		$user = new User($username,$password,$salt,$admin,$avatar,$signature,$postCount);
	}

	if ($req_password == NULL) {
		$req_password = $user->password;
		$req_salt = $user->salt;
	} else {
		$req_salt = generate_salt();
		$req_password = md5(md5($req_password).$req_salt);
	}
	if ($req_avatar == NULL) {
		$req_avatar = $user->avatar;
	}
	if ($req_signature == NULL) {
		$req_signature = $user->signature;
	}

	$stmt = $mysqli->stmt_init();
	$stmt->prepare('UPDATE users SET password = ?, salt = ?, avatar = ?, signature = ? WHERE username = ?');
	$stmt->bind_param('sssss', $req_password,$req_salt,$req_avatar,$req_signature,$req_username);
	$_SESSION['user'] = new User($username,$req_password,$req_salt,$admin,$req_avatar,$req_signature,$postCount);
	$stmt->execute() or die ('Could not update user info properly');
}


function user_login($req_username, $req_password) {
	$mysqli = dbconnect();
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
	$stmt->bind_param('s', $req_username);
	$stmt->execute();
	$stmt->bind_result($username,$password,$salt,$admin,$avatar,$signature,$postCount);
	$stmt->store_result();
	
	if ($stmt->fetch()) {
		//$user = new User($username,$password,$salt,$admin,$avatar,$signature,$postCount);
		$user = new User($username,'','',$admin,$avatar,$signature,$postCount); //Hide password, salt
	}

	$encrypted_pass = md5(md5($req_password).$salt);
	
	//echo "$encrypted_pass<br/>";
	//echo "$password<br/>";
	
	if ($password == $encrypted_pass) {
		//Success!
		$encrypted_name = md5($user->username);
		//session_start();
		$_SESSION['user'] = $user;
		$_SESSION['username'] = $user->username;
		$_SESSION['encrypted_name'] = $encrypted_name;
		$_SESSION['admin'] = $user->admin;
		return true;
	} else {
		return false;
	}
}


function user_logout() {
	// End the session and unset all vars
	session_unset();
	session_destroy();
}


?>


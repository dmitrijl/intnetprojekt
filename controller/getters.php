<?php
//getters.php
//holds classes and functions for getting data
/***********************************
CLASSES
************************************/

class Category {
	public $id;
	public $name;
	public $numThreads;

	function __construct($id,$name,$numthreads) {
		$this->id = $id;
		$this->name = $name;
		$this->numthreads = $numthreads;
	}
}

class Thread {
	public $threadID;
	//public $category = 'cats';
	public $title;
	public $op;
	public $postCount;
	public $timestamp;
	public $locked;
	public $sticky;
	
	function __construct($threadID, $title, $op, $postCount, $timestamp, $locked, $sticky) {
		$this->threadID = $threadID;
		$this->title = $title;
		$this->op = $op;
		$this->postCount = $postCount;
		$this->timestamp = $timestamp;
		$this->locked = $locked;
		$this->sticky = $sticky;
	}
	
}

class Post {
	public $threadID = 0;
	public $postSucc = 1;
	public $postID = 0;
	public $poster = "intelligent person";
	public $message = 'No';
	public $timestamp = 'now';
}

class User {
	public $username = 'idrott';
	public $password = 'pass';
	public $group = 'user';
	public $avatar = 'avatars/cat.png';
	public $signature = 'The cake is a lie';
	public $postCount = 4;
}

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



function getCategories($mysqli) {
	/*
	$cat1 = new Category();
	$cat1->id = 1; $cat1->name = 'Animals'; $cat1->numthreads=2;
	$cat2 = new Category();
	$cat2->id = 2; $cat2->name = 'Vikings'; $cat2->numthreads=1;
	$cat3 = new Category();
	$cat3->id = 3; $cat3->name = 'Computers'; $cat3->numthreads=1;

	$ret = array($cat1,$cat2,$cat3);
	return $ret;
	*/
	
	
	/*
	$query = "select * from categories";
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$stmt->store_result();
	
	$cats = array();
	
	if($stmt->num_rows == 0) {
		echo ("Location: home?errormsg=notfound");
	}
	
	//$c = count($cats);
	$c = $stmt->num_rows;
	echo ("Got here $c");
	
	return $cats;
	*/
	
	$cats = array();
	
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('select * from categories');
	
	$stmt->execute();
	$stmt->bind_result($id, $name, $numthreads);
	//$result = array();
	//$result = $stmt->get_result();
	
	$stmt->store_result();
	while ($stmt->fetch()) {
		$cats[] = new Category($id, $name, $numthreads);
	}

	//var_dump($cats);
	
	return $cats;
	
}


function getThreads($mysqli,$category,$min,$max,$includestickies) {
//function getThreads($mysqli) {
	//debug_to_console("Calling getThreads, parameters:");
	//debug_to_console("Category: ".$category);
	//debug_to_console("Min: ".$min.". Max: ".$max.". IncludeStickies: ".$includestickies.".");

	
	
	$t1 = new Thread();
	$t1->threadID = 1; $t1->title = 'TIL the sky is blue.'; $t1->op="roger";
	$t1->postCount = 2; $t1->timestamp = "2014-03-17-23-22"; $t1->locked=false; $t1->sticky=false; 

	$t2 = new Thread();
	$t2->threadID = 2; $t2->title = 'Need help'; $t2->op="terminator";
	$t2->postCount = 3; $t2->timestamp = "2014-03-17-13-14"; $t2->locked=false; $t2->sticky=false; 

	$ret = array($t1,$t2);
	return $ret;
	
	
	/*
	$threads = array();
	
	$stmt = $mysqli->stmt_init();
	$stmt->prepare('select * from threads');
	
	$stmt->execute();
	$stmt->bind_result($threadID, $title, $op, $postCount, $timestamp, $locked, $sticky);
	//$result = array();
	//$result = $stmt->get_result();
	
	$stmt->store_result();
	while ($stmt->fetch()) {
		$threads[] = new Thread($threadID, $title, $op, $postCount, $timestamp, $locked, $sticky);
	}

	var_dump($threads);
	
	return $threads;
	*/
	
}


function getStickiedThreads($category) {
	debug_to_console("Calling getStickiedThreads on thread: ".$category.".");

	$t2 = new Thread();
	$t2->threadID = 3; $t2->title = 'Rules'; $t2->op="roger";
	$t2->postCount = 1; $t2->timestamp = "2014-03-17-14-14"; $t2->locked=true; $t2->sticky=true; 
}


function getPosts($threadID,$min,$max) {
	debug_to_console("Calling getPosts, parameters:");
	debug_to_console("threadID: ".$threadID);
	debug_to_console("Min: ".$min.". Max: ".$max.".");

	$p1 = new Post();
	$p1->threadID = 1; $p1->postSucc = 1; $p1->postID = 1;
	$p1->poster = "roger"; $p1->message = "I live in London..."; $p1->timestamp="2014-03-17-13-11";

	$p2 = new Post();
	$p2->threadID = 1; $p2->postSucc = 2; $p2->postID = 2;
	$p2->poster = "terminator"; $p2->message = "hahahahaha\n\ngood one"; $p2->timestamp="2014-03-17-23-22";
}


function getUserInfo($name) {
	debug_to_console("Calling getUserInfo on username ".$name.".");

	$u = new User();
	if($name == "terminator") {
		$u->username='terminator';
		$u->group='user';
		$u->avatar='./avatars/anarchy.png';
		$u->signature='There is no problem that cannot be solved with explosives.';
		$u->postCount=4;
	} else {
		$u->username='roger';
		$u->group='moderator';
		$u->avatar='./avatars/TALogo.png';
		$u->signature='I am the best.';
		$u->postCount=3;
	}

	return $u;
}


function getUserGroup() {
	debug_to_console("Calling getUserGroup.");
	return "moderator";
}


function getUsername() {
	debug_to_console("Calling getUsername.");
	return "roger";
}















// Old reused functions from basketcamp

// Salt Generator
function generate_salt() {
	$salt = '';

	for ($i = 0; $i < 3; $i++) {
		$salt .= chr(rand(35, 126));
	}
	return $salt;
}


function is_authed() {
	// Check if the encrypted username is the same as the
	// unencrypted one. If it is, it hasn't been changed.
	if (isset($_SESSION['username']) && (md5($_SESSION['username']) == $_SESSION['encrypted_name'])) {
		return true;
	} else {
		return false;
	}
}


function is_admin() {
	if (is_authed() && ($_SESSION['title'] == 'admin')) {
		return true;
	} else {
		return false;
	}
}


function user_register($username, $password, $firstname, $lastname, $yearofbirth, $monthofbirth, $dateofbirth, $address, $city, $zipcode, $homephonenumber, $cellphonenumber, $emailaddress, $basketballclub) {
	
	// Encrypt password with salt
	$salt = generate_salt();
	$encrypted = md5(md5($password).$salt);

	// Write to database
	$query = "insert into user (username, password, salt, title, firstname, lastname, yearofbirth, monthofbirth, dateofbirth, address, city, zipcode, homephonenumber, cellphonenumber, emailaddress, basketballclub) values ('$username', '$encrypted', '$salt', 'member', '$firstname', '$lastname', '$yearofbirth', '$monthofbirth', '$dateofbirth', '$address', '$city', '$zipcode', '$homephonenumber', '$cellphonenumber', '$emailaddress', '$basketballclub')";
	mysql_query ($query) or die ('Kunde inte skapa anv&auml;ndare.');
}


function change_userinfo( $password, $firstname, $lastname, $yearofbirth, $monthofbirth, $dateofbirth, $address, $city, $zipcode, $homephonenumber, $cellphonenumber, $emailaddress, $basketballclub) {
	// Encrypt password with salt
	$salt = generate_salt();
	$encrypted = md5(md5($password).$salt);

	// Write to database
	$query = "update user set password='$encrypted', salt='$salt', firstname='$firstname', lastname='$lastname', yearofbirth='$yearofbirth', monthofbirth='$monthofbirth', dateofbirth='$dateofbirth', address='$address', city='$city', zipcode='$zipcode', homephonenumber='$homephonenumber', cellphonenumber='$cellphonenumber', emailaddress='$emailaddress', basketballclub='$basketballclub' where userid='$_SESSION[userid]'";
	mysql_query ($query) or die ('Kunde inte ändra personuppgifter.');
}


function user_login($username, $password) {
	$query = "select salt from user where username='$username' limit 1";
	$result = mysql_query($query);
	$user = mysql_fetch_array($result);

	$encrypted_pass = md5(md5($password).$user['salt']);

	$query = "select userid, username, title, firstname, lastname, yearofbirth, monthofbirth, dateofbirth, address, city, zipcode, homephonenumber, cellphonenumber, emailaddress, basketballclub from user where username='$username' and password='$encrypted_pass'";
	$result = mysql_query($query);
	$user = mysql_fetch_array($result);
	$numrows = mysql_num_rows($result);

	$encrypted_id = md5($user['userid']);
	$encrypted_name = md5($user['username']);

	$_SESSION['userid'] = $user['userid'];
	$_SESSION['username'] = $username;
	$_SESSION['encrypted_id'] = $encrypted_id;
	$_SESSION['encrypted_name'] = $encrypted_name;
	$_SESSION['title'] = $user['title'];
	$_SESSION['firstname'] = $user['firstname'];
	$_SESSION['lastname'] = $user['lastname'];
	$_SESSION['yearofbirth'] = $user['yearofbirth'];
	$_SESSION['monthofbirth'] = $user['monthofbirth'];
	$_SESSION['dateofbirth'] = $user['dateofbirth'];
	$_SESSION['address'] = $user['address'];
	$_SESSION['city'] = $user['city'];
	$_SESSION['zipcode'] = $user['zipcode'];
	$_SESSION['homephonenumber'] = $user['homephonenumber'];
	$_SESSION['cellphonenumber'] = $user['cellphonenumber'];
	$_SESSION['emailaddress'] = $user['emailaddress'];
	$_SESSION['basketballclub'] = $user['basketballclub'];

	if ($numrows == 1) {
		return 'Correct';
	} else {
		return false;
	}
}


function user_logout() {
	// End the session and unset all vars
	session_unset ();
	session_destroy ();
}










?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<div style="background-color:#cc00cc;border:1px solid">
<?php



if ($_POST['postMode'] == 'newThread') {

	if (!isset($_SESSION['user'])) {
		echo "You cannot create new threads.";
	} else {
		echo "<form action='' method='post'>";
		echo "Write title here.<br/>";
		echo "<textarea rows='1' cols='80' name='title'></textarea><br/>";
		echo "Write your message here.<br/>";
		echo "<textarea rows='6' cols='80' name='message'></textarea>";
		echo "<br /><button type='submit' name='postMode' value='newThread'>Post</button></form>";
	}

} else if ($_POST['postMode'] == 'newPost') {
	
	if (!isset($_SESSION['user'])) {
		echo "You cannot post in this thread.";
	} else if ($_SESSION['currentThread']->locked == 1) {
		echo "You cannot post in locked threads.";
	} else {
		echo "<form action='' method='post'>";
		echo "Write your message here.<br/>";
		echo "<textarea rows='6' cols='80' name='message'></textarea>";
		echo "<br /><button type='submit' name='postMode' value='newPost'>Post</button></form>";
	}

} else if ($_POST['postMode'] == 'editPost') {
	
	if (!isset($_SESSION['user'])) {
		echo "You cannot edit posts.";
	} else if ($_SESSION['user']->username == $_SESSION['currentPost']->poster->username || 
	$_SESSION['user']->admin == 'administrator') {
		echo "<form action='' method='post'>";
		echo "Write the new message here.<br/>";
		echo "<textarea rows='6' cols='80' name='message'></textarea>";
		echo "<br /><button type='submit' name='postMode' value='editPost'>Post</button></form>";
	} else {
		//var_dump($_SESSION['user']);
		//var_dump($_SESSION['currentPost']);
		echo "You cannot edit this post.";
	}
	
}

?>

</div>
</body>
</html>

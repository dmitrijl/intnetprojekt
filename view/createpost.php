<div class='createpost'>
<?php

if ($_POST['postMode'] == 'newThread') {

	if (!isset($_SESSION['user'])) {
		echo "You cannot create new threads.";
	} else {
		$uname = getUsername();
		$savedThread = null;
		if($uname != null) {
			$savedThread = getSavedThread($uname,$curCateg->id);
		}
		//echo "Uname: ".$uname."<br>";
		//echo "savedThread: ".$savedThread."<br>";
		//echo "categ id:".$curCateg->id;
		
		echo "<form action='' method='post'>";
		echo "Write title here.<br/>";
		echo "<textarea rows='1' cols='80' name='title'>";
		if($savedThread != null) {
			echo $savedThread->title;
		}
		echo"</textarea><br/>";
		echo "Write your message here.<br/>";
		echo "<textarea rows='6' cols='80' name='message'>";
		if($savedThread != null) {
			echo $savedThread->message;
		}
		echo "</textarea>";
		echo "<br /><button type='submit' name='postMode' value='newThread'>Post</button>";
		echo "<button type='submit' name='saveMode' value='saveThread' ";
		echo "onclick='return window.confirm(\"Warning! If you have a post previously saved you will lose that! Are you sure you want to save?\");' ";
		echo "title='Saves the currently typed text so that you can continue working on it the next time you visit the category.'>";
		echo "Save thread</button></form>\n";
	}

} else if ($_POST['postMode'] == 'newPost') {
	
	if (!isset($_SESSION['user'])) {
		echo "You cannot post in this thread.";
	} else if ($_SESSION['currentThread']->locked == 1) {
		echo "You cannot post in locked threads.";
	} else {
		$uname = getUsername();
		$savedMessage = null;
		if($uname != null) {
			$savedMessage = getSavedMessage(getUsername(),$_SESSION['currentThread']->threadID);
		}
		//echo $savedMessage."<br>";
		echo "<form action='' method='post'>";
		echo "Write your message here.<br/>";
		echo "<textarea rows='6' cols='80' name='message'>";
		if($savedMessage != null) {
			echo $savedMessage;
		}
		echo "</textarea>";
		echo "<br /><button type='submit' name='postMode' value='newPost'>Post</button>";
		echo "<button type='submit' name='saveMode' value='savePost' ";
		echo "onclick='return window.confirm(\"Warning! If you have a thread previously saved you will lose that! Are you sure you want to save?\");' ";
		echo "title='Saves the currently typed text so that you can continue working on it the next time you visit this thread.'>";
		echo "Save post</button></form>\n";
	}

} else if ($_POST['postMode'] == 'editPost') {
	
	if (!isset($_SESSION['user'])) {
		echo "You cannot edit posts.";
	} else if ($_SESSION['user']->username == $_SESSION['currentPost']->poster->username || 
	$_SESSION['user']->admin == 'administrator') {
		echo "<form action='' method='post'>";
		echo "Write the new message here to edit this post.<br/>";
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


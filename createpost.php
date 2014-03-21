<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
</head>

<body>

<div style="background-color:#cc00cc;border:1px solid">
	<?php
		//session_start();
		//include 'model/functions.php';
		
		$user = getUsername();
		
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

		if($user != null) {
			//logged in - provide a post form
			echo "<form id='createpost' action='' method='post'>";
			
			//Provide title field if new thread
			if (isset($_GET['createthread'])) {
				if ($_GET['createthread'] == true) {
					echo "Write title here.<br/>";
					echo "<textarea rows='1' cols='80' name='title' form='createpost'></textarea><br/>";
				}
			}
			
			echo "Write your message here.<br/>";
			echo "<textarea rows='6' cols='80' name='message' form='createpost'></textarea>";
			echo "<br /><input type='submit' name='post' value='Post'>";
		} else {
			if (isset($_GET['createthread']) && $_GET['createthread'] == true) {
				echo "You cannot create new threads in this forum.";
			} else {
				echo "You cannot post in this thread.";
			}
		}
		
		
	?>
</div>
</body>
</html>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
</head>

<body>

<div style="background-color:#cc00cc;border:1px solid">
	<?php
		session_start();
		
		$user = getUsername();
		
		if (isset($_POST['post'])) {
			//User just posted
			
			$createpost_result = createPost($user, $_GET['thread'], $_POST['message']);
			if ($createpost_result == true) {
				//echo "Successful post!"
			} else {
				//echo "Failed to post!"
			}
			
			//Prevent duplicate posts on refresh.
			header("Location: " . $_SERVER['REQUEST_URI']);
		  exit();
		}

		if($user != null) {
			//logged in - provide a post form
			echo "Write your message here.";
			echo "<form id='createpost' action='' method='post'>";
			echo "<textarea rows='6' cols='80' name='message' form='createpost'></textarea>";
			echo "<br /><input type='submit' name='post' value='Post'>";
		} else {
			echo "You cannot post in this thread.";
		}
		
		
	?>
</div>
</body>
</html>

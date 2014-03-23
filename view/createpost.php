<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<div class="createpost">
	<?php
		//session_start();
		//include 'model/functions.php';
		
		$user = getUsername();
		//$user = $_SESSION['username'];

		if($user != null) {
			//logged in - provide a post form
			echo "<form id='createpost' action='' method='post'>";
			
			//Provide title field if new thread
			if (isset($_GET['createthread'])) {
				if ($_GET['createthread'] == true) {
					echo "Write title here.<br/>";
					echo "<textarea rows='1' cols='120' name='title' form='createpost'></textarea><br/>";
				}
			}
			
			echo "Write your message here.<br/>";
			echo "<textarea rows='6' cols='120' name='message' form='createpost'></textarea>";
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

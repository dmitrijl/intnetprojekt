<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
</head>
<body>
<div style="background-color:#cc00cc;border:1px solid">
<?php
	
if ($_POST['postMode'] == 'newThread') {

	echo "<form action='' method='post'>";
	echo "Write title here.<br/>";
	echo "<textarea rows='1' cols='80' name='title'></textarea><br/>";
	echo "Write your message here.<br/>";
	echo "<textarea rows='6' cols='80' name='message'></textarea>";
	echo "<br /><button type='submit' name='postMode' value='newThread'>Post</button></form>";

} else if ($_POST['postMode'] == 'newPost') {
	
	echo "<form action='' method='post'>";
	echo "Write your message here.<br/>";
	echo "<textarea rows='6' cols='80' name='message'></textarea>";
	echo "<br /><button type='submit' name='postMode' value='newPost'>Post</button></form>";

} else if ($_POST['postMode'] == 'editPost') {
	
	echo "<form action='' method='post'>";
	echo "Write the new message here.<br/>";
	echo "<textarea rows='6' cols='80' name='message'></textarea>";
	echo "<br /><button type='submit' name='postMode' value='editPost'>Post</button></form>";

}

?>
</div>
</body>
</html>

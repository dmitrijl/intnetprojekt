<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<style>
#banner {
	position: absolute;
	top: 0px;
	left: 0px;
	right: 0px;
	width: 100%;
	height: 120px;
}

#top {
	top: 0px;
	left: 0px;
	right: 0px;
	width: 100%;
	height: 120px;
}

#title {
	width: 100%;
	height: 100px;
	background-color: yellow; <!-- ONLY TEMPORARY REMOVE LATER -->
}

h1 {
	font-size: 24px;
	text-align:center;
}

category {
	font-size: 16px;
	font-family: verdana;
}
<<<<<<< HEAD

<div id=top>
	<img id="banner" src="./banner.png" href="./frontpage.php" />
</div>
</head>

<?php
require 'init.php';
require 'controller/getters.php';
?>

<body>
<div id="title">
	<h1> Welcome to our intnet14 project </h1>
	<div style="position:relative; width:250px; height:80px; margin-left:auto; margin-right:20px; top: -35px; background-color:white;">
		<?php
			$user = getUsername();
			if($user == null) {
				//not logged in - provide a login form
				echo "<form action='' method='post' onsubmit='alert(\"loggar in. Ej implementerat.\");'>";
				echo "Username: <input type='text' name='username'><br>";
				echo "Password: <input type='password' name='pwd'><br>";
				echo "<input type='submit' value='Login'></form>";
			} else {
				//logged in - provide a greeting.
				echo "You are signed in as <b>".$user."</b>.<br>\n";
				echo "<a href='./editprofile.php'> Click here to edit your profile </a>";				
			}
		?>
	</div>
</div>
<h2> Choose a category! </h2>

<?php
$cats = getCategories();

foreach($cats as $cat) {
	echo "<div><p><category>\n";
	echo "<a href='forum.php?category=".$cat->id."'>".$cat->name."</a><br>\n";
	echo "</category></p></div>\n\n";
}

?>

</body>
</html>

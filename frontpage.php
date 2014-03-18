<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<style>
#banner {
	top: 0px;
	left: 0px;
	right: 0px;
	width: 100%;
	height: 120px;
}

h1 {
	font-size: 24px;
	text-align:center;
}

category {
	font-size: 16px;
	font-family: verdana;
}
</style>
<div>
<img id="banner" src="./banner.png" href="./frontpage.php" />
</div>
</head>

<body>
<h1> Welcome to our intnet14 project </h1>
<br>
<h2> Choose a category! </h2>

<?php

require 'controller/getters.php';

$cats = getCategories();

$i = 1;
foreach($cats as $cat) {
	echo "<div><p><category>\n";
	echo "<a href='forum.php?category=".$cat->id."'>".$cat->name."</a><br>\n";
	echo "</category></p></div>\n\n";
	$i += 1;
}

?>

</body>
</html>

<!DOCTYPE html>
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

#title {
	width: 100%;
	height: 160px;
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
<img id="banner" src="./img/banner.png" href="./frontpage.php" />
</div>
</head>

<body>
<div id="title">
<h1> Welcome to our intnet14 project </h1>

</div>




<br>
<h2> Choose a category! </h2>

<?php


require 'controller/getters.php';
require 'init.php';


$cats = getCategories($mysqli);


foreach($cats as $cat) {
	echo "<div><p><category>\n";
	echo "<a href='forum.php?category=".$cat->id."'>".$cat->name."</a><br>\n";
	echo "</category></p></div>\n\n";
}

?>

</body>
</html>

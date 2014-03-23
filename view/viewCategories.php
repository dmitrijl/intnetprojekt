<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>

<div id="title">
	<!--<h1> Welcome to our intnet14 project </h1>-->
	<div class='titlebanner'>
		<img src="img/green-banner.png"></img>
	</div>
</div>
<h2> Choose a category! </h2>

<?php

if (!isset($_SESSION['categories'])) {
	$_SESSION['categories'] = getCategories();
} else {
	//echo "cats wasset";
}

$cats = $_SESSION['categories'];

foreach($cats as $cat) {
	echo "<div><p><category>\n";
	echo "<a href='index.php?view=viewForum&category=".$cat->id."'>".$cat->name."</a><br>\n";
	echo "</category></p></div>\n\n";
}

?>

</body>
</html>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>

<div id="title">
	<h1> Welcome to our intnet14 project </h1>

</div>
<h2> Choose a category! </h2>

<?php

$cats = getCategories();

foreach($cats as $cat) {
	echo "<div><p><category>\n";
	echo "<a href='index.php?action=viewForum&category=".$cat->id."'>".$cat->name."</a><br>\n";
	echo "</category></p></div>\n\n";
}

?>

</body>
</html>
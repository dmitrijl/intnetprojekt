<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<div id="banner">
<p> WELCOME TO THE JUNGLE </p>
</div>
</head>

<body>

<?php

include 'init.php';
include 'controller/getters.php';

$cats = getCategories();

$i = 1;
foreach($cats as $cat) {
	echo "<a href='forum.php?category=$i'>$cat->name<br>";
	//echo "<a href='forum.php?category=$i'>$cat<br>";
	$i += 1;
}

?>

</body>
</html>

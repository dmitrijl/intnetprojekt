<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>


<?php

//require 'init.php';
require 'model/functions.php';
include 'banner.php';

if(isset($_GET["category"])) {
	$categ = $_GET["category"];
} else {
	$categ = "BEST CATEGORY EVER!!";
}

if(isset($_GET["page"])) {
	$page = $_GET["page"];
	if(is_int($page) && $page > 0) {
		//do nothing
	} else {
		$page = 1;
	}
} else {
	$page = 1;
}
$threadsperpage = 10;
$max = $page * $threadsperpage;
$min = $max - $threadsperpage + 1;

$threads = getThreads($categ,$min,$max,false);
//$stickies = getStickiedThreads($categ);
//$threads = getThreads($mysqli);

echo "<h1> Category: $categ</h1>";

$i = 1;
foreach($threads as $th) {
	//echo "<a href='thread.php?thread=$i'>$th<br>";
	echo "<div class='thread";
	if( $i % 2 == 0) {
		echo " everyother";
	}
	echo "'>";
		echo "<a href='thread.php?thread=$i'>$th->title</a>";
	echo " by $th->op";
	echo "</div>\n";
	$i++;
}


echo '<br>';

echo "<a href='createpost.php?createthread=true&category=$categ'>Create Thread</a>";
?>

</body>
</html>

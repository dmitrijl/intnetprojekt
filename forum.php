<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<style>
.col1 {
	width:15%;
}

.col2 {
	width:45%;
}

.col3 {
	width:15%;
}

.col4 {
	width:15%;
}

.smallborder {
	border:1px solid black;
}

</style>
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

echo "<table style='width:80%;border:1px solid black;'>\n";
echo "<tr> <td class='col1 smallborder'>Author</td>";
echo "<td class='col2 smallborder'>Title</td>";
echo "<td class='col3 smallborder'>Controls</td>";
echo "<td class='col4 smallborder'>Last post at</td></tr>\n";

//$i = 1;
foreach($threads as $th) {
	echo "<tr> <td class='col1 smallborder'><b>$th->op</b></td>";
	echo "<td class='col2 smallborder'><a href='thread.php?thread=".$th->threadID."'>".$th->title."</a></td>";
	//echo "<td class='col2 smallborder'><a$th->title</td>";
	echo "<td class='col3 smallborder'>TODO</td>";
	echo "<td class='col4 smallborder'>$th->timestamp</td></tr>";
}

echo "</table>";
echo '<br>';

echo "<a href='createpost.php?createthread=true&category=$categ'>Create Thread</a>";
?>

</body>
</html>

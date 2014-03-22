<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<style>
.col1 {
	width:14%;
}

.col2 {
	width:45%;
}

.col3 {
	width:15%;
}

.col4 {
	width:3%;
}

.col5 {
	width:13%;
}

.smallborder {
	border:1px solid black;
}

</style>
</head>

<body>


<?php

//require 'init.php';
//require 'model/functions.php';
require $_SERVER['DOCUMENT_ROOT'].'/model/rights.php';


if(isset($_GET["category"])) {
	$categ = $_GET["category"];
} else {
	$categ = "BEST CATEGORY EVER!!";
}

//$_GET["createthread"] = true;
//include 'createpost.php';

$categ_name = getCategoryName($categ);

if(isset($_GET["page"])) {
	$page = $_GET["page"];
	if(is_int(intval($page)) && $page > 0) {
		//do nothing
	} else {
		$page = 1;
	}
} else {
	$page = 1;
}
//echo "<h1>Page is $page</h1>";
$threadsperpage = 10;
$max = $page * $threadsperpage;
$min = $max - $threadsperpage + 1;

$threads = getThreads($categ,$min,$max,false);
//$stickies = getStickiedThreads($categ);
//$threads = getThreads($mysqli);

echo "<h1>Category: <a href='./index.php?action=viewForum&category=$categ'>$categ_name</a></h1>";

echo "<table style='width:90%;border:1px solid black;'>\n";
echo "<tr> <td class='col1 smallborder'>Author</td>";
echo "<td class='col2 smallborder'>Title</td>";
echo "<td class='col3 smallborder'>Controls</td>";
echo "<td class='col4 smallborder'>Posts</td>\n";
echo "<td class='col5 smallborder'>Last post at</td></tr>\n";

//$i = 1;
foreach($threads as $th) {
	//author
	echo "<tr> <td class='col1 smallborder'><b>$th->op</b></td>\n";
	//title
	echo "<td class='col2 smallborder'>";
	if($th->sticky) {
		echo "  <img src='img/sticky.png' style='width:14px;height:14px;' title='stickied thread'></img>";
	}
	if($th->locked) {
		echo "  <img src='img/locked.png' style='width:14px;height:14px;' title='locked thread'></img>";
	}
	echo "<a href='index.php?action=viewThread&thread=".$th->threadID."'>".$th->title."</a></td>\n";

	
	//echo "<td class='col2 smallborder'><a$th->title</td>";
	//controls
	echo "<td class='col3 smallborder'>";
	
	//delete thread
	if(canDeleteThread(getUserGroup())) {
		echo "<button type='button' onclick='if(confirm(\"Are you sure you want to delete this thread?\")) ";
		echo "alert(\"Deleting thread, not implemented.\")' style='width:33%;height:25px;font-size:12px;'>Delete</button>";
	} 
	if(canStickyThread(getUserGroup())) {
		echo "<button type='button' onclick='alert(\"not implemented yet\")' style='width:33%;height:25px;font-size:12px;'>";
		if($th->sticky) {
			echo "Unsticky";
		} else {
			echo "Sticky";
		}
		echo "</button>";
	} 
	if(canLockThread(getUserGroup())) {
		echo "<button type='button' onclick='alert(\"not implemented yet\")' style='width:33%;height:25px;font-size:12px;'>";
		if($th->locked) {
			echo "Unlock";
		} else {
			echo "Lock";
		}
		echo "</button>";
	} 
	echo "</td>\n";
	//numPosts
	echo "<td class='col4 smallborder'>$th->postCount</td>";
	//timestamp
	echo "<td class='col5 smallborder'>$th->timestamp</td></tr>";
}

echo "</table>";
echo '<br>';

//echo "<a href='createpost.php?createthread=true&category=$categ'>Create Thread</a>";


?>

</body>
</html>

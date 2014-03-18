<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>

</head>

<body>


<?php

require 'init.php';
require 'controller/getters.php';

echo '<div id="banner">';

if(isset($_GET["category"])) {
	$categ = $_GET["category"];
} else {
	$categ = "BEST CATEGORY EVER!!";
}
echo "<p> WELCOME TO THE VIEW OF THREADS IN CATEGORY NR $categ</p>";

echo '</div>';


$threads = array(
	"Thread 1",
	"Thread 2",
	"Thread 3");

$threads = getThreads($mysqli, $categ,NULL,NULL,true);
//$threads = getThreads($mysqli);

$i = 1;
foreach($threads as $th) {
	//echo "<a href='thread.php?thread=$i'>$th<br>";
	echo "<a href='thread.php?thread=$i'>$th->title</a>";
	echo " by $th->op";
	echo "<br>";
	$i++;
}


echo '<br>';

echo "<a href='createpost.php?createthread=true&category=$categ'>Create Thread</a>";
?>

</body>
</html>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>



<body>

<div id="banner">
<?php

//require 'init.php';
require 'model/functions.php';
include 'banner.php';
//echo "<a href='createpost.php?createthread=false&thread=$thr'>Create post</a>";
include 'createpost.php';

if(isset($_GET["thread"])) {
	$thr = $_GET["thread"];
} else {
	$thr = "BEST THREAD EVER!!";
}
echo "<p>WELCOME TO THE VIEW OF POSTS IN THREAD NR $thr</p>";
?>
</div>
<?php

$posts = getPosts($thr, 1, 10);


echo "<h1>Category: <a href='./forum.php?category=$categ'>$categ_name</a></h1>";



foreach($posts as $post) {
	echo "<div style='border:2px solid;background-color:cyan'><b>".$post->poster.":</b>";
	echo "".$post->timestamp."";
	echo "<div style='top:0px;left:0px;background-color:white'>"."[avatar here]"."</div>";
	echo "".$post->message."</div>";
	//echo "<td class='col2 smallborder'><a$th->title</td>";
}

echo "</table>";
echo '<br>';


?>

</body>
</html>

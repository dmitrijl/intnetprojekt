<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>



<body>

<div id="banner">
<?php

//require 'init.php';
//require 'model/functions.php';
//include 'banner.php';
//echo "<a href='createpost.php?createthread=false&thread=$thr'>Create post</a>";
//include 'createpost.php';

if (isset($_GET["thread"])) {
	$thr = $_GET["thread"];
} else {
	$thr = "BEST THREAD EVER!!";
}
//echo "<p>WELCOME TO THE VIEW OF POSTS IN THREAD NR $thr</p>";
?>
</div>
<?php

$posts = getPosts($thr, 1, 10);


//echo "<h1>Category: <a href='./forum.php?category=$categ'>$categ_name</a></h1>";


/*
foreach ($posts as $post) {
echo "<div>";
echo "<dl>";
echo "<dt>";

$imgpath = "img/avatars/"."admin.png";
echo '<img src='.$imgpath.' />';

echo "</dl>";
echo "</dt>";
echo "</div>";
}
*/



foreach ($posts as $post) {
	//User info bar
	echo "<div style='margin-top:-1px;padding: 2px;background-color:cyan;";
	//echo "border-left:1px solid #cccccc;";
	//echo "border-bottom:1px solid #cccccc;";
	//echo "border-top:1px solid #cccccc;";
	//echo "border-right:1px solid #cccccc;";
	echo "border:1px solid #eeeeee;'>";
	//echo "border: 4px solid;' >";
	echo "<b>".$post->poster."&nbsp; &nbsp; </b>".$post->timestamp;;
	echo "</div>";
	
	//Avatar + message
	echo "<div style='background-color: #f4f4ff;margin-top:-1px;border:1px solid #eeeeee; overflow: auto;'>";
	
	//Avatar
	echo "<div style='padding: 5px;float:left;'>";
	$imgpath = "img/avatars/"."admin.png";
	//echo $imgpath . "<br/>";
	echo "<img src=".$imgpath." />";
	echo "</div>";
	
	//Messsage
	echo "<div style='padding: 5px;float:left;'>".$post->message."</div>";
	
	echo "</div>";
	//echo "<br/>";
}


//echo "</table>";
echo '<br>';


?>

</body>
</html>

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


foreach($posts as $post) {
	//echo "<p>$post</p>";
	echo "<p><b>$post->poster:</b> ";
	echo "$post->message</p>";
}

?>

</body>
</html>

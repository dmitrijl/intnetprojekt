<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<div id="banner">
<?php

require 'init.php';
require 'controller/getters.php';

if(isset($_GET["thread"])) {
	$thr = $_GET["thread"];
} else {
	$thr = "BEST THREAD EVER!!";
}
echo "<p>WELCOME TO THE VIEW OF POSTS IN THREAD NR $thr</p>";
?>
</div>
</head>

<body>

<?php
$posts = array(
	"Post 1",
	"Post 2",
	"Post 3");

$posts = getPosts($mysqli, $thr, 1, 10);

foreach($posts as $post) {
	echo "<br>";
	//echo "<p>$post</p>";
	echo "<p>$post->message</p>";
	echo "<br>";
}

?>
<br>
<?php
echo "<a href='createpost.php?createthread=false&thread=$thr'>Create post</a>";
?>

</body>
</html>

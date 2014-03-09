<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<div id="banner">
<?php

if(isset($_GET["thread"])) {
	$thr = $_GET["thread"];
} else {
	$thr = "BEST THREAD EVER!!";
}
echo "<p> WELCOME TO THE VIEW OF POSTS IN THREAD NR $thr</p>";
?>
</div>
</head>

<body>

<?php
$posts = array(
	"Post 1",
	"Post 2",
	"Post 3");

foreach($posts as $post) {
	echo "<p> $post </p>";
}

?>
<br>
<?php
echo "<a href='createpost.php?createthread=false&thread=$thr'> Create post </a>";
?>

</body>
</html>
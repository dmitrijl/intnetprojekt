<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<div id="banner">
<p> WELCOME TO THE JUNGLE </p>
</div>
</head>

<body>

<?php
$cats = array(
	"Category 1",
	"Category 2",
	"Category 3");

$i = 1;
foreach($cats as $cat) {
	echo "<a href='forum.php?category=$i'> $cat <br>";
	$i += 1;
}

?>

</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<div id="banner">
<?php

if(isset($_GET["category"])) {
	$categ = $_GET["category"];
} else {
	$categ = "BEST CATEGORY EVER!!";
}
echo "<p> WELCOME TO THE VIEW OF THREADS IN CATEGORY NR $categ</p>";
?>
</div>
</head>

<body>

<?php
$threads = array(
	"Thread 1",
	"Thread 2",
	"Thread 3");

$i = 1;
foreach($threads as $th) {
	echo "<a href='thread.php?thread=$i'> $th <br>";
	$i++;
}

?>
<br>
<?php
echo "<a href='createpost.php?createthread=true&category=$categ'> Create Thread </a>";
?>

</body>
</html>
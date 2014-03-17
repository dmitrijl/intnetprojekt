<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<div id="banner">

TEST POST PLEASE IGNORE

</div>
</head>

<body>

<?php
if($_GET["createthread"] == "true") {
	$cat = $_GET["category"];
	echo "create thread in category $cat";
} else {
	$thread = $_GET["thread"];
	echo "create post in thread $thread";
}
?>


</body>
</html>

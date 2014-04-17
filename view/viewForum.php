<!--
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>

-->

<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/view/numlinkfunctions.php'); 
//require_once($_SERVER['DOCUMENT_ROOT'].'/model/rights.php');
require_once('model/rights.php');
require_once('view/numlinkfunctions.php'); 
?>



<!--
</head>
<body>
-->

<?php

$threads = $_SESSION['threads'];


//echo "<div> <a href='index.php'>Home</a> </div>\n";
echo "<br/><a href='index.php'>Home</a> ->";
echo "$categ_name";
//echo "<a href='./index.php?view=viewForum&category=$categ'>$categ_name</a><br/><br/>";


echo "<table id='table'>\n";
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
		echo "  <img src='img/sticky.png' style='width:14px;height:14px;' title='stickied thread' alt=''>";
	}
	if($th->locked) {
		echo "  <img src='img/locked.png' style='width:14px;height:14px;' title='locked thread' alt=''>";
	}
	echo "<a href='index.php?view=viewThread&thread=".$th->threadID."'>".$th->title."</a></td>\n";

	
	//echo "<td class='col2 smallborder'><a$th->title</td>";
	//controls
	echo "<td class='col3 smallborder'>";
	
	//delete thread
	echo "<form action='' method='post'>";
	if(canDeleteThread(getUserGroup())) {
		echo "<button class='controlbtn' value=".$th->threadID." name='delete' type='submit' onclick='if(confirm(\"Are you sure you want to delete this thread?\")) ";
		echo "alert(\"Deleting thread, not implemented.\")' '>Delete</button>";
	} 
	if(canStickyThread(getUserGroup())) {
		$sticky = NULL;
		if($th->sticky) {
			$sticky = "Unsticky";
		} else {
			$sticky = "Sticky";
		}
		echo "<button class='controlbtn' value=".$th->threadID." name='".strtolower($sticky)."' type='submit' onclick=''>";
		echo $sticky;
		echo "</button>";
	}
	if(canLockThread(getUserGroup())) {
		$lock = NULL;
		if($th->locked) {
			$lock = "Unlock";
		} else {
			$lock = "Lock";
		}
		echo "<button class='controlbtn' value=".$th->threadID." name='".strtolower($lock)."' type='submit' onclick=''>";
		echo $lock;
		echo "</button>";
	} 
	echo "</form>";
	echo "</td>\n";
	//numPosts
	echo "<td class='col4 smallborder'>$th->postCount</td>";
	//timestamp
	echo "<td class='col5 smallborder'>$th->timestamp</td></tr>";
}
echo "</table>";
echo '<br>';

?>

<!--
</body>
</html>
-->

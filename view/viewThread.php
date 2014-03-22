<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/viewThreads.css">
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

$thread = getThread($thr);
$category = getCategory($thread->category);
echo "<div> <a href='index.php'>Home</a> -&gt ";
echo "<a href='index.php?view=viewForum&category=".$thread->category."'>".$category->name."</a></div>\n";
echo "<h1>".$thread->title."</h1>";

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
	$user = $post->poster;
	
	echo "<div class='post'>";
	echo "<div class='topbar'>";
	//echo "<div style='margin-top:-1px;padding: 2px;background-color:cyan;";
	//echo "border:1px solid #eeeeee;'>";
	//echo "border: 4px solid;' >";
	echo "<b>".$user->username."&nbsp; &nbsp; </b>".$post->timestamp;
	//echo "   ".$user->admin."   Posts: ".$user->postCount;
	echo "</div>\n";
	
	echo "<table class='postbodytable'>";
		echo "<tr class='postbodytr'>\n";
			echo "<td class='posterinfo'>";
				$imgpath = "img/avatars/".$user->avatar;
				echo "<img src=".$imgpath." class='avatar' /><br>";
				echo "<div class='postername'>".$user->username."</div><br>";
				echo "<div class='posteradmin'>User group: ".$user->admin."</div><br>";
				echo "<div class='posterpostcount'>Posts: ".$user->postCount."</div>";
				echo "<div class='rest'>Just filling</div>";
			echo "</td>\n";
			echo "<td class='postmessage'>";
				echo nl2br($post->message);
			echo "</td>\n";
		echo "</tr>";
	echo "</table>\n";
	echo "</div>";
	echo "<div class='signature'>";
		echo nl2br($user->signature);
	echo "</div>";
	//Avatar + message
	//echo "<div style='background-color: #f4f4ff;margin-top:-1px;border:1px solid #eeeeee; overflow: auto;'>";
		//echo "<div class='postbody'>";
	//Avatar
			//echo "<div style='padding: 5px;float:left;'>";
	//$imgpath = "img/avatars/"."admin.png";
	//$imgpath = "img/avatars/".$user->avatar;
	//echo $imgpath . "<br/>";
	//echo "<img src=".$imgpath." />";
	//echo "</div>";
	
	//Messsage
	//echo "<div style='padding: 5px;'><p style='text-spacing:none;'>";
	//echo nl2br($post->message)."</p></div>";
	
	//echo "<hr/>";
	//echo $user->signature;
	//echo "<br/>";
	//echo "</div>";
	//echo "<br/>";
}


//echo "</table>";
echo '<br>';


?>

</body>
</html>

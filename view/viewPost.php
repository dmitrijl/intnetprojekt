<div id="banner">
<?php



//echo "<p>WELCOME TO THE VIEW OF POSTS IN THREAD NR $thr</p>";
?>
</div>
<?php


$post = $_SESSION['currentPost'];
$thread = $_SESSION['currentThread'];
$category = $_SESSION['currentCategory'];

echo "<div> <a href='index.php'>Home</a> -&gt ";
echo "<a href='index.php?view=viewForum&category=".$thread->category."'>".$category->name."</a> -&gt ";
echo "<a href='index.php?view=viewThread&thread=".$thread->threadID."'>".$thread->title."</a></div>\n";

echo "<h1>".$thread->title."</h1>";

$user = $post->poster;

echo "<div class='post'>";
echo "<div class='topbar'>";
echo "<b>".$user->username."&nbsp; &nbsp; </b>".$post->timestamp."&nbsp; &nbsp;";
echo "</div>\n";

echo "<table class='postbodytable'>";
	echo "<tr class='postbodytr'>\n";
		echo "<td class='posterinfo'>";
			$imgpath = "img/avatars/".$user->avatar;
			echo "<img src=".$imgpath." class='avatar' alt=""/><br>";
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



?>


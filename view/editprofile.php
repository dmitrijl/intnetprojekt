<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<?php
//require '../model/functions.php';
//require 'model/functions.php';
?>

<script>
function validateForm()
{
//checks for empty username, empty password, and that passwords match.
//DOES NOT check if username is unique.

var form=document.forms["changepass"];
var pass1 = form["newpass1"].value;
var pass2 = form["newpass2"].value;

if (pass1 != pass2) {
	alert("The passwords do not match!");
	return false;
}
if (pass1 == null || pass1 == "") {
	alert("Cannot have an empty password!");
	return false;
}
alert("Password ok. Not implemented yet.");
}
</script>


</head>

<body>
<h1> Edit your Profile </h1>
<h2> You can change your password, upload an avatar, and change signature. </h2>
<br><br>
<div class="edit" style="width=100%;height:200px;">
	<p class="title">Upload an avatar!</p>
	<div style="position:relative">
		<form action="" method="post" enctype="multipart/form-data" onsubmit="alert('Uploading file. Not implemented yet.')">
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Upload and change!">
		</form>
<?php
		$userarray = getUserInfo(getUsername());
		if(count($userarray) > 0) {
			$user = getUserInfo(getUsername())[0];
		} else {
			$user = null;
		}
		//echo "USER: ".$user;

		if($user != null) {
			$avatar = $user->avatar;
			if($avatar == null || $avatar == "") {
				echo "<p>You have no avatar currently uploaded</p>";
			} else {
				echo "<div style='position:relative;top:-50px;left:300px;'>";
				echo "<p style='vertical-align:text-middle'>Current avatar:</p>";
				echo "<img src='img/avatars/".$avatar."' style='width:100px;height:100px;'></img></div>";
			}
		} else {
			echo "You are not logged in what are you doing on this page?";
		}
?>
	</div>
</div>

<br><br><br>
<div class="edit" style="width=100%;height:200px;">
	<p class="title">Change your signature</p>
	<textarea rows="6" cols="80" name="comment" form="usrform">
<?php
if($user != null) {
	$signature = $user->signature;
	if($signature != null) {
		echo "".$signature;
	}
} else {
	echo "You are not logged in what are you doing on this page.";
}
?>
</textarea>
	<form id="sigform" action="" method="post" enctype="multipart/form-data" onsubmit="alert('Changing signature.')">
		<input type="submit" name="submit" value="Change!">
	</form>
</div
<br><br><br>
<div class="edit" style="width=100%;height:200px;">
	<p class="title">Change your password</p>
	<form name="changepass" action="" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
		New password: <input type="password" name="newpass1"><br>
		New password repeated: <input type="password" name="newpass2"><br>
		<input type="submit" name="submit" value="Change!">
	</form>
</div>
<br><br><br>

</body>
</html>


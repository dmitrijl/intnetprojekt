<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/editProfile.css">
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
//alert("Password ok. Not implemented yet.");
}
</script>
</head>

<body>
<div> <a href='index.php'>Home</a> </div>
<h1> Edit your Profile </h1>
<h2> You can change your password, upload an avatar, and change signature. </h2>
<br><br>
<div class="edit" style="width=100%">
<p class="title">Change avatar!</p>
<div style="position:relative">
<!--<form action="" method="post" enctype="multipart/form-data" onsubmit="alert('Uploading file. Not implemented yet.')">-->
<form action="" method="post" enctype="multipart/form-data" onsubmit="">
<!--<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<button type="submit" name="editProfile" value="changeAvatar">Upload and change!</button>-->

<?php

//$user = getUserInfo(getUsername());

$user = $_SESSION['user'];

if($user != null) {
	$avatar = $user->avatar;
	if($avatar == null || $avatar == "") {
		echo "<p>You have no avatar currently uploaded</p>";
	} else {
		echo "<div style='position:relative;'>";
		echo "<p style='vertical-align:text-middle'>Current avatar:</p>";
		echo "<img src='img/avatars/".$avatar."' style='width:100px;height:100px;'></img></div>";
	}
}

$directory = "img/avatars/";

//get all pictures with a .png extension.
$pics = glob($directory . "*.png");

echo "<br />";
echo "<p style='vertical-align:text-middle'>Choose a new avatar:</p>";

//print each file name
foreach($pics as $pic) {
	echo '<input type="radio" name="avatar" value="'.substr($pic, strlen($directory)).'">';
	echo '<img src="'.$pic.'" width="32px" height="32px" >';
}
echo "<br />";

?>
<button type="submit" name="editProfile" value="changeAvatar">Change!</button>
</form>

</div>
</div>

<br><br><br>
<div class="edit" style="width=100%;">
<form action="" method="post" enctype="multipart/form-data" onsubmit="alert('Changing signature.')">
<p class="title">Change your signature</p>
<textarea rows="6" cols="80" name="signature">
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
<br />
<button type="submit" name="editProfile" value="changeSignature">Change!</button>
</form>
</div>
<br><br><br>
<div class="edit" style="width=100%;">
	<p class="title">Change your password</p>
	<form name="changepass" action="" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
		New password: <input type="password" name="password"><br>
		New password repeated: <input type="password" name="password2"><br>
		<button type="submit" name="editProfile" value="changePassword">Change!</button>
	</form>
</div>
<br><br><br>

</body>
</html>
